<?php
	session_start();
	if( !isset($_SESSION['id']) && $_SESSION['id'] != "SE" )
	{
		header("Location:index.php");
		die();
	}

	if( !isset($_POST['name']) || !isset($_POST['ru']) || !isset($_POST['mid']))
	{
		echo("no input");
	}

	require("config/config.php");
	$mysqli2 = new mysqli( $server , $server_id, $server_pwd , $server_name);
	
	if ($mysqli2->connect_errno) {
		    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	}

	/************************************/
	/*  -1 : no input					*/
	/*	-2 : can't find the input id	*/
	/*  -3 : is already deny		    */

	// find the input data
	if( $_POST['ru'] == "permit" )
	{
		$stmt = $mysqli->prepare("SELECT id,date,time,loc,admin_result FROM dorm_list WHERE id = ?");
		$stmt->bind_param("s", $_POST['mid'] );
		$stmt->execute();
		$stmt->bind_result($input_id,$input_date,$input_time,$input_loc,$input_ru);
		if( !$stmt->fetch() )
		{
			echo ("-2");
			die();
		}
		else if( $input_ru == 'deny' )
		{
			echo ("-3");
			die();
		}
		$stmt->close();

		// find all 'wait' which is collision
		$stmt = $mysqli->prepare("SELECT id,date,time,loc,admin_result
				FROM dorm_list
				WHERE date = ? AND loc = ? AND admin_result = 'wait' ");
		$stmt->bind_param("ss", $input_date , $input_loc );
		$stmt->execute();
		$stmt->bind_result($id,$no,$time,$no,$no);

		$str_time = $input_time;
		$insh = (int)substr( $str_time , 0 , 2 );
		$insm = (int)substr( $str_time , 2 , 2 );
		$ineh = (int)substr( $str_time , 4 , 2 );
		$inem = (int)substr( $str_time , 6 , 2 );

		$deny_list = $mysqli2->prepare("UPDATE dorm_list SET admin_name = '機器人(自動)' ,admin_date = NOW() ,admin_result = 'deny' ,admin_reason = '已有重疊場次申請' WHERE id = ?");
		$deny_list->bind_param("i", $id );

		while( $stmt->fetch() )
		{
			$str_time=$time;
			$sh = (int)substr( $str_time , 0 , 2 );
			$sm = (int)substr( $str_time , 2 , 2 );
			$eh = (int)substr( $str_time , 4 , 2 );
			$em = (int)substr( $str_time , 6 , 2 );
			if( ( $insm + $insh * 60 < $sm + $sh * 60 ) &&
					( $inem + $ineh * 60 > $sm + $sh * 60 ))
			{
				// set result is deny
				$deny_list->execute();
			}
			else if( ( $insm + $insh * 60 >= $sm + $sh * 60 ) &&
					( $insm + $insh * 60 < $em + $eh * 60 ))
			{
				if( $id == $input_id )
				{
					continue;
				}
				// set result is deny
				$deny_list->execute();
			}
		}
		$deny_list->close();
		$stmt->close();
	}
	// update the input is permit
	$stmt = $mysqli->prepare("UPDATE dorm_list SET admin_name = ? ,admin_date = NOW() ,admin_result = ? ,admin_reason = ? WHERE id = ?");

	if( $_POST['ru'] == "permit" )
	{
		$rs = "";
	}
	else
	{
		$rs = $_POST['rs'];
	}

	$stmt->bind_param( "sssi" , $_POST['name'] , $_POST['ru'] , $rs ,$_POST['mid'] );

	if( $stmt->execute() )
	{
		echo ("1");
	}
	else
	{
		echo ("0");
	}

	// $_POST['name']		$_POST['ru']		$_POST['rs']  $_POST['id']

?>
