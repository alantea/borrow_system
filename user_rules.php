<?php
	session_start();
	if(!isset( $_SESSION['id'] ) )
	{
		include("nologin.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> 借用規範 </title>
	
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
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					學士班宿舍場地申請登記注意事項
				</div>
				<div class="panel-body">
				<ol type='1'>
					<li>申請日期 : 活動當日起10天起，始可申請場地。</li>
					<li>申請時間 : 每日08時至22時止。</li>
					<li>場地開放使用時間 : 每日08時起至23時止。</li>
					<li>場地的使用時間為3個小時以內</li>
					<li>場地容量分配 :<br>
						30人以下團體限用小AB1、小CB1交誼廳。<br>
					    60人以上團體始可直接借用大AB1、大CB1交誼廳。<br>
						30人至60人之團體，視場地空餘情況及活動需要核辦。<br>
						大AB1、大CB1交誼廳以容納80人為標準，50人以下之團體借用大交誼廳時，須同意許其他社團合併使用，始予核准。
					</li>
					<li>場地借用次數限制 : 同一團體一週內(週日起至週六止)最多僅能申請2場次。</li>
					<li>基於安全考量，宿舍區內禁止舉辦各類型式炊煮活動。</li>
					<li>
						若需特殊借用，請點選<a href="user_rules_spc.php">此處</a>
					</li>
				</ol>
				</div>
			</div>
			<form class="form-horizontal" role="form" action="user_add.php" method="GET">
				<div class = "checkbox" style = "margin-bottom:10px">
					<label>
						<input type="checkbox" id="agree" name="agree">我已詳閱以上條款，並同意遵守配合。
					</label>
				</div>
				<button type="submit" class="btn btn-default" id="nextstep" style="margin-bottom:10px">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			</form>
		</div>
	</div><!-- /.container -->

    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$("#u_ru").addClass('active');
		$("#user_rules").addClass('active');
		
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

