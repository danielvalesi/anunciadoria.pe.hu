<?php
class Nova_Senha_Front extends Init {

function __construct($_init) { $this->_init = $_init; }


/* Verifica se o usuario da nova senha existe */

protected function __Verificar()
{
	if(!isset($_GET['c'])) $this->_init->__rError();

	$sql = $this->_init->con->prepare('select count(cadastro_id) as cv from tb_cadastro where cadastro_id=:cid and timestampdiff(day,cadastro_novasenha_data,now()) = 0');
	$sql->bindValue(':cid',$this->DEC($_GET['c']),PDO::PARAM_INT);
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if($out == 0) $this->_init->__rError();
}

}
?>