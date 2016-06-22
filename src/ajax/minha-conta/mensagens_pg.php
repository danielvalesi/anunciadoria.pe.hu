<?php
class Mensagens_PG extends Utils {
private $_out = array('s'=>'ok','i'=>array());

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/mensagens';
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->AbrirCon();
		
		if(!$this->__Mensagens()) $this->_out['s'] = 'nr';
		
		$this->FecharCon();
	}
	
	return json_encode($this->_out);
}

/* listagem de mensagens */

private function __Mensagens()
{
	$_ck_q = isset($_POST['q']);
	
	$_where = ($_ck_q)?' and b.anuncio_id like :txt or b.anuncio_titulo like :txt':NULL;

	$sql = $this->con->prepare('select a.cadastro_contato_id,a.cadastro_contato_nome,a.cadastro_contato_email,a.cadastro_contato_telefone,a.cadastro_contato_msg,b.anuncio_id,b.anuncio_titulo,c.cadastro_id,c.cadastro_url from tb_cadastro_contato a inner join tb_cadastro d on d.cadastro_id=a.cid left join tb_anuncio b on b.anuncio_id=a.anuncio_id left join tb_cadastro c on c.cadastro_id=a.cadastro_id where d.cadastro_id=:cid'.$_where.' order by a.cadastro_contato_id desc limit :limit offset :offset');
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::limit_mc_msgs,PDO::PARAM_INT);
	$sql->bindValue(':offset',(int)$_POST['offset'],PDO::PARAM_INT);
	
	if($_ck_q) $sql->bindValue(':txt','%'.$_POST['q'].'%',PDO::PARAM_STR);
	
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
	
		$this->_out['i'][] = '<div class="grid_12 last marg8 _msg-item" data-mid="'.$ret['cadastro_contato_id'].'">
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