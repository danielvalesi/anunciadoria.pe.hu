<?php
class Sugerir_Segmento extends Utils {
private $out = array('s'=>'ok');

function __construct() { parent::__construct(); }

public function __run()
{	
	if(!$this->__EnviarMSG()) return ;
	
	return json_encode($this->out);
}


/* Faz o envio da mensagem */

private function __EnviarMSG()
{
	$this->AbrirCon();
	
	$out = $this->__CarregaEmailTemplate('sugerir-segmento');
	
	$this->FecharCon();
	
	return $this->__EnviaEmailTemplate($out,NULL,array('[@nome]'),array($_POST['nome']));
}

}
?>