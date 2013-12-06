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
	<script>
		$(function() {
			$( "#datepicker" ).datepicker();
			$( "#datepicker" ).datepicker( "option" , "dateFormat", "yy-mm-dd" );
		});
	</script>
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
			<form class="form-horizontal" role="form" action="user_add2.php" method="POST">
				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">借用日期</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="datepicker" placeholder="2013-10-10" name="date" required>
					</div>
				</div>
				<div class="form-group">
					<label for="time" class="col-sm-2 control-label">借用時間(先採用直接輸入 , 8碼)</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="time" placeholder="19002100" name="time" required>
					</div>
				</div>
				<div class="form-group">
					<label for="loc" class="col-sm-2 control-label">借用地點</label>
					<div class="col-sm-4">
						<select class="form-control" id="loc" name="loc">
							<option value="大AB1">大AB1</option>
							<option value="小AB1">小AB1</option>
							<option value="大CB1">大CB1</option>
							<option value="小CB1">小CB1</option>
							<option value="CD棟前進樓梯處(限借桌1張、椅2張)">CD棟前進樓梯處(限借桌1張、椅2張)</option>
							<option value="EB1前空地">EB1前空地</option>
							<option value="other">其他場地</option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="newloc" placeholder="地點" style="display:none" name="loc2" >
					</div>
				</div>
				<div class="form-group">
					<label for="club" class="col-sm-2 control-label">申請社團</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="club" placeholder="吃吃社" name="club" required>
					</div>
				</div>
				<div class="form-group">
					<label for="pm" class="col-sm-2 control-label">申請人</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="pm" placeholder="吃貨" name="pm" required>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">活動名稱</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="name" placeholder="吃吃期末大會" name="name" required>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-2 control-label">連絡電話</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="phone" placeholder="0911111111" name="phone" required>
					</div>
				</div>
				<div class="form-group">
					<label for="attend" class="col-sm-2 control-label">參加人數</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="attend" placeholder="60" name="attend" required>
					</div>
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
	function isValidDate(date)
	{
		var matches = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(date);
		if (matches == null) return false;
		var m = matches[2] - 1;
		var y = matches[1];
		var d = matches[3];
		var composedDate = new Date(y, m, d);
		return composedDate.getDate() == d &&
			composedDate.getMonth() == m &&
			composedDate.getFullYear() == y;
	}


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

		$( "#nextstepsssss" ).click(function(){
			if( $("#datepicker").val() == "" ) // check date
			{
				alert("請輸入日期");
				//return false;
			}
			else if( !isValidDate( $("#datepicker").val() ) )
			{
				alert("請輸入正確的日期");
				//return false;
			}
			
			if( $("#time").val() == "" )
			{
				alert("請輸入正確時間");
				//return false;
			}

			if( $("#loc").val() == "other" && $("#newloc").val() == "" )
			{
				alert("請輸入正確地點");
				//return false;
			}

			if( $("#club").val() == "" )
			{
				alert("請輸入社團");
				//return false;
			}
			
			if( $("#pm").val() == "" )
			{
				alert("請輸入申請人");
				//return false;
			}

			if( $("#name").val() == "" )
			{
				alert("請輸入活動名稱");
				//return false;
			}
			
			if( $("#phone").val() == "" )
			{
				alert("請輸入電話");
				//return false;
			}
			
			if( $("#attend").val() == "" )
			{
				alert("請輸入參加人數");
				//return false;
			}

			return true;
		});
	</script>
</body>
</html>
