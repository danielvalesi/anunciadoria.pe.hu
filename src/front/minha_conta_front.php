<?php
class Minha_Conta_Front extends Init {
public $_ck_q;

function __construct($_init) { $this->_init = $_init; }


/* Sub paginas do painel do usuario */

protected function __Paginas()
{
	switch($this->_init->sub01)
	{
		case 'cadastrar-anuncio':
			
			if($this->_init->user['cadastro_tipo'] == 2) $this->_init->__rError('minha-conta/');
		
			$this->_init->AddJS('mask.js');
			$this->_init->AddJS('up.js');
			$this->_init->AddJS('cropper.min.js');
			$this->_init->AddJS('jquery.maskMoney.js');
			$this->_init->AddJS('_uploadfoto.js');
			$this->_init->AddJS('sugerir_segmento.js','sugerir_segmento.init();');
			$this->_init->AddJS('minha-conta/cadastrar_anuncio.js','cadastrar_anuncio.init();');
			
			$this->__Interesses(true);
		
			$this->_init->html_tpl['c'] = 'minha-conta/cadastrar-anuncio';
			
			$this->_init->__addRequire('html_tpl/popup-crop.php');
		
		break;
		case 'editar-anuncio':
		
			if($this->_init->user['cadastro_tipo'] == 2) $this->_init->__rError('minha-conta/');
		
			$this->__EditarAnuncio();
		
			$this->_init->AddJS('mask.js');
			$this->_init->AddJS('up.js');
			$this->_init->AddJS('cropper.min.js');
			$this->_init->AddJS('jquery.maskMoney.js');
			$this->_init->AddJS('_uploadfoto.js');
			$this->_init->AddJS('sugerir_segmento.js','sugerir_segmento.init();');
			$this->_init->AddJS('minha-conta/cadastrar_anuncio.js','cadastrar_anuncio.aid = '.$this->_init->sub02.'; cadastrar_anuncio.init();');
			
			$this->__Interesses(true);
		
			$this->_init->html_tpl['c'] = 'minha-conta/editar-anuncio';
			
			$this->_init->__addRequire('html_tpl/popup-crop.php');
		
		break;
		case 'lista-de-anuncios':
		
			if($this->_init->user['cadastro_tipo'] == 2) $this->_init->__rError('minha-conta/');
		
			$this->_ck_q = isset($_GET['q']);
			
			$_q = ($this->_ck_q)?'lista_de_anuncios._json.q = "'.$_GET['q'].'"; ':NULL;
			
			$this->_init->AddJS('minha-conta/lista_de_anuncios.js',$_q.'lista_de_anuncios.limit = '.self::limit_mc_anuncios.'; lista_de_anuncios.init();');
		
			$this->__TotalAnuncios();
			$this->__Anuncios();
			
			$this->_init->html_tpl['c'] = 'minha-conta/lista-de-anuncios';
		
		break;
		case 'mensagens':
		
			$this->_ck_q = isset($_GET['q']);
			
			$_q = ($this->_ck_q)?'mensagens._json.q = "'.$_GET['q'].'"; ':NULL;
		
			$this->_init->AddJS('minha-conta/mensagens.js',$_q.'mensagens.limit = '.self::limit_mc_msgs.'; mensagens.init();');
			
			$this->__TotalMensagens();
			$this->__Mensagens();
		
			$this->_init->html_tpl['c'] = 'minha-conta/mensagens';
		
		break;
		case 'excluir-conta':
		
			$this->_init->AddJS('minha-conta/excluir_conta.js','excluir_conta.init();');
		
			$this->_init->html_tpl['c'] = 'minha-conta/excluir-conta';
		
		break;
		default:
		
			$this->_init->AddJS('mask.js');
			$this->_init->AddJS('up.js');
			$this->_init->AddJS('cropper.min.js');
			$this->_init->AddJS('_uploadfoto.js');
			$this->_init->AddJS('sugerir_segmento.js','sugerir_segmento.init();');
			$this->_init->AddJS('url.js');
			$this->_init->AddJS('minha-conta/meus_dados.js','meus_dados.init();');
		
			$this->__Interesses();
		
			$this->_init->html_tpl['c'] = 'minha-conta/meus-dados';
			
			$this->_init->__addRequire('html_tpl/popup-crop.php');
		
		break;
	}
}

/* Total de mensagens */

private function __TotalMensagens()
{
	$_where = ($this->_ck_q)?' and b.anuncio_id like :txt or b.anuncio_titulo like :txt':NULL;

	$sql = $this->_init->con->prepare('select count(a.cadastro_contato_id) from tb_cadastro_contato a inner join tb_cadastro c on c.cadastro_id=a.cid left join tb_anuncio b on b.anuncio_id=a.anuncio_id where c.cadastro_id=:cid'.$_where);
	$sql->bindValue(':cid',$this->_init->user['cadastro_id'],PDO::PARAM_INT);
	
	if($this->_ck_q) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	$this->_init->otxt['total_mensagens'] = $sql->fetchColumn();
	
	$sql->closeCursor();
}

/* Lista as mensagens */

private function __Mensagens()
{
	$this->_init->otxt['mensagens'] = '';
	
	$_where = ($this->_ck_q)?' and b.anuncio_id like :txt or b.anuncio_titulo like :txt':NULL;
	
	$sql = $this->_init->con->prepare('select a.cadastro_contato_id,a.cadastro_contato_nome,a.cadastro_contato_email,a.cadastro_contato_telefone,a.cadastro_contato_msg,b.anuncio_id,b.anuncio_titulo,c.cadastro_id,c.cadastro_url from tb_cadastro_contato a inner join tb_cadastro d on d.cadastro_id=a.cid left join tb_anuncio b on b.anuncio_id=a.anuncio_id left join tb_cadastro c on c.cadastro_id=a.cadastro_id where d.cadastro_id=:cid'.$_where.' order by a.cadastro_contato_id desc limit :limit');
	$sql->bindValue(':cid',$this->_init->user['cadastro_id'],PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::limit_mc_msgs,PDO::PARAM_INT);
	
	if($this->_ck_q) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		if($ret['cadastro_id'])
		{
			if($ret['cadastro_url'])
			{ $_url = '<a href="'.$ret['cadastro_url'].'/" title="Visitar perfil">'.$ret['cadastro_contato_nome'].'</a>'; }
			else
			{ $_url = '<a href="'.$ret['cadastro_id'].'/" title="Visitar perfil">'.$ret['cadastro_contato_nome'].'</a>'; }
		}
		else
		{
			$_url = $ret['cadastro_contato_nome'];
		}
		
		if($ret['anuncio_id']) $ret['anuncio_titulo'] .= ' (ref: '.$ret['anuncio_id'].')';
	
		$this->_init->otxt['mensagens'] .= '<div class="grid_12 last marg8 _msg-item" data-mid="'.$ret['cadastro_contato_id'].'">
                 <div class="hr-divisa2 marg9"> </div>
                 	<div class="grid_10">
                    <p class="marg13 tit9">'.$ret['anuncio_titulo'].'</p>
                    <p>'.$_url.'<span class="_span-fx01"> | </span><span class="_span-fx02">'.$ret['cadastro_contato_email'].'</span><span class="_span-fx01"> | </span><span class="_span-fx02">'.$ret['cadastro_contato_telefone'].'</span></p>
                    <p class="descr-anuncio">'.$ret['cadastro_contato_msg'].'</p>
                    </div>
                    <div class="grid_2 txtcenter last"><a href="" class="_msg-deletar"><img class="responsive" src="img/icone-excluir.png"></a></div>
                    <div class="grid_12 last txtcenter texto-p exc-anun marg15 dnone _msg-confirmacao"><span class="_span-fx03">Confirma exclus&atilde;o da mensagem? </span><a href="" data-act="1">Sim</a> <a href="" data-act="0">N&atilde;o</a></div>
                    <div class="grid_12 last txtcenter texto-p exc-anun2 marg15 dnone _msg-confirmacao-loading">Excluindo mensagem ...</div>
                 </div>';
	}
	
