<?php
	
	/*
	 * Check the two time is collision
	 * Input time is start hour , start minutes , end hour, end time
	 * Sample : 12001500
	 * From 12:00 to 15:00
	 */
	function time_collision( $t1 , $t2 )
	{
		if( strlen($t1) != 8 || strlen($t2) != 8 )	// is not correct time
		{
			echo ("input time is not correct");
			die();
		}

		$t1sh = (int)substr( $t1 , 0 , 2 );
		$t1sm = (int)substr( $t1 , 2 , 2 );
		$t1eh = (int)substr( $t1 , 4 , 2 );
		$t1em = (int)substr( $t1 , 6 , 2 );
		
		$t2sh = (int)substr( $t2 , 0 , 2 );
		$t2sm = (int)substr( $t2 , 2 , 2 );
		$t2eh = (int)substr( $t2 , 4 , 2 );
		$t2em = (int)substr( $t2 , 6 , 2 );

		if( ( $t1sm + $t1sh * 60 < $t2sm + $t2sh * 60 ) &&
			( $t1em + $t1eh * 60 > $t2sm + $t2sh * 60 ))
		{
			return true;
		}
		else if( ( $t1sm + $t1sh * 60 >= $t2sm + $t2sh * 60 ) &&
				 ( $t1sm + $t1sh * 60 < $t2em + $t2eh * 60 ))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/*
	 * source : http://tw1.php.net/checkdate
	 * check the date format is correct
	 */

	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
?>
