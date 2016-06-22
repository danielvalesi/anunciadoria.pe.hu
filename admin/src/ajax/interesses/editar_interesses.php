<?php
class Editar_Interesses extends Utils {

function __construct() {}

public function __run()
{
	$this->AbrirCon();
	
	$this->__DeletarSubcategorias();
	$this->__AdicionarSubcategorias();
		
	$this->FecharCon();
	
	return 'ok';
}

private function __DeletarSubcategorias()
{
	if(!isset($_POST['dels'])) return ;
	
	try {
	
		$sql = $this->con->prepare('delete from tb_interesse_item where interesse_item_id=:sid');
		$sql->bindParam(':sid',$_sid,PDO::PARAM_INT);
	
		foreach($_POST['dels'] as $_sid) $sql->execute();
	
	}
	catch(PDOException $e) { return ; }
}

private function __AdicionarSubcategorias()
{
	try {
	
		foreach($_POST['subcats'] as $a)
		{
			$a['v'] = trim($a['v']);
		
			if(isset($a['id']))
			{
				$sql = $this->con->prepare('update ignore tb_interesse_item set interesse_item_nome=:nome,interesse_item_editado=now() where interesse_item_id=:sid');
				$sql->bindValue(':sid',$a['id'],PDO::PARAM_INT);
			}
			else
			{
				$sql = $this->con->prepare('insert ignore into tb_interesse_item(interesse_item_nome,interesse_id) values(:nome,:cid)');
				$sql->bindValue(':cid',$_POST['cid'],PDO::PARAM_INT);
			}
			
			$sql->bindValue(':nome',$a['v'],PDO::PARAM_STR);
			$sql->execute();
		}
	
	}
	catch(PDOException $e) { return ; }
}

}
?>