<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['aid']))
{
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/anuncio_ver_contato.php';
	
	$ajax = new Anuncio_Ver_Contato();
	echo $ajax->__run();
}

session_write_close();
?>