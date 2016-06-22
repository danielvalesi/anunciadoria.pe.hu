<?php
class Anuncio_Enviar_Contato extends Utils {
private $_out = array('s'=>'ok');

function __construct() { parent::__construct(); }

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__AnuUI($_POST['aid']) or !$this->__add())
	{
		$this->FecharCon();
		return ;
	}
		
	$out = $this->__CarregaEmailTemplate('anuncio-enviar-contato');
		
	$this->FecharCon();
		
	$this->__EnviaEmailTemplate($out,$this->_anu_ui['cadastro_email'],array('[@nome]','[@link]','[@anuncio_nome]','[@anuncio_ref]','[@contato_nome]','[@contato_email]','[@contato_telefone]','[@contato_msg]'),array($this->_anu_ui['cadastro_nome'],$this->base.'minha-conta/mensagens/',$this->_anu_ui['anuncio_titulo'],$this->_anu_ui['anuncio_id'],$_POST['nome'],$_POST['email'],$_POST['telefone'],nl2br($_POST['msg'])));
	
	return json_encode($this->_out);
}

/* Adiciona uma nova mensagem */

private function __add()
{
	try {
	
		$sql = $this->con->prepare('insert into tb_cadastro_contato(cadastro_contato_nome,cadastro_contato_email,cadastro_contato_telefone,cadastro_contato_msg,cadastro_id,cid,anuncio_id) values(:nome,:email,:telefone,:msg,:cid,:cid2,:aid)');
		$sql->bindValue(':nome',$_POST['nome'],PDO::PARAM_STR);
		$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$sql->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
		$sql->bindValue(':msg',$_POST['msg'],PDO::PARAM_STR);
		$sql->bindValue(':cid2',$this->_anu_ui['cadastro_id'],PDO::PARAM_INT);
		$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
		
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