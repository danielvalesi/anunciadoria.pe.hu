<?php
//sleep(2);
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['_act']) and isset($_FILES['_foto']))
{
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/upload_foto.php';
	
	$ajax = new Upload_Foto();
	echo $ajax->__run();
}

session_write_close();
?>