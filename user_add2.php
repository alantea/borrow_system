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
							/*
							$str_time=$_POST['time'];
							$sh = substr( $str_time , 0 , 2 );
							$sm = substr( $str_time , 2 , 2 );
							$eh = substr( $str_time , 4 , 2 );
							$em = substr( $str_time , 6 , 2 );
							echo ($sh . ":" . $sm . " - " . $eh . ":" . $em);
							*/
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
							$str_date=$_POST['loc'];
							if( $str_date=="other" )
							{
								$str_date= $_POST['loc2'];
							}
							echo ($str_date);
							?></td>
						<input type="hidden" name="loc" value="<?php echo($str_date);?>" />
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
				<button type="submit" class="btn btn-default" id="nextstep">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			</form>
<!--
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
				<button type="button" class="btn btn-default" id="nextstep">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
				--!>
			</form>
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
