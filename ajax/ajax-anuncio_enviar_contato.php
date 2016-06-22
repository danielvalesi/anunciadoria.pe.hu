<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['aid']) and isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['telefone']) and isset($_POST['msg']))
{
	require '../src/php_mailer/class.phpmailer.php';
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/anuncio_enviar_contato.php';
	
	$ajax = new Anuncio_Enviar_Contato();
	echo $ajax->__run();
}

session_write_close();
?>