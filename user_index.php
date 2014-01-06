<?php
	session_start();
	if( !isset($_SESSION['id']) )
	{
		header("Location: index.php");
		die();
	}
	else if( $_SESSION['id'] == "SE" )
	{
		header("Location: admin_index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> 管理介面 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="css/jquery-ui.min.css" rel="stylesheet" />
	<link href="css/user_index.css" rel="stylesheet" />

	<!-- Javascript -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
	
<body>

	<?php include("user_navbar"); ?>

	<!-- content -->
	<div class="container">
		<div class="col-md-2" style="padding:20px">
			<ul class="nav">
				<a href="user_rules.php" class="list-group-item">新增借用</a>
				<a href="user_record.php" class="list-group-item">借用紀錄</a>
				<a href="user_index.php" class="list-group-item active">管理介面</a>
			</ul>
		</div>
		<div class = "col-md-8" style="padding:20px">
			<p class = "text-danger">歡迎使用國立中正大學學士班宿舍場地借用系統。使用本系統前請詳讀借用規則與功能說明，謝謝您。</p>
			<p class = "text-info">功能說明</p>
			<p><span class = "glyphicon glyphicon-plus-sign" style = "margin-right:3px"></span>新增借用</br>
			<li>新增學士班宿舍部分場地的借用。填妥資料送出借用後待管理員審核通過，方可使用場地。</li></p>
			<p><span class = "glyphicon glyphicon-list-alt" style = "margin-right:3px"></span>借用紀錄
			<li>檢視你所借用的場地紀錄，包含場地目前的審核狀態。</li></p>
		</div>
		<div class="col-md-10" >
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
