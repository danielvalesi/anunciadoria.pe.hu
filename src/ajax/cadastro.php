<?php
class Cadastro extends Utils {
private $cid;
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__VerificaEmail())
	{
		$this->_out['s'] = 'err_email';
	}
	else
	{
		if(!$this->__add())
		{
			$this->_out['s'] = 'err_doc';
		}
		else
		{
			$this->__AdicionarNews();
			$_SESSION['user'] = $this->cid;
		}
	}
	
	$this->FecharCon();
	
	return json_encode($this->_out);
}

/* Verifica o email */

private function __VerificaEmail()
{
	$sql = $this->con->prepare('select count(cadastro_id) from tb_cadastro where cadastro_email=:email');
	$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if($out == 1) return ;
	
	return true;
}

/* Adiciona newsletter */

private function __AdicionarNews()
{
	if(!isset($_POST['news'])) return ;

	try {
	
		$sql = $this->con->prepare('insert ignore into tb_newsletter(newsletter_email) values(:email)');
		$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
}

/* Adiciona um novo usuario */

private function __add()
{
	try {
	
		$sql = $this->con->prepare('insert into tb_cadastro(cadastro_nome,cadastro_sobre,cadastro_email,cadastro_senha,cadastro_telefone,cadastro_tipo,cadastro_cpf,cadastro_nascimento,cadastro_razaoSocial,cadastro_cnpj,cadastro_ie) values(:nome,:sobre,:email,:senha,:telefone,:tipo,:cpf,:nascimento,:razaoSocial,:cnpj,:ie)');
		$sql->bindValue(':nome',$_POST['nome'],PDO::PARAM_STR);
		$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$sql->bindValue(':senha',md5($_POST['senha']),PDO::PARAM_STR);
		$sql->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
		$sql->bindValue(':tipo',$_POST['tipo'],PDO::PARAM_INT);
		
		if(isset($_POST['sobre']))
		{
			$sql->bindValue(':sobre',$_POST['sobre'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':sobre',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['cpf']))
		{
			$_nascimento = explode('/',$_POST['nascimento']);
			$_nascimento = $_nascimento[2].'-'.$_nascimento[1].'-'.$_nascimento[0];
		
			$sql->bindValue(':cpf',$_POST['cpf'],PDO::PARAM_STR);
			$sql->bindValue(':nascimento',$_nascimento,PDO::PARAM_STR);
			
			$sql->bindValue(':cnpj',NULL,PDO::PARAM_NULL);
			$sql->bindValue(':razaoSocial',NULL,PDO::PARAM_NULL);
			$sql->bindValue(':ie',NULL,PDO::PARAM_NULL);
		}
		else
		{
			$sql->bindValue(':cnpj',$_POST['cnpj'],PDO::PARAM_STR);
			$sql->bindValue(':razaoSocial',$_POST['razaoSocial'],PDO::PARAM_STR);
			
			if(isset($_POST['ie']))
			{
				$sql->bindValue(':ie',$_POST['ie'],PDO::PARAM_STR);
			}
			else
			{
				$sql->bindValue(':ie',NULL,PDO::PARAM_NULL);
			}
			
			$sql->bindValue(':cpf',NULL,PDO::PARAM_NULL);
			$sql->bindValue(':nascimento',NULL,PDO::PARAM_NULL);
			
		}
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if(!$this->cid = $this->con->lastInsertId()) return ;
	
	return true;
}

}
?>