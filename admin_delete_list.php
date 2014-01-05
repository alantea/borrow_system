<?php
	// check_it_admin
	session_start();
	if( !isset($_SESSION['id']) && $_SESSION['id'] != "SE" )
	{
		header("Location:index.php");
		die();
	}

	/************************************/
	/* echo value						*/
	/* -1 : no post value				*/
	/* -2 : can't find the data			*/
	/* -3 : can't update the data		*/
	/* 1 : ok							*/
	
	if( !isset($_POST['lid']) )
	{
		echo ("-1");
		die();
	}
	
	$lid = $_POST['lid'];

	require("config/config.php");
	
	// check it hava data to delete 
	$stmt = $mysqli->prepare("SELECT id FROM dorm_list WHERE id = ? ");
	$stmt->bind_param("i", $lid);
	$stmt->execute();
	$stmt->bind_result($no);

	$find = false;
				
	while( $stmt->fetch() )
	{
		$find = true;
	}
	if( !$find )
	{
		echo ("-2");
		die();
	}

	// delete data
	$stmt = $mysqli->prepare("DELETE FROM dorm_list WHERE id = ? ");
	$stmt->bind_param("i", $lid);
	
	if( !$stmt->execute() )
	{
		echo ("-3");
		die();
	}
	else
	{
		echo ("1");
	}
	
?>
