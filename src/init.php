<?php
class Init extends Utils {
public $pn; // Nome da página
public $sub01;
public $sub02;
public $sub03;
public $sub04;
public $sub05;
public $user;
public $html_tpl = array('h'=>NULL,'f'=>NULL,'c'=>NULL);
public $seo = array('description'=>NULL,'keywords'=>NULL);
public $og;
public $__cache = array();
private $_pgcon = array(); // Paginas que vai ter conexão com o banco
private $_init; // Instancia global
protected $js_files = array(); // Arquivos JS
protected $js_ready = array(); // DOM Ready
protected $js_global = array(); // JS GLOBAL

/* Variaveis customizadas */

protected $_shop;

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
	if($this->pn == 'login-via-admin' and isset($_SESSION['user-admin']))
	{
		$_SESSION['user'] = $this->sub01;
		
		$_r = (isset($_GET['r']))?$_GET['r']:NULL;
		
		$this->__rError('minha-conta/'.$_r);
	}

	$this->AbrirCon();
	
	if(!$this->isLoggedUser())
	{
		$this->AddJS('mask.js');
		$this->AddJS('login_topo.js','login_topo.init();');
		$this->AddJS('cadastro_topo.js','cadastro_topo.init();');
		$this->AddJS('newsletter.js','newsletter.init();');
	}
	
	if($this->__cache('Perfil_Front')->__Verificar())
	{
		$this->AddJS('mask.js');
		$this->AddJS('perfil.js','perfil.cid = '.$this->otxt['perfil']['cadastro_id'].'; perfil.init();');
		
		if($this->otxt['perfil']['cadastro_tipo'] == 1)
		{
			$this->__cache['Perfil_Front']->__AnuncianteCategorias();
			$this->__cache['Perfil_Front']->__TotalAnuncios();
			$this->__cache['Perfil_Front']->__Anuncios();
		
			$this->html_tpl['c'] = 'perfil-anunciante';
			
			$this->AddJS('anuncios.js','anuncios.init();');
			$this->AddJS('perfil_anunciante.js','perfil_anunciante.limit = '.self::limit_perfil_anuncios.'; perfil_anunciante.init();');
		}
		else
		{
			$this->__cache['Perfil_Front']->__ContratanteCategorias();
		
			$this->html_tpl['c'] = 'perfil-contratante';
		}
		
		return ;
	}
	
