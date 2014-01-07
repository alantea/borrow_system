<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> 條件查詢 </title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="css/index.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet" />

	<!-- Javascript -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.ui.datepicker-zh-TW.min.js"></script>
	<script>
		$(document).ready(init);

		function init(){
			$("#search").addClass('active');
		}
	</script>
</head>
	
<body>
	<?php
		if( !isset($_SESSION['id']) )
		{
			include("navbar");
		}
		else
		{
			include("user_navbar");
		}
	?>

	<!-- content -->
	<div class="container">
		<div id="search_list" class="col-md-3 well">
			<form action="/" method="POST" id="search_form">
				<legend>日期區間</legend>
				<label for="start">從</label>
				<input type="text" class="form-control" id="start" name="stime" placeholder="開始時間" />
				<label for="end">到</label>
				<input type="text" class="form-control" id="end" name="etime" placeholder="結束時間" />
		
				<legend>地點</legend>
				<div class="checkbox">
					<input type="checkbox" value="bab1"	name="select_loc[]">大AB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="sab1" name="select_loc[]">小AB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="bcb1" name="select_loc[]">大CB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="scb1" name="select_loc[]">小CB1
				</div>
				<div class="checkbox">
					<input type="checkbox" value="cd" name="select_loc[]">CD棟前近樓梯處
				</div>
				<div class="checkbox">
					<input type="checkbox" value="eb1" name="select_loc[]">EB1前空地
				</div>
				<div class="checkbox">
					<input type="checkbox" value="other" name="select_loc[]">其他場地
				</div>
				<div>
					<a href="javascript:void(0)" id="selectall">選取全部選項</a><br />
					<a href="javascript:void(0)" id="disselectall">取消全部選項</a>
				</div>
				<div>
					<button type="submit" id="formsubmit" class="btn btn-primary">查詢</button>
					<button type="reset" id="clearall" class="btn btn-default">重填</button>
				</div>
			
			</div>
		</form>
		<div id="search_table" class="col-md-6">
			
		</div>
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
		$(function() {
			$( "#start" ).datepicker( { 
				dateFormat : "yy-mm-dd",
				onClose: function( selectedDate ) {
					$( "#end" ).datepicker( "option", "minDate", selectedDate );
				}
			});

			$( "#end" ).datepicker( {
				dateFormat : "yy-mm-dd",
				onClose: function( selectedDate ) {
					$( "#start" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
			$( "#selectall" ).click(function(){
				$("input[name='select_loc[]']").each(function(){
					$(this).prop("checked",true);
				});
			});
			$( "#disselectall" ).click(function(){
				$("input[name='select_loc[]']").each(function(){
					$(this).prop("checked",false);
				});
			});
			$( "#formsubmit").click(function(event){
				event.preventDefault();
				var loc = false;
				var error_msg = "";
				if( $("#start").val() == "" || $("#end").val() == "" )
				{
					error_msg += "請輸入區間\n";
				}
				$("input[name='select_loc[]']").each(function(){
					if( $(this).prop("checked") )
					{
						loc = true;
					}
				});
				if( !loc )
				{
					error_msg += "請至少選擇一個場地";
				}

				if( error_msg != "" )
				{
					alert( error_msg );
					return false;
				}
				
					var request = $.ajax({
					url: "getsearchlist.php",
					type: "POST",
					data: $("#search_form").serialize(),
					dataType: "html"
				});
				request.done(function(msg) {
					$("#search_table").html( msg );
				    var target = "#search_table";
			        $('html, body').animate({
	        	        scrollTop: $(target).offset().top - 50
       	            }, 1500);
				});
			});
		});

    </script>
</body>
</html>
