<?php
class Cadastro02 extends Utils {
private $_out = array('s'=>'ok');

function __construct() { parent::__construct(); }

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'cadastro';
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->AbrirCon();
		
		if(!$this->__CadUI() or !$this->__edit())
		{
			$this->FecharCon();
			return ;
		}
		
		$this->__AdicionarInteresses();
		
		$out = $this->__CarregaEmailTemplate('confirmar-cadastro-usuarios');
		
		$this->FecharCon();
		
		$this->__EnviaEmailTemplate($out,$this->_cad_ui['cadastro_email'],array('[@nome]','[@link]'),array($this->_cad_ui['cadastro_nome'],$this->base.'confirmar-cadastro/?c='.urlencode($this->ENC($_SESSION['user']))));
	
		$this->_out['email'] = $this->_cad_ui['cadastro_email'];
	}
	
	return json_encode($this->_out);
}

/* Adiciona os interesses */

private function __AdicionarInteresses()
{
	$sql = $this->con->prepare('delete from tb_cadastro_interesse where cadastro_id=:cid');
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->execute();
	$sql->closeCursor();

	if(!isset($_POST['i'])) return ;

	try {
	
		$sql = $this->con->prepare('insert ignore into tb_cadastro_interesse(cadastro_id,interesse_item_id) values(:cid,:iid)');
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		$sql->bindParam(':iid',$iid,PDO::PARAM_INT);
		
		foreach($_POST['i'] as $iid) $sql->execute();
	
	}
	catch(PDOException $e) { return ; }
}

/* Edita o cadastro e coloca o endereço */

private function __edit()
{
	try {
	
		$sql = $this->con->prepare('update tb_cadastro set cadastro_endereco_cep=:cep,cadastro_endereco_rua=:rua,cadastro_endereco_numero=:numero,cadastro_endereco_bairro=:bairro,cadastro_endereco_complemento=:complemento,cadastro_endereco_cidade=:cidade,cadastro_endereco_estado=:estado,cadastro_fotoPerfil=:foto,cadastro_editado=now() where cadastro_id=:cid');
		$sql->bindValue(':cep',$_POST['cep'],PDO::PARAM_STR);
		$sql->bindValue(':rua',$_POST['rua'],PDO::PARAM_STR);
		$sql->bindValue(':numero',$_POST['numero'],PDO::PARAM_STR);
		$sql->bindValue(':bairro',$_POST['bairro'],PDO::PARAM_STR);
		$sql->bindValue(':cidade',$_POST['cidade'],PDO::PARAM_STR);
		$sql->bindValue(':estado',$_POST['estado'],PDO::PARAM_STR);
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		
		if(isset($_POST['complemento']))
		{
			$sql->bindValue(':complemento',$_POST['complemento'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':complemento',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['foto']))
		{
			$sql->bindValue(':foto',$_POST['foto'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':foto',NULL,PDO::PARAM_NULL);
		}
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

}
?>