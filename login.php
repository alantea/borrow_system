<?php
	session_start();
	if( $_SESSION['id'] != "" )
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

    <title>Login</title>

    <!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="login_check.php">
        <h2 class="form-signin-heading">CCU 場地借用系統</h2>
        <input type="text" class="form-control" placeholder="學號" autofocus>
        <input type="password" class="form-control" placeholder="密碼" />
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
