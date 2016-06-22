<?php
class interesses_Front extends Init {
public $_txt;
private $_url;

function __construct($_init) { $this->_init = $_init; }


/* Sub paginas */

protected function __Paginas()
{
	switch($this->_init->sub01)
	{
		case 'gerenciar-interesses':
		
			$this->__Interesses();
			$this->__Paginacao();
		
		break;
		case 'editar-interesse':
		
			$this->__Editar();
			$this->__EditarSubs();
		
			$this->_init->_titulo[1] = 'editar interesse';
		
		break;
		default: $this->_init->__rError(); break;
	}
	
	$this->_init->AddJS($this->_init->pn.'/'.$this->_init->sub01.'.js');
	$this->_init->html_tpl = $this->_init->pn.'/'.$this->_init->sub01;
}


/* Listar interesses */

private function __Interesses()
{
	$this->_init->otxt['interesses'] = '';
	
	// Pagina
	
	if($this->_init->sub02)
	{
		$_offset = ($this->_init->sub02-1)*self::interesses_limit;
	}
	else
	{
		$this->_init->sub02 = $_offset = 0;
	}
	
	// Busca
	
	if(isset($_GET['q']))
	{
		$this->_txt = ' where a.interesse_nome like :txt or b.interesse_item_nome like :txt';
		$this->_url .= '?q='.urlencode($_GET['q']);
	}
	else
	{ $this->_txt = NULL; }
	
	$_pg = max(1,$this->_init->sub02);

	$sql = $this->_init->con->prepare('select a.interesse_id,a.interesse_nome,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator "<br>") as subs from tb_interesse a inner join tb_interesse_item b on a.interesse_id=b.interesse_id'.$this->_txt.' group by a.interesse_id order by a.interesse_nome asc limit :offset,:limit');
	$sql->bindValue(':offset',(int)$_offset,PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::interesses_limit,PDO::PARAM_INT);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$this->_init->otxt['interesses'] .= '<tr class="">
                                  <td>'.$ret['interesse_nome'].'</td>
                                  <td>'.$ret['subs'].'</td>
                                  <td><a class="edit" href="interesses/editar-interesse/'.$ret['interesse_id'].'/'.$_pg.'/'.$this->_txt.'">Editar</a></td>
                              </tr>';
	}
	
	$sql->closeCursor();
}


/* Listar interesses paginação */

private function __Paginacao()
{
	$this->_init->otxt['paginacao'] = '';

	$total = $this->__Quantidade();
	
	$ultima_pag = ceil($total / self::interesses_limit);
	
	if($ultima_pag <= 1) return ;
	
	$prox = $this->_init->sub02 + 1;
	$ant = $this->_init->sub02 - 1;
	$penultima = $ultima_pag - 1;	
	$adjacentes = 2;
	
	if($this->_init->sub02 > 1) $this->_init->otxt['paginacao'] .= '<li class="prev"><a href="interesses/gerenciar-interesses/'.$ant.'/'.$this->_url.'"><</a></li>';
	
	if ($ultima_pag <= 10)
	{
		for ($i=1; $i< $ultima_pag+1; $i++)
		{
			if ($i == $this->_init->sub02 or ($this->_init->sub02 == 0 and $i == 1))
			{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
			else
			{ $this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
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
				{ $this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			
			if(($i-1) != $penultima) $this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		elseif($this->_init->sub02 > (2 * $adjacentes) && $this->_init->sub02 < $ultima_pag - 3)
		{
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			for($i = $this->_init->sub02-$adjacentes; $i<= $this->_init->sub02 + $adjacentes; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		else
		{	
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			$_calc = $ultima_pag - (4 + (2 * $adjacentes));
			if($_calc == 2) ++$_calc;
			
			for($i = $_calc; $i <= $ultima_pag; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
		}
	}
	
	if($prox <= $ultima_pag and $ultima_pag > 1) $this->_init->otxt['paginacao'] .= '<li><a href="interesses/gerenciar-interesses/'.$prox.'/'.$this->_url.'">></a></li>';
}


/* Quantidade de interesses para paginação */

private function __Quantidade()
{
	$sql = $this->_init->con->prepare('select count(distinct a.interesse_id) from tb_interesse a inner join tb_interesse_item b on a.interesse_id=b.interesse_id'.$this->_txt);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	return $out;
}


/* Editar interesse */

private function __Editar()
{
	$sql = $this->_init->con->prepare('select interesse_nome from tb_interesse where interesse_id=:iid');
	$sql->bindValue(':iid',$this->_init->sub02,PDO::PARAM_INT);
	
	$sql->execute();
	
	$this->_init->otxt['infos'] = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->_init->otxt['infos']) $this->_init->__rError();
}

/* Lista as sub do interesse editado */

private function __EditarSubs()
{
	$this->_init->otxt['subs'] = '';

	$sql = $this->_init->con->prepare('select interesse_item_id,interesse_item_nome from tb_interesse_item where interesse_id=:iid order by interesse_item_nome asc');
	$sql->bindValue(':iid',$this->_init->sub02,PDO::PARAM_INT);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		if($this->_init->otxt['subs'])
		{
			$this->_init->otxt['subs'] .= '<div class="form-group">
						<label>Nome da sub interesse</label>
						<div class="row">                 
							<div class="col-sm-8"><input type="text" class="form-control _subcategoria" required="" parsley-trigger="change" name="nick" value="'.$ret['interesse_item_nome'].'" data-sid="'.$ret['interesse_item_id'].'"></div>
							<div class="col-sm-4"><button type="button" class="btn btn-danger btn-block _subcategoria-remover">Remover</button></div>
						</div>
						<div class="clear_both"></div>
					</div>';
		}
		else
		{
			$this->_init->otxt['subs'] .= '<div class="form-group">
						<label>Nome da sub interesse</label>
						<div class="row">                 
							<div class="col-sm-8"><input type="text" class="form-control _subcategoria" required="" parsley-trigger="change" name="nick" value="'.$ret['interesse_item_nome'].'" data-sid="'.$ret['interesse_item_id'].'"></div>
							<div class="col-sm-4"><button type="button" class="btn btn-primary btn-block" id="_subcategoria-add">Adicionar</button></div>
						</div>
						<div class="clear_both"></div>
					</div>';
		}
	}
	
	$sql->closeCursor();
}

}
?>