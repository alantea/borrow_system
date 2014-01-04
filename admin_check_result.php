<?php
	session_start();
	if( !isset($_SESSION['id']) && $_SESSION['id'] != "SE" )
	{
		header("Location:index.php");
		die();
	}

	require("config/config.php");

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
