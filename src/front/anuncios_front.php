<?php
class Anuncios_Front extends Init {
function __construct($_init) { $this->_init = $_init; }

/* Retorna o ID da localidade */

private function __IDLocal($t,$url)
{
	if($t == 'cidade')
	{
		$sql = $this->_init->con->prepare('select '.$t.'_id from tb_'.$t.' where '.$t.'_url=:url and estado_id=:estado_id');
		$sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	}
	elseif($t == 'bairro')
	{
		$sql = $this->_init->con->prepare('select '.$t.'_id from tb_'.$t.' where '.$t.'_url=:url and cidade_id=:cidade_id');
		$sql->bindValue(':cidade_id',$this->_init->otxt['cidade_id'],PDO::PARAM_INT);
	}
	else
	{
		$sql = $this->_init->con->prepare('select '.$t.'_id from tb_'.$t.' where '.$t.'_url=:url');
	}
	
	$sql->bindValue(':url',$url,PDO::PARAM_STR);
	
	$sql->execute();
	
	$this->_init->otxt[$t.'_id'] = $sql->fetchColumn();
	
	$sql->closeCursor();
	
	if(!$this->_init->otxt[$t.'_id']) $this->_init->__rError('anuncios/');
}

/* Lista estados com anuncios cadastrados */

protected function __Estados()
{
	if($this->_init->sub01 and $this->_init->sub01!='todos') $this->__IDLocal('estado',$this->_init->sub01);

	$this->_init->otxt['estados'] = '';
	
	$sql = $this->_init->con->prepare('select a.estado_id,a.estado_nome,a.estado_url,count(d.anuncio_id) as cv from tb_estado a inner join(tb_cidade b inner join(tb_bairro c left join tb_anuncio d on c.bairro_id=d.bairro_id and d.anuncio_status=1) on b.cidade_id=c.cidade_id) on a.estado_id=b.estado_id group by a.estado_id having cv > 0 order by a.estado_nome asc');
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$_sel = ($this->_init->sub01 and $this->_init->otxt['estado_id'] == $ret['estado_id'])?' selected="selected"':NULL;
		$this->_init->otxt['estados'] .= '<option class="cor" value="'.$ret['estado_url'].'"'.$_sel.'>'.$ret['estado_nome'].'</option>';
	}
	
	$sql->closeCursor();
}

/* Lista cidades com anuncios cadastrados */

protected function __Cidades()
{
	if($this->_init->sub02) $this->__IDLocal('cidade',$this->_init->sub02);

	$this->_init->otxt['cidades'] = '';
	
	$sql = $this->_init->con->prepare('select b.cidade_id,b.cidade_nome,b.cidade_url,count(d.anuncio_id) as cv from tb_cidade b inner join(tb_bairro c left join tb_anuncio d on c.bairro_id=d.bairro_id and d.anuncio_status=1) on b.cidade_id=c.cidade_id where b.estado_id=:estado_id group by b.cidade_id having cv > 0 order by b.cidade_nome asc');
	$sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$_sel = ($this->_init->sub02 and $this->_init->otxt['cidade_id'] == $ret['cidade_id'])?' selected="selected"':NULL;
		$this->_init->otxt['cidades'] .= '<option class="cor" value="'.$ret['cidade_url'].'"'.$_sel.'>'.$ret['cidade_nome'].'</option>';
	}
	
	$sql->closeCursor();
}

/* Lista bairros com anuncios cadastrados */

protected function __Bairros()
{
	if($this->_init->sub03) $this->__IDLocal('bairro',$this->_init->sub03);

	$this->_init->otxt['bairros'] = '';
	
	$sql = $this->_init->con->prepare('select c.bairro_id,c.bairro_nome,c.bairro_url,count(d.anuncio_id) as cv from tb_bairro c left join tb_anuncio d on c.bairro_id=d.bairro_id and d.anuncio_status=1 where c.cidade_id=:cidade_id group by c.bairro_id having cv > 0 order by c.bairro_nome asc');
	$sql->bindValue(':cidade_id',$this->_init->otxt['cidade_id'],PDO::PARAM_INT);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$_sel = ($this->_init->sub03 and $this->_init->otxt['bairro_id'] == $ret['bairro_id'])?' selected="selected"':NULL;
		$this->_init->otxt['bairros'] .= '<option class="cor" value="'.$ret['bairro_url'].'"'.$_sel.'>'.$ret['bairro_nome'].'</option>';
	}
	
	$sql->closeCursor();
}

/* Lista os interesses dos produtos */

