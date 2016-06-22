<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['cid']) and isset($_POST['offset']))
{
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/perfil_anuncios_pg.php';
	
	$ajax = new Perfil_Anuncios_PG();
	echo $ajax->__run();
}

session_write_close();
?>