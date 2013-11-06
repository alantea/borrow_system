<?php
	session_start();
	$_SESSION['id']="apple";
	header("Location:user_index.php");
?>
