<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> index </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="css/index.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet" />

	<!-- Javascript --!>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script>
		$(document).ready(init);

		function init(){
			$("#rules").addClass('active');
		}
	</script>
</head>
	
<body>
	<?php
		if( !$_SESSION['id'] || $_SESSION['id'] == "" )
		{
			include("navbar");
		}
		else
		{
			include("user_navbar");
		}
	?>

	<!-- content --!>
	<div class="container">
		規範
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
