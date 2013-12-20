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
			$("#search").addClass('active');
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
		<br>
		<div id="search_list" class="col-md-3 well">
			<legend>日期區間</legend>
			<label for="datepicker1">從</label>
			<input type="text" class="form-control" id="datepicker1" placeholder="開始時間" />
			<label for="datepicker2">到</label>
			<input type="text" class="form-control" id="datepicker2" placeholder="結束時間" />
		
			<legend>地點</legend>
			<div class="checkbox">
				<input type="checkbox" value="bab1">大AB1
			</div>
			<div class="checkbox">
				<input type="checkbox" value="sab1">小AB1
			</div>
			<div class="checkbox">
				<input type="checkbox" value="bcb1">大CB1
			</div>
			<div class="checkbox">
				<input type="checkbox" value="scb1">小CB1
			</div>
			<div class="checkbox">
				<input type="checkbox" value="cd">CD棟前近樓梯處
			</div>
			<div class="checkbox">
				<input type="checkbox" value="eb1">EB1前空地
			</div>
		
		</div>
		<div id="search_table" class="col-md-6">
		
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
		$(function() {
			$( "#datepicker1" ).datepicker( { dateFormat : "yy-mm-dd" });
			$( "#datepicker2" ).datepicker( { dateFormat : "yy-mm-dd" });
		});

    </script>
</body>
</html>
