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
	<script src="js/bootstrap.min.js"></script>
</head>
	
<body>

	<?php include("user_navbar"); ?>
	
	<!-- content --!>
	<div class="container">
		<div class="col-md-2 list" >
			<ul class="nav">
				<a href="user_add.php" class="list-group-item active">新增借用</a>
				<a href="user_record.php" class="list-group-item">借用紀錄</a>
				<a href="user_index.php" class="list-group-item" >管理介面</a>
			</ul>
		</div>
		<div class="col-md-10" >
			<br>
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">借用日期</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" id="date" placeholder="2013-10-10">
					</div>
				</div>
				<div class="form-group">
					<label for="time" class="col-sm-2 control-label">借用時間(先採用直接輸入 , 8碼)</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="time" placeholder="19002100">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">借用地點</label>
					<div class="col-sm-4">
						<select class="form-control" id="loc">
							<option>大AB1</option>
							<option>小AB1</option>
							<option>大CB1</option>
							<option>小CB1</option>
							<option>CD棟前進樓梯處(限借桌1張、椅2張)</option>
							<option>EB1前空地</option>
							<option value="other">其他場地</option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="newloc" placeholder="地點" style="display:none"/>
					</div>
				</div>
				<div class="form-group">
					<label for="club" class="col-sm-2 control-label">申請社團</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="club" placeholder="吃吃社">
					</div>
				</div>
				<div class="form-group">
					<label for="pm" class="col-sm-2 control-label">申請人</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="pm" placeholder="吃貨">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">活動名稱</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="name" placeholder="吃吃期末大會">
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-2 control-label">連絡電話</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="phone" placeholder="0911111111">
					</div>
				</div>
				<div class="form-group">
					<label for="attend" class="col-sm-2 control-label">參加人數</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="attend" placeholder="60">
					</div>
				</div>
				<button type="button" class="btn btn-default">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			<!--
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="exampleInputFile">File input</label>
					<input type="file" id="exampleInputFile">
					<p class="help-block">Example block-level help text here.</p>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox"> Check me out
					</label>
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
				--!>
			</form>
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script>
		$( "#loc" ).change(function() {
			if( $( "#loc" ).val() == "other" )
			{
				$("#newloc").css('display','block');
			}
			else
			{
				$("#newloc").css('display','none');
			}
		});
	</script>
</body>
</html>
