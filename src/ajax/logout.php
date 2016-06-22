<?php
class Logout extends Utils {

function __construct() { parent::__construct(); }

public function __run()
{
	if(isset($_SESSION['user'])) unset($_SESSION['user']);
	
	header('Location: '.$this->base);
}

}
?>