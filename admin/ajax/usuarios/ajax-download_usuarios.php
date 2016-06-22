<?php
ini_set('display_errors',1);
ini_set('memory_limit','1824M');
error_reporting(E_ALL);

set_time_limit(0);
session_start();

if(isset($_SESSION['user-admin']))
{
	header('Content-type: text/html; charset=utf-8');

	require '../../src/_config.php';
	require '../../src/utils.php';
	require '../../src/ajax/usuarios/download_usuarios.php';
	
	$ajax = new Download_Usuarios();
	echo $ajax->__run();
}

session_write_close();
?>