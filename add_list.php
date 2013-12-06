<?php
	session_start();
	if( $_SESSION['id'] == "" )
	{
		header("Location: index.php");
		die();
	}

	require("config/config.php");

	$id = $_SESSION['id'];

	$stmt = $mysqli->prepare("INSERT INTO dorm_list(date,time,loc,club,pm,name,
				              phone,sid,attend,bdate,btime) VALUES
				              ( ? , ? , ? , ? , ? , ? , ? , ? , ? , CURDATE() , CURTIME() )");
	if( !($stmt->bind_param( "ssssssssi" , $_POST['date'] ,  $_POST['time'] , $_POST['loc'] ,
										   $_POST['club'] , $_POST['pm'] , $_POST['name'] ,
										   $_POST['phone'] , $id , $_POST['attend'] )))
	{
		echo "Prepare failed (" . $mysqli->errno . ") " . $mysqli->error;
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
