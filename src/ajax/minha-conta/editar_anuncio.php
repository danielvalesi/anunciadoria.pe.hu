<?php
class Editar_Anuncio extends Utils {
private $estado_id;
private $cidade_id;
private $bairro_id;
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/editar-anuncio/'.$_POST['aid'];
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->AbrirCon();
		
		if(!$this->__AdicionarEstado()) $this->__Estado();
		if(!$this->__AdicionarCidade()) $this->__Cidade();
		if(!$this->__AdicionarBairro()) $this->__Bairro();
		
		if(!$this->__edit())
		{
			$this->FecharCon();
			return ;
		}
		
		$this->__AdicionarInteresses();
		$this->__AdicionarFotos();
		
		$this->FecharCon();
	}
	
	return json_encode($this->_out);
}

/* Adiciona as fotos */

private function __AdicionarFotos()
{
	$sql = $this->con->prepare('delete from tb_anuncio_foto where anuncio_id=:aid');
	$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
	$sql->execute();
	$sql->closeCursor();

	if(!isset($_POST['f'])) return ;

	try {
	
		$destaque = 1;
	
		$sql = $this->con->prepare('insert into tb_anuncio_foto(anuncio_id,anuncio_foto_url,anuncio_foto_destaque) values(:aid,:url,:destaque)');
		$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
		$sql->bindParam(':url',$url,PDO::PARAM_STR);
		$sql->bindParam(':destaque',$destaque,PDO::PARAM_INT);
		
		foreach($_POST['f'] as $url)
		{
			$sql->execute();
			$destaque = 0;
		}
	
	}
	catch(PDOException $e) { return ; }
}

/* Adiciona os interesses */

private function __AdicionarInteresses()
{
	$sql = $this->con->prepare('delete from tb_anuncio_interesse where anuncio_id=:aid');
	$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
	$sql->execute();
	$sql->closeCursor();

	if(!isset($_POST['i'])) return ;

	try {
	
		$sql = $this->con->prepare('insert ignore into tb_anuncio_interesse(anuncio_id,interesse_item_id) values(:aid,:iid)');
		$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
		$sql->bindParam(':iid',$iid,PDO::PARAM_INT);
		
		foreach($_POST['i'] as $iid) $sql->execute();
	
	}
	catch(PDOException $e) { return ; }
}

/* Estado */

private $_estado_txt;
private function __Estado()
{
	$sql = $this->con->prepare('select estado_id from tb_estado where estado_url=:url');
	$sql->bindValue(':url',$this->_estado_txt,PDO::PARAM_STR);
	$sql->execute();
	
	$this->estado_id = $sql->fetchColumn();
	
	$sql->closeCursor();
}

private function __AdicionarEstado()
{
	$this->_estado_txt = $this->__url(trim($_POST['estado']));

	try {
	
		$sql = $this->con->prepare('insert into tb_estado(estado_nome,estado_url) values(:nome,:url)');
		$sql->bindValue(':nome',$_POST['estado'],PDO::PARAM_STR);
		$sql->bindValue(':url',$this->_estado_txt,PDO::PARAM_STR);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	$this->estado_id = $this->con->lastInsertId();
	
	return true;
}

/* Cidade */

private $_cidade_txt;
private function __Cidade()
{
	$sql = $this->con->prepare('select cidade_id from tb_cidade where cidade_url=:url and estado_id=:estado_id');
	$sql->bindValue(':url',$this->_cidade_txt,PDO::PARAM_STR);
	$sql->bindValue(':estado_id',$this->estado_id,PDO::PARAM_INT);
	$sql->execute();
	
	$this->cidade_id = $sql->fetchColumn();
	
	$sql->closeCursor();
}

private function __AdicionarCidade()
{
	$this->_cidade_txt = $this->__url(trim($_POST['cidade']));

	try {
	
		$sql = $this->con->prepare('insert into tb_cidade(cidade_nome,cidade_url,estado_id) values(:nome,:url,:estado_id)');
		$sql->bindValue(':nome',$_POST['cidade'],PDO::PARAM_STR);
		$sql->bindValue(':url',$this->_cidade_txt,PDO::PARAM_STR);
		$sql->bindValue(':estado_id',$this->estado_id,PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	$this->cidade_id = $this->con->lastInsertId();
	
	return true;
}

/* Bairro */

private $_bairro_txt;
private function __Bairro()
{
	$sql = $this->con->prepare('select bairro_id from tb_bairro where bairro_url=:url and cidade_id=:cidade_id');
	$sql->bindValue(':url',$this->_bairro_txt,PDO::PARAM_STR);
	$sql->bindValue(':cidade_id',$this->cidade_id,PDO::PARAM_INT);
	$sql->execute();
	
	$this->bairro_id = $sql->fetchColumn();
	
	$sql->closeCursor();
}

private function __AdicionarBairro()
{
	$this->_bairro_txt = $this->__url(trim($_POST['bairro']));

	try {
	
		$sql = $this->con->prepare('insert into tb_bairro(bairro_nome,bairro_url,cidade_id) values(:nome,:url,:cidade_id)');
		$sql->bindValue(':nome',$_POST['bairro'],PDO::PARAM_STR);
		$sql->bindValue(':url',$this->_bairro_txt,PDO::PARAM_STR);
		$sql->bindValue(':cidade_id',$this->cidade_id,PDO::PARAM_INT);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	$this->bairro_id = $this->con->lastInsertId();
	
	return true;
}

/* Edita anuncio */

private function __edit()
{
	try {
	
		$sql = $this->con->prepare('update tb_anuncio set anuncio_titulo=:titulo,anuncio_valor=:valor,anuncio_valorTipo=:valorTipo,anuncio_telefone=:telefone,anuncio_descricao=:descricao,anuncio_endereco_cep=:cep,anuncio_endereco_rua=:rua,anuncio_endereco_numero=:numero,anuncio_endereco_complemento=:complemento,anuncio_endereco_bairro=:bairro_txt,bairro_id=:bairro_id,anuncio_editado=now() where anuncio_id=:aid and cadastro_id=:cid');
		$sql->bindValue(':titulo',$_POST['titulo'],PDO::PARAM_STR);
		$sql->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
		$sql->bindValue(':cep',$_POST['cep'],PDO::PARAM_STR);
		$sql->bindValue(':rua',$_POST['rua'],PDO::PARAM_STR);
		$sql->bindValue(':numero',$_POST['numero'],PDO::PARAM_STR);
		$sql->bindValue(':bairro_id',$this->bairro_id,PDO::PARAM_INT);
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		$sql->bindValue(':aid',$_POST['aid'],PDO::PARAM_INT);
		
		if(isset($_POST['valor']))
		{
			$sql->bindValue(':valor',strval($_POST['valor']),PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':valor',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['bairro_txt']))
		{
			$sql->bindValue(':bairro_txt',$_POST['bairro_txt'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':bairro_txt',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['complemento']))
		{
			$sql->bindValue(':complemento',$_POST['complemento'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':complemento',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['valorTipo']))
		{
			$sql->bindValue(':valorTipo',(int)$_POST['valorTipo'],PDO::PARAM_INT);
		}
		else
		{
			$sql->bindValue(':valorTipo',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['descricao']))
		{
			$sql->bindValue(':descricao',$_POST['descricao'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':descricao',NULL,PDO::PARAM_NULL);
		}
		
		$sql->execute();
	
	}
	catch(PDOException $e) { print_r($e); return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

}
?>