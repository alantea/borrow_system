<?php
	session_start();
	if( !isset($_SESSION['id']) )
	{
		header("Location: index.php");
		die();
	}
	if (!isset($_SESSION['agree']) || (!isset($_POST['date']))
	{	// check agree & data hava submit to it.
		header("Location: user_rules.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> 確認資料 </title>
	
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
				<a href="user_rules.php" class="list-group-item active">新增借用</a>
				<a href="user_record.php" class="list-group-item">借用紀錄</a>
				<a href="user_index.php" class="list-group-item" >管理介面</a>
			</ul>
		</div>
		<div class="col-md-10" >
			<br>
			
			<h3> 確認資料 </h3>
			<form role="form" action="add_list.php" method="POST">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>借用日期</th>
						<td><?php echo($_POST['date']);?></td>
						<input type="hidden" name="date" value="<?php echo($_POST['date']);?>" />
					</tr>
					<tr>
						<th>借用時間</th>
						<td><?php
							$sh = $_POST['sh'];
							$sm = $_POST['sm'];
							$eh = $_POST['eh'];
							$em = $_POST['em'];
							echo ($sh . ":" . $sm . " - " . $eh . ":" . $em);
							$str_time = $sh . $sm . $eh . $em;
						?></td>
						<input type="hidden" name="time" value="<?php echo $str_time;?>" />
					</tr>
					<tr>
						<th>借用地點</th>
						<td><?php
							$str_loc=$_POST['loc'];
							if( $str_loc=="other" )
							{
								$str_loc= $_POST['loc2'];
							}
							echo ($str_loc);
							?></td>
						<input type="hidden" name="loc" value="<?php echo($str_loc);?>" />
					</tr>
					<tr>
						<th>申請社團</th>
						<td><?php echo($_POST['club']);?></td>
						<input type="hidden" name="club" value="<?php echo($_POST['club']);?>" />
					</tr>
					<tr>
						<th>申請人</th>
						<td><?php echo($_POST['pm']);?></td>
						<input type="hidden" name="pm" value="<?php echo($_POST['pm']);?>" />
					</tr>
					<tr>
						<th>活動名稱</th>
						<td><?php echo($_POST['name']);?></td>
						<input type="hidden" name="name" value="<?php echo($_POST['name']);?>" />
					</tr>
					<tr>
						<th>連絡電話</th>
						<td><?php echo($_POST['phone']);?></td>
						<input type="hidden" name="phone" value="<?php echo($_POST['phone']);?>" />
					</tr>
					<tr>
						<th>參加人數</th>
						<td><?php echo($_POST['attend']) . "人";?></td>
						<input type="hidden" name="attend" value="<?php echo($_POST['attend']);?>" />
					</tr>
				</tbody>
			</table>
			<table class = "table1">
			<tbody>
			<tr>
			<td>
			<center><h2><b>同意書</b></h2></center>
			<p class = "ps">
			本人<span style="display: inline-block;width:180px;text-align:center;font-weight:bolder"><?php echo($_POST['pm']);?></span>
			承辦<span style="display: inline-block;width:250px;text-align:center;font-weight:bolder"><?php echo($_POST['club']);?></span>(社團名稱)於
			<span style="display: inline-block;width:55px;text-align:center;font-weight:bolder"><?php 
			$str_date = $_POST['date'];
			$datearray = explode("-",$str_date);
			$chyear = (int)$datearray[0] - 1911;
			echo($chyear);
			?></span>
			年<span style="display: inline-block;width:55px;text-align:center;font-weight:bolder"><?php echo($datearray[1]);?></span>
			月<span style="display: inline-block;width:55px;text-align:center;font-weight:bolder"><?php echo($datearray[2]);?></span>
			日<br><span style="display: inline-block;width:55px;text-align:center;font-weight:bolder"><?php echo($_POST['sh']);?></span>
			時起至<span style="display: inline-block;width:55px;text-align:center;font-weight:bolder"><?php echo($_POST['eh']);?></span>
			時止，舉辦<span style="display: inline-block;width:270px;text-align:center;font-weight:bolder"><?php echo($_POST['name']);?></span>
			活動，申請借用學生宿舍學士班<span style="display: inline-block;width:250px;text-align:center;font-weight:bolder"><?php echo($_POST['loc']);?></span>
			(場地名稱)，基於宿舍安全及環境衛生考量，同意配合禁止舉辦炊煮形式活動，以及將確實配合維護宿舍環境安寧，不使用擴音器材，夜間22時準時結束活動並解散，如有違反，願接受校規處分。<br>
			此致  學務處生活事務組</p>
			<p class = "pr">
			立同意書人:<span style="display: inline-block;width:150px;text-align:right;font-weight:bolder"><?php echo($_POST['pm']);?></span><br>
			系級：<span style="display: inline-block;width:150px;text-align:right;font-weight:bolder"><?php echo($_POST['dep']);?></span><br>
			學號：<span style="display: inline-block;width:150px;text-align:right;font-weight:bolder"><?php echo($_POST['schid']);?></span><br></p>
			<p class = "pd">
			中華民國 <span style="display: inline-block;width:100px;text-align:center"><?php 
			date_default_timezone_set("Asia/Taipei");
			$nowyear = date("Y") - 1911;
			echo date($nowyear);?></span>年
			<span style="display: inline-block;width:100px;text-align:center"><?php echo date("m");?></span>月
			<span style="display: inline-block;width:100px;text-align:center"><?php echo date("d");?></span>日
			</p>
			</td>
			</tr>
			</tbody>
			</table>
				<button type="submit" class="btn btn-default" id="nextstep">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			</form>
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
