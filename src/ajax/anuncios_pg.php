<?php
class Anuncios_PG extends Utils {
private $estado_id;
private $cidade_id;
private $bairro_id;
private $preco;
private $com_foto;
private $_interesses;
private $_out = array('s'=>'ok','i'=>array());

function __construct()
{
	if(isset($_POST['estado_id'])) $this->estado_id = $_POST['estado_id'];
	if(isset($_POST['cidade_id'])) $this->cidade_id = $_POST['cidade_id'];
	if(isset($_POST['bairro_id'])) $this->bairro_id = $_POST['bairro_id'];
	if(isset($_POST['interesses'])) $this->_interesses = implode(',',array_map('intval',$_POST['interesses']));
	
	$this->com_foto = isset($_POST['com_foto']);
	
	if(isset($_POST['preco_min']) and isset($_POST['preco_max']))
	{
		$this->preco = true;
		++$_POST['preco_max'];	
	}
}

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__Anuncios()) $this->_out['s'] = 'nr';
	
	if(isset($_POST['fc']))
	{
		//$this->__AnunciosInteresses();
		$this->__Aplicados();
		
		if(!$this->preco) $this->__AnunciosPrecos();
	}
		
	$this->FecharCon();
	
	return json_encode($this->_out);
}

/* Maior e menor preço dos anuncios */

private function __AnunciosPrecos()
{
	$_wheres = array();
	
	if($this->estado_id) $_wheres[] = 'd.estado_id=:estado_id';
	if($this->cidade_id) $_wheres[] = 'c.cidade_id=:cidade_id';
	if($this->bairro_id) $_wheres[] = 'b.bairro_id=:bairro_id';
	
	$_wheres_txt = ($_wheres)?' and '.implode(' and ',$_wheres):NULL;
	
	$_where_foto = ($this->com_foto)?' inner join tb_anuncio_foto ft on a.anuncio_id=ft.anuncio_id and ft.anuncio_foto_destaque=1':NULL;
	
	if($this->_interesses)
	{
		/*$sql = $this->con->prepare('select floor(min(a.anuncio_valor)) as minimo,floor(max(a.anuncio_valor)) as maximo from tb_anuncio a'.$_where_foto.' inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id inner join(
		
		select a.anuncio_id,count(c2.interesse_item_id) as ts from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id inner join tb_anuncio_interesse c2 on a.anuncio_id=c2.anuncio_id where a.anuncio_status=1'.$_wheres_txt.' and c2.interesse_item_id in('.$this->_interesses.') group by a.anuncio_id having ts = '.count($_POST['interesses']).'
		
		) _f on a.anuncio_id=_f.anuncio_id');*/
		
		$sql = $this->con->prepare('select floor(min(a.anuncio_valor)) as minimo,floor(max(a.anuncio_valor)) as maximo from tb_anuncio a'.$_where_foto.' inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id inner join(
		
		select a.anuncio_id,count(c2.interesse_item_id) as ts from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id inner join tb_anuncio_interesse c2 on a.anuncio_id=c2.anuncio_id where a.anuncio_status=1'.$_wheres_txt.' and c2.interesse_item_id in('.$this->_interesses.') group by a.anuncio_id
		
		) _f on a.anuncio_id=_f.anuncio_id');
	}
	else
	{
		$sql = $this->con->prepare('select floor(min(a.anuncio_valor)) as minimo,floor(max(a.anuncio_valor)) as maximo from tb_anuncio a'.$_where_foto.' inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id where a.anuncio_status=1'.$_wheres_txt);
	}
	
	//$sql->bindValue(':estado_id',(int)$_POST['estado_id'],PDO::PARAM_INT);
	
	if($this->estado_id) $sql->bindValue(':estado_id',(int)$this->estado_id,PDO::PARAM_INT);
	if($this->cidade_id) $sql->bindValue(':cidade_id',(int)$this->cidade_id,PDO::PARAM_INT);
	if($this->bairro_id) $sql->bindValue(':bairro_id',(int)$this->bairro_id,PDO::PARAM_INT);
	
	$sql->execute();
	
	$this->_out['precos'] = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
}

/* Lista os interesses aplicados */

protected function __Aplicados()
{
	if(!$this->_interesses) return ;

	$out = array();

	$sql = $this->con->prepare('select interesse_item_id,interesse_item_nome from tb_interesse_item where interesse_item_id in('.$this->_interesses.') order by interesse_item_nome asc');
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$out[] = '<p class="_interesses-aplicado active" data-iid="'.$ret['interesse_item_id'].'">'.$ret['interesse_item_nome'].'<a href="" class="_interesses-aplicado-remover"><img src="img/fechar.png" alt="Excluir" title="Excluir"></a></p>';
	}
	
	$sql->closeCursor();
	
	if($out) $this->_out['fap'] = $out;
}

