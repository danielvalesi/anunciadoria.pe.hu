<?php
class Deletar_Anuncio extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/lista-de-anuncios';
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

/* Deleta um anuncio */

private function __del()
{
	try {
		
		$sql = $this->con->prepare('delete from tb_anuncio where anuncio_id=:aid and cadastro_id=:cid');
		$sql->bindValue(':aid',(int)$_POST['aid'],PDO::PARAM_INT);
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;;
}

}
?>