<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['email']))
{
	require '../src/_config.php';
	require '../src/utils.php';
	require '../src/ajax/newsletter.php';
	
	$ajax = new Newsletter();
	echo $ajax->__run();
}

session_write_close();
?>