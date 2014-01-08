<?php
	session_start();
	if( !isset($_SESSION['id']) && $_SESSION['id'] != "SE" )
	{
		header("Location:login.php");
		die();
	}
	
	// http://tw1.php.net/checkdate
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	/***********check it hava POST data & it's vaild input ***************/
	if( !isset($_POST['date']) || !isset($_POST['time']) || !isset($_POST['loc']) ||
		!isset($_POST['club']) || !isset($_POST['pm']) || !isset($_POST['name']) ||
		!isset($_POST['phone']) || !isset($_POST['attend']) || !isset($_POST['aname']) )
	{
		$_SESSION['in_fail'] = 3;
		header("Location:admin_insert_fail.php");
		die();
	}
	else if( !validateDate( $_POST['date'] , 'Y-m-d' ) ) // check date format is correct
	{
		$_SESSION['in_fail'] = 4;
		header("Location:admin_insert_fail.php");
		die();
	}
	
	// check date
	date_default_timezone_set('Asia/Taipei');
	$borrowday = date("Y-m-d" , strtotime($_POST['date']) );
	$today = date("Y-m-d");
	
	$thirtyday = date("Y-m-d" , mktime( 0 , 0 , 0 , date("m") , date("d") + 30 , date("Y") ));
	if( $borrowday > $thirtyday || $borrowday < $today )
	{
		$_SESSION['in_fail'] = 6;
		header("Location:admin_insert_fail.php");
		die();
	}
	
	$str_time = $_POST['time'];
	$insh = (int)substr( $str_time , 0 , 2 );
	$insm = (int)substr( $str_time , 2 , 2 );
	$ineh = (int)substr( $str_time , 4 , 2 );
	$inem = (int)substr( $str_time , 6 , 2 );
	if(( $insh > $ineh ) || (( $insh == $ineh ) && ( $insm >= $inem )))
	{
		$_SESSION['in_fail'] = 5;
		header("Location:admin_insert_fail.php");
		die();
	}

	require("config/config.php");
	$mysqli2 = new mysqli( $server , $server_id, $server_pwd , $server_name);
	
	if ($mysqli2->connect_errno) {
		    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	}

	$id = $_SESSION['id'];	// sid use $id

	// check the time is not collision , only select permit
	$check_time = $mysqli->prepare("SELECT date,time,loc,admin_result FROM dorm_list
									WHERE date = ? AND loc = ? AND admin_result = 'permit'");
	$check_time->bind_param("ss" , $_POST['date'] , $_POST['loc'] );
	$check_time->execute();
	$check_time->bind_result($no,$gettime,$no,$no);

	while( $check_time->fetch() )
	{
		$str_time=$gettime;
		$sh = (int)substr( $str_time , 0 , 2 );
		$sm = (int)substr( $str_time , 2 , 2 );
		$eh = (int)substr( $str_time , 4 , 2 );
		$em = (int)substr( $str_time , 6 , 2 );

		if( ( $insm + $insh * 60 < $sm + $sh * 60 ) &&
			( $inem + $ineh * 60 > $sm + $sh * 60 ))
		{
			$_SESSION['in_fail'] = 1;
			header("Location:admin_insert_fail.php");
			die();
		}
		else if( ( $insm + $insh * 60 >= $sm + $sh * 60 ) &&
				 ( $insm + $insh * 60 < $em + $eh * 60 ))
		{
			$_SESSION['in_fail'] = 1;
			header("Location:admin_insert_fail.php");
			die();
		}
	}

	$check_time->close();
	// deny all the other loc in time collision
	$stmt = $mysqli->prepare("SELECT id,date,time,loc,admin_result FROM dorm_list
							  WHERE date = ? AND loc = ? AND admin_result = 'wait' ");
	$stmt->bind_param("ss", $_POST['date'] , $_POST['loc'] );
	$stmt->execute();
	$stmt->bind_result($getid,$no,$gettime,$no,$no);

	$deny_list = $mysqli2->prepare("UPDATE dorm_list SET admin_name = '機器人(自動)' ,admin_date = NOW() ,admin_result = 'deny' ,admin_reason = '已有重疊場次申請' WHERE id = ?");
	$deny_list->bind_param("i", $getid );

	while( $stmt->fetch() )
	{
		$str_time=$gettime;
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
	

	// insert data
	$stmt = $mysqli->prepare("INSERT INTO dorm_list(date,time,loc,club,pm,name,
				              phone,sid,attend,bdate,btime,admin_name,admin_date,admin_result) VALUES
				              ( ? , ? , ? , ? , ? , ? , ? , ? , ? , CURDATE() , CURTIME() , ? , NOW() , 'permit' )");
	if( !($stmt->bind_param( "ssssssssis" , $_POST['date'] ,  $_POST['time'] , $_POST['loc'] ,
										   $_POST['club'] , $_POST['pm'] , $_POST['name'] ,
										   $_POST['phone'] , $id , $_POST['attend'] , 
										   $_POST['aname'] ) ))
	{
		echo "Prepare failed (" . $mysqli->errno . ") " . $mysqli->error;
		header("Location:insert_fail.php");
		die();
	}
	
	if( $stmt->execute() )
	{
		// $stmt->exit();
		header("Location:admin_insert_success.php");
		die();
	}
	else
	{
		 $_SESSION['in_fail'] = 2;
		header("Location:admin_insert_fail.php");
		die();
	}

?>
