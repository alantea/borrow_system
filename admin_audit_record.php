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
	<title> 審核紀錄 </title>
	
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
	<link href="css/theme.bootstrap.css" rel="stylesheet" />
	<style>
		.permit{
			color: green;
		}
		.deny{
			color: red;
		}
		.wait{
			color: #0000CC;
		}
	</style>

	<!-- Javascript -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.tablesorter.bootstrap.js"></script>
</head>
	
<body>

	<?php include("user_navbar"); ?>

	<!-- content -->
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
			<table class="table table-hover tablesorter">
				<thead>
					<tr>
						<th>日期</th>
						<th>時間</th>
						<th>地點</th>
						<th>社團</th>
						<th>申請人</th>
						<th>連絡電話</th>
						<th data-sorter="false">參加人數</th>
						<th>審核結果</th>
						<th data-sorter="false">詳細資料</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th colspan="7" class=" ts-pager form-horizontal">
							<button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
							<button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
							<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
							<button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
							<button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
							<select class="pagesize input-mini" title="Select page size">
								<option selected="selected" value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
							</select>
							<select class="pagenum input-mini" title="Select page number"></select>
						</th>
					</tr>
				</tfoot>
				<tbody>
		
		<?php
			require("config/config.php");
	
			$stmt = $mysqli->prepare("SELECT id,date,time,loc,club,pm,name,phone,attend,bdate,btime,admin_name,
											 admin_date,admin_result,admin_reason
	                          FROM dorm_list WHERE admin_result != ? ORDER By date");
	
	$res = "wait";
	$stmt->bind_param("s", $res);
	
	$stmt->execute();

	$stmt->bind_result($id,$date,$time,$loc,$club,$pm,$name,$phone,$attend,$bdate,$btime,$ad_name,$ad_date,$ad_result,$ad_reason);

	$borrowed = false;
				
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

		if( strpos($loc,'CD棟前近樓梯處(限借桌1張、椅2張)') === false )
		{
			$list .= $loc . "</td><td>";
		}
		else
		{
			$list .= "CD棟前近樓梯處</td><td>";
		}
		
//		$list .= $name . "</td><td>";
		$list .= $club . "</td><td>";
		$list .= $pm . "</td><td>";
		$list .= $phone . "</td><td>";
		$list .= $attend . "</td>";
		$list .= '<td class="' . $ad_result . '">';
		if( $ad_result == 'permit' )
		{
			$list .= '通過';
		}
		else if( $ad_result == 'deny' )
		{
			$list .= '不通過';
		}
		$list .= "</td><td>";
		$borrowed = true;
		$list .= '<div class="btn btn-default" data-toggle="modal" 
					   data-target="#myModal' . $id . '">Detail</div>' .
'<div class="modal fade" id="myModal' . $id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel' . $id . '" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
      </div>
      <div class="modal-body">
			<div class="row">
				<label for="date" class="col-sm-3">日期</label>
				<div class="col-sm-5">' . $date . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">時段</label>
				<div class="col-sm-5">' . $time . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">地點</label>
				<div class="col-sm-5">' . $loc . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">社團</label>
				<div class="col-sm-5">' . $club . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">申請人</label>
				<div class="col-sm-5">' . $pm . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">活動名稱</label>
				<div class="col-sm-5">' . $name . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">連絡電話</label>
				<div class="col-sm-5">' . $phone . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">參加人數</label>
				<div class="col-sm-5">' . $attend . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">借用時間</label>
				<div class="col-sm-5">' . $bdate . ' ' . $btime . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">借用結果</label>
				<div class="col-sm-5">';
				if( $ad_result == 'wait' )
				{
					$list .= '處理中';
				}
				else if( $ad_result == 'permit' )
				{
					$list .= '通過';
				}
				else if( $ad_result == 'deny' )
				{
					$list .= '不通過';
				}

				$list .= '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">審核人</label>
				<div class="col-sm-5">' . $ad_name . '</div>
			</div>
			<div class="row">
				<label for="date" class="col-sm-3">審核時間</label>
				<div class="col-sm-5">' . $ad_date . '</div>
			</div>';
			if( $ad_result == 'deny' )
			{
				$list .='
			<div class="row">
				<label for="date" class="col-sm-3">不借用原因</label>
				<div class="col-sm-5">' . $ad_reason . '</div>
			</div>';
			}
			$list .='
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" id="delete' . $id . '">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->' . '</td></tr>';

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
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="js/jquery.tablesorter.widgets.min.js"></script>
	<script src="js/jquery.tablesorter.pager.min.js"></script>
	<script src="js/jquery.tablesorter.pager.bootstrap.js"></script>
</body>
</html>
