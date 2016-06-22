<?php
class Esqueci_Minha_Senha extends Utils {
private $_out = array('s'=>'ok');

function __construct() { parent::__construct(); }

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__CadUI(NULL,$_POST['email']))
	{
		$this->_out['s'] = 'err';
		$this->FecharCon();
	}
	else
	{
		$this->__edit();
		
		$out = $this->__CarregaEmailTemplate('esqueci-minha-senha');
		
		$this->FecharCon();
		
		$this->__EnviaEmailTemplate($out,$_POST['email'],array('[@nome]','[@link]'),array($this->_cad_ui['cadastro_nome'],$this->base.'nova-senha/?c='.urlencode($this->ENC($this->_cad_ui['cadastro_id']))));
	}
	
	return json_encode($this->_out);
}

/* Defini o tempo de duraчуo do link de nova senha */

private function __edit()
{
	try {
	
		$sql = $this->con->prepare('update tb_cadastro set cadastro_novasenha_data=now() where cadastro_id=:cid');
		$sql->bindValue(':cid',$this->_cad_ui['cadastro_id'],PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
}

}
?>