<?php
abstract class Utils implements _Config {
protected $con; // variavel de conexao
protected $phpmailer; // variavel de smtp
protected $host; // informações do host (dominio,subdominio)
public $base; // variavel de base
public $otxt = array(); // Variavel de output
public $__extrafiles = array();


/* Monta a URL Base */

function __construct() { $this->base = (isset($_SERVER['HTTPS']))?self::_https:self::_http; }

public function __run(){}


/* Metodos para alteração de dados */

private function __add(){}
private function __edit(){}
private function __del(){}


/* Adiciona um arquivo extra para o require */

public function __addRequire($v)
{
	if(!in_array($v,$this->__extrafiles)) $this->__extrafiles[] = $v;
}


/* Metodo para sempre redirecionar o usuário para www */

public function __www()
{
	if(strpos($_SERVER['HTTP_HOST'],'www') === false)
	{
		$_uri = ($_SERVER['REQUEST_URI'])?substr($_SERVER['REQUEST_URI'],1):NULL;
		header('Location: '.$this->base.$_uri);
		exit(0);
	}
}


/* Metodo para lojas virtuais que ja iniciam em https */

public function __https()
{
	if(strpos($_SERVER['HTTP_HOST'],'www') === false or !isset($_SERVER['HTTPS']))
	{
		$_uri = ($_SERVER['REQUEST_URI'])?substr($_SERVER['REQUEST_URI'],1):NULL;
		header('Location: '.self::_https.$_uri);
		exit(0);
	}
}

/* Verifica dispositivo */

public function __Device()
{
	$tablet_browser = 0;
	$mobile_browser = 0;
	 
	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
	}
	 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	 
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}
	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
		$mobile_browser++;
		//Check for tablets on opera mini alternative headers
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		  $tablet_browser++;
		}
	}
	
	//return 2;
	 
	if ($tablet_browser > 0) return 1;
	elseif ($mobile_browser > 0) return 2;
	else return 3;
}

/* Check Mobile */

public function is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	
	$is_mobile = false;
	
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	
	return $is_mobile;
}


/* Abre conexão com o banco de dados */

public function AbrirCon()
{	
	try {
	
		$this->con = new PDO('mysql:host='.self::db_servidor.';dbname='.self::db_banco.';charset=utf8',self::db_usuario,self::db_senha);
		$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->con->exec('SET NAMES utf8');
		//$this->con->exec('SET SESSION group_concat_max_len = 1000000');
	
	}
	catch(PDOException $e) { exit(0); }
}


/* Fecha conexão com o banco de dados */

public function FecharCon() { $this->con = NULL; }


/* Abre conexão com o SMTP */

protected function AbrirSMTP()
{
	if($this->phpmailer) return ;

	$this->phpmailer = new PHPMailer();
	$this->phpmailer->CharSet='UTF-8';
	
	$this->phpmailer->IsSMTP();
	$this->phpmailer->SMTPAuth = true;
	//$this->phpmailer->SMTPDebug = true;
	
	if(self::smtp_ssl) $phpmailer->SMTPSecure = self::smtp_ssl;
	
	$this->phpmailer->Host = self::smtp_host;
	$this->phpmailer->Port = self::smtp_port;
			
	$this->phpmailer->Username = self::smtp_user;
	$this->phpmailer->Password = self::smtp_pass;
	
	$this->phpmailer->From = self::smtp_user;
	$this->phpmailer->FromName = self::smtp_from;
}


/* Anti SQL-Injection */

protected function TMS($v) { return trim(mysql_escape_string(stripslashes($v))); }


/* Formata dinheiro no formato int para real */

public function FMoney($v) { return number_format($v,2,',','.'); }


/* Formata dinheiro no formato Americano */

public function FMoneyEn($v) { return ($v)?substr($v,0,-2).'.'.substr($v,-2):NULL; }


/* Criptografa dados */

public function ENC($v) { return base64_encode(mcrypt_cbc(MCRYPT_RIJNDAEL_128,self::chave,$v,MCRYPT_ENCRYPT,self::iv)); }


/* Descriptografa dados */

public function DEC($v) { return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128,self::chave, base64_decode($v),MCRYPT_MODE_CBC,self::iv)); }


/* Retorna valores randomicos em md5 */

protected function GetUName() { return md5(uniqid(rand(),true)); }


/* Tira espaços e caracteres especiais de uma string, usado para urls */

public function __url($v)
{
	$_strip = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E','Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U','Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c','è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o','ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y',' / '=>'-',' /'=>'-','/ '=>'-','/'=>'-',' - '=>'-',' -'=>'-','- '=>'-');
	
	return mb_strtolower(preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('-', '-', ''), strtr($v,$_strip)),'UTF-8');
}


/* Remover acentos */

protected function __RemoveAcentos($v) { return strtr($v, 'áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ', 'aaaaeeiooouucAAAAEEIOOOUUC'); }


/* Cria um novo cookie */

protected function AddCookie($n,$v,$s) { setcookie($n,$v,time()+$s,'/'); }


/* Deleta um cookie */

protected function DelCookie($n) { setcookie($n,NULL,time()-7200,'/'); }


/* Tira tudo que não for numeros */

protected function __Numeros($v) { return preg_replace('#[^0-9]#',NULL,$v); }


/* Redirecionar Erros */

protected function __rError($r=NULL)
{
	$this->FecharCon();
	
	header('Location: '.$this->base.$r);
	
	exit(0);
}

