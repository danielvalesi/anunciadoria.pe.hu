<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['cid']) and isset($_POST['subcats']) and count($_POST['subcats']) > 0)
{
	require '../../src/_config.php';
	require '../../src/utils.php';
	require '../../src/ajax/interesses/editar_interesses.php';
	
	$ajax = new Editar_Interesses();
	echo $ajax->__run();
}

session_write_close();
?>