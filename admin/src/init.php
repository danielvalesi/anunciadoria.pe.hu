<?php
class Init extends Utils {
public $pn; // Nome da página
public $sub01;
public $sub02;
public $sub03;
public $sub04;
public $sub05;
public $user;
public $html_tpl;
public $__cache = array();
private $_pgcon = array(); // Paginas que vai ter conexão com o banco
private $_init; // Instancia global
protected $js_files = array(); // Arquivos JS
protected $js_ready = array(); // DOM Ready
protected $js_global = array(); // JS GLOBAL

function __construct()
{
	parent::__construct();

	$this->pn = (isset($_GET['pn']))?$_GET['pn']:'index';
	
	if(isset($_GET['sub01'])) $this->sub01 = $_GET['sub01'];
	if(isset($_GET['sub02'])) $this->sub02 = $_GET['sub02'];
	if(isset($_GET['sub03'])) $this->sub03 = $_GET['sub03'];
	if(isset($_GET['sub04'])) $this->sub04 = $_GET['sub04'];
	if(isset($_GET['sub05'])) $this->sub05 = $_GET['sub05'];
}


public function __run()
{	
	switch($this->pn)
	{
		case 'index':
			
			$this->html_tpl = 'home';
			
			$this->_titulo = array('INICIAL','Informações');
			
			$this->__cache('Home_Front')->__TotalAnuncios();
			$this->__cache['Home_Front']->__TotalAnuncios(1);
			$this->__cache['Home_Front']->__TotalUsuarios();
			$this->__cache['Home_Front']->__TotalNewsletters();
			
		break;
		case 'alterar-senha':
			
			$this->html_tpl = 'alterar-senha';
			
			$this->_titulo = array('alterar senha','Digite sua nova senha');
			
			$this->AddJS('alterar-senha.js');
			
		break;
		case 'anuncios': break;
		case 'interesses': break;
		case 'usuarios': break;
		case 'newsletter': break;
		case 'sair':
		
			unset($_SESSION['user-admin']);
			$this->__rError();
		
		break;
		default: $this->__rError(); break;
	}
	
	if(isset($this->_menu[$this->pn])) $this->__cache($this->pn.'_Front')->__Paginas();
}


private $_menu = array(

	array('INICIAL',NULL),
	
	'anuncios'=>array('AN&Uacute;NCIOS','anuncios',array(
		array('Pendentes','pendentes'),
		array('Aprovados','aprovados'),
		array('Não Aprovados','nao-aprovados')
	)),
	
	'interesses'=>array('INTERESSES','interesses',array(
		array('Gerenciar interesses','gerenciar-interesses')
	)),
	
	'usuarios'=>array('USUARIOS','usuarios',array(
		array('Listar usu&aacute;rios','listar-usuarios')
	)),
	
	'newsletter'=>array('NEWSLETTER','newsletter',array(
		array('Listar contatos','listar-contatos')
	))

);

public $_nav = array();
public $_titulo = array();

/* Listar Barra de navegação */

public function _Nav()
{
	$this->otxt['nav'] = '';
	
	foreach($this->_nav as $v) $this->otxt['menu'] .= '<li class="active">'.$v.'</li>';
	
	if(!$this->otxt['nav']) return ;
	
	return true;
}


/* Listar Menu do admin */

public function _Menu()
{
	$out = '';
	
	foreach($this->_menu as $v)
	{
		if($this->pn == $v[1])
		{
			$_sty01 = ' class="left_nav_active theme_border"';
			$_sty02 = ' class="opened" style="display:block"';
			
			$this->_nav[] = $v[0];
			$this->_titulo[0] = $v[0];
		}
		else
		{
			$_sty01 = $_sty02 = NULL;
		}
	
		if(isset($v[2]))
		{
			$out .= '<li'.$_sty01.'> <a href="javascript:void(0);"> <i class="fa fa-caret-right"></i> '.$v[0].' <span class="plus"><i class="fa fa-plus"></i></span></a><ul'.$_sty02.'>';
			
			foreach($v[2] as $v2)
			{
				if($this->sub01 == $v2[1])
				{
					$_substy01 = ' theme_color';
					$_substy02 = ' class="theme_color"';
					
					$this->_nav[] = $v2[0];
					$this->_titulo[1] = $v2[0];
				}
				else
				{
					$_substy01 = $_substy02 = NULL;
				}
			
				$out .= '<li> <a href="'.$v[1].'/'.$v2[1].'/"> <span>&nbsp;</span> <i class="fa fa-circle'.$_substy01.'"></i> <b'.$_substy02.'>'.$v2[0].'</b> </a> </li>';
			}
			
			$out .= '</ul></li>';
		}
		else
		{
			if($v[1]) $v[1] .= '/';
			$out .= '<li> <a href="'.$v[1].'"> <i class="fa fa-caret-right"></i> '.$v[0].'</a>';
		}
	}
	
	return $out;
}

/* Adiciona JS no DOMReady */

protected function AddJSReady($v) { $this->js_ready[] = $v; }


/* Adiciona JS no escopo GLOBAL */

protected function AddJSGlobal($v) { $this->js_global[] = $v; }


/* Adiciona um novo arquivo JS */

protected function AddJS($v,$s=NULL)
{
	if(!in_array($v,$this->js_files)) $this->js_files[] = $v;
	if($s) $this->js_ready[] = $s;
}


/* Faz o retorno dos arquivos JS */

public function getJsFiles()
{
	$this->otxt['js_files'] = '';
	foreach($this->js_files as $v) $this->otxt['js_files'] .= '<script type="text/javascript" src="js/'.$v.'?v='.self::_version.'"></script>'.PHP_EOL;
}


/* Faz o retorno do conteudo JS que vai o DOMReady do jQuery */

public function getJsGlobal()
{
	$this->otxt['js_global'] = '';
	foreach($this->js_global as $v) $this->otxt['js_global'] .= $v.PHP_EOL;
}


/* Faz o retorno do conteudo JS que vai o DOMReady do jQuery */

public function getJsReady()
{
	$this->otxt['js_ready'] = '';
	foreach($this->js_ready as $v) $this->otxt['js_ready'] .= $v.PHP_EOL;
}


/* Salva os objetos em cache */

private function __cache($v)
{
	if(isset($this->__cache[$v])) return ;
	
	$this->__cache[$v] = new $v($this);
	
	return $this->__cache[$v];
}


/* Verifica se o usuario está logado se sim obtem informações do mesmo */

public function isLoggedUser()
{
	$this->AbrirCon();

	if(!isset($_SESSION['user-admin'])) return ;
	
	$sql = $this->con->prepare('select admin_id,admin_nome from tb_admin where admin_id=:aid');
	$sql->bindValue(':aid',$_SESSION['user-admin'],PDO::PARAM_INT);
	$sql->execute();
	
	$this->user = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->user)
	{
		unset($_SESSION['user-admin']);
		return ;
	}
	
	return true;
}

}
?>