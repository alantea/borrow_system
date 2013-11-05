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
	<script src="js/index.js"></script>
	<script>
	</script>
</head>
	
<body>
	<!-- navbar --!>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">CCU 場地借用</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="search.php">條件查詢</a></li>
					<li><a href="rules.php">借用規則</a></li>
				</ul>
				<a href="login.php" class="btn btn-danger pull-right" style="margin-top: 8px;" >Login</a>
			</div><!--/.nav-collapse -->
		</div>
	</div>

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
