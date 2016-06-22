<?php
class Perfil_Front extends Init {
function __construct($_init) { $this->_init = $_init; }

/* Verifica se é um perfil */

protected function __Verificar()
{
	$sql = $this->_init->con->prepare('select cadastro_id,cadastro_nome,cadastro_sobre,cadastro_telefone,cadastro_tipo,cadastro_cpf,cadastro_razaoSocial,cadastro_cnpj,cadastro_endereco_cep,cadastro_endereco_rua,cadastro_endereco_rua,cadastro_endereco_bairro,cadastro_endereco_numero,cadastro_endereco_complemento,cadastro_endereco_cidade,cadastro_endereco_estado,cadastro_fotoPerfil from tb_cadastro where cadastro_id=:cid or cadastro_url=:url');
	
	$sql->bindValue(':url',$this->_init->pn,PDO::PARAM_STR);
	$sql->bindValue(':cid',(int)$this->_init->pn,PDO::PARAM_INT);
	
	$sql->execute();
	
	$this->_init->otxt['perfil'] = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->_init->otxt['perfil']) return ;
	
	if($this->_init->otxt['perfil']['cadastro_endereco_complemento'])
	{
		$this->_init->otxt['perfil']['cadastro_endereco_numero'] .= ' '.$this->_init->otxt['perfil']['cadastro_endereco_complemento'];
	}
	
	$this->_init->otxt['perfil']['endereco'] = $this->_init->otxt['perfil']['cadastro_endereco_rua'].', '.$this->_init->otxt['perfil']['cadastro_endereco_numero'].', '.$this->_init->otxt['perfil']['cadastro_endereco_bairro'].' CEP: '.$this->_init->otxt['perfil']['cadastro_endereco_cep'].' | '.$this->_init->otxt['perfil']['cadastro_endereco_cidade'].' - '.$this->_init->otxt['perfil']['cadastro_endereco_estado'];
	
	if($this->_init->otxt['perfil']['cadastro_fotoPerfil'])
	{
		$this->_init->otxt['perfil']['cadastro_fotoPerfil'] = 'fotos/usuarios/'.$this->_init->otxt['perfil']['cadastro_fotoPerfil'];
	}
	else
	{
		$this->_init->otxt['perfil']['cadastro_fotoPerfil'] = 'fotos/sem-foto-perfil.jpg';
	}
	
	$this->_init->og = array('title'=>$this->_init->otxt['perfil']['cadastro_nome'],'description'=>$this->_init->otxt['perfil']['cadastro_sobre'],'image'=>$this->_init->otxt['perfil']['cadastro_fotoPerfil'],'url'=>$this->_init->pn);
	
	return true;
}

/* Lista anuncios do anunciante */

