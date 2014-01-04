<?php
	session_start();
	if(!isset( $_SESSION['id']) )
	{
		header("Location: user_index.php");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
  
  </head>

	<body>

		<div class="container">

			<form class="form-signin" action="login_check.php" method="POST">
				<h2 class="form-signin-heading">CCU 場地借用系統</h2>
				<input type="text" class="form-control" placeholder="學號" name="id" autofocus>
				<input type="password" class="form-control" placeholder="密碼" name="pw" />
				<div class="radio">
					<label class="col-sm-6">
						<input type="radio" name="iden" value="student" checked>
						學生
					</label>
					<label class="col-sm-6">
						<input type="radio" name="iden" value="staff">
						管理員
					</label>
				</div>
        <!--<label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>--!>
			<button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
			
			</form>

		</div> <!-- /container -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	</body>
</html>
