<?php
class Login extends Utils {
private $uid;

function __construct() {}

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__check()) return 'err';
	
	$_SESSION['user-admin'] = $this->uid;
	
	return 'ok';
}


/* Verifica se o usuario existe */

private function __check()
{
	$sql = $this->con->prepare('select admin_id from tb_admin where admin_usuario=:usuario and admin_senha=:senha');
	$sql->bindValue(':usuario',$_POST['login'],PDO::PARAM_STR);
	$sql->bindValue(':senha',md5($_POST['senha']),PDO::PARAM_STR);
	$sql->execute();
	
	$this->uid = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if(!$this->uid) return ;
	
	return true;
}

}
?>