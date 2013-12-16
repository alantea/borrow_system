<table class="table table-hover">
	<thead>
		<tr>
			<th>地點</th>
			<th>時間</th>
		</tr>
	</thead>
<tbody>

<?php
	require("config/config.php");
	$date = $_GET['date'];
	if( $date == "" )
	{
		date_default_timezone_set("Asia/Taipei");
		$date = date('Y-m-d', time());
	}
	
	$stmt = $mysqli->prepare("SELECT date,time,loc,admin_result
	                          FROM dorm_list WHERE date = ? ORDER BY loc");
	$stmt->bind_param("s", $date);

	$stmt->execute();

	$stmt->bind_result($date,$time,$loc,$ad_result);

	$borrowed = false;
				
	for( $i = 1 ;  $stmt->fetch() ; $i++ )
	{
		$list = "<tr><td>";
		$list .= $loc . "</td><td>";
						
		$str_time=$time;
		$sh = substr( $str_time , 0 , 2 );
		$sm = substr( $str_time , 2 , 2 );
		$eh = substr( $str_time , 4 , 2 );
		$em = substr( $str_time , 6 , 2 );
		$time = ($sh . ":" . $sm . " - " . $eh . ":" . $em);
					
		$list .= $time . "</td></tr>";

		$borrowed = true;

		echo $list;
	}

	if( !$borrowed )
	{
		echo "<tr><td colspan='2'>本日無借用資料</td></tr>";
	}

	echo ("\n");
	
?>
	</tbody>
</table>
