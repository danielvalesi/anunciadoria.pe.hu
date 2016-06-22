<?php
class Newsletter extends Utils {
private $_out = array('s'=>'ok');

function __construct() {}

public function __run()
{
	$this->AbrirCon();
	
	if(!$this->__add())
	{
		$this->FecharCon();
		return ;
	}
	
	$this->FecharCon();
	
	return json_encode($this->_out);
}

/* Adiciona newsletter */

private function __add()
{
	try {
	
		$sql = $this->con->prepare('insert ignore into tb_newsletter(newsletter_email) values(:email)');
		$sql->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	return true;
}

}
?>