	$sql->closeCursor();
}

/* Dados para edição do anuncio */

private function __EditarAnuncio()
{
	$sql = $this->_init->con->prepare('select a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_telefone,a.anuncio_descricao,a.anuncio_endereco_cep,a.anuncio_endereco_rua,a.anuncio_endereco_numero,a.anuncio_endereco_complemento,a.anuncio_endereco_bairro,b.bairro_nome,b1.cidade_nome,b2.estado_nome,group_concat(c.anuncio_foto_url separator 0x1D) as fotos from tb_anuncio a inner join(tb_bairro b inner join(tb_cidade b1 inner join tb_estado b2 on b2.estado_id=b1.estado_id) on b1.cidade_id=b.cidade_id) on b.bairro_id=a.bairro_id left join tb_anuncio_foto c on a.anuncio_id=c.anuncio_id where a.anuncio_id=:aid and a.cadastro_id=:cid group by a.anuncio_id');
	$sql->bindValue(':cid',$this->_init->user['cadastro_id'],PDO::PARAM_INT);
	$sql->bindValue(':aid',$this->_init->sub02,PDO::PARAM_INT);
	$sql->execute();
	
	$this->_init->otxt['anuncio_infos'] = $sql->fetch(PDO::FETCH_ASSOC);
	
	$sql->closeCursor();
	
	if(!$this->_init->otxt['anuncio_infos']) $this->_init->__rError('minha-conta/lista-de-anuncios/');
	
	$this->_init->otxt['anuncio_infos']['fotos'] = explode(chr(0x1D),$this->_init->otxt['anuncio_infos']['fotos']);
}

