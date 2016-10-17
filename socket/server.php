<?php 
	$host = '192.168.0.2';
	$port = 9000;
	set_time_limit(0);

	//server
	$sock = socket_create(AF_INET, SOCK_STREAM, 'TCP') or die("can not create socket\n");
	$bool = socket_bind($sock, '127.0.0.1', 8001);
	if (!$bool) {
		unset($socket);
		exit;
	}
	socket_listen($socket, 256); // 最大连接数：256
	socket_set_block($socket);	 // 非阻塞模式	
?>