<?php
	session_start();
	if( !isset($_SESSION['id']) && $_SESSION['id'] != "SE" )
	{
		header("Location:login.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> 新增借用 </title>
	
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
	<script src="js/jquery.numeric.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script>
		$(function() {
			$( "#datepicker" ).datepicker( { dateFormat : "yy-mm-dd" , minDate: -0 , maxDate: +30 });
		});
	</script>
</head>
	
<body>

	<?php include("user_navbar.php"); ?>

	<!-- content -->
	<div class="container">
		<div class="col-md-2" style="padding:20px">
			<ul class="nav">
				<a href="admin_audit.php" class="list-group-item">審核借用</a>
				<a href="admin_audit_record.php" class="list-group-item">審核紀錄</a>
				<a href="admin_add.php" class="list-group-item active">新增借用</a>
				<a href="admin_record.php" class="list-group-item">借用紀錄</a>
				<a href="admin_index.php" class="list-group-item">管理介面</a>
			</ul>
		</div>
		<div class="col-md-10" style="padding-top:20px">
			<form class="form-horizontal" role="form" action="admin_add2.php" method="POST">
				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">借用日期</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="datepicker" placeholder="<?php
						date_default_timezone_set("Asia/Taipei");
						echo date('Y-m-d', time());
						?>" name="date" required>
					</div>
				</div>
				<div class="form-group">
					<label for="time" class="col-sm-2 control-label">借用時間</label>
					<div class="col-sm-9 form-inline">
						<div class="form-group col-sm-2">
							<select class="form-control" name="sh" id="sh">
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
							</select>
						</div>
						<h5 class="form-group col-sm-1">
							時
						</h5>
						<div class="form-group col-sm-2">
							<select class="form-control" name="sm" id="sm">
								<option value="00">00</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>
						</div>
						<h5 class="form-group col-sm-1">
							分-
						</h5>
						<div class="form-group col-sm-2">
							<select class="form-control" name="eh" id="eh">
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
							</select>
						</div>
						<h5 class="form-group col-sm-1">
							時
						</h5>
						<div class="form-group col-sm-2">
							<select class="form-control" name="em" id="em">
								<option value="00">00</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>
						</div>
						<h5 class="form-group col-sm-1">
							分
						</h5>
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
							<option value="CD棟前近樓梯處(限借桌1張、椅2張)">CD棟前近樓梯處(限借桌1張、椅2張)</option>
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
				<hr>
				<div class="form-group">
					<label for="aname" class="col-sm-2 control-label">審核人員</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="aname" placeholder="X先生" name="aname" required>
					</div>
				</div>
				<!--
				<div class="form-group">
					<label for="areason" class="col-sm-2 control-label">通過原因</label>
					<div class="col-sm-4">
						<textarea class="form-control" id="areason" placeholder="可不填" name="areason" rows="3"></textarea>
					</div>
				</div>
				-->
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

		$( "#nextstep" ).click(function(){
			var error_msg = "";
			if( $("#datepicker").val() == "" ) // check date
			{
				error_msg += "請輸入日期\n";
			}
			else if( !isValidDate( $("#datepicker").val() ) )
			{
				error_msg += "請輸入正確的日期\n";
			}
			
			// check time
			if( ( $("#sh").val() > $("#eh").val() ) ||
				(( $("#sh").val() == $("#eh").val() ) && ( $("#sm").val() >= $("#em").val() )) )
			{
				error_msg += "請輸入正確時間\n";
			}

			if( $("#loc").val() == "other" && $("#newloc").val() == "" )
			{
				error_msg += "請輸入正確地點\n";
			}

			if( $("#club").val() == "" )
			{
				error_msg += "請輸入社團\n";
			}
			
			if( $("#pm").val() == "" )
			{
				error_msg += "請輸入申請人\n";
			}

			if( $("#name").val() == "" )
			{
				error_msg += "請輸入活動名稱\n";
			}
			
			if( $("#phone").val() == "" )
			{
				error_msg += "請輸入電話\n";
			}
			
			if( $("#attend").val() == "" )
			{
				error_msg += "請輸入參加人數\n";
			}
			else if( ($("#loc").val() == "大AB1" || $("#loc").val() == "大CB1") && 
					  $("#attend").val() < 30 )
			{
				error_msg += $("#loc").val() + "參加人數需30人以上\n";
			}
			
			if( $("#aname").val() == "" )
			{
				error_msg += "請輸入審核人員";
			}
			
			if( error_msg != "" )
			{
				alert( error_msg );
				return false;
			}

			return true;
		});
		$("#phone").numeric();
		$("#attend").numeric();
		jQuery('#phone').keyup(function () { 
			this.value = this.value.replace(/[^0-9]/g,'');
		});
		jQuery('#attend').keyup(function () { 
			this.value = this.value.replace(/[^0-9]/g,'');
		});
	</script>
</body>
</html>
