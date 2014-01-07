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
		<div class="col-md-2" style="padding:20px">
			<ul class="nav">
				<a href="admin_audit.php" class="list-group-item">審核借用</a>
				<a href="admin_audit_record.php" class="list-group-item">審核紀錄</a>
				<a href="admin_add.php" class="list-group-item active">新增借用</a>
				<a href="admin_record.php" class="list-group-item">借用紀錄</a>
				<a href="admin_index.php" class="list-group-item">管理介面</a>
			</ul>
		</div>
		<div class="col-md-10">
			<h3> 確認資料 </h3>
			<form role="form" action="admin_add_list.php" method="POST">
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
					<tr>
						<th>審核人員</th>
						<td><?php echo($_POST['aname']);?></td>
						<input type="hidden" name="aname" value="<?php echo($_POST['aname']);?>" />
					</tr>
					<!--
					<tr>
						<th>通過原因</th>
						<td><?php echo($_POST['areason']);?></td>
						<input type="hidden" name="areason" value="<?php echo($_POST['areason']);?>" />
					</tr>
					-->
					<?php
						// check borrow day have collision
						require("config/config.php");
						$stmt = $mysqli->prepare("SELECT date,time,loc,admin_result
												  FROM dorm_list
												  WHERE date = ? AND loc = ? AND admin_result = 'wait'
												  ORDER by time");
						$stmt->bind_param("ss" , $_POST['date'] , $str_loc );
						$stmt->execute();
						$stmt->bind_result($no,$gettime,$no,$getresult);

						$wait_msg = "";
						$wait_count = 0;

						while( $stmt->fetch() )
						{
							$str_time=$gettime;
							$insh = (int)$str_insh = substr( $str_time , 0 , 2 );
							$insm = (int)$str_insm = substr( $str_time , 2 , 2 );
							$ineh = (int)$str_ineh = substr( $str_time , 4 , 2 );
							$inem = (int)$str_inem = substr( $str_time , 6 , 2 );
	
							if( ( $sm + $sh * 60 < $insm + $insh * 60 ) &&
								( $em + $eh * 60 > $insm + $insh * 60 ))
							{
								if( $wait_count == 0 )
								{
									$wait_msg .= $str_insh . ":" . $str_insm . " - " .
											 $str_ineh . ":" . $str_inem;
									$wait_count++;
								}
								else
								{
									$wait_msg .= " , " . $str_insh . ":" . $str_insm . " - " .
											 $str_ineh . ":" . $str_inem;
									$wait_count++;
								}
							}
							else if( ( $sm + $sh * 60 >= $insm + $insh * 60 ) &&
									 ( $sm + $sh * 60 < $inem + $ineh * 60 ))
							{
								if( $wait_count == 0 )
								{
									$wait_msg .= $str_insh . ":" . $str_insm . " - " .
											 $str_ineh . ":" . $str_inem;
									$wait_count++;
								}
								else
								{
									$wait_msg .= " , " . $str_insh . ":" . $str_insm . " - " .
											 $str_ineh . ":" . $str_inem;
									$wait_count++;
								}
							}
						}
						if( $wait_count != 0 )
						{
							echo '<tr>
									<td colspan="2">
									<span style="color : #FF0000">目前已有 ' . $wait_count . 
								   ' 個活動申請</span>，時段分別為 : <br />' . $wait_msg . 
								   '<br />若依舊想要借用請點選下一步</td></tr>';
						}
					?>
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
    <script>
		$("#nextstep").click(function(){
			var check_next = <?php echo($wait_count != 0) ? "true" : "false"; ?>;
			if( check_next )
			{
				if( confirm("其他場次將會直接拒絕掉，請問真的要繼續嗎?" ) )
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			return true;
		});
    </script>
</body>
i</html>
