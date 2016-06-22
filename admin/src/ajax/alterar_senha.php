<?php
class Alterar_Senha extends Utils {

function __construct() {}

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__Alterar()) return 'err';
	
	unset($_SESSION['user-admin']);
	
	return 'ok';
}


/* Faz a alteraчуo de senha */

private function __Alterar()
{
	try {
	
		$sql = $this->con->prepare('update tb_admin set admin_senha=:senha where admin_id=:aid and admin_senha=:senha_antiga');
		$sql->bindValue(':senha',md5($_POST['senha']),PDO::PARAM_STR);
		$sql->bindValue(':senha_antiga',md5($_POST['senha_antiga']),PDO::PARAM_STR);
		$sql->bindValue(':aid',$_SESSION['user-admin'],PDO::PARAM_INT);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

}
?>