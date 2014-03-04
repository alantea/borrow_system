<?php
	session_start();
	if( !isset($_SESSION['id']))
	{
		include("nologin.php");
		die();
	}
	
	require("inc/func.php");

	/***********check it hava POST data & it's vaild input ***************/
	if( !isset($_POST['date']) || !isset($_POST['time']) || !isset($_POST['loc']) ||
		!isset($_POST['club']) || !isset($_POST['pm']) || !isset($_POST['name']) ||
		!isset($_POST['phone']) || !isset($_POST['attend']) )
	{
		$_SESSION['in_fail'] = 3;
		header("Location:insert_fail.php");
		die();
	}
	else if( !validateDate( $_POST['date'] , 'Y-m-d' ) )
	{
		$_SESSION['in_fail'] = 4;
		header("Location:insert_fail.php");
		die();
	}
	
	require("config/config.php");
	date_default_timezone_set('Asia/Taipei');
	
	$getdate = htmlentities( $_POST['date'] );
	$gettime = htmlentities( $_POST['time'] );
	$getloc = htmlentities( $_POST['loc'] );
	$getclub = htmlentities( $_POST['club'] );
	$getpm = htmlentities( $_POST['pm'] );
	$getname = htmlentities( $_POST['name'] );
	$getphone = htmlentities( $_POST['phone'] );
	$getattend = htmlentities( $_POST['attend'] );

	$borrowday = date("Y-m-d" , strtotime( $getdate ));
	$today = date("Y-m-d");
	
	/*	check borrow time is in correct date
	 *	General borrow in 10 days
	 *	Spectial borrow in 30 days
	 */

	if( !isset($_SESSION['special']) )
	{
		$tenday = date("Y-m-d" , mktime( 0 , 0 , 0 , date("m") , date("d") + 10 , date("Y") ));
		if( $borrowday > $tenday || $borrowday < $today )
		{
			$_SESSION['in_fail'] = 6;
			header("Location:insert_fail.php");
			die();
		}
	}
	else if( isset($_SESSION['special']) == 1 )
	{
		$thirtyday = date("Y-m-d" , mktime( 0 , 0 , 0 , date("m") , date("d") + 30 , date("Y") ));
		if( $borrowday > $thirtyday || $borrowday < $today )
		{
			$_SESSION['in_fail'] = 6;
			header("Location:insert_fail.php");
			die();
		}
	}

	/*
	 * Check time is correct : General borrow is less equal than 3 hours
	 */
	$str_time = $gettime;
	$insh = (int)substr( $str_time , 0 , 2 );
	$insm = (int)substr( $str_time , 2 , 2 );
	$ineh = (int)substr( $str_time , 4 , 2 );
	$inem = (int)substr( $str_time , 6 , 2 );
	if(( $insh > $ineh ) || (( $insh == $ineh ) && ( $insm >= $inem )))
	{
		$_SESSION['in_fail'] = 5;
		header("Location:insert_fail.php");
		die();
	}
	else if( !isset($_SESSION['special']) && ( $ineh - $insh == 3 &&  $inem - $insm > 0 ) )
	{
		$_SESSION['in_fail'] = 5;
		header("Location:insert_fail.php");
		die();
	}

	$id = $_SESSION['id'];

	/*
	 * check the time is not collision in others which is permit
	 */
	 
	$check_time_col = $mysqli->prepare("SELECT date,time,loc,admin_result FROM dorm_list
										WHERE date = ? AND loc = ? AND admin_result = 'permit'");
	$check_time_col->bind_param("ss" , $getdate , $getloc );
	$check_time_col->execute();
	$check_time_col->bind_result($nop,$time,$nop,$nop);

	while( $check_time_col->fetch() )
	{
		if( time_collision( $gettime , $time ) )
		{
			$_SESSION['in_fail'] = 1;
			header("Location:insert_fail.php");
			die();
		}
	}

	/*
	 * Execute to insert data
	 */
	$stmt = $mysqli->prepare("INSERT INTO dorm_list(date,time,loc,club,pm,name,
				              phone,sid,attend,bdate,btime) VALUES
				              ( ? , ? , ? , ? , ? , ? , ? , ? , ? , CURDATE() , CURTIME() )");
	if( !($stmt->bind_param( "ssssssssi" , $getdate ,  $gettime , $getloc ,
										   $getclub , $getpm , $getname ,
										   $getphone , $id , $getattend )))
	{
		echo "Prepare failed (" . $mysqli->errno . ") " . $mysqli->error;
		header("Location:insert_fail.php");
		die();
	}
	
	if( $stmt->execute() )
	{
		header("Location:insert_success.php");
		die();
	}
	else
	{
		 $_SESSION['in_fail'] = 2;
		header("Location:insert_fail.php");
		die();
	}

?>