protected function __AnunciosInteresses()
{
	$this->_init->otxt['anuncios_interesses'] = '';
	
	$_wheres = array();
	
	if($this->_init->otxt['estado_id']) $_wheres[] = 'd.estado_id=:estado_id';
	if($this->_init->otxt['cidade_id']) $_wheres[] = 'c.cidade_id=:cidade_id';
	if($this->_init->otxt['bairro_id']) $_wheres[] = 'b.bairro_id=:bairro_id';
	
	$_wheres_txt = ($_wheres)?' and '.implode(' and ',$_wheres):NULL;
	
	$_subquery = 'select _a.interesse_item_id,count(_a.anuncio_id) as total from tb_anuncio_interesse _a inner join(tb_anuncio _b inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=_b.bairro_id) on _b.anuncio_id=_a.anuncio_id where _b.anuncio_status=1'.$_wheres_txt.' group by _a.interesse_item_id';
	
	$sql = $this->_init->con->prepare('select a.interesse_nome,a.interesse_icone,group_concat(b.interesse_item_id order by b.interesse_item_nome asc separator 0x1D) as subid,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator 0x1D) as subnome,group_concat(c.total order by b.interesse_item_nome asc separator 0x1D) as subtotal from tb_interesse a inner join tb_interesse_item b on a.interesse_id=b.interesse_id inner join(

'.$_subquery.'

) as c on b.interesse_item_id=c.interesse_item_id group by a.interesse_id order by a.interesse_nome asc');

	//$sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	
	// and _b.anuncio_valor >= :preco_min and _b.anuncio_valor <= :preco_max
	//$sql->bindValue(':preco_min',strval($this->_init->otxt['anuncios_precos']['minimo']),PDO::PARAM_STR);
	//$sql->bindValue(':preco_max',strval($this->_init->otxt['anuncios_precos']['maximo']),PDO::PARAM_STR);
	
	if($this->_init->otxt['estado_id']) $sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	if($this->_init->otxt['cidade_id']) $sql->bindValue(':cidade_id',$this->_init->otxt['cidade_id'],PDO::PARAM_INT);
	if($this->_init->otxt['bairro_id']) $sql->bindValue(':bairro_id',$this->_init->otxt['bairro_id'],PDO::PARAM_INT);

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
		
		$this->_init->otxt['anuncios_interesses'] .= '<ul>
                    	<li class="tit6" style="cursor:default;">
                    		<img src="img/img-'.$ret['interesse_icone'].'.jpg">
                    		'.$ret['interesse_nome'].'
                    	</li>
                        '.$_subs.'
                    </ul>';
	}
	
	$sql->closeCursor();
}

/* Maior e menor preço dos anuncios */

protected function __AnunciosPrecos()
{
	$_wheres = array();
	
	if($this->_init->otxt['estado_id']) $_wheres[] = 'd.estado_id=:estado_id';
	if($this->_init->otxt['cidade_id']) $_wheres[] = 'c.cidade_id=:cidade_id';
	if($this->_init->otxt['bairro_id']) $_wheres[] = 'b.bairro_id=:bairro_id';
	
	$_wheres_txt = ($_wheres)?' and '.implode(' and ',$_wheres):NULL;
	
	$sql = $this->_init->con->prepare('select floor(min(a.anuncio_valor)) as minimo,floor(max(a.anuncio_valor)) as maximo from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id where a.anuncio_status=1'.$_wheres_txt);
	//$sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	
	if($this->_init->otxt['estado_id']) $sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	if($this->_init->otxt['cidade_id']) $sql->bindValue(':cidade_id',$this->_init->otxt['cidade_id'],PDO::PARAM_INT);
	if($this->_init->otxt['bairro_id']) $sql->bindValue(':bairro_id',$this->_init->otxt['bairro_id'],PDO::PARAM_INT);
	
	$sql->execute();
	
	$this->_init->otxt['anuncios_precos'] = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
}

/* Lista anuncios da busca */

protected function __Anuncios()
{
	$this->_init->otxt['anuncios'] = '';
	
	$_wheres = array();
	
	if($this->_init->otxt['estado_id']) $_wheres[] = 'd.estado_id=:estado_id';
	if($this->_init->otxt['cidade_id']) $_wheres[] = 'c.cidade_id=:cidade_id';
	if($this->_init->otxt['bairro_id']) $_wheres[] = 'b.bairro_id=:bairro_id';
	
	$_wheres_txt = ($_wheres)?' and '.implode(' and ',$_wheres):NULL;
	
	$sql = $this->_init->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,c.cidade_nome,d.estado_nome,group_concat(e.anuncio_foto_url separator 0x1D) as fotos,t.cadastro_id,t.cadastro_nome,t.cadastro_url,t.cadastro_fotoPerfil from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id left join tb_anuncio_foto e on a.anuncio_id=e.anuncio_id inner join tb_cadastro t on t.cadastro_id=a.cadastro_id where a.anuncio_status=1'.$_wheres_txt.' group by a.anuncio_id order by a.anuncio_id desc limit :limit');
	$sql->bindValue(':limit',(int)self::limit_busca_anuncios,PDO::PARAM_INT);
	//$sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	
	// and a.anuncio_valor >= :preco_min and a.anuncio_valor <= :preco_max
	//$sql->bindValue(':preco_min',strval($this->_init->otxt['anuncios_precos']['minimo']),PDO::PARAM_STR);
	//$sql->bindValue(':preco_max',strval($this->_init->otxt['anuncios_precos']['maximo']),PDO::PARAM_STR);
	
	if($this->_init->otxt['estado_id']) $sql->bindValue(':estado_id',$this->_init->otxt['estado_id'],PDO::PARAM_INT);
	if($this->_init->otxt['cidade_id']) $sql->bindValue(':cidade_id',$this->_init->otxt['cidade_id'],PDO::PARAM_INT);
	if($this->_init->otxt['bairro_id']) $sql->bindValue(':bairro_id',$this->_init->otxt['bairro_id'],PDO::PARAM_INT);
	
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
			$_valorfix = 'Valor: R$<span> '.$this->FMoney($ret['anuncio_valor']).'</span>'.$this->_init->__ValorTipoFx($ret['anuncio_valorTipo']);
		}
		else
		{
			$_valorfix = 'Sob consulta';
		}
	
		$this->_init->otxt['anuncios'] .= '<div class="grid_12 responsive last item-list _perfil-anuncio" data-aid="'.$ret['anuncio_id'].'"'.$_dfotos.'>
            	
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
                            <small>(Ref: '.$ret['anuncio_id'].')</small>
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
					<input type="text" placeholder="Nome" class="perfil-contato-nome" value="'.$this->_init->otxt['_perfil_nome'].'">
					</span>
                 </div>
                 
                 <div class="grid_12 last adapt">
                 <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" placeholder="E-mail" class="perfil-contato-email" value="'.$this->_init->otxt['_perfil_email'].'">
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
}

