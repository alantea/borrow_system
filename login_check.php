<?php
	session_start();

	/****************  need to add encryption before finish *****************/

	if( $_POST['iden'] == 'student' )
	{
		if( $_POST['id'] == 'banana' && $_POST['pw'] == 'ok' )
		{
			$_SESSION['id']="banana";
		}
		else
		{
			$_SESSION['id']="412345678";
		}
		header("Location:user_index.php");
	}
	else if( $_POST['iden'] == 'staff' )
	{
		require("config/config.php");
		$stmt = $mysqli->prepare("SELECT username,password,depart FROM dorm_admin WHERE username = ?");
		$stmt->bind_param("s", $_POST['id']);

		$stmt->execute();
		$stmt->bind_result($id,$pw,$de);
		
		$stmt->fetch();

		if( $pw == $_POST['pw'] )
		{
			$_SESSION['id']=$de;
			header("Location:admin_index.php");
		}
		else
		{
			$_SESSION['login_fail']=1;
			header("Location:login.php");
		}
	}
	else
	{
		header("Location:user_index.php");
	}
?>
