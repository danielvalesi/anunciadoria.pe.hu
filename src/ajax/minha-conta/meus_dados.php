<?php
class Meus_Dados extends Utils {
private $_out = array('s'=>'ok');
private $_ck_senha;

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/meus-dados';
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->_ck_senha = isset($_POST['senhaAtual']) and isset($_POST['senhaNova']);
	
		$this->AbrirCon();
	
		if(!$this->__VerificaSenhaAtual())
		{
			$this->_out['s'] = 'err_senha';
		}
		else
		{
			if(isset($_POST['url']) and !$this->__VerificaUrl())
			{
				$this->_out['s'] = 'err_url';
			}
			else
			{
				if(!$this->__VerificaEmail())
				{
					$this->_out['s'] = 'err_email';
				}
				else
				{
					if(!$this->__edit())
					{
						$this->_out['s'] = 'err_doc';
					}
					else
					{
						$this->__AdicionarInteresses();
					}
				}
			}
		}
		
		$this->FecharCon();
	}
	
	return json_encode($this->_out);
}

/* Verifica a senha */

private function __VerificaSenhaAtual()
{
	if(!$this->_ck_senha) return true;

	$sql = $this->con->prepare('select count(cadastro_id) from tb_cadastro where cadastro_id=:cid and cadastro_senha=:senha');
	$sql->bindValue(':senha',md5($_POST['senhaAtual']),PDO::PARAM_STR);
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if($out == 0) return ;
	
	return true;
}

/* Verifica a url */

private function __VerificaUrl()
{
	$sql = $this->con->prepare('select count(cadastro_id) from tb_cadastro where cadastro_url=:url and cadastro_id!=:cid');
	$sql->bindValue(':url',$_POST['url'],PDO::PARAM_STR);
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if($out == 1) return ;
	
	return true;
}

/* Verifica o email */

private function __VerificaEmail()
{
	$sql = $this->con->prepare('select count(cadastro_id) from tb_cadastro where cadastro_email=:email and cadastro_id!=:cid');
	$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if($out == 1) return ;
	
	return true;
}

/* Adiciona os interesses */

private function __AdicionarInteresses()
{
	$sql = $this->con->prepare('delete from tb_cadastro_interesse where cadastro_id=:cid');
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->execute();
	$sql->closeCursor();

	if(!isset($_POST['i'])) return ;

	try {
	
		$sql = $this->con->prepare('insert ignore into tb_cadastro_interesse(cadastro_id,interesse_item_id) values(:cid,:iid)');
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		$sql->bindParam(':iid',$iid,PDO::PARAM_INT);
		
		foreach($_POST['i'] as $iid) $sql->execute();
	
	}
	catch(PDOException $e) { return ; }
}

/* Edita o cadastro */

private function __edit()
{
	$_senha = ($this->_ck_senha)?',cadastro_senha=:senha':NULL;

	try {
	
		$sql = $this->con->prepare('update tb_cadastro set cadastro_url=:url,cadastro_cpf=:cpf,cadastro_nascimento=:nascimento,cadastro_razaoSocial=:razaoSocial,cadastro_cnpj=:cnpj,cadastro_ie=:ie,cadastro_nome=:nome,cadastro_sobre=:sobre,cadastro_email=:email,cadastro_telefone=:telefone,cadastro_endereco_cep=:cep,cadastro_endereco_rua=:rua,cadastro_endereco_numero=:numero,cadastro_endereco_bairro=:bairro,cadastro_endereco_complemento=:complemento,cadastro_endereco_cidade=:cidade,cadastro_endereco_estado=:estado,cadastro_fotoPerfil=:foto,cadastro_editado=now()'.$_senha.' where cadastro_id=:cid');
		$sql->bindValue(':nome',$_POST['nome'],PDO::PARAM_STR);
		$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$sql->bindValue(':telefone',$_POST['telefone'],PDO::PARAM_STR);
		$sql->bindValue(':cep',$_POST['cep'],PDO::PARAM_STR);
		$sql->bindValue(':rua',$_POST['rua'],PDO::PARAM_STR);
		$sql->bindValue(':numero',$_POST['numero'],PDO::PARAM_STR);
		$sql->bindValue(':bairro',$_POST['bairro'],PDO::PARAM_STR);
		$sql->bindValue(':cidade',$_POST['cidade'],PDO::PARAM_STR);
		$sql->bindValue(':estado',$_POST['estado'],PDO::PARAM_STR);
		$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
		
		if($this->_ck_senha)
		{
			$sql->bindValue(':senha',md5($_POST['senhaNova']),PDO::PARAM_STR);
		}
		
		if(isset($_POST['url']))
		{
			$sql->bindValue(':url',$_POST['url'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':url',NULL,PDO::PARAM_NULL);
		}
		
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
		
		if(isset($_POST['complemento']))
		{
			$sql->bindValue(':complemento',$_POST['complemento'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':complemento',NULL,PDO::PARAM_NULL);
		}
		
		if(isset($_POST['foto']))
		{
			$sql->bindValue(':foto',$_POST['foto'],PDO::PARAM_STR);
		}
		else
		{
			$sql->bindValue(':foto',NULL,PDO::PARAM_NULL);
		}
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

}
?>