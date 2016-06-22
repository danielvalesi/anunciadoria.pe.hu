<?php
class Lista_De_Anuncios_PG extends Utils {
private $_out = array('s'=>'ok','i'=>array());

function __construct() {}

public function __run()
{
	if(!isset($_SESSION['user']))
	{
		$_SESSION['_bk'] = 'minha-conta/lista-de-anuncios';
		$this->_out['s'] = 'err';
	}
	else
	{
		$this->AbrirCon();
		
		if(!$this->__Anuncios()) $this->_out['s'] = 'nr';
		
		$this->FecharCon();
	}
	
	return json_encode($this->_out);
}

/* listagem de anuncios */

private function __Anuncios()
{
	$_ck_q = isset($_POST['q']);
	
	$_where = ($_ck_q)?' and a.anuncio_id like :txt or a.anuncio_titulo like :txt':NULL;

	$sql = $this->con->prepare('select a.anuncio_id,a.anuncio_titulo,a.anuncio_valor,a.anuncio_valorTipo,a.anuncio_descricao,b.anuncio_foto_url from tb_anuncio a left join tb_anuncio_foto b on a.anuncio_id=b.anuncio_id where a.cadastro_id=:cid'.$_where.' group by a.anuncio_id order by a.anuncio_id desc limit :limit offset :offset');
	$sql->bindValue(':cid',$_SESSION['user'],PDO::PARAM_INT);
	$sql->bindValue(':limit',(int)self::limit_mc_anuncios,PDO::PARAM_INT);
	$sql->bindValue(':offset',(int)$_POST['offset'],PDO::PARAM_INT);
	
	if($_ck_q) $sql->bindValue(':txt','%'.$_POST['q'].'%',PDO::PARAM_STR);
	
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
	
		$this->_out['i'][] = '<div class="grid_12 last marg8 _anuncio-item" data-aid="'.$ret['anuncio_id'].'">
                 <div class="hr-divisa2 marg9"> </div>
                 	<div class="grid_2">
                    <img class="responsive f-a" src="'.$ret['anuncio_foto_url'].'">
                    </div>
                    <div class="grid_6">
                    <p class="tit9">'.$ret['anuncio_titulo'].' <small style="font-weight:normal;">(Ref: '.$ret['anuncio_id'].')</small></p>
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