/* Total de anuncios */

private function __TotalAnuncios()
{
	$_where = ($this->_ck_q)?' and anuncio_id like :txt or anuncio_titulo like :txt':NULL;

	$sql = $this->_init->con->prepare('select count(anuncio_id) from tb_anuncio where cadastro_id=:cid'.$_where);
	$sql->bindValue(':cid',$this->_init->user['cadastro_id'],PDO::PARAM_INT);
	
	if($this->_ck_q) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	$this->_init->otxt['total_anuncios'] = $sql->fetchColumn();
	
	$sql->closeCursor();
}

/* Lista os anuncios */

private function __Anuncios($a=false)
{
	$this->_init->otxt['anuncios'] = '';
	
	$_where = ($this->_ck_q)?' and a.anuncio_id like :txt or a.anuncio_titulo like :txt':NULL;
	
	$sql = $this->_init->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,a.anuncio_status,b.anuncio_foto_url from tb_anuncio a left join tb_anuncio_foto b on a.anuncio_id=b.anuncio_id where a.cadastro_id=:cid'.$_where.' group by a.anuncio_id order by a.anuncio_id desc limit :limit');
	$sql->bindValue(':cid',$this->_init->user['cadastro_id'],PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::limit_mc_anuncios,PDO::PARAM_INT);
	
	if($this->_ck_q) $sql->bindValue(':txt','%'.$_GET['q'].'%',PDO::PARAM_STR);
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$ret['anuncio_foto_url'] = ($ret['anuncio_foto_url'])?'fotos/anuncios/'.$ret['anuncio_foto_url'].'':'fotos/sem-foto-anuncio.jpg';
		
		if($ret['anuncio_valor'])
		{
			$_valorfix = 'Valor R$ '.$this->FMoney($ret['anuncio_valor']).$this->_init->__ValorTipoFx($ret['anuncio_valorTipo']);
		}
		else
		{
			$_valorfix = 'Sob consulta';
		}
		
		
		$status = $ret['anuncio_status'];
		
		switch ($status) {
    case 0:
        $_status = 'Pendente para aprovação';
        break;
    case 1:
        $_status = 'Ativo';
        break;
    case 2:
        $_status = 'Inativo';
        break;
		}	
	
		$this->_init->otxt['anuncios'] .= '<div class="grid_12 last marg8 _anuncio-item" data-aid="'.$ret['anuncio_id'].'">
                 <div class="hr-divisa2 marg9"> </div>
                 	<div class="grid_2">
                    <img class="responsive f-a" src="'.$ret['anuncio_foto_url'].'">
                    </div>
                    <div class="grid_6">
                    <p class="tit9">'.$ret['anuncio_titulo'].' <small style="font-weight:normal;">(Ref: '.$ret['anuncio_id'].')</small> <small class="label status'.$ret['anuncio_status'].'"> '.$_status.' </small> </p>
                    <p class="descr-anuncio">'.$ret['anuncio_descricao'].'</p>
                    <p class="v-anuncio">'.$_valorfix.'</p>
                    
                    
                    </div>
                    <div class="grid_2 txtcenter"><a href="minha-conta/editar-anuncio/'.$ret['anuncio_id'].'/"><img class="responsive" src="img/icone-editar.png"></a></div>
                    <div class="grid_2 txtcenter last"><a href="" class="_anuncio-deletar"><img class="responsive aviso-delete" src="img/icone-excluir.png"></a></div>
                    <div class="grid_12 last txtcenter texto-p exc-anun marg15 dnone _anuncio-confirmacao"><span class="_span-fx03">Confirma exclus&atilde;o do an&uacute;ncio? </span><a href="" data-act="1">Sim</a> <a href="" data-act="0">N&atilde;o</a></div>
                    <div class="grid_12 last txtcenter texto-p exc-anun2 marg15 dnone _anuncio-confirmacao-loading">Excluindo an&uacute;ncio ...</div>
                 </div>';
	}
	
	$sql->closeCursor();
}

