<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> 場地借用系統 </title>
	
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
	<script src="js/index.js"></script>
	<script>
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
		<div class="col-md-4" id="datepicker">
		</div>
		<div class="col-md-8">
			<div>
				<h4 id="alternate" class="CurrDate"></h4>
			</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>時間</th>
						<th>地點</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>13:00~15:00</td>
						<td>房間裡</td>
					</tr>
					<tr>
						<td>2</td>
						<td>16:00~18:00</td>
						<td>行政大樓</td>
				</tbody>
			</table>
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
