<?php
	session_start();
	if( $_SESSION['id'] == "" )
	{
		header("Location: index.php");
		die();
	}

	require("config/config.php");

	$id = $_SESSION['id'];

	// check the time is not collision
	$check_time = $mysqli->prepare("SELECT date,time,loc,admin_result FROM dorm_list
									WHERE date = ? AND loc = ?");
	$check_time->bind_param("ss" , $_POST['date'] , $_POST['loc'] );
	$check_time->execute();
	$check_time->bind_result($no,$gettime,$no,$no);

	$str_time = $_POST['time'];
	$insh = (int)substr( $str_time , 0 , 2 );
	$insm = (int)substr( $str_time , 2 , 2 );
	$ineh = (int)substr( $str_time , 4 , 2 );
	$inem = (int)substr( $str_time , 6 , 2 );

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
			echo "時間爆炸";
			die();
		}
		else if( ( $insm + $insh * 60 >= $sm + $sh * 60 ) &&
				 ( $insm + $insh * 60 < $em + $eh * 60 ))
		{
			echo "時間爆炸2";
			die();
		}
	}

	// insert data
	$stmt = $mysqli->prepare("INSERT INTO dorm_list(date,time,loc,club,pm,name,
				              phone,sid,attend,bdate,btime) VALUES
				              ( ? , ? , ? , ? , ? , ? , ? , ? , ? , CURDATE() , CURTIME() )");
	if( !($stmt->bind_param( "ssssssssi" , $_POST['date'] ,  $_POST['time'] , $_POST['loc'] ,
										   $_POST['club'] , $_POST['pm'] , $_POST['name'] ,
										   $_POST['phone'] , $id , $_POST['attend'] )))
	{
		echo "Prepare failed (" . $mysqli->errno . ") " . $mysqli->error;
		header("Location:insert_fail.php");
	}
	
	if( $stmt->execute() )
	{
		// $stmt->exit();
		header("Location:insert_success.php");
	}
	else
	{
		header("Location:insert_fail.php");
	}

	/*
	$query = "INSERT INTO dorm_list(date,time,loc,club,pm,name,
									phone,attend,bdate,btime,sid) VALUES ";
	$data = "'" . $_POST['date'] . "'";
	$data .= ",'" . $_POST['time'] . "'";
	$data .= ",'" . $_POST['loc'] . "'";
	$data .= ",'" . $_POST['club'] . "'";
	$data .= ",'" . $_POST['pm'] . "'";
	$data .= ",'" . $_POST['name'] . "'";
	$data .= ",'" . $_POST['phone'] . "'";
	$data .= "," . $_POST['attend'];
	$data .= "," . "CURDATE()" . "," . "CURTIME()";
	$data .= ",'" . $_SESSION['id'] . "'";
	
	$query .= "(" . $data . ")";
	
	$result = $mysqli->query( $query , MYSQLI_USE_RESULT);
	if( $result )
	{
		header("Location:insert_success.php");
	}
	else
	{
		header("Location:insert_fail.php");
	}
	*/

?>
