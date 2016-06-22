<?php
class Cep extends Utils {
private $_out;
private $out = array('s'=>'ok','i'=>NULL);

function __construct() {}

public function __run()
{
	$this->__CEP();
	
	return json_encode($this->out);
}


/* Recupera informações no site do correio */

private function __CEP()
{
	$n = 0;
	
	while($n<3)
	{
		if($this->_out = $this->__curl('http://m.correios.com.br/movel/buscaCepConfirma.do','cepEntrada='.$_POST['cep'].'&tipoCep=&cepTemp=&metodo=buscarCep')) break;
		++$n;
	}
	
	if(!$this->_out)
	{
		$_fpm = false;
		$n2 = 0;
		
		while($n2<3)
		{
			if($this->__CEPAux() or $this->out['s'] == 'err')
			{
				$_fpm = true;
				break;
			}
			++$n2;
		}
		
		if(!$_fpm) $this->out['s'] = 'err';
		
		return ;
	}
	
	$dom = new DOMDocument();
	$dom->validateOnParse = true;
	@$dom->loadHTML($this->_out);
	
	$xpath = new DOMXPath($dom);
	
	if($xpath->query('//div[@class="erro"]')->length)
	{
		$this->out['s'] = 'err';
		return ;
	}
	
	$cb = $xpath->query('//div[@class="caixacampobranco"]');
	
	if($cb->length == 0)
	{
		$_fpm = false;
		$n2 = 0;
		
		while($n2<3)
		{
			if($this->__CEPAux() or $this->out['s'] == 'err')
			{
				$_fpm = true;
				break;
			}
			++$n2;
		}
		
		if(!$_fpm) $this->out['s'] = 'err';
		
		return ;
	}
	
	$infos = $cb->item(0)->getElementsByTagName('span');
	
	if(strpos($infos->item(0)->nodeValue,'UF') !== false)
	{
		$ct = explode('/',$infos->item(1)->nodeValue);
		$this->out['i'] = array_map('trim',array('cidade'=>$ct[0],'estado'=>$ct[1],'bairro'=>'Centro','extra'=>1));
	}
	else
	{
		$ct = explode('/',$infos->item(5)->nodeValue);
		$this->out['i'] = array_map('trim',array('endereco'=>$infos->item(1)->nodeValue,'bairro'=>$infos->item(3)->nodeValue,'cidade'=>$ct[0],'estado'=>$ct[1]));
	}
	
	return true;
}

private function __CEPAux()
{
	$_post = http_build_query(array(
		'relaxation'=>$_POST['cep'],
		'TipoCep'=>'ALL',
		'semelhante'=>'N',
		'cfm'=>1,
		'Metodo'=>'listaLogradouro',
		'TipoConsulta'=>'relaxation',
		'StartRow'=>1,
		'EndRow'=>10
	));

	$this->_out = $this->__curl('http://www.buscacep.correios.com.br/servicos/dnec/consultaEnderecoAction.do',$_post,NULL,0,NULL,120,NULL,1);
	
	if(!$this->_out) return ;
	
	$dom = new DOMDocument();
	$dom->validateOnParse = true;
	@$dom->loadHTML($this->_out);
	
	$xpath = new DOMXPath($dom);
	
	$_titles = $xpath->query('//title');
	
	if($_titles->length == 2 and $_titles->item(1)->nodeValue == 'Erro')
	{
		$this->out['s'] = 'err';
		return ;
	}
	
	$_tables = $xpath->query('//table[@bgcolor="gray"]');
	
	if($_tables->length == 0)
	{
		$this->out['s'] = 'err';
		return ;
	}
	
	preg_match_all('/Set-Cookie: (.*)\b/',$this->_out, $Cookies);
	
	if(!isset($Cookies[1][0])) return ;
	
	$this->_out = $this->__curl('http://www.buscacep.correios.com.br/servicos/dnec/detalheCEPAction.do',http_build_query(array('Metodo'=>'detalhe','Posicao'=>'1','TipoCep'=>2,'CEP'=>'')),NULL,0,$Cookies[1][0]);
	
	if(!$this->_out) return ;
	
	$dom = new DOMDocument();
	$dom->validateOnParse = true;
	@$dom->loadHTML($this->_out);
	
	$_tables = $dom->getElementsByTagName('table');
	
	if($_tables->length != 3) return ;
	
	$_tds = $_tables->item(1)->getElementsByTagName('td');
	
	$_cidade = explode('/',$_tds->item(5)->nodeValue);
	
	if($_tds->item(1)->nodeValue)
	{
		$this->out['i'] = array_map('trim',array('endereco'=>$_tds->item(1)->nodeValue,'bairro'=>$_tds->item(3)->nodeValue,'cidade'=>$_cidade[0],'estado'=>$_cidade[1]));
	}
	else
	{
		$this->out['i'] = array_map('trim',array('cidade'=>$_cidade[0],'estado'=>$_cidade[1],'bairro'=>'Centro','extra'=>1));
	}
	
	return true;
}

}
?>