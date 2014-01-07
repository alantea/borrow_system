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
	<title> 審核借用 </title>
	
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
				<a href="admin_audit.php" class="list-group-item active">審核借用</a>
				<a href="admin_audit_record.php" class="list-group-item">審核紀錄</a>
				<a href="admin_add.php" class="list-group-item">新增借用</a>
				<a href="admin_record.php" class="list-group-item">借用紀錄</a>
				<a href="admin_index.php" class="list-group-item">管理介面</a>
			</ul>
		</div>
		
		<div class="col-md-10" style="padding-top:5px">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>日期</th>
						<th>時間</th>
						<th>地點</th>
						<th>活動</th>
						<th>社團</th>
						<th>申請人</th>
						<th>連絡電話</th>
						<th>參加人數</th>
						<th>審核</th>
					</tr>
				</thead>
				<tbody>
		
		<?php
			require("config/config.php");
	
			$stmt = $mysqli->prepare("SELECT id,date,time,loc,club,pm,name,phone,attend,bdate,btime,admin_result
	                          FROM dorm_list WHERE admin_result = ? ");
	
	$res = "wait";
	$stmt->bind_param("s", $res);
	
	$stmt->execute();

	$stmt->bind_result($id,$date,$time,$loc,$club,$pm,$name,$phone,$attend,$bdate,$btime,$ad_result);

	$borrowed = false;
				
	for( $i = 1 ;  $stmt->fetch() ; $i++ )
	{
		$list = '<tr><td>';
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
		
		$list .= $name . "</td><td>";
		$list .= $club . "</td><td>";
		$list .= $pm . "</td><td>";
		$list .= $phone . "</td><td>";
		$list .= $attend . "</td><td>";

		$list .= '<button id="check'. $id .'" data-toggle="collapse" class="btn btn-info" data-target="#collatd' . $id . '">審核</button>' .'</td></tr>';
		
		$list .= '<tr ><td id="collatd' . $id . '" colspan=\'9\' class="collapse">';
			
		$list .= '
				<div class="form-group">
					<div class="col-sm-12">
						<label for="aname" class="col-sm-2 control-label">承辦人</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="aname' . $id . '" placeholder="某" name="aname' . $id . '" required>
						</div>
					</div>
		
					<div class="col-sm-12">
					<label for="aresu" class="col-sm-2 control-label">審核結果</label>
						<div class="radio col-sm-4">
							<div class="col-sm-4">
								<label>
								    <input type="radio" name="aresu' . $id . '" id="aresu_agree' . $id . '" value="permit" checked>
									通過
								</label>
							</div>
							<div class="col-sm-8">
								<label>
									<input type="radio" name="aresu' . $id . '" id="aresu_deny' . $id . '" value="deny" data-toggle="collapse" data-target="#demo' . $id . '">
								    不通過
								</label>
							</div>
						</div>
					</div>
					<div id="demo' . $id . '" class="collapse">
						<label for="ason" class="col-sm-2 control-label">未通過原因</label>
						<div class="col-sm-4">
							<textarea class="form-control" rows="3" id="ason' . $id . '" placeholder="某某原因" name="ason"></textarea>
						</div>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-primary" id="sub' . $id . '">送出</button>
					</div>
				</div>';

		$list .= '</td></tr>';

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
    <script>
		$("[id^='check']").click(function(event){
			var num = (event.target.id).substr(5,(event.target.id).length);	// get the sender id
			var desid = "#collatd" + num;
			var now = $( desid ).css('display');
			if( now == "block" )
			{
				//$( desid ).css("display","none");
				//$( desid ).css("height","0px");
			}
			else
			{
				//$( desid ).css("display","block");
				//$( desid ).css("height","auto");
			}
		});

		$("[id^='aresu_agree']").click(function(event){
			 var num = (event.target.id).substr(11,(event.target.id).length);
			 $( "#demo" + num ).attr( "class" , "collapse" );
			 $( "#demo" + num ).css( "height" , "0px" );
		});

		$("[id^='sub']").click(function(event){
			var num = (event.target.id).substr(3,(event.target.id).length);	// get the sender id
			submit_result(num);
		});

		function submit_result(id)
		{
			var nameval = $( "#aname" + id ).val();

			// permit & deny
			var resuval = $( "input[name=aresu"  + id + "]:checked" ).val();

			var sonval = $( "#ason" + id ).val();

			if( nameval == "" || resuval == "" )
			{
				alert("請確認資料輸入完整");
				return false;
			}
			else if( nameval == "" || ( resuval == "deny" && sonval == "" ) )
			{
				alert("請確認資料輸入完整");
				return false;
			}

			$.ajax({
				type: "POST",
				url: "admin_check_result.php",
				data: { mid: id , name: nameval , ru : resuval , rs: sonval }
			})
			.done(function( msg ) {
				if( msg == "1" )
				{
					$( "#check" + id ).trigger( "click" );	// call click event
					$( "#check" + id ).attr("disabled","disabled");
					$( "#check" + id ).attr("class","btn btn-success");
					$( "#check" + id ).text( "更新成功!!" );
				}
				else
				{
	//				$( "#check" + id ).attr("disabled","disabled");
					$( "#check" + id ).attr("class","btn btn-danger");
					$( "#check" + id ).text( "更新失敗!!" );
					alert( "Error : " + msg );
				}
			});
		}
    </script>
</body>
</html>
