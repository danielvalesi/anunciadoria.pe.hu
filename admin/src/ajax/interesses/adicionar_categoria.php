<?php
class Adicionar_Categoria extends Utils {
private $cid;

function __construct() {}

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__Adicionar())
	{
		$this->FecharCon();
		return 'err';
	}
	
	$this->__AdicionarSubcategorias();
		
	$this->FecharCon();
	
	return 'ok';
}


private function __AdicionarSubcategorias()
{
	if(!isset($_POST['subcats'])) return ;
	
	try {
	
		$sql = $this->con->prepare('insert into tb_categoria(categoria_nome,_categoria_id,categoria_url,categoria_hash) values(:nome,:cid,:url,:hash)');
		$sql->bindValue(':cid',$this->cid,PDO::PARAM_INT);
		$sql->bindParam(':nome',$_nome,PDO::PARAM_STR);
		$sql->bindParam(':url',$_url,PDO::PARAM_STR);
		$sql->bindParam(':hash',$_hash,PDO::PARAM_STR);
	
		foreach($_POST['subcats'] as $a)
		{
			$_nome = trim($a['v']);
			$_url = $this->__url($_nome);
			$_hash = md5(mb_strtolower($_nome,'UTF-8').'#hash#'.$this->cid);
			
			$sql->execute();
		}
	
	}
	catch(PDOException $e) { return ; }
}

/* Adicionar categoria */

private function __Adicionar()
{
	$_hash = md5(mb_strtolower(trim($_POST['nome']),'UTF-8').'#hash#');

	try {
	
		$sql = $this->con->prepare('insert into tb_categoria(categoria_nome,categoria_url,categoria_hash) values(:nome,:url,:hash)');
		$sql->bindValue(':nome',trim($_POST['nome']),PDO::PARAM_STR);
		$sql->bindValue(':url',$this->__url(trim($_POST['nome'])),PDO::PARAM_STR);
		$sql->bindValue(':hash',$_hash,PDO::PARAM_STR);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	$this->cid = $this->con->lastInsertId();
	
	if(!$this->cid) return ;
	
	return true;
}

}
?>