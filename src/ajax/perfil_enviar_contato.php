<?php
class Perfil_Enviar_Contato extends Utils {
private $_out = array('s'=>'ok');

function __construct() { parent::__construct(); }

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__CadUI($_POST['cid']) or !$this->__add())
	{
		$this->FecharCon();
		return ;
	}
		
	$out = $this->__CarregaEmailTemplate('perfil-enviar-contato');
		
	$this->FecharCon();
		
	$this->__EnviaEmailTemplate($out,$this->_cad_ui['cadastro_email'],array('[@nome]','[@link]','[@contato_nome]','[@contato_email]','[@contato_telefone]','[@contato_msg]'),array($this->_cad_ui['cadastro_nome'],$this->base.'minha-conta/mensagens/',$_POST['nome'],$_POST['email'],$_POST['telefone'],nl2br($_POST['msg'])));
	
	return json_encode($this->_out);
}

/* Adiciona uma nova mensagem */

private function __add()
{
	try {
	
		$sql = $this->con->prepare('insert into tb_cadastro_contato(cadastro_contato_nome,cadastro_contato_email,cadastro_contato_telefone,cadastro_contato_msg,cadastro_id,cid) values(:nome,:email,:telefone,:msg,:cid,:cid2)');
		$sql->bindValue(':nome',$_POST['nome'],PDO::PARAM_STR);
		$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$sql->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
		$sql->bindValue(':msg',$_POST['msg'],PDO::PARAM_STR);
		$sql->bindValue(':cid2',$_POST['cid'],PDO::PARAM_INT);
		
		if(isset($_SESSION['user']))
		{
			$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		}
		else
		{
			$sql->bindValue(':cid',NULL,PDO::PARAM_NULL);
		}
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	return true;
}

}
?>