/* Converte dia da semana para extenso */

private $_dia = array('Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado');
public function __Dia($v) { return $this->_dia[$v]; }


/* Converte mes para extenso */

private $_mes = array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
public function __Mes($v) { return $this->_mes[$v-1]; }

public function __SelectDias()
{
	$out = '';
	$_dias = range(1,30);
	
	foreach($_dias as $v)
	{
		$fx = ($v < 10)?'0'.$v:$v;
		$out .= '<option value="'.$v.'">'.$fx.'</option>';
	}
	
	return $out;
}

/* Converte data para formato americano */

protected function __ConverteDataEN($d)
{
	$out = explode('/',$d);
	return $out[2].'-'.$out[1].'-'.$out[0];
}

/* Conexão Curl */

protected function __curl($url,$p=NULL,$h=NULL,$ssl=0,$c=NULL,$tm=120,$put=NULL,$header=0)
{
	$ch = curl_init();
	$opts = array(
	CURLOPT_URL => $url,
	CURLOPT_HEADER => $header,
	CURLOPT_FOLLOWLOCATION => 1,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_SSL_VERIFYPEER => $ssl,
	CURLOPT_TIMEOUT => $tm
	);
	
	if($p)
	{
		$opts[CURLOPT_CUSTOMREQUEST] = ($put)?'PUT':'POST';
		if(!$put) $opts[CURLOPT_POST] = 1;
		$opts[CURLOPT_POSTFIELDS] = $p;
	}
	if($h) $opts[CURLOPT_HTTPHEADER] = $h;
	if($c) $opts[CURLOPT_COOKIE] = $c;
	
	curl_setopt_array($ch,$opts);
	$out = curl_exec($ch);
	curl_close($ch);
	
	return $out;
}

/* Metodos customizados */

private $__valortipo_fx = array('','Hora','Dia','Semana','Quinzena','Quarentena','Mês','Bimestre','Trimestre','Semestre','Ano');
protected function __ValorTipoFx($t)
{
	if(!$t) return ;
	
	return '&nbsp;&nbsp;<small style="font-weight:normal;">/&nbsp;&nbsp;'.$this->__valortipo_fx[$t].'</small>';
}

/* Recupera informações do anuncio */
protected $_anu_ui;
protected function __AnuUI($aid)
{
	$sql = $this->con->prepare('select a.anuncio_id,a.anuncio_telefone,a.anuncio_titulo,b.cadastro_id,b.cadastro_email,b.cadastro_nome from tb_anuncio a inner join tb_cadastro b on b.cadastro_id=a.cadastro_id where anuncio_id=:aid');
	$sql->bindValue(':aid',$aid,PDO::PARAM_INT);
	$sql->execute();
	
	$this->_anu_ui = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->_anu_ui) return ;
	
	return true;
}

/* Recupera informações do usuario logado */
protected $_cad_ui;
protected function __CadUI($cid=NULL,$e=NULL)
{
	$_where = ($e)?'cadastro_email=:email':'cadastro_id=:uid';

	$sql = $this->con->prepare('select cadastro_id,cadastro_nome,cadastro_email,cadastro_telefone from tb_cadastro where '.$_where);
	
	if($e)
	{ $sql->bindValue(':email',$e,PDO::PARAM_STR); }
	elseif($cid)
	{ $sql->bindValue(':uid',$cid,PDO::PARAM_INT); }
	else
	{ $sql->bindValue(':uid',$_SESSION['user'],PDO::PARAM_INT); }
	
	$sql->execute();
	
	$this->_cad_ui = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->_cad_ui) return ;
	
	return true;
}

/* Carrega o template email especifico */

protected function __CarregaEmailTemplate($ref)
{
	$sql = $this->con->prepare('select template_email_assunto,template_email_mensagem from tb_template_email where template_email_ref=:ref');
	$sql->bindValue(':ref',$ref,PDO::PARAM_STR);
	
	$sql->execute();
	
	$out = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	return $out;
}

/* Faz envio de um template de e-mail */

protected function __EnviaEmailTemplate($out,$email=NULL,$c=array(),$v=array(),$cp=array())
{
	$msg = str_replace($c,$v,str_replace('[@dominio]',$this->base,$out['template_email_mensagem']));
	
	$this->AbrirSMTP();
	
	$this->phpmailer->ClearAllRecipients();
	
	$this->phpmailer->Subject = '=?UTF-8?B?'.base64_encode(str_replace($c,$v,$out['template_email_assunto'])).'?=';
	$this->phpmailer->Body = $msg;
	$this->phpmailer->AltBody = strip_tags(str_replace('<br>',"\n",$msg));
	
	if($email)
	{ $this->phpmailer->AddAddress($email); }
	else
	{ $this->phpmailer->AddAddress(self::smtp_email); }
	
	if($cp)
	{
		foreach($cp as $v) $this->phpmailer->AddCC($v);
	}
	
	if(!$this->phpmailer->Send())
	{
		echo $this->phpmailer->ErrorInfo;
		return ;
	}
	
	return true;
}

/* Gerar codigo aleatorio */

protected function __GerarCodigo()
{
	$a = 0;
	$_code = '';
    $_c = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

	while($a<9)
	{
		$_random = (float)rand()/(float)getrandmax();
		$_code .= $_c[floor($_random * strlen($_c))];
		$a++;
	}
	
	return $_code;
}

}
?>