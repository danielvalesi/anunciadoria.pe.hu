<?php
class Nova_Senha extends Utils {
private $cid;
private $_out = array('s'=>'ok');

function __construct() { $this->cid = $this->DEC($_POST['cid']); }

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__edit())
	{
		$this->FecharCon();
		return ;
	}
	
	$this->FecharCon();
	
	$_SESSION['user'] = $this->cid;
	
	return json_encode($this->_out);
}


/* Salva a nova senha */

private function __edit()
{
	try {
	
		$sql = $this->con->prepare('update tb_cadastro set cadastro_senha=:senha,cadastro_novasenha_data=NULL where cadastro_id=:cid');
		$sql->bindValue(':senha',md5($_POST['senha']),PDO::PARAM_STR);
		$sql->bindValue(':cid',$this->cid,PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { print_r($e); return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

}
?>