/* Lista anuncios os ultimos anuncios */

protected function __UltimosAnuncios()
{
	$this->_init->otxt['ultimos_anuncios'] = '';
	
	$sql = $this->_init->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,c.cidade_nome,d.estado_nome,group_concat(e.anuncio_foto_url separator 0x1D) as fotos,t.cadastro_id,t.cadastro_nome,t.cadastro_url,t.cadastro_fotoPerfil from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id left join tb_anuncio_foto e on a.anuncio_id=e.anuncio_id inner join tb_cadastro t on t.cadastro_id=a.cadastro_id where a.anuncio_status=1 group by a.anuncio_id order by a.anuncio_id desc limit :limit');
	$sql->bindValue(':limit',(int)self::limit_ultimos_anuncios,PDO::PARAM_INT);
	
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
	
		$this->_init->otxt['ultimos_anuncios'] .= '<div class="grid_12 responsive last item-list _perfil-anuncio" data-aid="'.$ret['anuncio_id'].'"'.$_dfotos.'>
            	
                <div class="grid_12 last adapt">
                	<div class="grid_4 txtcenter marg21 relative">
                <a href="" class="_perfil-anuncio-foto-esq dnone"><img class="seta-esq responsive" src="img/seta-esq.png"></a>
                <img class="img-anunciante responsive _perfil-anuncio-foto" src="fotos/'.$_img.'">
                <a href="" class="_perfil-anuncio-foto-dir '.$_sdir.'"><img class="seta-dir responsive" src="img/seta-dir.png"></a>
				<img class="load-foto responsive dnone _perfil-anuncio-foto-loading" src="img/load-foto.gif">
				<div class="overpass2 dnone _perfil-anuncio-foto-over"></div>
                </div>
                	<div class="grid_8 responsive marg20 last txtleft">
                    	<div class="grid_12 responsive last">
                        	<div class="grid_8" style="margin-bottom:3px;">
                            <p class="tit5">'.$ret['anuncio_titulo'].'</p>
                            <small>(Ref: '.$ret['anuncio_id'].')</small>
							<p class="end-perfis ico-end"> '.$ret['anuncio_endereco_rua'].', '.$ret['anuncio_endereco_numero'].', '.$ret['bairro_nome'].'<br>&nbsp;&nbsp;&nbsp;&nbsp;'.$ret['cidade_nome'].' - '.$ret['estado_nome'].'</p>
                            <p class="infos-item">'.$ret['anuncio_descricao'].'</p>
							<p class="valor-item">Valor: R$<span> '.$this->FMoney($ret['anuncio_valor']).'</span>'.$this->_init->__ValorTipoFx($ret['anuncio_valorTipo']).'</p>
							
							<div class="marg8 dnone tblock">
                            	<img class="responsive dinline-block vmiddle" src="fotos/'.$ret['cadastro_fotoPerfil'].'" style="max-width:98px;">
                            	<div class="dinline-block vmiddle marg-l7">
                                 <p class="anunciante"> '.$ret['cadastro_nome'].'</p>
                                 <a href="'.$ret['cadastro_url'].'/" class="btn-item2">Perfil anunciante</a>
                            	</div>
                            </div>
							
                            <a href="" class="btn-item _perfil-anuncio-contato">Ver telefone</a> <a href="" class="btn-item _perfil-anuncio-msg">Fazer proposta</a>
                            </div>
							<div class="grid_4 marg8 txtcenter last tnone">
                            	<img class="responsive" src="fotos/'.$ret['cadastro_fotoPerfil'].'" style="max-width:98px;">
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
					<input type="text" placeholder="Nome" class="perfil-contato-nome" value="'.$this->_init->otxt['_perfil_nome'].'">
					</span>
                 </div>
                 
                 <div class="grid_12 last adapt">
                 <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" placeholder="E-mail" class="perfil-contato-email" value="'.$this->_init->otxt['_perfil_email'].'">
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
}

}
?>
