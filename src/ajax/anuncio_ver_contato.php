<?php
class Anuncio_Ver_Contato extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__AnuUI($_POST['aid']) or !$this->__add())
	{
		$this->FecharCon();
		return ;
	}
		
	$this->FecharCon();
	
	$this->_out['t'] = $this->_anu_ui['anuncio_telefone'];
	
	$this->AddCookie('anuncio_'.$_POST['aid'],1,3600);
	
	return json_encode($this->_out);
}

/* Adiciona um novo relatorio ao anuncio */

private function __add()
{
	if(isset($_COOKIE['anuncio_'.$_POST['aid']])) return true;

	try {
	
		$sql = $this->con->prepare('insert into tb_anuncio_relatorio(anuncio_relatorio_data,anuncio_id) values(date(now()),:aid) on duplicate key update anuncio_relatorio_quantidade=anuncio_relatorio_quantidade+1');
		$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	return true;
}

}
?>