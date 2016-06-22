<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(700);

session_start();

if(isset($_POST['cep']) and isset($_POST['rua']) and isset($_POST['numero']) and isset($_POST['bairro']) and isset($_POST['cidade']) and isset($_POST['estado']) and isset($_POST['titulo']) and isset($_POST['telefone']))
{
	require '../../src/_config.php';
	require '../../src/utils.php';
	require '../../src/ajax/minha-conta/cadastrar_anuncio.php';
	
	$ajax = new Cadastrar_Anuncio();
	echo $ajax->__run();
}

session_write_close();
?>