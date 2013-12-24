<?php
	session_start();
	if( $_SESSION['id'] != "SE" )
	{
		header("Location:login.php");
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
</head>
	
<body>

	<?php include("user_navbar"); ?>

	<!-- content --!>
	<div class="container">
		<div class="col-md-2 list" >
			<ul class="nav">
				<a href="admin_audit.php" class="list-group-item">審核借用</a>
				<a href="admin_audit_record.php" class="list-group-item active">審核紀錄</a>
				<a href="admin_add.php" class="list-group-item">新增借用</a>
				<a href="admin_record.php" class="list-group-item">借用紀錄</a>
				<a href="admin_index.php" class="list-group-item">管理介面</a>
			</ul>
		</div>
		
		<div class="col-md-10" >
			<br>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>日期</th>
						<th>時間</th>
						<th>地點</th>
<!--					<th>活動</th>		--!>
						<th>社團</th>
						<th>申請人</th>
						<th>連絡電話</th>
						<th>參加人數</th>
					</tr>
				</thead>
				<tbody>
		
		<?php
			require("config/config.php");
	
			$stmt = $mysqli->prepare("SELECT id,date,time,loc,club,pm,name,phone,attend,bdate,btime,admin_result
	                          FROM dorm_list WHERE admin_result != ? ORDER By date");
	
	$res = "Waiting";
	$stmt->bind_param("s", $res);
	
	$stmt->execute();

	$stmt->bind_result($id,$date,$time,$loc,$club,$pm,$name,$phone,$attend,$bdate,$btime,$ad_result);

	$borrowed = false;
				
	for( $i = 1 ;  $stmt->fetch() ; $i++ )
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

		if( strpos($loc,'CD棟前進樓梯處(限借桌1張、椅2張)') === false )
		{
			$list .= $loc . "</td><td>";
		}
		else
		{
			$list .= "CD棟前進樓梯處</td><td>";
		}
		
//		$list .= $name . "</td><td>";
		$list .= $club . "</td><td>";
		$list .= $pm . "</td><td>";
		$list .= $phone . "</td><td>";
		$list .= $attend . "</td><tr>";
		$borrowed = true;

		echo $list;
	}

	if( !$borrowed )
	{
		echo "<tr><td colspan='2'>無借用資料</td></tr>";
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
