<?php
	session_start();
	if( $_POST['id'] == 'banana' && $_POST['pw'] == 'ok' )
	{
		$_SESSION['id']="banana";
	}
	else
	{
		$_SESSION['id']="apple";
	}
	header("Location:user_index.php");
?>
