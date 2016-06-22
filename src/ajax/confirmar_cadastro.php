<?php
class Confirmar_Cadastro extends Utils {
private $cid;

function __construct()
{
	parent::__construct();
	$this->cid = $this->DEC($_GET['c']);
}

public function __run()
{
	$this->AbrirCon();
		
	$out = $this->__edit();
		
	$this->FecharCon();
	
	if($out)
	{
		$_SESSION['user'] = $this->cid;
		$this->__rError('minha-conta/');
	}
	else
	{
		$this->__rError();
	}	
}

/* Ativa o cadastro */

private function __edit()
{
	try {
	
		$sql = $this->con->prepare('update tb_cadastro set cadastro_confirmado=now() where cadastro_id=:cid and cadastro_confirmado is null');
		$sql->bindValue(':cid',$this->cid,PDO::PARAM_INT);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

}
?>