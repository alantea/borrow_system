<?php
	session_start();
	if( $_SESSION['id'] == "" )
	{
		header("Location: index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> user Borrow </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="css/jquery-ui.min.css" rel="stylesheet" />
	<link href="css/user_index.css" rel="stylesheet" />

	<!-- Javascript --!>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.numeric.js"></script> <!-- source --!>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script>
		$(function() {
			//$( "#datepicker" ).datepicker( "option" , "dateFormat", "yy-mm-dd" );
			$( "#datepicker" ).datepicker( { dateFormat : "yy-mm-dd" , minDate: -0, maxDate: +10  });
		});
	</script>
</head>
	
<body>

	<?php include("user_navbar"); ?>
	
	<!-- content --!>
	<div class="container">
		<div class="col-md-2 list" >
			<ul class="nav">
				<a href="user_rules.php" class="list-group-item active">新增借用</a>
				<a href="user_record.php" class="list-group-item">借用紀錄</a>
				<a href="user_index.php" class="list-group-item" >管理介面</a>
			</ul>
		</div>
		<div class="col-md-10" >
			<br />
			<p>		
			規範說安安<br />
			你想要借嗎？<br />
			請按我同意
			</p>
			<form class="form-horizontal" role="form" action="user_add.php" method="POST">
				<div class="form-group">
					<div class="col-sm-1">
						<input type="checkbox" class="form-control" id="agree" name="agree" required>
					</div>
					<label for="name" class="col-sm-3 control-label">我同意balabala</label>
				</div>
				<button type="submit" class="btn btn-default" id="nextstep">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			</form>
		</div>
	</div><!-- /.container -->

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script>

		$( "#nextstep" ).click(function(){

			return true;
		});
	</script>
</body>
</html>

