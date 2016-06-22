<?php
class usuarios_Front extends Init {
public $_txt;
private $_url;

function __construct($_init) { $this->_init = $_init; }


/* Sub paginas */

protected function __Paginas()
{
	switch($this->_init->sub01)
	{
		case 'listar-usuarios':
		
			$this->__Usuarios();
			$this->__Paginacao();
		
		break;
		default: $this->_init->__rError(); break;
	}
	
	$this->_init->AddJS($this->_init->pn.'/'.$this->_init->sub01.'.js');
	$this->_init->html_tpl = $this->_init->pn.'/'.$this->_init->sub01;
}


/* Listar usuarios */

private function __Usuarios()
{
	$this->_init->otxt['usuarios'] = '';
	
	// Pagina
	
	if($this->_init->sub02)
	{
		$_offset = ($this->_init->sub02-1)*self::usuarios_limit;
	}
	else
	{
		$this->_init->sub02 = $_offset = 0;
	}
	
	// Busca
	
	if(isset($_GET['q']))
	{
		$this->_txt = ' where cadastro_nome like :txt or cadastro_email like :txt';
		$this->_url .= '?q='.urlencode($_GET['q']);
	}
	else
	{ $this->_txt = NULL; }
	
	$_pg = max(1,$this->_init->sub02);

	$sql = $this->_init->con->prepare('select cadastro_id,cadastro_nome,cadastro_email,date_format(cadastro_criado,"%d/%m/%Y &agrave;s %H:%i") as criado,cadastro_tipo from tb_cadastro'.$this->_txt.' order by cadastro_id desc limit :offset,:limit');
	$sql->bindValue(':offset',(int)$_offset,PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::usuarios_limit,PDO::PARAM_INT);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$_tipo = ($ret['cadastro_tipo'] == 1)?'Anunciante':'Contratante';
	
		$this->_init->otxt['usuarios'] .= '<tr class="">
                                  <td>'.$ret['cadastro_nome'].'</td>
                                  <td>'.$ret['cadastro_email'].'</td>
								  <td>'.$_tipo.'</td>
								  <td>'.$ret['criado'].'</td>
                                  <td><a class="edit" href="../login-via-admin/'.$ret['cadastro_id'].'/" target="_blank">Entrar na conta</a></td>
                              </tr>';
	}
	
	$sql->closeCursor();
}


/* Listar usuarios paginação */

private function __Paginacao()
{
	$this->_init->otxt['paginacao'] = '';

	$this->_init->otxt['total_usuarios'] = $total = $this->__Quantidade();
	
	$ultima_pag = ceil($total / self::usuarios_limit);
	
	if($ultima_pag <= 1) return ;
	
	$prox = $this->_init->sub02 + 1;
	$ant = $this->_init->sub02 - 1;
	$penultima = $ultima_pag - 1;	
	$adjacentes = 2;
	
	if($this->_init->sub02 > 1) $this->_init->otxt['paginacao'] .= '<li class="prev"><a href="usuarios/listar-usuarios/'.$ant.'/'.$this->_url.'"><</a></li>';
	
	if ($ultima_pag <= 10)
	{
		for ($i=1; $i< $ultima_pag+1; $i++)
		{
			if ($i == $this->_init->sub02 or ($this->_init->sub02 == 0 and $i == 1))
			{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
			else
			{ $this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
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
				{ $this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			
			if(($i-1) != $penultima) $this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		elseif($this->_init->sub02 > (2 * $adjacentes) && $this->_init->sub02 < $ultima_pag - 3)
		{
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			for($i = $this->_init->sub02-$adjacentes; $i<= $this->_init->sub02 + $adjacentes; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		else
		{	
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			$_calc = $ultima_pag - (4 + (2 * $adjacentes));
			if($_calc == 2) ++$_calc;
			
			for($i = $_calc; $i <= $ultima_pag; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
		}
	}
	
	if($prox <= $ultima_pag and $ultima_pag > 1) $this->_init->otxt['paginacao'] .= '<li><a href="usuarios/listar-usuarios/'.$prox.'/'.$this->_url.'">></a></li>';
}


/* Quantidade de usuarios para paginação */

private function __Quantidade()
{
	$sql = $this->_init->con->prepare('select count(cadastro_id) from tb_cadastro'.$this->_txt);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	return $out;
}

}
?>