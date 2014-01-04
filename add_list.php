<?php
	session_start();
	if( $_SESSION['id'] == "" )
	{
		header("Location: index.php");
		die();
	}

	require("config/config.php");

	$id = $_SESSION['id'];

	// check the time is not collision , only select permit
	$check_time = $mysqli->prepare("SELECT date,time,loc,admin_result FROM dorm_list
									WHERE date = ? AND loc = ? AND admin_result = 'permit'");
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
			$_SESSION['in_fail'] = 1;
			header("Location:insert_fail.php");
			die();
		}
		else if( ( $insm + $insh * 60 >= $sm + $sh * 60 ) &&
				 ( $insm + $insh * 60 < $em + $eh * 60 ))
		{
			$_SESSION['in_fail'] = 1;
			header("Location:insert_fail.php");
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
		die();
	}
	else
	{
		 $_SESSION['in_fail'] = 2;
		header("Location:insert_fail.php");
		die();
	}

?>
