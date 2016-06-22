<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['src']) and isset($_POST['rotate']) and isset($_POST['x']) and isset($_POST['y']) and isset($_POST['width']) and isset($_POST['height']) and isset($_POST['_act']))
{
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/crop.php';
	
	$ajax = new Crop();
	echo $ajax->__run();
}

session_write_close();
?>