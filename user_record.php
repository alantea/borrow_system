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
	<title> 借用紀錄 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/jquery-ui.min.css" rel="stylesheet" />
	<link href="css/theme.bootstrap.css" rel="stylesheet" />

	<!-- Custom styles -->
	<link href="css/custom/user_fix-top.css" rel="stylesheet" />
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
</head>
	
<body>
	<?php include("user_navbar.php"); ?>
	<!-- content -->
	<div class="container">
		<?php include("user_left_navbar.php"); ?>
		<div class="col-md-10">
			<table class="table table-bordered tablesorter" id="user_table">
				<thead>
					<tr>
						<th>日期</th>
						<th>時段</th>
						<th>地點</th>
						<th>社團</th>
						<th>活動名稱</th>
						<th>借用結果</th>
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
					$stmt = $mysqli->prepare("SELECT date,time,loc,club,pm,name,
					                              phone,attend,bdate,btime,admin_result,
					                              admin_reason,sid
					                              FROM dorm_list WHERE sid = ?
					                              ORDER BY date DESC");
					
					if( !($stmt->bind_param( "s" , $_SESSION['id'] )))
					{
						echo "Prepare failed (" . $mysqli->errno . ") " . $mysqli->error;
					}
					$stmt->execute();
					$stmt->bind_result($date,$time,$loc,$club,$pm,$name,
									   $phone,$attend,$bdate,$btime,$ad_result,$ad_reason,$sid);
					
					for( $i = 1 ; $stmt->fetch() ; $i++ )
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
						$list .= $name . "</td>";
						$list .= '<td class="' . $ad_result . '">';
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
						$list .= "</td><td>";
						//$list .= $ad_reason . "</td></tr>";
						$list .= '
<div class="btn btn-default" data-toggle="modal" data-target="#myModal' . $i . '">Detail</div>
	<div class="modal fade" id="myModal' . $i . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel' . $i . '" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Detail</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<label for="date" class="col-xs-3">日期</label>
						<div class="col-xs-9">' . $date . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">時段</label>
						<div class="col-xs-9">' . $time . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">地點</label>
						<div class="col-xs-9">' . $loc . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">社團</label>
						<div class="col-xs-9">' . $club . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">申請人</label>
						<div class="col-xs-9">' . $pm . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">活動名稱</label>
						<div class="col-xs-9">' . $name . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">連絡電話</label>
						<div class="col-xs-9">' . $phone . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">參加人數</label>
						<div class="col-xs-9">' . $attend . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">借用時間</label>
						<div class="col-xs-9">' . $bdate . ' ' . $btime . '</div>
					</div>
					<div class="row">
						<label for="date" class="col-xs-3">借用結果</label>
						<div class="col-xs-9">';
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
					</div>';
						if( $ad_result == 'deny' )
						{
							$list .='
					<div class="row">
						<label for="date" class="col-xs-3">不借用原因</label>
						<div class="col-xs-9">' . $ad_reason . '</div>
					</div>';
						}
						$list .='
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->' . '</td></tr>';
						echo $list;
					}
					$stmt->close();
					$mysqli->close();
				?>
				</tbody>
			</table>
		</div>
	</div><!-- /.container -->

    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.tablesorter.min.js"></script>
	
	<script src="js/jquery.tablesorter.bootstrap.js"></script>
	<script src="js/jquery.tablesorter.widgets.min.js"></script>
	<script src="js/jquery.tablesorter.pager.min.js"></script>
	<script src="js/jquery.tablesorter.pager.bootstrap.js"></script>
	<script>
		$("#u_re").addClass('active');
	</script>
</body>
</html>
