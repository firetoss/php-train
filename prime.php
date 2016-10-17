<?php
	function is_prime($value)
	{
		if ($value <= 1) {
			return false;
		}

		for ($i=2; $i < $value; $i++) { 
			if ($value % $i === 0) {
				return false;
			}
		}

		return true;
	}

	function get_microtime()
	{
		list($usec, $sec) = explode(" ", microtime());

		return ((float)$usec + (float)$sec);
	}

	$num = intval(readline('please enter a number:'));

	$start = get_microtime();
	for ($i = 0; $i <= $num; $i++) { 
		if (is_prime($i)) {
			echo "$i\r\n";
		}
	}
	$end = get_microtime();

	echo 'exec time:' . ($end - $start) * 1000 . "\r\n";
?>
