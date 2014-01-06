<?php
	session_start();
	if( !isset($_SESSION['id']) && $_SESSION['id'] != "SE" )
	{
		header("Location: index.php");
		die();
	}
	else if( !isset($_SESSION['in_fail']) )
	{
		header("Location: index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> 新增失敗 </title>
	
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
		<div class="col-md-2 list" >
			<ul class="nav">
				<a href="admin_audit.php" class="list-group-item">審核借用</a>
				<a href="admin_audit_record.php" class="list-group-item">審核紀錄</a>
				<a href="admin_add.php" class="list-group-item active">新增借用</a>
				<a href="admin_record.php" class="list-group-item">借用紀錄</a>
				<a href="admin_index.php" class="list-group-item">管理介面</a>
			</ul>
		</div>
		<div class="col-md-10" style="padding-top: 30px">
			<h2> 新增失敗 </h2>
			<li>原因 : 
			<?php
				if( $_SESSION['in_fail'] == 1 ) // alerady borrow
				{
					echo( "已有人成功借用該時段");
				}
				else if( $_SESSION['in_fail'] == 2 ) // mysql error
				{
					echo( "Database出現問題，請稍後再試" );
				}
				else
				{ // 3. some input no input
				  // 4. date format is not correct
				  // 5. time format
				  // 6. date fromat is not in accept
					echo( "不明錯誤 0x00000" . $_SESSION['in_fail'] );
				}
			?>
			</li>
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
