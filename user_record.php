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
	<title> user index </title>
	
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

	</script>
</head>
	
<body>

	<?php include("user_navbar"); ?>

	<!-- content --!>
	<div class="container">
		<div class="col-md-2 list" >
			<ul class="nav">
				<a href="user_rules.php" class="list-group-item">新增借用</a>
				<a href="user_record.php" class="list-group-item active">借用紀錄</a>
				<a href="user_index.php" class="list-group-item">管理介面</a>
			</ul>
		</div>
		<div class="col-md-10" >
			<br>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>日期</th>
						<th>時段</th>
						<th>地點</th>
						<th>社團</th>
<!--					<th>申請人</th>		--!>
						<th>活動名稱</th>
<!--					<th>連絡電話</th>	--!>
<!--					<th>參加人數</th>	--!>
<!--					<th>借用時間</th>	--!>
						<th>借用結果</th>
<!--					<th>不借用原因</th>	--!>
						<th>詳細資料</th>
					</tr>
				</thead>
				<tbody>
				<?php
					require("config/config.php");
					$stmt = $mysqli->prepare("SELECT date,time,loc,club,pm,name,
					                              phone,attend,bdate,btime,admin_result,
					                              admin_reason,sid
					                              FROM dorm_list WHERE sid = ?
					                              ORDER BY date");
					
					if( !($stmt->bind_param( "s" , $_SESSION['id'] )))
					{
						echo "Prepare failed (" . $mysqli->errno . ") " . $mysqli->error;
					}
					$stmt->execute();

					$stmt->bind_result($date,$time,$loc,$club,$pm,$name,
									   $phone,$attend,$bdate,$btime,$ad_result,$ad_reason,$sid);
					
					while( $stmt->fetch() )
					{
						$list = "<tr><td>";
						$list .= $date . "</td><td>";
						
						$str_time=$time;
						$sh = substr( $str_time , 0 , 2 );
						$sm = substr( $str_time , 2 , 2 );
						$eh = substr( $str_time , 4 , 2 );
						$em = substr( $str_time , 6 , 2 );
						$time = ($sh . ":" . $sm . " - " . $eh . ":" . $em);

						$list .= $time . "</td><td>";
						
						
						$list .= $loc . "</td><td>";
						$list .= $club . "</td><td>";
						//$list .= $pm . "</td><td>";
						$list .= $name . "</td><td>";
						//$list .= $phone . "</td><td>";
						//$list .= $attend . "</td><td>";
						//$list .= $bdate . " " . $btime . "</td><td>";
						$list .= $ad_result . "</td><td>";
						//$list .= $ad_reason . "</td></tr>";
						$list .= '<div class="btn btn-default">Detail</div>' . "</td></tr>";
						echo $list;
					}
					echo ("\n");
				?>
				</tbody>
			</table>
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
