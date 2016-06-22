<?php
class anuncios_Front extends Init {
public $_txt;
private $_url;
private $_status;

function __construct($_init) { $this->_init = $_init; }

/* Sub paginas */

protected function __Paginas()
{
	switch($this->_init->sub01)
	{
		case 'pendentes':
		
			$this->_status = 0;
		
			$this->__Interesses();
			$this->__Anuncios();
			$this->__Paginacao();
		
		break;
		case 'aprovados':
		
			$this->_status = 1;
			
			$this->__Interesses();
			$this->__Anuncios();
			$this->__Paginacao();
		
		break;
		case 'nao-aprovados':
		
			$this->_status = 2;
			
			$this->__Interesses();
			$this->__Anuncios();
			$this->__Paginacao();
		
		break;
		case 'aprovar':
		
			if(!$this->_init->sub02 or !$this->_init->sub03 or !$this->_init->sub04 or !$this->_init->sub05 or !$this->__TrocarStatus()) $this->_init->__rError();
			
			$_extra = (isset($_GET['q']))?'?q='.urlencode($_GET['q']):NULL;
			
			$this->_init->__rError('anuncios/'.$this->_init->sub04.'/'.$this->_init->sub03.'/'.$_extra);
		
		break;
		default: $this->_init->__rError(); break;
	}
	
	$this->_init->AddJS($this->_init->pn.'/anuncios.js');
	$this->_init->html_tpl = $this->_init->pn.'/anuncios';
}

/* Deletar contato */

private function __TrocarStatus()
{
	$_status = ($this->_init->sub05 == 'sim')?1:2;

	try {
	
		$sql = $this->_init->con->prepare('update tb_anuncio set anuncio_status=:status,anuncio_editado=now() where anuncio_id=:aid');
		$sql->bindValue(':aid',$this->_init->sub02,PDO::PARAM_INT);
		$sql->bindValue(':status',$_status,PDO::PARAM_INT);
		
		$sql->execute();
	
	}
	catch(PDOException $e) { print_r($e); return ; }
	
	if($sql->rowCount() == 0) return ;
	
	return true;
}

/* Listar interesses */

private function __Interesses()
{
	$this->_init->otxt['interesses'] = array();

	$sql = $this->_init->con->prepare('select a.interesse_id,a.interesse_nome,group_concat(b.interesse_item_id order by b.interesse_item_nome asc separator 0x1D) as ids,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator 0x1D) as nomes from tb_interesse a inner join tb_interesse_item b on a.interesse_id=b.interesse_id group by a.interesse_id order by a.interesse_nome');
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$ret['ids'] = explode(chr(0x1D),$ret['ids']);
		$ret['nomes'] = explode(chr(0x1D),$ret['nomes']);
		
		$this->_init->otxt['interesses'][] = $ret;
	}
	
	$sql->closeCursor();
}

private function __LoopInteresses($subs)
{
	$out = '';

	foreach($this->_init->otxt['interesses'] as $v)
	{
		$_p = array();
		$cats_p = false;
		
		foreach($v['ids'] as $a=>$b)
		{
			if(in_array($b,$subs))
			{
				if(!$cats_p) $cats_p = true;
						
				$_p[] = $v['nomes'][$a];
			}
		}
				
		if($cats_p) $out .= '<span>- <strong>'.$v['interesse_nome'].'</strong> ('.implode(', ',$_p).')</span>';
	}
	
	return $out;
}

/* Listar anuncios */

