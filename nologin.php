<?php
	session_start();

	if( isset($_SESSION['id']) )
	{
		header("Location: index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> 您尚未登入 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<style>
		body{
			 padding-top: 50px;
		}
	</style>

	<!-- Javascript -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
	
<body>
	<?php
		if( !isset($_SESSION['id']) )
		{
			include("navbar.php");
		}
		else
		{
			include("user_navbar.php");
		}
	?>
	<!-- content -->
	<div class="jumbotron">
	
	<div class="container">
		<h2> 您尚未登入 </h2>
		<p> 請點選右上方進行登入 , 或者點選左上方回至首頁 </p>
	</div><!-- /.container -->
	</div>

    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
