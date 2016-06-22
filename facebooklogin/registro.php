<?php 
require_once("src/Facebook.php");

$config = array();
$config['appId'] = '1692271104370843';
$config['secret'] = 'f40c10fa348761d86efc8bd1a0eb2b2f';

$facebook = new Facebook($config);
$facebook_id = $facebook->getUser();

//$datos = $facebook->api("/me");

if ($facebook_id!=0){
	echo "Conectado";
} else {
	echo "Não conectado";
}