/* Lista os interesses dos produtos */

protected function __AnunciosInteresses()
{
	$_wheres = $out = array();
	
	if($this->estado_id) $_wheres[] = 'd.estado_id=:estado_id';
	if($this->cidade_id) $_wheres[] = 'c.cidade_id=:cidade_id';
	if($this->bairro_id) $_wheres[] = 'b.bairro_id=:bairro_id';
	
	$_wheres_txt = ($_wheres)?' and '.implode(' and ',$_wheres):NULL;
	
	if($this->_interesses)
	{
		$_where_preco = ($this->preco)?' and a.anuncio_valor >= :preco_min and a.anuncio_valor <= :preco_max':NULL;
		$_where_foto = ($this->com_foto)?' inner join tb_anuncio_foto ft on a.anuncio_id=ft.anuncio_id and ft.anuncio_foto_destaque=1':NULL;
	
		$_subquery = 'select _a.interesse_item_id,count(_a.anuncio_id) as total from tb_anuncio_interesse _a inner join(
		
			select a.anuncio_id,count(c2.interesse_item_id) as ts from tb_anuncio a'.$_where_foto.' inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id inner join tb_anuncio_interesse c2 on a.anuncio_id=c2.anuncio_id where a.anuncio_status=1'.$_wheres_txt.$_where_preco.' and c2.interesse_item_id in('.$this->_interesses.') group by a.anuncio_id having ts = '.count($_POST['interesses']).'
		
		) as c on c.anuncio_id=_a.anuncio_id where _a.interesse_item_id not in('.$this->_interesses.') group by _a.interesse_item_id';
	}
	else
	{
		$_where_preco = ($this->preco)?' and _b.anuncio_valor >= :preco_min and _b.anuncio_valor <= :preco_max':NULL;
		$_where_foto = ($this->com_foto)?' inner join tb_anuncio_foto ft on _b.anuncio_id=ft.anuncio_id and ft.anuncio_foto_destaque=1':NULL;
	
		$_subquery = 'select _a.interesse_item_id,count(_a.anuncio_id) as total from tb_anuncio_interesse _a inner join(tb_anuncio _b'.$_where_foto.' inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=_b.bairro_id) on _b.anuncio_id=_a.anuncio_id where _b.anuncio_status=1'.$_wheres_txt.$_where_preco.' group by _a.interesse_item_id';
	}
	
	$sql = $this->con->prepare('select a.interesse_nome,group_concat(b.interesse_item_id order by b.interesse_item_nome asc separator 0x1D) as subid,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator 0x1D) as subnome,group_concat(c.total order by b.interesse_item_nome asc separator 0x1D) as subtotal from tb_interesse a inner join tb_interesse_item b on a.interesse_id=b.interesse_id inner join(

'.$_subquery.'

) as c on b.interesse_item_id=c.interesse_item_id group by a.interesse_id order by a.interesse_nome asc');

	//$sql->bindValue(':estado_id',(int)$_POST['estado_id'],PDO::PARAM_INT);
	
	if($this->preco)
	{
		$sql->bindValue(':preco_min',strval($_POST['preco_min']),PDO::PARAM_STR);
		$sql->bindValue(':preco_max',strval($_POST['preco_max']),PDO::PARAM_STR);
	}
	
	if($this->estado_id) $sql->bindValue(':estado_id',(int)$this->estado_id,PDO::PARAM_INT);
	if($this->cidade_id) $sql->bindValue(':cidade_id',(int)$this->cidade_id,PDO::PARAM_INT);
	if($this->bairro_id) $sql->bindValue(':bairro_id',(int)$this->bairro_id,PDO::PARAM_INT);

	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$ret['subid'] = explode(chr(0x1D),$ret['subid']);
		$ret['subnome'] = explode(chr(0x1D),$ret['subnome']);
		$ret['subtotal'] = explode(chr(0x1D),$ret['subtotal']);
	
		$_subs = '';
	
		foreach($ret['subid'] as $a=>$b)
		{
			$_subs .= '<li class="_interesses_item" data-iid="'.$b.'">
                        <p class="input-perso fleft"></p>
                        <p class="text-pos">'.$ret['subnome'][$a].' <span>('.$ret['subtotal'][$a].')</span></p>
                        </li>';
		}
		
		$out[] = '<ul>
                    	<li class="tit6" style="cursor:default;">'.$ret['interesse_nome'].'</li>
                        '.$_subs.'
                    </ul>';
	}
	
	$sql->closeCursor();
	
	if($out) $this->_out['f'] = $out;
}

/* listagem de anuncios */

