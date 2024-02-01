<?php

	session_start(); //utilização de sessões
	require('vendor/autoload.php');
	date_default_timezone_set('America/Sao_Paulo');
	define('INCLUDE_PATH_STATIC','http://localhost/Kauru/KauruJob/Views/pages/');
	define('INCLUDE_PATH','http://localhost/Kauru/'); 
	$app = new KauruJob\Application();
	$app->run();

?>