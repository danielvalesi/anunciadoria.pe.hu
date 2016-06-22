<!-- Middle -->
<section class="pd dnone" id="cadastro-ok">
	<div class="container_grid max1200 responsive">
		<div class="grid_12 last txtcenter marg marg11">
			<img class="txtcenter responsive marg4" src="img/check-maior.png" alt="Anunciadoria">
			<h2><span>Cadastro</span> <span style="color:#093;">Finalizado</span><span> com sucesso!</span></h2>
			<p class="marg3">Enviamos um email para <strong id="cadastro-ok-email"></strong>, siga as instruções.</p>
		</div>		
	</div>
</section>

<section class="pd" id="cadastro-box">
	<div class="container_grid max1200 responsive">
		<div class="grid_12 last txtcenter marg">
			<h2><span>Finalize seu </span>Cadastro<span>, é simples e rápido!</span></h2>
            <p class="marg3">Quanto mais completo for, mais objetiva será a interação.</p>
		</div>
        
    <div class="grid_12 last max1200 responsive">
      <div class="grid_12 last adapt">
        <div class="grid_3 marg txtcenter">
        	<div class="responsive reducao _upload-box">
       	    	<div style="max-width:160px; margin:0 auto;"><img src="<?php echo $c->user['cadastro_fotoPerfil']; ?>" alt="Foto de perfil" title="Foto de perfil" class="foto-perfil-g _upload-view" id="cadastro-foto"<?php echo $c->user['foto_url']; ?>></div>
                <div class="area-file area-file4 marg3 _upload-btn">
                <span>Importar foto</span>
				<form action="ajax/ajax-upload_foto.php" method="post" enctype="multipart/form-data"><input type="hidden" name="_act" value="1"><input type="file" name="_foto" class="_upload-foto ifile" size="300" onchange="__upload(this)" onclick="this.value=null;"></form>
                </div>
                <div class="area-file marg3 _upload-loading" style="cursor:default; display:none;">
                <span>Carregando ...</span>
                </div>
            </div>            
            <div class="clear"></div>
        </div> 
               
        <div class="grid_9 last marg adapt">
       	  <div class="row responsive">
            <div class="form-contato grid_12 last responsive">
                <div class="grid_12 last">
                	<div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-cep" placeholder="CEP" value="<?php echo $c->user['cadastro_endereco_cep']; ?>">
					<small class="alert-error" id="cadastro-endereco-cep-erro">CEP Inválido !</small>
					</span>
                	</div>
                   	<div class="grid_6 last">
                	<a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank" class="alignleft n-cep">Não lembro meu CEP</a>
                	</div>
                </div>
                <div class="grid_9">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-rua" placeholder="Rua" value="<?php echo $c->user['cadastro_endereco_rua']; ?>" maxlength="255">
					</span>
                </div>
                <div class="grid_3 last">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-numero" placeholder="Nº" value="<?php echo $c->user['cadastro_endereco_numero']; ?>" maxlength="10">
					</span>
                </div>
                <div class="grid_5">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-bairro" placeholder="Bairro" value="<?php echo $c->user['cadastro_endereco_bairro']; ?>" maxlength="100">
					</span>
                </div>
                <div class="grid_7 last">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-complemento" placeholder="Complemento" value="<?php echo $c->user['cadastro_endereco_complemento']; ?>" maxlength="50">
					</span>
                 </div>
                 <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-estado" placeholder="Estado" readonly="true" value="<?php echo $c->user['cadastro_endereco_estado']; ?>">
					</span>
                </div>
                <div class="grid_6 last">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-cidade" placeholder="Cidade" readonly="true" value="<?php echo $c->user['cadastro_endereco_cidade']; ?>">
					</span>
                 </div>
                 
                
            </div>
                <div class="clear"></div>
            </div>
        </div>
      </div>   
        </div>
        
        <div class="grid_12 last txtcenter ">
			<h3>Selecione os seguimentos de interesse</h3>
		</div>
        
        
        <div class="grid_12 last max1200 marg marg17">
        	<div class="row responsive">
            
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
        
       <div class="grid_12 last max1200 responsive txtcenter mar-fim">
             <button class="btn-einfo2 cinza marg2" title="Enviar Informações" id="cadastro-enviar">Finalizar cadastro</button>
             <span class="btn-einfo2 cinza-claro marg2 dinline-block vtop dnone" id="cadastro-loading">Enviando dados ...</span>
       </div>
        
        <div class="clear"></div>
    </div>
</section>
<!-- End. Middle -->