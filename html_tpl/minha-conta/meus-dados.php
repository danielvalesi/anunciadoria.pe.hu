<?php
if($c->user['cadastro_cpf'])
{
	$_nome_ph = 'Nome';
	$_jur_sty = ' style="display:none;"';
	$_fis_sty = $_jur_ie = $_jur_ieIsento = NULL;
}
else
{
	$_nome_ph = 'Nome fantasia';
	$_fis_sty = ' style="display:none;"';
	$_jur_sty = '';
	
	if($c->user['cadastro_ie'])
	{
		$_jur_ie = ' value="'.$c->user['cadastro_ie'].'"';
		$_jur_ieIsento = NULL;
	}
	else
	{
		$_jur_ie = ' disabled="true"';
		$_jur_ieIsento = ' checked="checked"';
	}
}
?>
<!-- Middle -->
<section class="pd">
	<div class="container_grid max1200 responsive">
		<div class="grid_12 last marg">
			<h2><span>Minha</span> conta</h2>
        </div>
        <div class="grid_12 last marg8">
       	  <div class="hr-divisa"> </div>
          
          <div class="grid_12 last">
          	<div class="row marg responsive">
          		
                <div class="grid_12 last adapt">
				
                 <?php require 'html_tpl/minha-conta/menu.php'; ?>
            	
                 <div class="grid_10 last responsive">
					<div class="grid_12 last adapt">
                 	<div class="grid_12 last _fxmargin-01"> </div>
                	
               		<div class="grid_2 marg7 txtcenter adapt">
        	<div class="responsive reducao _upload-box">
       	    	<div style="max-width:160px; margin:0 auto;"><img src="<?php echo $c->user['cadastro_fotoPerfil']; ?>" alt="Foto de perfil" title="Foto de perfil" class="foto-perfil-g _upload-view" id="cadastro-foto"<?php echo $c->user['foto_url']; ?>></div>
                <div class="area-file2 area-file5 marg3 _upload-btn">
                <span>Importar foto</span>
                <form action="ajax/ajax-upload_foto.php" method="post" enctype="multipart/form-data"><input type="hidden" name="_act" value="1"><input type="file" name="_foto" class="_upload-foto ifile" size="300" onchange="__upload(this)" onclick="this.value=null;"></form>
                </div>
                <div class="area-file2 marg3 _upload-loading" style="cursor:default; display:none;">
                <span>Carregando...</span>
                </div>
            </div>    
            <div class="clear"></div>
        	</div>
                
         <div class="grid_10 last marg7 adapt" id="cadastro-box">
		         
       	  <div class="responsive">
          	<div class="form-contato grid_12 last adapt">
			
			 <div class="grid_9">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-nome" placeholder="<?php echo $_nome_ph; ?>" value="<?php echo $c->user['cadastro_nome']; ?>" maxlength="120">
					</span>
                </div>
                <div class="grid_3 last">
                	<span class="lineform smallControl"<?php echo $_fis_sty; ?>>
					<input type="text" id="cadastro-cpf" placeholder="CPF" value="<?php echo $c->user['cadastro_cpf']; ?>" maxlength="20">
					<small class="alert-error" id="cadastro-cpf-erro">CPF já cadastrado !</small>
					</span>
                    <span class="lineform smallControl"<?php echo $_jur_sty; ?>>
					<input type="text" id="cadastro-cnpj" placeholder="CNPJ" value="<?php echo $c->user['cadastro_cnpj']; ?>" maxlength="30">
					<small class="alert-error" id="cadastro-cnpj-erro">CNPJ já cadastrado !</small>
                    </span>
                </div>
                <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-email" placeholder="E-mail" value="<?php echo $c->user['cadastro_email']; ?>" maxlength="120">
					<small class="alert-error" id="cadastro-email-erro">E-mail já cadastrado !</small>
					</span>
                </div>
                <div class="grid_3">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-telefone" placeholder="Telefone" value="<?php echo $c->user['cadastro_telefone']; ?>">
					</span>
                </div>
                <div class="grid_3 last">
                	<span class="lineform smallControl"<?php echo $_fis_sty; ?>>
					<input type="text" id="cadastro-nascimento" placeholder="Data Nascimento" value="<?php echo $c->user['nascimento']; ?>">
					</span>
                    <span class="lineform smallControl"<?php echo $_jur_sty; ?>>
					<input type="text" id="cadastro-razaoSocial" placeholder="Razão Social" value="<?php echo $c->user['cadastro_razaoSocial']; ?>" maxlength="120">
					</span>
                </div>
			
                <div class="grid_12 last"<?php echo $_jur_sty; ?>>
                	<div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-ie" placeholder="IE - Inscrição estadual" maxlength="80"<?php echo $_jur_ie; ?>>
					</span>
                	</div>
                    <div class="grid_6 last marg14">
                	<input type="checkbox" id="cadastro-ieIsento" class="dinline-block vmiddle"<?php echo $_jur_ieIsento; ?>><label for="cadastro-ieIsento" class="dinline-block vmiddle texto-check">Isento</label>
                	</div>
				</div>
				
				<div class="grid_12 last">
					<span class="lineform smallControl">
					<textarea placeholder="Descreva sobre você ou sua empresa" style="font-size:15px; color:#666;" id="cadastro-sobre"><?php echo $c->user['cadastro_sobre']; ?></textarea>
					</span>  
				</div>
				
				<div class="grid_12 last marg">
					<p class="tit8">Digite sua nova senha abaixo <small>(Opcional)</small></p>
				</div>
				
				<div class="grid_12 last">
					<span class="lineform smallControl">
					<input type="password" placeholder="Senha atual" id="cadastro-senhaAtual">
					<small class="alert-error" id="cadastro-senhaAtual-erro">Senha atual incorreta</small>
					</span>  
				</div>
				
				<div class="grid_12 last responsive">
					<div class="grid_6">
						<span class="lineform smallControl">
						<input type="password" placeholder="Nova senha" id="cadastro-senhaNova">
						</span> 
					</div>
					<div class="grid_6 last">
						<span class="lineform smallControl">
						<input type="password" placeholder="Confirmar nova senha" id="cadastro-senhaNovaConfirmar">
						</span> 
					</div> 
				</div>
				
				<div class="grid_12 last marg">
					<p class="tit8">Link da sua página de perfil <small id="cadastro-url-view1"<?php if(!$c->user['cadastro_url']) { ?> class="dnone"<?php } ?>>(Ex: www.anunciadoria.com/<span id="cadastro-url-view2"><?php echo $c->user['cadastro_url']; ?></span>/)</small></p>
				</div>
				
				<div class="grid_12 last">
					<span class="lineform smallControl">
					<input type="text" placeholder="Link da sua página" id="cadastro-url" value="<?php echo $c->user['cadastro_url']; ?>" maxlength="60">
					<small class="alert-error" id="cadastro-url-erro">Link já cadastrado !</small>
					</span>  
				</div>
				
				<div class="grid_12 last">
                	<div class="grid_6 marg">
                	<span class="lineform smallControl">
					<input type="text" id="cadastro-endereco-cep" placeholder="CEP" value="<?php echo $c->user['cadastro_endereco_cep']; ?>">
					<small class="alert-error" id="cadastro-endereco-cep-erro">CEP Inválido !</small>
					</span>
                	</div>
                    	<div class="grid_6 marg last">
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
                   
            </div>
            <div class="clear"></div>
         </div>
        
        <div class="grid_12 last">
		<p class="tit8">Meus interesses</p>
		</div>
        
        	<div class="grid_12 last max1200 marg17">
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
                
                <div class="grid_12 last txtcenter">
                 	<button class="btn-sal-alt cinza marg2" title="Enviar Informações" id="cadastro-enviar">Salvar alterações</button>
                    <span class="btn-sal-alt cinza-claro marg2 dinline-block vtop dnone" id="cadastro-loading">Salvando ...</span>
                    <span class="btn-sal-alt verde marg2 dinline-block vtop dnone" id="cadastro-ok">Salvo com sucesso !</span>
                 </div>
                
                </div>
                </div>
                </div>
               
                
          	</div>
          </div>
          
        </div>
       
       <div class="grid_12 last txtcenter marg4"></div>
       
       <div class="clear"></div>
       
  </div>
</section>
<!-- End. Middle -->