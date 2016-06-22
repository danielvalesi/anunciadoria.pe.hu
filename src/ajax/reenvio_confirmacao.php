<?php
class Reenvio_Confirmacao extends Utils {
private $_out = array('s'=>'ok');

function __construct() { parent::__construct(); }

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta';
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->AbrirCon();
		
		if(!$this->__CadUI())
		{
			$this->FecharCon();
			return ;
		}
		
		$out = $this->__CarregaEmailTemplate('confirmar-cadastro-usuarios');
		
		$this->FecharCon();
		
		$this->__EnviaEmailTemplate($out,$this->_cad_ui['cadastro_email'],array('[@nome]','[@link]'),array($this->_cad_ui['cadastro_nome'],$this->base.'confirmar-cadastro/?c='.urlencode($this->ENC($_SESSION['user']))));
	}
	
	return json_encode($this->_out);
}

}
?>