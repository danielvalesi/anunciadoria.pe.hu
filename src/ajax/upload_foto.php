<?php
class Upload_Foto extends Utils {

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		if($_POST['_act'] == 1) $_SESSION['_bk'] = 'cadastro';
		elseif($_POST['_act'] == 2) $_SESSION['_bk'] = 'minha-conta/cadastrar-anuncio';
		
		return 'err';
	}
	
	$ns = 'fotos/tmp/'.$this->GetUName().'-'.$_SESSION['user'].substr($_FILES['_foto']['name'],-4);
	
	move_uploaded_file($_FILES['_foto']['tmp_name'],'../'.$ns);
		
	return $ns;
}

}
?>