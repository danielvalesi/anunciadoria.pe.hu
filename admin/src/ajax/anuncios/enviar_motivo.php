<?php
class Enviar_Motivo extends Utils {
private $_infos;
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__Anuncio())
	{
		$this->FecharCon();
		return ;
	}
	
	$out = $this->__CarregaEmailTemplate('motivo-nao-aprovado');
		
	$this->FecharCon();
	
	$this->__EnviaEmailTemplate($out,$this->_infos['cadastro_email'],array('[@nome]','[@anuncio_titulo]','[@msg]'),array($this->_infos['cadastro_nome'],$this->_infos['anuncio_titulo'],nl2br($_POST['msg'])));
	
	return json_encode($this->_out);
}

/* Informações do anuncio */

private function __Anuncio()
{
	$sql = $this->con->prepare('select a.anuncio_titulo,b.cadastro_nome,b.cadastro_email from tb_anuncio a inner join tb_cadastro b on b.cadastro_id=a.cadastro_id where a.anuncio_id=:aid');
	$sql->bindValue(':aid',(int)$_POST['aid'],PDO::PARAM_INT);
	$sql->execute();
	
	$this->_infos = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->_infos) return ;
	
	return true;
}

}
?>