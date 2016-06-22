<?php
if($c->user)
{
	$_perfil_nome = $c->user['cadastro_nome'];
	$_perfil_email = $c->user['cadastro_email'];
}
else
{
	$_perfil_nome = $_perfil_email = NULL;
}
?>
<!-- Middle -->
<section class="pd">
	<div class="container_grid max1200 responsive">
		<div class="grid_12 last txtcenter marg">
			<h2><span>Perfil do</span> contratante</h2>
            <p class="marg3">Conheça quem procura seus serviços para melhor atendê-los.</p>
		</div>
        
        <div class="grid_12 last marg">
       	  <div class="hr-divisa"> </div>
          
          <div class="grid_12 last" id="_perfil">
          	<div class="marg responsive">
          		<div class="grid_2">
                	<div class="fp">
                	<img class="foto-perfil-g-mini _fxbradius" src="<?php echo $c->otxt['perfil']['cadastro_fotoPerfil']; ?>">
                	</div>
                </div>
            	<div class="grid_5 marg7">
                	<div class="grid_12 last">
                    <p class="tit-perfis"><?php echo $c->otxt['perfil']['cadastro_nome']; ?></p>
                	<?php if($c->otxt['perfil']['cadastro_cpf']) { ?>
					<p class="chave-perfis"><strong>CPF:</strong> <?php echo $c->otxt['perfil']['cadastro_cpf']; ?></p>
					<?php } else { ?>
					<p class="chave-perfis"><strong>CNPJ:</strong> <?php echo $c->otxt['perfil']['cadastro_cnpj']; ?></p>
					<p class="chave-perfis"><strong>Razão Social:</strong> <?php echo $c->otxt['perfil']['cadastro_razaoSocial']; ?></p>
					<?php } ?>
					
                    <p class="end-perfis ico-end"> <?php echo $c->otxt['perfil']['endereco']; ?></p>
              		<a href="" class="btn-item" id="perfil-info">Ver contato</a> <a href="" class="btn-item" id="perfil-contato-btn">Entrar em contato</a>
                    </div>
                    
                    <div class="grid_12 last item-list2 form-contato3 responsive dnone" style="margin-top:10px;" id="perfil-contato-box">
            	<div class="grid_12 last marg16 txtcenter"><p><strong>Envie sua mensagem ao anunciante</strong></p>
            	</div>
                <div class="grid_12 last responsive">
                <div class="grid_12 last">
                	<span class="lineform smallControl">
					<input type="text" id="perfil-contato-nome" placeholder="Nome" maxlength="120" value="<?php echo $c->otxt['_perfil_nome']; ?>">
					</span>
                 </div>
                 
                 <div class="grid_12 last adapt">
                 <div class="grid_6">
                	<span class="lineform smallControl">
					<input type="text" id="perfil-contato-email" placeholder="E-mail" maxlength="120" value="<?php echo $c->otxt['_perfil_email']; ?>">
					</span>
                 </div>
                 <div class="grid_6 last">
                	<span class="lineform smallControl">
					<input type="text" id="perfil-contato-telefone" placeholder="Telefone">
					</span>
                 </div>
                 </div>
                
                 </div>
                  
                 <div class="grid_12 last form-contato5">
                 	<span class="lineform smallControl">
					<textarea id="perfil-contato-msg" style="font-size:15px; color:#666;" placeholder="Digite sua mensagem ..."></textarea>
					</span>
                  </div>
                 <div class="grid_12 last txtleft bot-red-senha">
                 	<button class="btn-anuncio-mens btn-senha2 cinza-suave" title="" id="perfil-contato-enviar">Enviar</button>
                    <span class="btn-anuncio-mens btn-senha2 dblock txtcenter cinza-claro dnone" id="perfil-contato-loading">Enviando ...</span>
                    <span class="btn-anuncio-mens btn-senha2 dblock txtcenter verde dnone" id="perfil-contato-ok">Enviado com sucesso !</span>
                 	</div>
            </div>
                    
              	</div>
            	<div class="grid_5 last marg7">
                	<p class="sobre-perfis">Sobre o contratante</p>
                    <p class="texto-perfis"><?php echo $c->otxt['perfil']['cadastro_sobre']; ?></p>
                </div>
                
          	</div>
          </div>
          
        </div>
       
	   <?php if($c->otxt['perfil_categorias']) { ?>
      <div class="grid_12 last txtcenter">
			<p class="marg3"><strong>Interesses do perfil <?php echo $c->otxt['perfil']['cadastro_nome']; ?></strong></p>
		</div>
       
       <div class="grid_12 last txtcenter marg5 responsive">
        	<div class="grid_12 last adapt">
        	
            <div class="grid_1 dinline-block vtop" style="float:none;">&nbsp;</div><?php echo $c->otxt['perfil_categorias']; ?><div class="grid_1 last dinline-block vtop" style="float:none;">&nbsp;</div>
            
            </div>
        </div>
		<?php } ?>
       
       <div class="grid_12 last txtcenter marg4">
	   </div>
       
       <div class="clear"></div>
       
  </div>
</section>
<!-- End. Middle -->