<?php
class Deletar_Conta extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/excluir-conta';
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->AbrirCon();
		
		if(!$this->__del())
		{
			$this->FecharCon();
			return ;
		}
		
		$this->FecharCon();
		
		unset($_SESSION['user']);
	}
	
	return json_encode($this->_out);
}

/* Deleta a conta */

private function __del()
{
	try {
		
		$sql = $this->con->prepare('delete from tb_cadastro where cadastro_id=:cid');
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;;
}

}
?>