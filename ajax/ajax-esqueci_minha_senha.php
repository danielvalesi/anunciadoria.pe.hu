<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['email']))
{
	require '../src/php_mailer/class.phpmailer.php';
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/esqueci_minha_senha.php';
	
	$ajax = new Esqueci_Minha_Senha();
	echo $ajax->__run();
}

session_write_close();
?>