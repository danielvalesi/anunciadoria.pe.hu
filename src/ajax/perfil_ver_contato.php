<?php
class Perfil_Ver_Contato extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__CadUI($_POST['cid']) or !$this->__add())
	{
		$this->FecharCon();
		return ;
	}
		
	$this->FecharCon();
	
	$this->_out['t'] = $this->_cad_ui['cadastro_telefone'];
	
	$this->AddCookie('perfil_'.$_POST['cid'],1,3600);
	
	return json_encode($this->_out);
}

/* Adiciona uma nova mensagem */

private function __add()
{
	if(isset($_COOKIE['perfil_'.$_POST['cid']])) return true;

	try {
	
		$sql = $this->con->prepare('insert into tb_cadastro_relatorio(cadastro_relatorio_data,cadastro_id) values(date(now()),:cid) on duplicate key update cadastro_relatorio_quantidade=cadastro_relatorio_quantidade+1');
		$sql->bindValue(':cid',$_POST['cid'],PDO::PARAM_INT);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	return true;
}

}
?>