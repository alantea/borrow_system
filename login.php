<?php
	session_start();
	if( isset( $_SESSION['id']) )
	{
		header("Location: user_index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title> 登入 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles -->
    <link href="css/custom/login.css" rel="stylesheet">

	<!-- Javascript -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	
	<div class="container">
		<form class="form-signin" action="login_check.php" method="POST">
			<h2 class="form-signin-heading">CCU 場地宿舍借用系統</h2>
			<?php
				if( isset( $_SESSION['login_fail']) )
				{
					echo '<div class="alert alert-danger">帳號或密碼輸入錯誤，請再輸入一次</div>';
					unset( $_SESSION['login_fail'] );
				}
			?>
			<input type="text" class="form-control" placeholder="學號" name="id" autofocus>
			<input type="password" class="form-control" placeholder="密碼" name="pw" />
			<div class="radio">
				<label class="col-xs-6">
					<input type="radio" name="iden" value="student" checked>
					學生
				</label>
				<label class="col-xs-6">
					<input type="radio" name="iden" value="staff">
					管理員
				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
			
		</form>

	</div> <!-- /container -->

    <!-- core JavaScript -->

</body>
</html>