private function __Anuncios()
{
	$this->_init->otxt['anuncios'] = '';
	
	// Pagina
	
	if($this->_init->sub02)
	{
		$_offset = ($this->_init->sub02-1)*self::anuncios_limit;
	}
	else
	{
		$this->_init->sub02 = $_offset = 0;
	}
	
	// Busca
	
	if(isset($_GET['q']))
	{
		$this->_txt = ' and a.anuncio_titulo like :txt or t.cadastro_nome like :txt or t.cadastro_email like :txt';
		$this->_url .= '?q='.urlencode($_GET['q']);
	}
	else
	{ $this->_txt = NULL; }
	
	$_pg = max(1,$this->_init->sub02);
	
	$sql = $this->_init->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,c.cidade_nome,d.estado_nome,group_concat(distinct e.anuncio_foto_url separator 0x1D) as fotos,t.cadastro_id,t.cadastro_nome,t.cadastro_fotoPerfil,group_concat(distinct i.interesse_item_id separator 0x1D) as subs from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id left join tb_anuncio_foto e on a.anuncio_id=e.anuncio_id inner join tb_cadastro t on t.cadastro_id=a.cadastro_id left join tb_anuncio_interesse i on a.anuncio_id=i.anuncio_id where a.anuncio_status=:status'.$this->_txt.' group by a.anuncio_id order by a.anuncio_id desc limit :offset,:limit');
	
	$sql->bindValue(':status',$this->_status,PDO::PARAM_INT);
	$sql->bindValue(':offset',(int)$_offset,PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::anuncios_limit,PDO::PARAM_INT);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$cats = '';
		
		if($ret['subs'])
		{
			$ret['subs'] = explode(chr(0x1D),$ret['subs']);
			$cats = $this->__LoopInteresses($ret['subs']);
		}
	
		if($ret['anuncio_endereco_bairro']) $ret['bairro_nome'] = $ret['anuncio_endereco_bairro'];
		if($ret['anuncio_endereco_complemento']) $ret['anuncio_endereco_numero'] .= ' '.$ret['anuncio_endereco_complemento'];
	
		$_n = 0;
		$_fotos = '';
		
		if($ret['fotos'])
		{
			$ret['fotos'] = explode(chr(0x1D),$ret['fotos']);
			
			foreach($ret['fotos'] as $v)
			{
				$_fotos .= '<div class="col-sm-6 col-xs-12 col-md-4"><div class="thumb"><div class="thumb_image"><img class="img-responsive" src="../fotos/anuncios/'.$v.'"></div></div></div>';
				++$_n;
			}
		}
		
		while($_n < 3)
		{
			$_fotos .= '<div class="col-sm-6 col-xs-12 col-md-4"><div class="thumb"><div class="thumb_image"><img class="img-responsive" src="../fotos/sem-foto-anuncio.jpg"></div></div></div>';
			++$_n;
		}
		
		$ret['cadastro_fotoPerfil'] = ($ret['cadastro_fotoPerfil'])?'usuarios/'.$ret['cadastro_fotoPerfil']:'sem-foto-perfil.jpg';
		
		if($ret['anuncio_valor'])
		{
			$_valorfix = '<strong>Valor:</strong> R$ '.$this->FMoney($ret['anuncio_valor']).$this->_init->__ValorTipoFx($ret['anuncio_valorTipo']);
		}
		else
		{
			$_valorfix = 'Sob consulta';
		}
	
		$this->_init->otxt['anuncios'] .= '<div class="contact_people" data-aid="'.$ret['anuncio_id'].'">
		
		<div style="padding-bottom: 20px;" class="col-xs-12">
  <a class="btn btn-success" style="" href="../login-via-admin/'.$ret['cadastro_id'].'/?r=editar-anuncio/'.$ret['anuncio_id'].'/" target="_blank"><i class="fa fa-edit"></i> <span>&nbsp;Editar an&uacute;ncio</span></a>
</div>
            	
                <div class="col-sm-8 col-xs-12 col-md-9">
<div class="contact_people_body" style="">
  
                	<h5 style="color:#333;">'.$ret['anuncio_titulo'].'</h5>
                    <span><i class="fa fa-map-marker"></i>'.$ret['anuncio_endereco_rua'].', '.$ret['anuncio_endereco_numero'].', '.$ret['bairro_nome'].'&nbsp;&nbsp;/&nbsp;&nbsp;'.$ret['cidade_nome'].' - '.$ret['estado_nome'].'</span>
                    <span>'.$ret['anuncio_descricao'].'</span>
					<span>'.$_valorfix.'</span>
                </div>';
				
		if($cats)
		{
				$this->_init->otxt['anuncios'] .= '<div style="padding:10px 0;"><a class="btn btn-primary _anuncio-cats-btn" style="margin-bottom:0px; background-color:#999;" href=""> <i class="fa fa-plus-square-o"></i>  <span>&nbsp;Categorias do an&uacute;ncio</span></a><div class="clear_both"></div></div>
				
				<div style="padding:10px 0; display:none;" class="contact_people_body _anuncio-cats-box">
					'.$cats.'
				</div>';		
		}
				
$this->_init->otxt['anuncios'] .= '</div>
<div class="col-sm-4 col-xs-12 col-md-3">
  <div class="col-sm-12"><img class="img-responsive center-block" style="margin-top: 4px; max-width:120px;" src="../fotos/'.$ret['cadastro_fotoPerfil'].'" title="'.$ret['cadastro_nome'].'"></div>
  <div class="col-sm-12 text-center" style="padding-top:4px; color:#666;">'.$ret['cadastro_nome'].'</div>
</div>
  <div class="clear_both"></div>
<div class="col-sm-12" style="margin-top:20px; padding-bottom: 15px; ">

  '.$_fotos.'
  
</div>
<div class="clear_both"></div>

<div class="col-xs-12 text-center" style="padding-bottom:12px; font-weight:bold;">
  Aprovar an&uacute;ncio ?
</div>';

if($this->_status == 0)
{
	$this->_init->otxt['anuncios'] .= '<div class="col-xs-12 text-center" style="border-bottom:1px solid #DDD; padding-bottom: 35px;">
	<div class="col-xs-12">
	  <div class="col-sm-2 col-xs-0"></div>
	  <div class="col-sm-4 col-xs-6"><a class="btn btn-success _tstatus" href="anuncios/aprovar/'.$ret['anuncio_id'].'/'.$_pg.'/'.$this->_init->sub01.'/sim/'.$this->_url.'" style="width:100%; line-height:28px;">SIM</a></div>
	  <div class="col-sm-4 col-xs-6"><a class="btn btn-primary _tstatus" href="anuncios/aprovar/'.$ret['anuncio_id'].'/'.$_pg.'/'.$this->_init->sub01.'/nao/'.$this->_url.'" style="width:100%; line-height:28px;">N&Atilde;O</a></div>
	  <div class="col-sm-2 col-xs-0"></div>
	 </div>
	 <div class="col-xs-12 _anuncio-motivo" style="display:none;">

    <div style="margin-bottom:0; padding-top:22px;" class="form-group">
                  <label style="margin-bottom:8px;" for="_informacoes">MOTIVO DA N&Atilde;O APROVA&Ccedil;&Atilde;O DO AN&Uacute;NCIO</label>
                  <textarea style="width:90%;" class="form-control center-block _anuncio-motivo-msg" rows="4"></textarea>
                </div>
				
<a class="btn btn-primary _anuncio-motivo-enviar" href="" style="margin-top: 12px; line-height: 28px; width: 80%; float: none; margin-right: 0px; background-color: rgb(153, 153, 153);">ENVIAR MENSAGEM</a>
<a class="btn btn-primary _anuncio-motivo-loading" href="" style="margin-top: 12px; line-height: 28px; width: 80%; float: none; margin-right: 0px; background-color: rgb(153, 153, 153); display:none;">ENVIANDO ...</a>
<a class="btn btn-primary _anuncio-motivo-ok" href="" style="margin-top: 12px; line-height: 28px; width: 80%; float: none; margin-right: 0px; background-color: rgb(71, 164, 71); display:none;">ENVIADO !</a>
    
  </div>
	</div>';
}
elseif($this->_status == 1)
{
	$this->_init->otxt['anuncios'] .= '<div class="col-xs-12 text-center" style="border-bottom:1px solid #DDD; padding-bottom: 35px;">
	<div class="col-xs-12">
	  <div class="col-sm-3 col-xs-0"></div>
	  <div class="col-sm-6 col-xs-12"><a class="btn btn-primary _tstatus" href="anuncios/aprovar/'.$ret['anuncio_id'].'/'.$_pg.'/'.$this->_init->sub01.'/nao/'.$this->_url.'" style="width:100%; line-height:28px;">N&Atilde;O</a></div>
	  <div class="col-sm-3 col-xs-0"></div>
	</div>
	 <div class="col-xs-12 _anuncio-motivo" style="display:none;">

    <div style="margin-bottom:0; padding-top:22px;" class="form-group">
                  <label style="margin-bottom:8px;" for="_informacoes">MOTIVO DA N&Atilde;O APROVA&Ccedil;&Atilde;O DO AN&Uacute;NCIO</label>
                  <textarea style="width:90%;" class="form-control center-block _anuncio-motivo-msg" rows="4"></textarea>
                </div>

<a class="btn btn-primary _anuncio-motivo-enviar" href="" style="margin-top: 12px; line-height: 28px; width: 80%; float: none; margin-right: 0px; background-color: rgb(153, 153, 153);">ENVIAR MENSAGEM</a>
<a class="btn btn-primary _anuncio-motivo-loading" href="" style="margin-top: 12px; line-height: 28px; width: 80%; float: none; margin-right: 0px; background-color: rgb(153, 153, 153); display:none;">ENVIANDO ...</a>
<a class="btn btn-primary _anuncio-motivo-ok" href="" style="margin-top: 12px; line-height: 28px; width: 80%; float: none; margin-right: 0px; background-color: rgb(71, 164, 71); display:none;">ENVIADO !</a>
    
  </div>
	</div>';
}
elseif($this->_status == 2)
{
	$this->_init->otxt['anuncios'] .= '<div class="col-xs-12 text-center" style="border-bottom:1px solid #DDD; padding-bottom: 35px;">
	  <div class="col-sm-3 col-xs-0"></div>
	  <div class="col-sm-6 col-xs-12"><a class="btn btn-success _tstatus" href="anuncios/aprovar/'.$ret['anuncio_id'].'/'.$_pg.'/'.$this->_init->sub01.'/sim/'.$this->_url.'" style="width:100%; line-height:28px;">SIM</a></div>
	  <div class="col-sm-3 col-xs-0"></div>
	</div>';
}

$this->_init->otxt['anuncios'] .= '<div class="clear_both"></div>

            </div>';
	}
	
	$sql->closeCursor();
	
	if(!$this->_init->otxt['anuncios'] and $this->_init->sub02 > 0)
	{
		$_fix = ($this->_init->sub02 > 1)?($this->_init->sub02-1).'/':NULL; 
		$this->_init->__rError('anuncios/'.$this->_init->sub01.'/'.$_fix.$this->_url);
	}
}

