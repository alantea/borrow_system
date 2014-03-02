<?php
	session_start();
	if( !isset($_SESSION['id']) )
	{
		include("nologin.php");
		die();
	}
	if (!isset($_SESSION['agree']) || (!isset($_POST['date'])))
	{
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
		<div class="col-md-10">
		<?php
			require("config/config.php");
			require("inc/func.php");
			date_default_timezone_set('Asia/Taipei');
			//trans all data for security
			$getdate = htmlentities( $_POST['date'] );
			$getsh = htmlentities( $_POST['sh'] );
			$getsm = htmlentities( $_POST['sm'] );
			$geteh = htmlentities( $_POST['eh'] );
			$getem = htmlentities( $_POST['em'] );
			$getloc = htmlentities( $_POST['loc'] );
			$str_loc=$getloc;
			if( $str_loc=="other" )
			{
				$str_loc= htmlentities( $_POST['loc2'] );
			}
			$getclub = htmlentities( $_POST['club'] );
			$getpm = htmlentities( $_POST['pm'] );
			$getschid = htmlentities( $_POST['schid'] );
			$getdep = htmlentities( $_POST['dep'] );
			$getname = htmlentities( $_POST['name'] );
			$getphone = htmlentities( $_POST['phone'] );
			$getattend = htmlentities( $_POST['attend'] );
			
			// check the club is not apply two times in same time
			$check_time = $mysqli->prepare("SELECT date,time,club,admin_result
											FROM dorm_list
											WHERE date = ? AND club = ? AND admin_result != 'deny'");
			$check_time->bind_param("ss" , $date , $club );
			$check_time->execute();
			$check_time->bind_result($nop,$time,$nop,$nop);
			
			$str_time = $getsh . $getsm . $geteh . $getem;

			while( $check_time->fetch() )
			{
				if( time_collision( $str_time , $time ) )
				{
					$error_msg = '<h2>您已有申請同時段其他場次，不可再申請</h2>';
					break;
				}
			}

			// can't borrow more than 3 times.
			$getweekday = date("w" , strtotime($getdate) );
			$first_weekday = date("Y-m-d" , mktime( 0 , 0 , 0 , date("m",strtotime($getdate)) , date("d",strtotime($getdate)) - $getweekday , date("Y",strtotime($getdate)) ) );
			$last_weekday = date("Y-m-d" , mktime( 0 , 0 , 0 , date("m",strtotime($getdate)) , date("d",strtotime($getdate)) +( 6 - $getweekday) , date("Y",strtotime($getdate)) ) );
								
			$stmt = $mysqli->prepare("SELECT date,club FROM dorm_list WHERE club = ? AND date BETWEEN ? AND ?");
			$stmt->bind_param("sss",$getclub,$first_weekday,$last_weekday);
			$stmt->execute();
			$stmt->bind_result($date,$club);
			
			$count = 0;	
			for( $count = 0 ; $stmt->fetch() ; $count++ ){}
			
			if( $count >= 2 )
			{
				$error_msg = '<h2>一週內借用場次達3場次以上，請點選此處進行申請</h2>
				<a href="./user_rules_spc.php" class="btn btn-info">特殊借用</a>';
			}

			if( isset($error_msg) )
			{
				echo $error_msg . '
		</div>
	</div><!-- /.container -->
    
    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>
		$(function() {
			$( "#u_ru" ).addClass("active");
		});
	</script>

</body>
</html>';
				die();
			}
		?>
			<h3> 確認資料 </h3>
			<form role="form" action="add_list.php" method="POST">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>借用日期</th>
						<td><?php echo($getdate);?></td>
					</tr>
					<tr>
						<th>借用時間</th>
						<td><?php echo ( $getsh . ":" . $getsm . " - " . $geteh . ":" . $getem); ?></td>
					</tr>
					<tr>
						<th>借用地點</th>
						<td><?php echo ($str_loc); ?></td>
					</tr>
					<tr>
						<th>申請社團</th>
						<td><?php echo($getclub);?></td>
					</tr>
					<tr>
						<th>申請人</th>
						<td><?php echo($getpm);?></td>
					</tr>
					<tr>
						<th>活動名稱</th>
						<td><?php echo($getname);?></td>
					</tr>
					<tr>
						<th>連絡電話</th>
						<td><?php echo($getphone);?></td>
					</tr>
					<tr>
						<th>參加人數</th>
						<td><?php echo($getattend) . "人";?></td>
					</tr>
					<?php
						// check borrow day have collision
						$stmt = $mysqli->prepare("SELECT date,time,loc,admin_result
												  FROM dorm_list
												  WHERE date = ? AND loc = ?
												  AND admin_result = 'wait'
												  ORDER by time");
						$stmt->bind_param("ss" , $getdate , $str_loc );
						$stmt->execute();
						$stmt->bind_result($no,$time,$no,$result);

						$wait_msg = "";
						$wait_count = 0;

						while( $stmt->fetch() )
						{
							if( time_collision( $str_time , $time ) )
							{
								$sh = substr( $time , 0 , 2 );
								$sm = substr( $time , 2 , 2 );
								$eh = substr( $time , 4 , 2 );
								$em = substr( $time , 6 , 2 );
								if( $wait_count == 0 )
								{
									$wait_msg .= $sh.":".$sm." - ".$eh.":".$em;
									$wait_count++;
								}
								else
								{
									$wait_msg .= " , ".$sh.":".$sm." - ".$eh.":".$em;
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

			<table class = "table1">
				<tbody>
					<tr>
						<td>
							<h2 class="text-center"><b>同意書</b></h2>
								<p class = "ps">
									本人<strong style="display: inline-block;width:100px;text-align:center;"><?php echo($getpm);?></strong>
									承辦<strong style="display: inline-block;width:150px;text-align:center;"><?php echo($getclub);?></strong>
									(社團名稱)於<strong style="display: inline-block;width:40px;text-align:center;">
			<?php // using the reGex if i java time...
				$datearray = explode("-",$getdate);
				$chyear = (int)$datearray[0] - 1911;
				echo($chyear);
			?></strong>
			年<strong style="display: inline-block;width:35px;text-align:center;"><?php echo($datearray[1]);?></strong>
			月<strong style="display: inline-block;width:35px;text-align:center;"><?php echo($datearray[2]);?></strong>
			日<strong style="display: inline-block;width:35px;text-align:center;"><?php echo($getsh);?></strong>
			時起至<strong style="display: inline-block;width:35px;text-align:center;"><?php echo($geteh);?></strong>
			時止，<br>
			舉辦<strong style="display: inline-block;width:240px;text-align:center;"><?php echo($getname);?></strong>
			活動，申請借用學生宿舍學士班<strong style="display: inline-block;width:180px;text-align:center;"><?php
				echo $getloc == "CD棟前近樓梯處(限借桌1張、椅2張)"?"CD棟前近樓梯處":$getloc;
			?></strong>
			(場地名稱)，基於宿舍安全及環境衛生考量，同意配合禁止舉辦炊煮形式活動，以及將確實配合維護宿舍環境安寧，不使用擴音器材，夜間22時準時結束活動並解散，如有違反，願接受校規處分。<br>
			此致  學務處生活事務組</p>
			<p class = "pr">
				立同意書人:<strong style="display: inline-block;width:150px;text-align:right;"><?php echo($getpm);?></strong><br>
				系級：<strong style="display: inline-block;width:150px;text-align:right;"><?php echo($getdep);?></strong><br>
				學號：<strong style="display: inline-block;width:150px;text-align:right;"><?php echo($getschid);?></strong><br>
			</p>
			<p class = "pd">
				中華民國
				<span style="display: inline-block;width:100px;text-align:center"><?php echo date("Y") - 1911;?></span>年
				<span style="display: inline-block;width:100px;text-align:center"><?php echo date("m");?></span>月
				<span style="display: inline-block;width:100px;text-align:center"><?php echo date("d");?></span>日
			</p>
			</td>
			</tr>
			</tbody>
			</table>
				<input type="hidden" name="date" value="<?php echo($getdate);?>" />
				<input type="hidden" name="time" value="<?php echo $str_time;?>" />
				<input type="hidden" name="loc" value="<?php echo($str_loc);?>" />
				<input type="hidden" name="club" value="<?php echo($getclub);?>" />
				<input type="hidden" name="pm" value="<?php echo($getpm);?>" />
				<input type="hidden" name="name" value="<?php echo($getname);?>" />
				<input type="hidden" name="phone" value="<?php echo($getphone);?>" />
				<input type="hidden" name="attend" value="<?php echo($getattend);?>" />
				<button type="submit" class="btn btn-default" id="nextstep" style="margin-bottom:10px" >
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			</form>
		</div>
	</div><!-- /.container -->

    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>
		$(function() {
			$( "#u_ru" ).addClass('active');
		});
	</script>
</body>
</html>
