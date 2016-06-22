<?php
class Perfil_Anuncios_PG extends Utils {
private $_out = array('s'=>'ok','i'=>array());

function __construct() {}

public function __run()
{
	$this->AbrirCon();
		
	if(!$this->__Anuncios()) $this->_out['s'] = 'nr';
		
	$this->FecharCon();
	
	return json_encode($this->_out);
}

/* Lista anuncios do anunciante */

private function __Anuncios()
{
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
	
	$sql = $this->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,c.cidade_nome,d.estado_nome,group_concat(e.anuncio_foto_url separator 0x1D) as fotos from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade c inner join tb_estado d on d.estado_id=c.estado_id) on c.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id left join tb_anuncio_foto e on a.anuncio_id=e.anuncio_id where a.cadastro_id=:cid group by a.anuncio_id order by '.$_ordenar.' limit :limit offset :offset');
	$sql->bindValue(':cid',$_POST['cid'],PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::limit_perfil_anuncios,PDO::PARAM_INT);
	$sql->bindValue(':offset',(int)$_POST['offset'],PDO::PARAM_INT);
	
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
			$_valorfix = 'Valor: R$<span> '.$this->FMoney($ret['anuncio_valor']).'</span>'.$this->__ValorTipoFx($ret['anuncio_valorTipo']);
		}
		else
		{
			$_valorfix = 'Sob consulta';
		}
	
		$this->_out['i'][] = '<div class="grid_12 responsive last item-list _perfil-anuncio" data-aid="'.$ret['anuncio_id'].'"'.$_dfotos.'>
            	
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
	
	$this->FecharCon();
	
	if(!$this->_out['i'])
	{
		unset($this->_out['i']);
		return ;
	}
	
	return true;
}

}
?>