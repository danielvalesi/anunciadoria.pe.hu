<?php
class Home_Front extends Init {

function __construct($_init) { $this->_init = $_init; }

/* Total de anuncios */

protected function __TotalAnuncios($s=0)
{
	$sql = $this->_init->con->prepare('select count(anuncio_id) from tb_anuncio where anuncio_status=:status');
	$sql->bindValue(':status',$s,PDO::PARAM_INT);
	$sql->execute();
	
	$this->_init->otxt['total_anuncios_'.$s] = $sql->fetchColumn();
	
	$sql->closeCursor();
}

/* Total de usuarios */

protected function __TotalUsuarios()
{
	$sql = $this->_init->con->prepare('select count(cadastro_id) from tb_cadastro');
	$sql->execute();
	
	$this->_init->otxt['total_usuarios'] = $sql->fetchColumn();
	
	$sql->closeCursor();
}

/* Total de newsletters */

protected function __TotalNewsletters()
{
	$sql = $this->_init->con->prepare('select count(newsletter_id) from tb_newsletter');
	$sql->execute();
	
	$this->_init->otxt['total_newsletters'] = $sql->fetchColumn();
	
	$sql->closeCursor();
}

}
?>