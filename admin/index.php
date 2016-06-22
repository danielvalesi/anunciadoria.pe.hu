<?php
ini_set('session.gc_probability',0);
ini_set('display_errors',1);
error_reporting(E_ALL);

if(isset($_GET['sk'])) session_id($_GET['sk']);

session_start();

require 'src/_boot.php';
require 'src/_config.php';
require 'src/utils.php';
require 'src/init.php';

$c = new Init();

$c->__www();

if($c->isLoggedUser())
{
	$c->__run();
	$c->getJsFiles();
	$c->getJsGlobal();
	$c->getJsReady();

	require 'html_tpl/head.php';
	require 'html_tpl/header.php';
	require 'html_tpl/'.$c->html_tpl.'.php';
	require 'html_tpl/footer.php';
}
else
{
	if($c->pn != 'index') $c->__rError();

	require 'html_tpl/login.php';
}

$c->FecharCon();
session_write_close();
?>