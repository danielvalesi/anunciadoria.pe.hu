<!-- Middle -->
<section class="pd">
	<div class="container_grid max1200 responsive row">
		<div class="grid_12 last marg">
			<h2><span>Minha</span> conta</h2>
        </div>
        <div class="grid_12 last marg8 responsive">
       	  <div class="hr-divisa"> </div>
          
          <div class="grid_12 last marg adapt">
          	
          	<?php require 'html_tpl/minha-conta/menu.php'; ?>
            	
            <div class="grid_10 last" id="cadastro-box">
			       
         <div class="grid_12 last marg7 adapt">
                 
       	  <div class="responsive">
          	<div class="form-contato grid_12 last adapt">
                <div class="grid_12 last">
                <div class="grid_12 last">
					<p class="tit8 marg19">Dados do anúncio</p>
				 	</div>
                	
                <div class="grid_12 last responsive">
                <div class="grid_12">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-titulo" placeholder="Título do anúncio" value="<?php echo $c->otxt['anuncio_infos']['anuncio_titulo']; ?>" maxlength="120">
					</span>
                </div>
               <div class="grid_12 last responsive">
                <div class="grid_4">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-telefone" placeholder="Telefone" value="<?php echo $c->otxt['anuncio_infos']['anuncio_telefone']; ?>">
					</span>
                </div>
				<div class="grid_4">
                	<span class="lineform smallControl">
                  <b class="tooltip">?<span>Se vazio aparacerá "Sob Consulta"</span></b>
					<input type="text" id="cadastro-valor" placeholder="Sob Consulta" maxlength="13"<?php if($c->otxt['anuncio_infos']['anuncio_valor']) { ?> value="<?php echo $c->FMoney($c->otxt['anuncio_infos']['anuncio_valor']); ?>"<?php } ?>>
					</span>
                </div>
                <div class="grid_4 last">
                	<span class="lineform smallControl">
					<div class="selecao">
                    <span>Período</span>
                    <select id="cadastro-valorTipo"<?php if($c->otxt['anuncio_infos']['anuncio_valorTipo']) { ?> data-val="<?php echo $c->otxt['anuncio_infos']['anuncio_valorTipo']; ?>"<?php } ?>>
					  <option class="cor" value="">Período</option>
                      <option class="cor" value="1">Hora</option>
					  <option class="cor" value="2">Dia</option>
					  <option class="cor" value="3">Semana</option>
					  <option class="cor" value="4">Quinzena</option>
                      <option class="cor" value="5">Quarentena</option>
					  <option class="cor" value="6">Mês</option>
                      <option class="cor" value="7">Bimestre</option>
                      <option class="cor" value="8">Trimestre</option>
                      <option class="cor" value="9">Semestre</option>
                      <option class="cor" value="10">Ano</option>
					</select>
                    </div>
					</span>
                 </div>
                 </div>
                 </div>
                 
                <div class="grid_12 last">
                 	<span class="lineform smallControl">
					<textarea id="cadastro-descricao" style="font-size:14px; color:#666;" placeholder="Descrição do anúncio"><?php echo $c->otxt['anuncio_infos']['anuncio_descricao']; ?></textarea>
					</span>
                  </div>               
                
                </div>
               
			   <div class="grid_12 marg8">
					<p class="tit8">Endereço do anúncio</p>
				</div> 
			   
			   	<div class="grid_12 last">
                	<div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-cep" placeholder="CEP" value="<?php echo $c->otxt['anuncio_infos']['anuncio_endereco_cep']; ?>">
					<small class="alert-error" id="cadastro-endereco-cep-erro">CEP Inválido !</small>
					</span>
                	</div>
                    	<div class="grid_6 last">
                		<a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank" class="alignleft n-cep">Não lembro meu CEP</a>
                		</div>
                </div>
                <div class="grid_9">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-rua" placeholder="Rua" value="<?php echo $c->otxt['anuncio_infos']['anuncio_endereco_rua']; ?>" maxlength="255">
					</span>
                </div>
                <div class="grid_3 last">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-numero" placeholder="Nº" value="<?php echo $c->otxt['anuncio_infos']['anuncio_endereco_numero']; ?>" maxlength="10">
					</span>
                </div>
                <div class="grid_5">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-bairro" placeholder="Bairro" readonly="true" value="<?php echo $c->otxt['anuncio_infos']['bairro_nome']; ?>">
					</span>
                </div>
                <div class="grid_7 last">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-complemento" placeholder="Complemento" value="<?php echo $c->otxt['anuncio_infos']['anuncio_endereco_complemento']; ?>"  maxlength="50">
					</span>
                 </div>
                <div class="grid_12 last<?php if(!$c->otxt['anuncio_infos']['anuncio_endereco_bairro']) { ?> dnone<?php } ?>" id="cadastro-endereco-extra">
					<div class="grid_12">
						<p class="tit8" style="margin-bottom: 10px; font-size: 1.3rem;">Sua cidade possui apenas um CEP<br><small>texto texto texto texto texto</small></p>
					</div>
					<div class="grid_12 last">
						<span class="lineform smallControl">
						<input type="text" id="cadastro-endereco-bairro-txt" placeholder="Digite o bairro aqui ..." style="background-color:#F7F7F7;" value="<?php echo $c->otxt['anuncio_infos']['anuncio_endereco_bairro']; ?>" maxlength="100">
						</span>
                	</div>
				</div>
				 <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-estado" placeholder="Estado" readonly="true" value="<?php echo $c->otxt['anuncio_infos']['estado_nome']; ?>">
					</span>
                </div>
                <div class="grid_6 last">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-cidade" placeholder="Cidade" readonly="true" value="<?php echo $c->otxt['anuncio_infos']['cidade_nome']; ?>">
					</span>
                 </div>
                 
                 <div class="clear"></div>
            </div>
			   
            </div>
         </div>
           
           <div class="grid_12 last">
					<p class="tit8">Selecionar as Categorias</p>
				 	</div>
           
           <div class="grid_12 last max1200 marg17">
        	<div class="responsive">

            
            <div class="grid_6 adapt">
            
            <div class="grid_12 last responsive fx-001">
        	<?php echo $c->otxt['interesses_01']; ?>
            </div>
            
            </div>
            <div class="grid_6 last adapt">
            
            <div class="grid_12 last responsive fx-001">
			<?php echo $c->otxt['interesses_02']; ?>
            <?php require 'html_tpl/sugerir_segmento.php'; ?>
            </div>
            
            </div>
            
            </div>
        </div>
		
		<?php
		$_ckf_1 = (isset($c->otxt['anuncio_infos']['fotos'][0]) and $c->otxt['anuncio_infos']['fotos'][0]);
		$_ckf_2 = (isset($c->otxt['anuncio_infos']['fotos'][1]) and $c->otxt['anuncio_infos']['fotos'][1]);
		$_ckf_3 = (isset($c->otxt['anuncio_infos']['fotos'][2]) and $c->otxt['anuncio_infos']['fotos'][2]);
		?>
           
                    <div class="row">
          				<div class="form-contato grid_12 last adapt">
                        	<div class="grid_12 last responsive">
                            <div class="grid_12 last marg8">
					<p class="tit8">Imagens do anúncio</p>
				 	</div>
                            	<div class="grid_4 adapt _upload-box">
								<div style="margin:0 auto; max-width:480px; position:relative;">
                           	    	<img class="list-fotos responsive _upload-view" <?php if($_ckf_1) { ?>src="fotos/anuncios/<?php echo $c->otxt['anuncio_infos']['fotos'][0]; ?>" data-url="<?php echo $c->otxt['anuncio_infos']['fotos'][0]; ?>"<?php } else { ?>src="fotos/sem-foto-anuncio.jpg"<?php } ?>>
                                    <div class="area-file3 marg3 _upload-btn">
                                    <span>Importar foto</span>
                                    <form action="ajax/ajax-upload_foto.php" method="post" enctype="multipart/form-data"><input type="hidden" name="_act" value="2"><input type="file" name="_foto" class="_upload-foto ifile3" size="300" onchange="__upload(this)" onclick="this.value=null;"></form>
                					</div>
                                    <div class="area-file3 marg3 _upload-loading" style="display:none; cursor:default;">
                                    <span>Carregando ...</span>
                					</div>
									<a href="" class="a-icon-foto-del<?php if(!$_ckf_1) { ?> dnone<?php } ?>"></a>
								</div>
                                </div>
                                <div class="grid_4 adapt _upload-box">
								<div style="margin:0 auto; max-width:480px; position:relative;">
                           	    	<img class="list-fotos responsive _upload-view" <?php if($_ckf_2) { ?>src="fotos/anuncios/<?php echo $c->otxt['anuncio_infos']['fotos'][1]; ?>" data-url="<?php echo $c->otxt['anuncio_infos']['fotos'][1]; ?>"<?php } else { ?>src="fotos/sem-foto-anuncio.jpg"<?php } ?>>
                                    <div class="area-file3 marg3 _upload-btn">
                                    <span>Importar foto</span>
                                    <form action="ajax/ajax-upload_foto.php" method="post" enctype="multipart/form-data"><input type="hidden" name="_act" value="2"><input type="file" name="_foto" class="_upload-foto ifile3" size="300" onchange="__upload(this)" onclick="this.value=null;"></form>
                					</div>
                                    <div class="area-file3 marg3 _upload-loading" style="display:none; cursor:default;">
                                    <span>Carregando ...</span>
                					</div>
									<a href="" class="a-icon-foto-del<?php if(!$_ckf_2) { ?> dnone<?php } ?>"></a>
								</div>
                                </div>
								<div class="grid_4 last adapt _upload-box">
								<div style="margin:0 auto; max-width:480px; position:relative;">
                           	    	<img class="list-fotos responsive _upload-view" <?php if($_ckf_3) { ?>src="fotos/anuncios/<?php echo $c->otxt['anuncio_infos']['fotos'][2]; ?>" data-url="<?php echo $c->otxt['anuncio_infos']['fotos'][2]; ?>"<?php } else { ?>src="fotos/sem-foto-anuncio.jpg"<?php } ?>>
                                    <div class="area-file3 marg3 _upload-btn">
                                    <span>Importar foto</span>
                                    <form action="ajax/ajax-upload_foto.php" method="post" enctype="multipart/form-data"><input type="hidden" name="_act" value="2"><input type="file" name="_foto" class="_upload-foto ifile3" size="300" onchange="__upload(this)" onclick="this.value=null;"></form>
                					</div>
                                    <div class="area-file3 marg3 _upload-loading" style="display:none; cursor:default;">
                                    <span>Carregando ...</span>
                					</div>
									<a href="" class="a-icon-foto-del<?php if(!$_ckf_3) { ?> dnone<?php } ?>"></a>
								</div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                      
        
        		 <div class="grid_12 last txtcenter">
                 	<button class="btn-sal-alt cinza marg2" title="Enviar Informações" id="cadastro-enviar">Salvar anúncio</button>
                    <span class="btn-sal-alt cinza-claro marg2 dinline-block vtop dnone" id="cadastro-loading">Salvando ...</span>
                    <span class="btn-sal-alt verde marg2 dinline-block vtop dnone" id="cadastro-ok">Salvo com sucesso !</span>
                 </div>
                
                </div>
                
          </div>
          
        </div>
       
       <div class="grid_12 last txtcenter marg4"></div>
       
       <div class="clear"></div>
       
  </div>
</section>
<!-- End. Middle -->
