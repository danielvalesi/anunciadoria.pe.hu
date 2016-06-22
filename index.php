<?php
if(!isset($_COOKIE['test'])) exit(0);

ini_set('session.gc_probability',1);
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

$c->__run();
$c->getJsFiles();
$c->getJsGlobal();
$c->getJsReady();

require 'html_tpl/head.php';
require 'html_tpl/header'.$c->html_tpl['h'].'.php';
require 'html_tpl/'.$c->html_tpl['c'].'.php';
require 'html_tpl/footer'.$c->html_tpl['f'].'.php';

$c->FecharCon();
session_write_close();
?>