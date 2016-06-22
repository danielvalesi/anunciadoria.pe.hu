<!-- Middle -->
<section class="pd">
	<div class="container_grid max1200 responsive">
		<div class="subheader">
      <div class="grid_12 last txtcenter marg">
  			<h2>Encontre<span> o anúncio que você procura!</span></h2>
              <p class="marg3">Caso não encontre o que procura nos sugira em <a href="sugestoes/">sugestões</a> para que possamos ajuda-lo.</p>
  		</div>
        
        <?php require 'html_tpl/anuncios-topo.php'; ?>
    </div>   
       <div class="grid_12 last responsive marg">
       	  <div class="grid_12 last adapt">
          	
            <div class="grid_3 menu-lateral">
              <div class="affix">
               <div class="grid_12 last">
                <div class="titulo-filtros">Filtro</div>
                <div class="filtrados" id="anuncios-interesses-aplicados"></div>
                <div class="com-foto" style="cursor:pointer;" id="anuncios-com-foto">
                	<p class="input-perso dinline-block vtop" style="margin-top:4px;"></p><p class="text-pos dinline-block vtop">Apenas anúncios com foto</p>
                </div>
                <div class="area-filtro-valor">
                	<p>Arraste para selecionar os valores</p>
                	<div id="anuncios-precos"></div>
					<div class="price_label">
						<span class="fleft from" id="anuncios-precos-de-txt"></span> <span class="fright to" id="anuncios-precos-ate-txt"></span>
						<div class="clear"></div>
					</div>
             	</div>
				<div class="filtrados">
					<p id="anuncios-valor-aplicado" style="display:none;"><span></span><a href=""  id="anuncios-valor-aplicado-remover"><img src="img/fechar.png" alt="Excluir" title="Excluir"></a></p>
				</div>
               </div> 
               
               <div class="grid_12 last marg5 filtramais">
               <a href="" class="maisfiltros dblock txtcenter" id="anuncios-mobfiltrar"<?php if(!$c->otxt['anuncios_interesses']) { ?> style="display:none;"<?php } ?>>Filtrar categorias</a>
               </div>
               
               <div class="grid_12 last">
                <div class="lista-filtros" id="anuncios-interesses">
                	
					<?php echo $c->otxt['anuncios_interesses']; ?>
					
                </div>
               </div>
               </div> <!-- .affix -->  
            </div>
            
			<div class="grid_9 last txtcenter dnone" id="_fx-box-erro">
			<p>Nada encontrado !</p>
			<p class="marg8"><img src="img/icone-triste.png" class="responsive"></p>
			</div>
			
            <div class="grid_9 last responsive" id="_fx-box">
            	<div class="grid_12 last txtright">
                	<div class="form-contato2 responsive">
                    <div class="grid_12 adapt last">
                    <div class="grid_9">&nbsp;</div>
                    <div class="grid_3 last">
                		<span class="lineform2 smallControl">
						<div class="selecao2">
                    	<span>Ordenação</span>
                    	<select id="anuncios-ordenar">
							<option class="cor" value="">Ordenação</option>
							<option class="cor" value="1">Menor valor</option>
                      		<option class="cor" value="2">Maior valor</option>
						</select>
                    	</div>
						</span>
                 	</div>
                    </div>
                    </div>
                </div>
            		
                    <div class="grid_12 last">
       	  <div class="row2 relative">	
            
            <div>
			
				<div id="anuncios-box"><?php echo $c->otxt['anuncios']; ?></div>
				<div class="clear"></div>
			
			</div>
			
			<div id="anuncios-loading"></div>
            
            <div class="clear"></div>
            <div class="overpass dnone" id="anuncios-box-over"></div>
            <div class="loadpass dnone" id="anuncios-box-loading"></div> 
            
          </div>
       </div>
            </div>
            
            <div class="clear row"></div>
          </div>
       </div>
       
       
  </div>
</section>
<!-- End. Middle -->
