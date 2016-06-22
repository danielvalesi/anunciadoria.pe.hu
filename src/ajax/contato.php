<?php
class Contato extends Utils {
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
	
	$out = $this->__CarregaEmailTemplate('contato');
	
	$this->FecharCon();
	
	$_assunto = (isset($_POST['assunto']))?$_POST['assunto']:'--';
	$_telefone = (isset($_POST['telefone']))?$_POST['telefone']:'--';
	$_msg = (isset($_POST['msg']))?$_POST['msg']:'--';
	
	return $this->__EnviaEmailTemplate($out,NULL,array('[@tipo]','[@assunto]','[@nome]','[@email]','[@telefone]','[@msg]'),array($_POST['tipo'],$_assunto,$_POST['nome'],$_POST['email'],$_telefone,nl2br($_msg)));
}

}
?>