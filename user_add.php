<?php
	session_start();
	if( !isset($_SESSION['id']) )
	{
		include("nologin.php");
		die();
	}
	if( !isset($_SESSION['agree']) && !isset($_GET['agree']))
	{
		header("Location: user_rules.php");
		die();
	}
	
	$_SESSION['agree'] = 1;
	date_default_timezone_set("Asia/Taipei");	// for date
?>
<!DOCTYPE html>
<html>
<head>
	<title> 新增借用 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/jquery-ui.min.css" rel="stylesheet" />

	<!-- Custom styles -->
	<link href="css/custom/user_fix-top.css" rel="stylesheet" />
	<link href="css/custom/person_add.css" rel="stylesheet" />

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
			<form class="form-horizontal" role="form" action="user_add2.php" method="POST">
				
				<div class="form-group" id="group-datepicker">
					<label for="date" class="col-sm-2 control-label">借用日期</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="datepicker"
						placeholder="<?php echo date('Y-m-d', time()); ?>" name="date" required>
					</div>
				</div>

				<div class="form-group" id="group-time">
					<label for="time" class="col-sm-2 control-label">借用時間</label>
					<div class="col-sm-9 form-inline" id="time">

						<div class="form-group col-sm-2 col-xs-6 time-item">
							<div class="input-group">
								<select class="form-control time-sel" name="sh" id="sh">
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
								</select>
								<span class="input-group-addon time-name">時</span>
							</div>
						</div>
						
						<div class="form-group col-sm-2 col-xs-6 time-item">
							<div class="input-group">
								<select class="form-control time-sel" name="sm" id="sm">
									<option value="00">00</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="40">40</option>
									<option value="50">50</option>
								</select>
								<span class="input-group-addon time-name">分</span>
							</div>
						</div>
						
						<span class="col-sm-1 col-xs-12 time-med">至</span>
						
						<div class="form-group col-sm-2 col-xs-6 time-item">
							<div class="input-group">
								<select class="form-control time-sel" name="eh" id="eh">
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
								</select>
								<span class="input-group-addon time-name">時</span>
							</div>
						</div>
						
						<div class="form-group col-sm-2 col-xs-6 time-item">
							<div class="input-group">
								<select class="form-control time-sel" name="em" id="em">
									<option value="00">00</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="40">40</option>
									<option value="50">50</option>
								</select>
								<span class="input-group-addon time-name">分</span>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group" id="group-loc">
					<label for="loc" class="col-sm-2 control-label">借用地點</label>
					<div class="col-sm-4">
						<select class="form-control" id="loc" name="loc">
							<option value="大AB1">大AB1</option>
							<option value="小AB1">小AB1</option>
							<option value="大CB1">大CB1</option>
							<option value="小CB1">小CB1</option>
							<option value="CD棟前近樓梯處(限借桌1張、椅2張)">CD棟前近樓梯處(限借桌1張、椅2張)</option>
							<option value="EB1前空地">EB1前空地</option>
						</select>
					</div>
				</div>
				
				<div class="form-group" id="group-club">
					<label for="club" class="col-sm-2 control-label">申請社團</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="club" placeholder="中正社" name="club" required>
					</div>
				</div>
				
				<div class="form-group" id="group-pm">
					<label for="pm" class="col-sm-2 control-label">申請人</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="pm" placeholder="林大師" name="pm" required>
					</div>
				</div>

				<div class="form-group" id="group-schid">
					<label for="schid" class="col-sm-2 control-label">申請人學號</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="schid" placeholder="412345678" name="schid" value="<?php echo $_SESSION['id']; ?>" readonly>
					</div>
				</div>

				<div class="form-group" id="group-dep">
					<label for="dep" class="col-sm-2 control-label">申請人系級</label>
				 	<div class="col-sm-4">
				 		<input type="text" class="form-control" id="dep" placeholder="資工三" name="dep" required>
					</div>
				</div>

				<div class="form-group" id="group-name">
					<label for="name" class="col-sm-2 control-label">活動名稱</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="name" placeholder="創社期初大會" name="name" required>
					</div>
				</div>

				<div class="form-group" id="group-phone">
					<label for="phone" class="col-sm-2 control-label">連絡電話</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="phone" placeholder="0911111111" name="phone" required>
					</div>
				</div>

				<div class="form-group" id="group-attend">
					<label for="attend" class="col-sm-2 control-label">參加人數</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="attend" placeholder="60" name="attend" required>
					</div>
				</div>

				<button type="submit" class="btn btn-default" id="nextstep" style="margin-bottom:10px">
					下一步	<span class="glyphicon glyphicon-chevron-right"></span>
				</button>

			</form>
		</div>
	</div><!-- /.container -->

    <!-- core JavaScript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.alphanumeric.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>

	<script>

		$(function() {
			$( "#datepicker" ).datepicker( { dateFormat : "yy-mm-dd" , minDate: -0, maxDate: +10  });
			$( "#u_ru" ).addClass('active');
			$( "#phone" ).tooltip({
				trigger: 'focus',
				placement: 'right',
				title: '只能輸入數字以及 ( ) #'
			});
		});

		function isValidDate(date)
		{
			var matches = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(date);
			if (matches == null) return false;
			var m = matches[2] - 1;
			var y = matches[1];
			var d = matches[3];
			var composedDate = new Date(y, m, d);
			return composedDate.getDate() == d &&
				composedDate.getMonth() == m &&
				composedDate.getFullYear() == y;
		}

		function isInputData(elem)
		{
			var name = elem.id;
			if( $( "#" + name ).val() == "" )
			{
				$( "#group-" + name ).addClass('has-error');
			}
			else
			{
				$( "#group-" + name ).removeClass('has-error');
			}
		}

		// just easy to test that hava input
		$( "#datepicker" ).blur( function(){isInputData(this);} );
		$( "#datepicker" ).change( function(){isInputData(this);} );
		$( "#club" ).blur( function(){isInputData(this);} );
		$( "#club" ).keyup( function(){isInputData(this);} );
		$( "#pm" ).blur( function(){isInputData(this);} );
		$( "#pm" ).keyup( function(){isInputData(this);} );
		$( "#dep" ).blur( function(){isInputData(this);} );
		$( "#dep" ).keyup( function(){isInputData(this);} );
		$( "#name" ).blur( function(){isInputData(this);} );
		$( "#name" ).keyup( function(){isInputData(this);} );
		$( "#phone" ).blur( function(){isInputData(this);} );
		$( "#phone" ).keyup( function(){isInputData(this);} );
		$( "#attend" ).blur( function(){isInputData(this);} );
		$( "#attend" ).keyup( function(){isInputData(this);} );
		
		$( "#nextstep" ).click(function(){
			var error_msg = "";
			if( $("#datepicker").val() == "" ) // check date
			{
				error_msg += "請輸入日期\n";
			}
			else if( !isValidDate( $("#datepicker").val() ) )
			{
				error_msg += "請輸入正確的日期\n";
			}
			
			// check time
			if( ( $("#sh").val() > $("#eh").val() ) ||
				(( $("#sh").val() == $("#eh").val() ) && ( $("#sm").val() >= $("#em").val() )) ||
				( $("#eh").val() - $("#sh").val() > 3 ) ||
				( $("#eh").val() - $("#sh").val() == 3 &&  $("#em").val() - $("#sm").val() > 0 ))
			{
				error_msg += "請輸入正確時間\n";
			}

			if( $("#club").val() == "" )
			{
				error_msg += "請輸入社團\n";
			}
			
			if( $("#pm").val() == "" )
			{
				error_msg += "請輸入申請人\n";
			}
			
			if( $("#dep").val() == "")
			{
				error_msg += "請輸入申請人系級\n";
			}

			if( $("#name").val() == "" )
			{
				error_msg += "請輸入活動名稱\n";
			}
			
			if( $("#phone").val() == "" )
			{
				error_msg += "請輸入電話\n";
			}
			
			if( $("#attend").val() == "" )
			{
				error_msg += "請輸入參加人數";
			}
			else if( ($("#loc").val() == "大AB1" || $("#loc").val() == "大CB1") && 
					  $("#attend").val() < 30 )
			{
				error_msg += $("#loc").val() + "參加人數需30人以上";
			}

			if( error_msg != "" )
			{
				alert( error_msg );
				return false;
			}

			return true;
		});
		$("#phone").numeric({allow:"()#"});
		$("#attend").numeric();

		// prevent chinese
		jQuery('#phone').keyup(function () { 
			this.value = this.value.replace(/[^0-9()#]/g,'')
		});
		jQuery('#attend').keyup(function () { 
			this.value = this.value.replace(/[^0-9]/g,'')
		});
	</script>
</body>
</html>
