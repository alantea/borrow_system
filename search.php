<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> 條件查詢 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/jquery-ui.min.css" rel="stylesheet" />

	<!-- Custom styles -->
	<link href="css/custom/fix-top.css" rel="stylesheet">

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
	<div class="container">
		<div id="search_list" class="col-md-3 well">
			<form action="/" method="POST" id="search_form">
				<legend>日期區間</legend>
				
				<label for="start">從</label>
				<input type="text" class="form-control" id="start" name="stime" placeholder="開始時間" />
				
				<label for="end">到</label>
				<input type="text" class="form-control" id="end" name="etime" placeholder="結束時間" />
		
				<legend>地點</legend>
				<div class="checkbox">
					<input type="checkbox" value="bab1"	name="select_loc[]">大AB1
				</div>				
				<div class="checkbox">
					<input type="checkbox" value="sab1" name="select_loc[]">小AB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="bcb1" name="select_loc[]">大CB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="scb1" name="select_loc[]">小CB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="cd" name="select_loc[]">CD棟前近樓梯處
				</div>
				<div class="checkbox">
					<input type="checkbox" value="eb1" name="select_loc[]">EB1前空地
				</div>
				<div class="checkbox">
					<input type="checkbox" value="other" name="select_loc[]">其他場地
				</div>
				
				<div>
					<a href="javascript:void(0)" id="selectall">選取全部選項</a>
				</div>
				<div>
					<a href="javascript:void(0)" id="disselectall">取消全部選項</a>
				</div>

				<div>
					<button type="submit" id="formsubmit" class="btn btn-primary">查詢</button>
					<button type="reset" id="clearall" class="btn btn-default">重填</button>
				</div>
			
			</div>
		</form>
		<div id="search_table" class="col-md-6">
		</div>
	</div><!-- /.container -->

    <!-- core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script src="js/custom/search.js"></script>
</body>
</html>
