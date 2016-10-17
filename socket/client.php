<?php 
	// client
	$socket = fsockopen("0.0.0.0", 8001, $errorno, $errstr, 1);
	if (!$socket) {
		echo "$error($errno) \n";
	}
	else {
		socket_set_blocking($socket, false);
		fwrite($socket, "sending data...\r\n");
		fwrite($socket, "end \r\n");

		while (!feof($socket)) {
			echo fread($socket, 128);
			flush();
			ob_flush();
			sleep(1);
		}

		fclose($socket);
	}
?>