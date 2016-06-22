<?php
class newsletter_Front extends Init {
public $_txt;
private $_url;

function __construct($_init) { $this->_init = $_init; }


/* Sub paginas */

protected function __Paginas()
{
	switch($this->_init->sub01)
	{
		case 'listar-contatos':
		
			$this->__Interesses();
			$this->__Paginacao();
		
		break;
		case 'deletar-contato':
		
			if(!$this->_init->sub02 or !$this->_init->sub03 or !$this->__Deletar()) $this->_init->__rError();
			
			$_extra = (isset($_GET['q']))?'?q='.urlencode($_GET['q']):NULL;
			
			$this->_init->__rError('newsletter/listar-contatos/'.$this->_init->sub03.'/'.$_extra);
		
		break;
		default: $this->_init->__rError(); break;
	}
	
	$this->_init->AddJS($this->_init->pn.'/'.$this->_init->sub01.'.js');
	$this->_init->html_tpl = $this->_init->pn.'/'.$this->_init->sub01;
}

/* Deletar contato */

private function __Deletar()
{
	try {
	
		$sql = $this->_init->con->prepare('delete from tb_newsletter where newsletter_id=:nid');
		$sql->bindValue(':nid',$this->_init->sub02,PDO::PARAM_INT);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

/* Listar contatos */

private function __Interesses()
{
	$this->_init->otxt['contatos'] = '';
	
	// Pagina
	
	if($this->_init->sub02)
	{
		$_offset = ($this->_init->sub02-1)*self::newsletter_limit;
	}
	else
	{
		$this->_init->sub02 = $_offset = 0;
	}
	
	// Busca
	
	if(isset($_GET['q']))
	{
		$this->_txt = ' where newsletter_email like :txt';
		$this->_url .= '?q='.urlencode($_GET['q']);
	}
	else
	{ $this->_txt = NULL; }
	
	$_pg = max(1,$this->_init->sub02);

	$sql = $this->_init->con->prepare('select newsletter_id,newsletter_email,date_format(newsletter_criado,"%d/%m/%Y &agrave;s %H:%i") as criado from tb_newsletter'.$this->_txt.' order by newsletter_id desc limit :offset,:limit');
	$sql->bindValue(':offset',(int)$_offset,PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::newsletter_limit,PDO::PARAM_INT);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$this->_init->otxt['contatos'] .= '<tr class="">
                                  <td>'.$ret['newsletter_email'].'</td>
                                  <td>'.$ret['criado'].'</td>
                                  <td><a class="delete" href="newsletter/deletar-contato/'.$ret['newsletter_id'].'/'.$_pg.'/'.$this->_url.'">Deletar</a></td>
                              </tr>';
	}
	
	$sql->closeCursor();
	
	if(!$this->_init->otxt['contatos'] and $this->_init->sub02 > 0)
	{
		$_fix = ($this->_init->sub02 > 1)?($this->_init->sub02-1).'/':NULL; 
		$this->_init->__rError('newsletter/listar-contatos/'.$_fix.$this->_url);
	}
}


/* Listar contatos paginação */

private function __Paginacao()
{
	$this->_init->otxt['paginacao'] = '';

	$this->_init->otxt['total_contatos'] = $total = $this->__Quantidade();
	
	$ultima_pag = ceil($total / self::newsletter_limit);
	
	if($ultima_pag <= 1) return ;
	
	$prox = $this->_init->sub02 + 1;
	$ant = $this->_init->sub02 - 1;
	$penultima = $ultima_pag - 1;	
	$adjacentes = 2;
	
	if($this->_init->sub02 > 1) $this->_init->otxt['paginacao'] .= '<li class="prev"><a href="newsletter/listar-contatos/'.$ant.'/'.$this->_url.'"><</a></li>';
	
	if ($ultima_pag <= 10)
	{
		for ($i=1; $i< $ultima_pag+1; $i++)
		{
			if ($i == $this->_init->sub02 or ($this->_init->sub02 == 0 and $i == 1))
			{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
			else
			{ $this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
		}
	}
	elseif($ultima_pag > 5)
	{
		if($this->_init->sub02 < 1 + (2 * $adjacentes))
		{
			for($i=1; $i< 2 + (2 * $adjacentes); $i++)
			{
				if($i == $this->_init->sub02 or ($this->_init->sub02 == 0 and $i == 1))
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			
			if(($i-1) != $penultima) $this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		elseif($this->_init->sub02 > (2 * $adjacentes) && $this->_init->sub02 < $ultima_pag - 3)
		{
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			for($i = $this->_init->sub02-$adjacentes; $i<= $this->_init->sub02 + $adjacentes; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		else
		{	
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			$_calc = $ultima_pag - (4 + (2 * $adjacentes));
			if($_calc == 2) ++$_calc;
			
			for($i = $_calc; $i <= $ultima_pag; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
		}
	}
	
	if($prox <= $ultima_pag and $ultima_pag > 1) $this->_init->otxt['paginacao'] .= '<li><a href="newsletter/listar-contatos/'.$prox.'/'.$this->_url.'">></a></li>';
}


/* Quantidade de contatos para paginação */

private function __Quantidade()
{
	$sql = $this->_init->con->prepare('select count(newsletter_id) from tb_newsletter'.$this->_txt);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	return $out;
}

}
?>