/* Lista os interesses */

protected function __Interesses($a=false)
{
	$this->_init->otxt['interesses_01'] = $this->_init->otxt['interesses_02'] = '';
	
	$_n = 0;
	
	if($a)
	{
		$_aid = ($this->_init->sub02)?$this->_init->sub02:0;	
		
		$sql = $this->_init->con->prepare('select a.interesse_id,a.interesse_nome,a.interesse_icone,group_concat(b.interesse_item_id order by b.interesse_item_nome asc separator 0x1D) as ids,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator 0x1D) as nomes,group_concat(if(c.anuncio_id is not null,1,0) order by b.interesse_item_nome asc separator 0x1D) as checkeds from tb_interesse a inner join(tb_interesse_item b left join tb_anuncio_interesse c on b.interesse_item_id=c.interesse_item_id and c.anuncio_id=:aid) on a.interesse_id=b.interesse_id group by a.interesse_id order by a.interesse_nome asc');
		$sql->bindValue(':aid',$_aid,PDO::PARAM_INT);
	}
	else
	{
		$sql = $this->_init->con->prepare('select a.interesse_id,a.interesse_nome,a.interesse_icone,group_concat(b.interesse_item_id order by b.interesse_item_nome asc separator 0x1D) as ids,group_concat(b.interesse_item_nome order by b.interesse_item_nome asc separator 0x1D) as nomes,group_concat(if(c.cadastro_id is not null,1,0) order by b.interesse_item_nome asc separator 0x1D) as checkeds from tb_interesse a inner join(tb_interesse_item b left join tb_cadastro_interesse c on b.interesse_item_id=c.interesse_item_id and c.cadastro_id=:cid) on a.interesse_id=b.interesse_id group by a.interesse_id order by a.interesse_nome asc');
		$sql->bindValue(':cid',$this->_init->user['cadastro_id'],PDO::PARAM_INT);
	}
	
	$sql->execute();
	
	while($ret = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$ret['ids'] = explode(chr(0x1D),$ret['ids']);
		$ret['nomes'] = explode(chr(0x1D),$ret['nomes']);
		$ret['checkeds'] = explode(chr(0x1D),$ret['checkeds']);
		$_ix = ($_n < 3)?1:2;
		
		++$_n;
		
		$_subs = '';
		foreach($ret['ids'] as $a=>$b)
		{
			$_checked = ($ret['checkeds'][$a] == 1)?' checked="checked"':NULL;
			$_subs .= '<li><input name="interesses-item" class="fleft _interesses-item" type="checkbox" value="'.$b.'" id="interesse-item-'.$b.'"'.$_checked.'> <label for="interesse-item-'.$b.'"><span>'.$ret['nomes'][$a].'</span> </label></li>';
		}
		
		$this->_init->otxt['interesses_0'.$_ix] .= '<div class="grid_4">
            	<img src="img/img-'.$ret['interesse_icone'].'.jpg">
				<p class="tit4">'.$ret['interesse_nome'].'</p>
                <ul class="listas2">
                	<li><input name="interesses-item" class="fleft _interesses-todos" type="checkbox" id="interesse-'.$ret['interesse_id'].'"> <label for="interesse-'.$ret['interesse_id'].'"> <span>Todos</span> </label></li>
                    '.$_subs.'
                </ul>
          	</div>';
	}
	
	$sql->closeCursor();
}

}
?>
