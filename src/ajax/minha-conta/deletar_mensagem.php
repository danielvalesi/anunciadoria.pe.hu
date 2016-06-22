<?php
class Deletar_Mensagem extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/mensagens';
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
	}
	
	return json_encode($this->_out);
}

/* Deleta uma mensagem */

private function __del()
{
	try {
		
		$sql = $this->con->prepare('delete from tb_cadastro_contato where cadastro_contato_id=:mid and cid=:cid');
		$sql->bindValue(':mid',(int)$_POST['mid'],PDO::PARAM_INT);
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;;
}

}
?>