<?php
class Download_Usuarios extends Utils {
private $_infos = array(array('Nome','E-mail','Telefone','Tipo de cadastro','Adicionado em'));
private $csv_handle;

function __construct() {}

public function __run()
{
	$this->__Usuarios();
	
	header("Content-type: text/csv");
	header("Cache-Control: no-store, no-cache");
	header('Content-Disposition: attachment; filename="usuarios_'.date('d-m-y-h-i').'.csv"');
	
	$this->csv_handle = fopen('php://output','w');
	array_walk($this->_infos,array(&$this,'__outputCSV'));
	fclose($this->csv_handle);
}

private function __outputCSV(&$vals,$key) { fputcsv($this->csv_handle, $vals,';','"'); }

private function __Usuarios()
{
	$this->AbrirCon();

	$sql = $this->con->prepare('select cadastro_nome,cadastro_email,cadastro_telefone,if(cadastro_tipo = 1,"Anunciante","Contratante") as tipo,date_format(cadastro_criado,"%d/%m/%Y - %H:%i") as criado from tb_cadastro order by cadastro_nome asc');
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC)) $this->_infos[] = $ret;
	
	$sql->closeCursor();
	
	$this->FecharCon();
}

}
?>