/* Listar anuncios paginação */

private function __Paginacao()
{
	$this->_init->otxt['paginacao'] = '';

	$total = $this->__Quantidade();
	
	$ultima_pag = ceil($total / self::anuncios_limit);
	
	if($ultima_pag <= 1) return ;
	
	$prox = $this->_init->sub02 + 1;
	$ant = $this->_init->sub02 - 1;
	$penultima = $ultima_pag - 1;	
	$adjacentes = 2;
	
	if($this->_init->sub02 > 1) $this->_init->otxt['paginacao'] .= '<li class="prev"><a href="anuncios/'.$this->_init->sub01.'/'.$ant.'/'.$this->_url.'"><</a></li>';
	
	if ($ultima_pag <= 10)
	{
		for ($i=1; $i< $ultima_pag+1; $i++)
		{
			if ($i == $this->_init->sub02 or ($this->_init->sub02 == 0 and $i == 1))
			{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
			else
			{ $this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
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
				{ $this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			
			if(($i-1) != $penultima) $this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		elseif($this->_init->sub02 > (2 * $adjacentes) && $this->_init->sub02 < $ultima_pag - 3)
		{
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			for($i = $this->_init->sub02-$adjacentes; $i<= $this->_init->sub02 + $adjacentes; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
			
			$this->_init->otxt['paginacao'] .= '<li><a>...</a></li> ';
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$penultima.'/'.$this->_url.'">'.$penultima.'</a></li>';
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$ultima_pag.'/'.$this->_url.'">'.$ultima_pag.'</a></li>';
		}
		else
		{	
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/1/'.$this->_url.'">1</a></li>';				
			$this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/2/'.$this->_url.'">2</a></li><li><a>...</a></li>';
			
			$_calc = $ultima_pag - (4 + (2 * $adjacentes));
			if($_calc == 2) ++$_calc;
			
			for($i = $_calc; $i <= $ultima_pag; $i++)
			{
				if ($i == $this->_init->sub02)
				{ $this->_init->otxt['paginacao'] .= '<li class="active"><a>'.$i.'</a></li>'; }
				else
				{ $this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$i.'/'.$this->_url.'">'.$i.'</a></li>'; }
			}
		}
	}
	
	if($prox <= $ultima_pag and $ultima_pag > 1) $this->_init->otxt['paginacao'] .= '<li><a href="anuncios/'.$this->_init->sub01.'/'.$prox.'/'.$this->_url.'">></a></li>';
}

/* Quantidade de anuncios para paginação */

private function __Quantidade()
{
	$sql = $this->_init->con->prepare('select count(a.anuncio_id) from tb_anuncio a inner join tb_cadastro t on t.cadastro_id=a.cadastro_id where a.anuncio_status=:status'.$this->_txt);
	$sql->bindValue(':status',$this->_status,PDO::PARAM_INT);
	
	if($this->_txt) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	$out = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	return $out;
}

}
?>