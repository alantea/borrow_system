<?php
	session_start();
	if(!isset( $_SESSION['id']) )
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
	<script src="js/jquery.numeric.js"></script> <!-- source --!>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script>
		$(function() {
			//$( "#datepicker" ).datepicker( "option" , "dateFormat", "yy-mm-dd" );
			$( "#datepicker" ).datepicker( { dateFormat : "yy-mm-dd" , minDate: -0, maxDate: +10  });
		});
	</script>
</head>
	
<body>

	<?php include("user_navbar"); ?>
	
	<!-- content --!>
	<div class="container">
		<div class="col-md-2 list" >
			<ul class="nav">
				<a href="user_rules.php" class="list-group-item active">新增借用</a>
				<a href="user_record.php" class="list-group-item">借用紀錄</a>
				<a href="user_index.php" class="list-group-item" >管理介面</a>
			</ul>
		</div>
		<div class="col-md-6" >
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">
					學士班宿舍場地特殊申請注意事項
				</div>
				<div class="panel-body">
				<ol type='1'>
					<li>申請日期 : 活動當日起30天起，始可申請場地。</li>
					<li>申請時間 : 每日08時至22時止。</li>
					<li>場地開放使用時間 : 每日08時起至23時止。</li>
					<li>場地容量分配 :<br>
						30人以下團體限用小AB1、小CB1交誼廳。<br>
					    60人以上團體始可直接借用大AB1、大CB1交誼廳。<br>
						30人至60人之團體，視場地空餘情況及活動需要核辦。<br>
						大AB1、大CB1交誼廳以容納80人為標準，50人以下之團體借用大交誼廳時，須同意許其他社團合併使用，始予核准。
					</li>
					<li>基於安全考量，宿舍區內禁止舉辦各類型式炊煮活動。</li>
				</ol>
				</div>
			</div>
			<form class="form-horizontal" role="form" action="user_add_spc.php" method="POST">
			<div class = "checkbox" style = "margin-bottom:10px">
					<label>
					<input type="checkbox" id="agree" name="agree">我已詳閱以上條款，並同意遵守配合。
					</label>
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
		$( "#nextstep" ).click(function(){
			var checked = $("#agree").is(':checked');
			if(!checked)
			{
				alert("請勾選同意框");
				return false;
			}	
			return true;
		});
	</script>
</body>
</html>