	switch($this->pn)
	{
		case 'index': case 'contato': case 'login': case 'video':
		
			if($this->pn == 'login' and isset($_SESSION['_bk']))
			{
				$this->AddJSGlobal('var __BK = "'.$_SESSION['_bk'].'";');
				unset($_SESSION['_bk']);
			}
			
			$this->AddJS('mask.js');
			$this->AddJS('contato.js','contato.init();');
			
			$this->html_tpl['h'] = '02';
			$this->html_tpl['c'] = 'home';
			
		break;
		case 'esqueci-minha-senha':
		
			if($this->user) $this->__rError();
			
			$this->AddJS('esqueci_minha_senha.js','esqueci_minha_senha.init();');
			
			$this->html_tpl['c'] = 'esqueci-minha-senha';
			
		break;
		case 'nova-senha':
		
			$this->__cache('Nova_Senha_Front')->__Verificar();
			
			$this->AddJS('nova_senha.js','nova_senha.cid = "'.$_GET['c'].'"; nova_senha.init();');
			
			$this->html_tpl['c'] = 'nova-senha';
			
		break;
		case 'minha-conta':
		
			if(!$this->user) $this->__rError();
			
			if(!$this->user['cadastro_confirmado'])
			{
				$this->AddJS('reenvio_confirmacao.js','reenvio_confirmacao.init();');
				$this->html_tpl['c'] = 'reenvio-confirmacao';
			}
			else
			{
				$this->AddJS('minha-conta/minha_conta.js','minha_conta.init();');
				$this->__cache('Minha_Conta_Front')->__Paginas();	
			}
			
		break;
		case 'cadastro':
		
			if(!$this->user)
			{
				$_SESSION['_bk'] = 'cadastro';
				$this->__rError('login/');
			}
			
			if($this->user['cadastro_confirmado']) $this->__rError('minha-conta/');
			
			$this->AddJS('mask.js');
			$this->AddJS('up.js');
			$this->AddJS('cropper.min.js');
			$this->AddJS('_uploadfoto.js');
			$this->AddJS('cadastro.js','cadastro.init();');
			$this->AddJS('sugerir_segmento.js','sugerir_segmento.init();');
			
			$this->__cache('Minha_Conta_Front')->__Interesses();
			
			$this->html_tpl['c'] = 'cadastro';
			
			$this->__addRequire('html_tpl/popup-crop.php');
			
		break;
		case 'anuncios':
		
			if(!$this->sub01) $this->__rError('anuncios/todos/');
		
			$this->otxt['estado_id'] = $this->otxt['cidade_id'] = $this->otxt['bairro_id'] = NULL;
			
			$this->__cache('Anuncios_Front')->__Estados();
			
			$this->AddJS('mask.js');
			$this->AddJS('anuncios.js','anuncios.init();');
			$this->AddJS('anuncios_topo.js','anuncios_topo.init();');
		
			/*if($this->sub01)
			{*/
				if($this->otxt['estado_id'])
				{
					$_json_estado_id = ' anuncios_busca._json.estado_id = '.$this->otxt['estado_id'].';';
				
					$this->__cache['Anuncios_Front']->__Cidades();
					
					if($this->otxt['cidade_id'])
					{
						$_json_cidade_id = ' anuncios_busca._json.cidade_id = '.$this->otxt['cidade_id'].';';
						$this->__cache['Anuncios_Front']->__Bairros();
					}
					else
					{
						$_json_cidade_id = NULL;
					}
					
					$_json_bairro_id = ($this->otxt['bairro_id'])?' anuncios_busca._json.bairro_id = '.$this->otxt['bairro_id'].';':NULL;
				}
				else
				{	
					$_json_estado_id = $_json_cidade_id = $_json_bairro_id = NULL;
				}
				
				$this->__cache['Anuncios_Front']->__Anuncios();
				$this->__cache['Anuncios_Front']->__AnunciosInteresses();
				$this->__cache['Anuncios_Front']->__AnunciosPrecos();
				
				if($this->otxt['anuncios_precos']['minimo'] and $this->otxt['anuncios_precos']['maximo'] > $this->otxt['anuncios_precos']['minimo'])
				{
					$_fixvl = 'anuncios_busca.preco_min = '.$this->otxt['anuncios_precos']['minimo'].'; anuncios_busca.preco_max = '.$this->otxt['anuncios_precos']['maximo'].'; ';
				}
				else
				{
					$_fixvl = NULL;
				}
					
				$this->AddJS('anuncios_busca.js',$_fixvl.'anuncios_busca.limit = '.self::limit_busca_anuncios.';'.$_json_estado_id.$_json_cidade_id.$_json_bairro_id.' anuncios_busca.init();');
					
				$this->html_tpl['c'] = 'anuncios-resultado';
			/*}
			else
			{
				$this->__cache['Anuncios_Front']->__UltimosAnuncios();
				
				$this->AddJS('ultimos_anuncios.js','ultimos_anuncios.limit = '.self::limit_ultimos_anuncios.'; ultimos_anuncios.init();');
				
				$this->html_tpl['c'] = 'anuncios';
			}*/
			
		break;
		case 'quem-somos':
			
			$this->html_tpl['c'] = 'quem-somos';
			
		break;
		case 'termos-de-uso':
			
			$this->html_tpl['c'] = 'termos-de-uso';
			
		break;
		case 'como-funciona':
			
			$this->html_tpl['c'] = 'como-funciona';
			
		break;
		case 'e-seguro':
			
			$this->html_tpl['c'] = 'e-seguro';
			
		break;
		case 'glossario':
			
			$this->html_tpl['c'] = 'glossario';
			
		break;
		case 'sugestoes':
			
			//$_def = (isset($_GET['assunto']))?'contato.def = '.$_GET['assunto'].'; ':NULL;
			
			$_def = NULL;
			
			$this->AddJS('mask.js');
			$this->AddJS('contato.js',$_def.'contato.init();');
			
			$this->html_tpl['c'] = 'sugestoes';
			
		break;
		default: $this->__rError(); break;
	}
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

public function __cache($v)
{
	if(isset($this->__cache[$v])) return ;
	
	$this->__cache[$v] = new $v($this);
	
	return $this->__cache[$v];
}


/* Verifica se o usuario está logado se sim obtem informações do mesmo */

private function isLoggedUser()
{
	$this->otxt['_perfil_nome'] = $this->otxt['_perfil_email'] = NULL;

	if(!isset($_SESSION['user'])) return ;
	
	$sql = $this->con->prepare('select cadastro_id,cadastro_nome,cadastro_fotoPerfil,cadastro_confirmado,cadastro_sobre,cadastro_email,cadastro_telefone,cadastro_tipo,cadastro_cpf,date_format(cadastro_nascimento,"%d/%m/%Y") as nascimento,cadastro_razaoSocial,cadastro_cnpj,cadastro_ie,cadastro_endereco_cep,cadastro_endereco_rua,cadastro_endereco_numero,cadastro_endereco_bairro,cadastro_endereco_complemento,cadastro_endereco_cidade,cadastro_endereco_estado,cadastro_url from tb_cadastro where cadastro_id=:uid');
	$sql->bindValue(':uid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->execute();
	
	$this->user = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if($this->user)
	{
		if($this->user['cadastro_fotoPerfil'])
		{
			$this->user['foto_url'] = ' data-url="'.$this->user['cadastro_fotoPerfil'].'"';
			$this->user['cadastro_fotoPerfil'] = 'fotos/usuarios/'.$this->user['cadastro_fotoPerfil'];
		}
		else
		{
			$this->user['foto_url'] = NULL;
			$this->user['cadastro_fotoPerfil'] = 'fotos/sem-foto-perfil.jpg';
		}
		
		$this->otxt['_perfil_nome'] = $this->user['cadastro_nome'];
		$this->otxt['_perfil_email'] = $this->user['cadastro_email'];
		
		return true;
	}
	
	unset($_SESSION['user']);
	
	return ;
}

}
?>
