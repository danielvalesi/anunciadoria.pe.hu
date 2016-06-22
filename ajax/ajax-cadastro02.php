<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['cep']) and isset($_POST['rua']) and isset($_POST['numero']) and isset($_POST['bairro']) and isset($_POST['cidade']) and isset($_POST['estado']))
{
	require '../src/php_mailer/class.phpmailer.php';
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/cadastro02.php';
	
	$ajax = new Cadastro02();
	echo $ajax->__run();
}

session_write_close();
?>