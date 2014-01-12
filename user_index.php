<?php
	session_start();

	if( !isset($_SESSION['id']) )
	{
		include("nologin.php");
		die();
	}// admin to admin_index
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
	
	<!-- core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles -->
	<link href="css/custom/user_fix-top.css" rel="stylesheet" />

	<!-- Javascript -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
	
<body>

	<?php include("user_navbar.php"); ?>

	<!-- content -->
	<div class="container">
		<?php include("user_left_navbar.php"); ?>
		<div class = "col-md-8">
			<p class = "text-danger">歡迎使用國立中正大學學士班宿舍場地借用系統。使用本系統前請詳讀借用規則與功能說明，謝謝您。</p>
			<p class = "text-info">功能說明</p>
			
			<div style="margin-top:10px">
				<p><span class = "glyphicon glyphicon-plus-sign" style = "margin-right:3px"></span>新增借用</p>
				<li>新增學士班宿舍部分場地的借用。填妥資料送出借用後待管理員審核通過，方可使用場地。</li>
			</div>
			
			<div style="margin-top:10px">
				<p><span class = "glyphicon glyphicon-list-alt" style = "margin-right:3px"></span>借用紀錄</p>
				<li>檢視你所借用的場地紀錄，包含場地目前的審核狀態。</li>
			</div>
	
			<div style="margin-top:10px">
				<p><span class = "glyphicon glyphicon-bold" style = "margin-right:3px"></span>瀏覽器</p>
				<li>建議使用IE8以上(含)版本，或其他各大瀏覽器。並請開啟瀏覽器Javascript及cookies功能。</li>
			</div>

			<div style="margin-top:10px">
				<p><span class = "glyphicon glyphicon-home" style = "margin-right:3px"></span>首頁</p>
				<li>可瀏覽已通過審核的借用。</li>
			</div>

			<div style="margin-top:10px">
				<p><span class = "glyphicon glyphicon-search" style = "margin-right:3px"></span>條件查詢</p>
				<li>可依日期、地點作為條件，查詢已通過審核的借用。</li>
			</div>
		</div>
	</div><!-- /.container -->
    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$("#u_in").addClass('active');
	</script>
</body>
</html>
