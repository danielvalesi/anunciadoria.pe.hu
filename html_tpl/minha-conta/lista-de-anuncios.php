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
            	
            <div class="grid_10 last" id="anuncios">        		
                
       <div class="grid_12 last marg7 adapt">
                 
       	  <div class="row responsive">
          	<div class="grid_12 last form-contato adapt">
                <div class="grid_12 last">
                	<p class="tit8 marg19">Lista de anúncios | <span><?php echo $c->otxt['total_anuncios']; ?></span> anúncios</p> 
				</div>
               <div class="grid_12 marg7 last responsive">
                <div class="grid_10">
                	<span class="lineform smallControl">
					<input type="text" id="loja-busca-input" placeholder="Busca de anúncios"<?php if($c->__cache['Minha_Conta_Front']->_ck_q) { ?> value="<?php echo htmlentities(stripslashes($_GET['q']),ENT_COMPAT,'UTF-8'); ?>"<?php } ?>>
					</span>
                	</div>
                    
                <div class="grid_2 last">
                 	<button class="btn-procura cinza dblock txtcenter" id="loja-busca-btn">Busca</button>
                </div>
               </div>
			   
			   <?php if($c->otxt['anuncios']) { ?>
			   
                <div class="grid_12 last">
                	<div class="grid_8"><p>Descrição</p></div>
                    <div class="grid_2 txtcenter"><p>Editar</p></div>
                    <div class="grid_2 txtcenter last"><p>Excluir</p></div>
				</div>
				
				<div class="clear"></div>
                
              <div class="lista-anuncios" id="anuncios-box">
               
			   <?php echo $c->otxt['anuncios']; ?>  
			    
				 <div class="clear"></div>
               
               </div>
			   
			   <div id="anuncios-loading"></div>
                 
				<?php } else { ?>
				
				<div class="grid_12 last txtcenter">
				<p>Nada encontrado !</p>
				<p class="marg8"><img src="img/icone-triste.png" class="responsive"></p>
				</div>
				
				<?php } ?>
				 
                <div class="clear"></div>
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