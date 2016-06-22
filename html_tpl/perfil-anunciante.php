<!-- Middle -->
<section class="pd">
	<div class="container_grid max1200 responsive">
		<div class="grid_12 last txtcenter marg">
			<h2><span>Perfil do</span> anunciante</h2>
            <p class="marg3">Conhecer o anunciante antes de iniciar qualquer negociação é muito importante.</p>
		</div>
        
        <div class="grid_12 last marg">
       	  <div class="hr-divisa">
          	<a href="anuncios/" class="botao-voltar dinline-block">Voltar para área de busca</a>
          </div>
          
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
            	<div class="grid_5 last">
                	<p class="sobre-perfis">Sobre o anunciante</p>
                    <p class="texto-perfis"><?php echo $c->otxt['perfil']['cadastro_sobre']; ?></p>
                    <?php if($c->otxt['perfil_categorias']) { ?>
					<p class="cat-perfis">Categorias cadastradas</p>
                    <div class="area-cat-cadast">
                    	<ul>
						<?php echo $c->otxt['perfil_categorias']; ?>
                        </ul>
                    </div>
					<?php } ?>
                    
                </div>
                
          	</div>
          </div>
          
        </div>
       
	   <?php if($c->otxt['perfil_anuncios']) { ?>
       <div class="grid_12 last marg">
       			<div class="grid_12 last responsive">
                	<div class="grid_12 last adapt">
                    <div class="grid_9 qtd-anuncios"><span>O anunciante possui <b><?php echo $c->otxt['perfil_total_anuncios']; ?> anúncio<?php if($c->otxt['perfil_total_anuncios'] != 1) { echo 's'; } ?></b> no sistema</span></div>
                    <div class="grid_3 last form-contato2">
                		<span class="lineform2 smallControl">
						<div class="selecao2">
                    	<span>Ordenação</span>
                    	<select id="perfil-anuncios-ordenar">
							<option class="cor" value="">Ordenação</option>
							<option class="cor" value="1">Menor valor</option>
                      		<option class="cor" value="2">Maior valor</option>
						</select>
                    	</div>
						</span>
                 	</div>
                    </div>
                    
                </div>
                <div class="clear"></div>
		
       	  <div class="row2 relative">
          	
            <div>
			
				<div id="perfil-anuncios-box"><?php echo $c->otxt['perfil_anuncios']; ?></div>
				<div class="clear"></div>
			
			</div>
			
			<div id="perfil-anuncios-loading"></div>
            
            <div class="clear"></div>
            <div class="overpass dnone" id="perfil-anuncios-box-over"></div>
            <div class="loadpass dnone" id="perfil-anuncios-box-loading"></div>
          </div>
		
       </div>
	   <?php } ?>
       
       <div class="grid_12 last txtcenter marg4">
	   </div>
       
       <div class="clear"></div>
       
  </div>
</section>
<!-- End. Middle -->