private function __Anuncios()
{
	if($this->_interesses)
	{
		$_inner_f = ' inner join tb_anuncio_interesse t2 on a.anuncio_id=t2.anuncio_id';
		$_where_f = ' and t2.interesse_item_id in('.$this->_interesses.')';
		//$_having_f = ' having count(distinct t2.interesse_item_id) = '.count($_POST['interesses']);
		$_having_f = NULL;
	}
	else
	{
		$_inner_f = $_where_f = $_having_f = NULL;
	}

	if(isset($_SESSION['user']) and $this->__CadUI())
	{
		$_perfil_nome = $this->_cad_ui['cadastro_nome'];
		$_perfil_email = $this->_cad_ui['cadastro_email'];
	}
	else
	{
		$_perfil_nome = $_perfil_email = NULL;
	}
	
	if(isset($_POST['ordenar']))
	{
		$_ordenar = ($_POST['ordenar'] == 1)?'a.anuncio_valor asc':'a.anuncio_valor desc';
	}
	else
	{
		$_ordenar = 'a.anuncio_id desc';
	}
	
	$_wheres = array();
	
	if($this->estado_id) $_wheres[] = 'd.estado_id=:estado_id';
	if($this->cidade_id) $_wheres[] = 'c.cidade_id=:cidade_id';
	if($this->bairro_id) $_wheres[] = 'b.bairro_id=:bairro_id';
	
	$_wheres_txt = ($_wheres)?' and '.implode(' and ',$_wheres):NULL;

	$_where_preco = ($this->preco)?' and a.anuncio_valor >= :preco_min and a.anuncio_valor <= :preco_max':NULL;
	
	$_where_foto = ($this->com_foto)?'inner':'left';

	$sql = $this->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,c.cidade_nome,d.estado_nome,group_concat(e.anuncio_foto_url separator 0x1D) as fotos,t.cadastro_id,t.cadastro_nome,t.cadastro_url,t.cadastro_fotoPerfil from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id '.$_where_foto.' join tb_anuncio_foto e on a.anuncio_id=e.anuncio_id inner join tb_cadastro t on t.cadastro_id=a.cadastro_id'.$_inner_f.' where a.anuncio_status=1'.$_wheres_txt.$_where_preco.$_where_f.' group by a.anuncio_id'.$_having_f.' order by '.$_ordenar.' limit :limit offset :offset');
	$sql->bindValue(':limit',(int)self::limit_busca_anuncios,PDO::PARAM_INT);
	$sql->bindValue(':offset',(int)$_POST['offset'],PDO::PARAM_INT);
	//$sql->bindValue(':estado_id',(int)$_POST['estado_id'],PDO::PARAM_INT);
	
	if($this->preco)
	{
		$sql->bindValue(':preco_min',strval($_POST['preco_min']),PDO::PARAM_STR);
		$sql->bindValue(':preco_max',strval($_POST['preco_max']),PDO::PARAM_STR);
	}
	
	if($this->estado_id) $sql->bindValue(':estado_id',(int)$this->estado_id,PDO::PARAM_INT);
	if($this->cidade_id) $sql->bindValue(':cidade_id',(int)$this->cidade_id,PDO::PARAM_INT);
	if($this->bairro_id) $sql->bindValue(':bairro_id',(int)$this->bairro_id,PDO::PARAM_INT);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		if($ret['anuncio_endereco_bairro']) $ret['bairro_nome'] = $ret['anuncio_endereco_bairro'];
		if($ret['anuncio_endereco_complemento']) $ret['anuncio_endereco_numero'] .= ' '.$ret['anuncio_endereco_complemento'];
	
		$ret['fotos'] = explode(chr(0x1D),$ret['fotos']);
		
		if($ret['fotos'][0])
		{
			$_img = 'anuncios/'.$ret['fotos'][0];
			$_dfotos = ' data-fotos=\''.json_encode($ret['fotos']).'\' data-ix="0"';
			
			$_sdir = (count($ret['fotos']) == 1)?' dnone':NULL;
		}
		else
		{
			$_img = 'sem-foto-anuncio.jpg';
			$_dfotos = NULL;
			$_sdir = ' dnone';
		}
		
		if(!$ret['cadastro_url']) $ret['cadastro_url'] = $ret['cadastro_id'];
		
		$ret['cadastro_fotoPerfil'] = ($ret['cadastro_fotoPerfil'])?'usuarios/'.$ret['cadastro_fotoPerfil']:'sem-foto-perfil.jpg';
		
		if($ret['anuncio_valor'])
		{
			$_valorfix = 'Valor: R$<span> '.$this->FMoney($ret['anuncio_valor']).'</span>'.$this->__ValorTipoFx($ret['anuncio_valorTipo']);
		}
		else
		{
			$_valorfix = 'Sob consulta';
		}
	
		$this->_out['i'][] = '<div class="grid_12 responsive last item-list _perfil-anuncio" data-aid="'.$ret['anuncio_id'].'"'.$_dfotos.'>
            	
                <div class="grid_12 last adapt">
                	<div class="grid_5 txtcenter marg21 relative">
                <a href="" class="_perfil-anuncio-foto-esq dnone"><img class="seta-esq responsive" src="img/seta-esq.png"></a>
                <img class="img-anunciante responsive _perfil-anuncio-foto" src="fotos/'.$_img.'">
                <a href="" class="_perfil-anuncio-foto-dir '.$_sdir.'"><img class="seta-dir responsive" src="img/seta-dir.png"></a>
				<img class="load-foto responsive dnone _perfil-anuncio-foto-loading" src="img/load-foto.gif">
				<div class="overpass2 dnone _perfil-anuncio-foto-over"></div>
                </div>
                	<div class="grid_7 responsive marg20 last txtleft">
                    	<div class="grid_12 responsive last">
                        	<div class="grid_8" style="margin-bottom:3px;">
                            <p class="tit5">'.$ret['anuncio_titulo'].'</p>
							<p class="end-perfis ico-end"> '.$ret['anuncio_endereco_rua'].', '.$ret['anuncio_endereco_numero'].', '.$ret['bairro_nome'].'<br>&nbsp;&nbsp;&nbsp;&nbsp;'.$ret['cidade_nome'].' - '.$ret['estado_nome'].'</p>
                            <p class="infos-item">'.$ret['anuncio_descricao'].'</p>
							<p class="valor-item">'.$_valorfix.'</p>
							
							<div class="marg8 dnone tblock">
                            	<img class="responsive dinline-block vmiddle _fxbradius" src="fotos/'.$ret['cadastro_fotoPerfil'].'" style="max-width:98px;">
                            	<div class="dinline-block vmiddle marg-l7">
                                 <p class="anunciante"> '.$ret['cadastro_nome'].'</p>
                                 <a href="'.$ret['cadastro_url'].'/" class="btn-item2">Perfil anunciante</a>
                            	</div>
                            </div>
							
                            <a href="" class="btn-item _perfil-anuncio-contato">Ver telefone</a> <a href="" class="btn-item _perfil-anuncio-msg">Fazer proposta</a>
                            </div>
							<div class="grid_4 marg8 txtcenter last tnone">
                            	<img class="responsive _fxbradius" src="fotos/'.$ret['cadastro_fotoPerfil'].'" style="max-width:98px;">
                                <p class="anunciante"> '.$ret['cadastro_nome'].'</p>
                                <a href="'.$ret['cadastro_url'].'/" class="btn-item2">Perfil anunciante</a>   
                          </div>
               			  
                        </div>
                    </div>
                </div>   
                    
                    <div class="grid_12 last item-list2 bordernone form-contato3 responsive dnone _perfil-anuncio-box">
            	<div class="grid_12 last marg16 txtcenter"><p><strong>Envie sua mensagem ao anunciante</strong></p>
            	</div>
                <div class="grid_12 last responsive">
                <div class="grid_12 last">
                	<span class="lineform smallControl">
					<input type="text" placeholder="Nome" class="perfil-contato-nome" value="'.$_perfil_nome.'">
					</span>
                 </div>
                 
                 <div class="grid_12 last adapt">
                 <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" placeholder="E-mail" class="perfil-contato-email" value="'.$_perfil_email.'">
					</span>
                 </div>
                 <div class="grid_6 last">
                	<span class="lineform smallControl">
					<input type="text" placeholder="Telefone" class="perfil-contato-telefone">
					</span>
                 </div>
                 </div>
                
                 </div>
                  
                 <div class="grid_12 last form-contato5">
                 	<span class="lineform smallControl">
					<textarea style="font-size:15px; color:#666;" placeholder="Envie a mensagem para o anunciante" class="perfil-contato-msg"></textarea>
					</span>
                  </div>
                 <div class="grid_12 last txtleft bot-red-senha">
                 	<button class="btn-anuncio-mens btn-senha2 cinza-suave perfil-contato-enviar" title="">Enviar</button>
                    <span class="btn-anuncio-mens btn-senha2 dblock txtcenter cinza-claro dnone perfil-contato-loading">Enviando ...</span>
                    <span class="btn-anuncio-mens btn-senha2 dblock txtcenter verde dnone perfil-contato-ok">Enviado com sucesso !</span>
                 	</div>
            </div>
            </div>';
	}
	
	$sql->closeCursor();
	
	if(!$this->_out['i'])
	{
		unset($this->_out['i']);
		return ;
	}
	
	return true;
}

}
?>