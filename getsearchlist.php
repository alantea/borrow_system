<table class="table table-hover">
	<thead>
		<tr>
			<th>日期</th>
			<th>時段</th>
			<th>地點</th>
		</tr>
	</thead>
<tbody>

<?php

function trans( $value )
{
	switch($value)
	{
		case 'bab1':
			return '大AB1';
		case 'sab1':
			return '小AB1';
		case 'bcb1':
			return '大CB1';
		case 'scb1':
			return '小CB1';
		case 'cd' :
			return 'CD棟前近樓梯處';
		case 'eb1':
			return 'EB1前空地';
		case 'other':
			return 'other';
		default:
			return 'error';
	}
}

function retrans( $x )
{
	switch($x)
	{
		case '大AB1';
			return 1;
		case '小AB1';
			return 2;
		case '大CB1';
			return 3;
		case '小CB1';
			return 4;
		case 'CD棟前近樓梯處';
			return 5;
		case 'EB1前空地';
			return 6;
		case 'other';
			return 7;
		default:
			return 7;
	}
}

	if( !(isset($_POST['stime']) && isset($_POST['etime']) &&
		isset($_POST['select_loc']) && is_array($_POST['select_loc'])) )
	{
		echo 'error';

	}
	

	$show_loc = array(0,0,0,0,0,0,0,0);
	
	foreach($_POST['select_loc'] as $value){
		$show_loc[ retrans( trans($value) ) ] = 1;
	}

	require("config/config.php");
	
	$stmt = $mysqli->prepare("SELECT date,time,loc,admin_result
	                          FROM dorm_list WHERE date BETWEEN ? AND ? ORDER BY loc");
	$stmt->bind_param("ss", $_POST['stime'] , $_POST['etime'] );

	$stmt->execute();

	$stmt->bind_result($date,$time,$loc,$ad_result);

	$borrowed = false;
	
	for( $i = 1 ;  $stmt->fetch() ; $i++ )
	{
		// Unwrite the admin_result to print
		if( $show_loc[retrans($loc)] == 0 )
		{
			continue;
		}

		$list = "<tr><td>";
		$list .= $date . "</td><td>";
						
		$str_time=$time;
		$sh = substr( $str_time , 0 , 2 );
		$sm = substr( $str_time , 2 , 2 );
		$eh = substr( $str_time , 4 , 2 );
		$em = substr( $str_time , 6 , 2 );
		$time = ($sh . ":" . $sm . " - " . $eh . ":" . $em);
					
		$list .= $time . "</td><td>";
		$list .= $loc . "</td></tr>";

		$borrowed = true;

		echo $list;
	}

	if( !$borrowed )
	{
		echo "<tr><td colspan='3'>無借用資料</td></tr>";
	}
	

?>

</tbody>
