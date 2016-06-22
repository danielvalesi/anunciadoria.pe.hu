<?php
class Download_Contatos extends Utils {
private $_infos = array(array('E-mail'));
private $csv_handle;

function __construct() {}

public function __run()
{
	$this->__Contatos();
	
	header("Content-type: text/csv");
	header("Cache-Control: no-store, no-cache");
	header('Content-Disposition: attachment; filename="contatos_'.date('d-m-y-h-i').'.csv"');
	
	$this->csv_handle = fopen('php://output','w');
	array_walk($this->_infos,array(&$this,'__outputCSV'));
	fclose($this->csv_handle);
}

private function __outputCSV(&$vals,$key) { fputcsv($this->csv_handle, $vals,';','"'); }

private function __Contatos()
{
	$this->AbrirCon();

	$sql = $this->con->prepare('select newsletter_email from tb_newsletter order by newsletter_id desc');
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC)) $this->_infos[] = $ret;
	
	$sql->closeCursor();
	
	$this->FecharCon();
}

}
?>