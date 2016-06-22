<?php
if(!isset($_COOKIE['test'])) setcookie('test',1,time()+2592000,'/','.anunciadoria.96.lt');

header('Location: http://www.anunciadoria.96.lt/');
?>
