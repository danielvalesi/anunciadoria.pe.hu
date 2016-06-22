<?php
class Login extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__VerificaCadastro()) $this->_out['s'] = 'err';
	
	return json_encode($this->_out);
}

/* Verifica se o cadastro existe */

private function __VerificaCadastro()
{
	$sql = $this->con->prepare('select cadastro_id from tb_cadastro where cadastro_email=:email and cadastro_senha=:senha');
	$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
	$sql->bindValue(':senha',md5($_POST['senha']),PDO::PARAM_STR);
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	$this->FecharCon();
	
	if(!$out) return ;
	
	$_SESSION['user'] = $out;
	
	return true;
}

}
?>