protected function __Anuncios()
{
	$this->_init->otxt['perfil_anuncios'] = '';
	
	$sql = $this->_init->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,c.cidade_nome,d.estado_nome,group_concat(e.anuncio_foto_url separator 0x1D) as fotos from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id left join tb_anuncio_foto e on a.anuncio_id=e.anuncio_id where a.cadastro_id=:cid and a.anuncio_status=1 group by a.anuncio_id order by a.anuncio_id desc limit :limit');
	$sql->bindValue(':cid',$this->_init->otxt['perfil']['cadastro_id'],PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::limit_perfil_anuncios,PDO::PARAM_INT);
	
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
		
		if($ret['anuncio_valor'])
		{
			$_valorfix = 'Valor: R$<span> '.$this->FMoney($ret['anuncio_valor']).'</span>'.$this->_init->__ValorTipoFx($ret['anuncio_valorTipo']);
		}
		else
		{
			$_valorfix = 'Sob consulta';
		}
	
		$this->_init->otxt['perfil_anuncios'] .= '<div class="grid_12 responsive last item-list _perfil-anuncio" data-aid="'.$ret['anuncio_id'].'"'.$_dfotos.'>
            	
                <div class="grid_12 last adapt">
                	<div class="grid_4 txtcenter marg21 relative">
                <a href="" class="_perfil-anuncio-foto-esq dnone"><img class="seta-esq responsive" src="img/seta-esq.png"></a>
                <img class="img-anunciante responsive _perfil-anuncio-foto" src="fotos/'.$_img.'">
                <a href="" class="_perfil-anuncio-foto-dir '.$_sdir.'"><img class="seta-dir responsive" src="img/seta-dir.png"></a>
				<img class="load-foto responsive dnone _perfil-anuncio-foto-loading" src="img/load-foto.gif">
				<div class="overpass2 dnone _perfil-anuncio-foto-over"></div>
                </div>
                	<div class="grid_8 responsive marg20 last txtleft">
                    	<div class="grid_12 adapt last">
                        	<div class="grid_12">
                            <p class="tit5">'.$ret['anuncio_titulo'].'</p>
							<p class="end-perfis ico-end"> '.$ret['anuncio_endereco_rua'].', '.$ret['anuncio_endereco_numero'].', '.$ret['bairro_nome'].'<br>&nbsp;&nbsp;&nbsp;&nbsp;'.$ret['cidade_nome'].' - '.$ret['estado_nome'].'</p>
                            <p class="infos-item">'.$ret['anuncio_descricao'].'</p>
							<p class="valor-item">'.$_valorfix.'</p>
                            <a href="" class="btn-item _perfil-anuncio-contato">Ver telefone</a> <a href="" class="btn-item _perfil-anuncio-msg">Fazer proposta</a>
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

/* Total de anuncios */

protected function __TotalAnuncios()
{
	$sql = $this->_init->con->prepare('select count(anuncio_id) from tb_anuncio where cadastro_id=:cid and anuncio_status=1');
	$sql->bindValue(':cid',$this->_init->otxt['perfil']['cadastro_id'],PDO::PARAM_INT);
	
	$sql->execute();
	
	$this->_init->otxt['perfil_total_anuncios'] = $sql->fetchColumn();
	
	$sql->closeCursor();
}

/* Lista contratante categorias */

protected function __ContratanteCategorias()
{
	$this->_init->otxt['perfil_categorias'] = '';
	
	$sql = $this->_init->con->prepare('select c.interesse_nome,c.interesse_icone,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator 0x1D) as subs from tb_cadastro_interesse a inner join(tb_interesse_item b inner join tb_interesse c on c.interesse_id=b.interesse_id) on b.interesse_item_id=a.interesse_item_id where a.cadastro_id=:cid group by c.interesse_id order by c.interesse_nome asc');
	$sql->bindValue(':cid',$this->_init->otxt['perfil']['cadastro_id'],PDO::PARAM_INT);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$_subs = '';
		$ret['subs'] = explode(chr(0x1D),$ret['subs']);
		
		foreach($ret['subs'] as $v) $_subs .= '<li><span>'.$v.'</span></li>';
	
		$this->_init->otxt['perfil_categorias'] .= '<div class="grid_2 dinline-block vtop _div-fx01" style="float:none; margin-bottom:10px;">
            	<img src="img/img-'.$ret['interesse_icone'].'.jpg">
				<p class="tit4">'.$ret['interesse_nome'].'</p>
                <ul class="listas2">
                	'.$_subs.'
                </ul>
          </div>';
	}
	
	$sql->closeCursor();
}

/* Lista anunciante categorias */

protected function __AnuncianteCategorias()
{
	$this->_init->otxt['perfil_categorias'] = '';
	
	$sql = $this->_init->con->prepare('select c.interesse_nome,c.interesse_icone from tb_anuncio_interesse a inner join(tb_interesse_item b inner join tb_interesse c on c.interesse_id=b.interesse_id) on b.interesse_item_id=a.interesse_item_id inner join tb_anuncio e on e.anuncio_id=a.anuncio_id where e.cadastro_id=:cid group by c.interesse_id order by c.interesse_nome asc');
	$sql->bindValue(':cid',$this->_init->otxt['perfil']['cadastro_id'],PDO::PARAM_INT);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$this->_init->otxt['perfil_categorias'] .= '<li>
                            	<p><img src="img/img-'.$ret['interesse_icone'].'.jpg"></p>
                                <p class="tit-categ-mini">'.$ret['interesse_nome'].'</p>
                            </li>';
	}
	
	$sql->closeCursor();
}

}
?>