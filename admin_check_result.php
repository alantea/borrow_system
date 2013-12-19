<?php
	session_start();
	if( $_SESSION['id'] != "SE" )
	{
		header("Location:index.php");
		die();
	}

	require("config/config.php");

	$stmt = $mysqli->prepare("UPDATE dorm_list SET admin_name = ? ,admin_date = ? ,admin_result = ? ,admin_reason = ? ");



	// $_POST['name']		$_POST['ru']		$_POST['rs']  $_POST['id']

?>
