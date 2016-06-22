<!-- Middle -->
<section class="pd">
	<div class="container_grid max1200 responsive">
		<div class="grid_12 last txtcenter marg">
			<h2>Encontre<span>, o anúncio que você procura!</span></h2>
            <p class="marg3">Caso não encontre o que procura nos sugira em <a href="sugestoes/">sugestões</a> para que possamos ajuda-lo.</p>
		</div>
        
        <?php require 'html_tpl/anuncios-topo.php'; ?>
       
       <div class="grid_12 last">
       	  <div class="row2 relative">
          	
			<div id="anuncios-box">
			
				<?php echo $c->otxt['ultimos_anuncios']; ?>
				<div class="clear"></div>
				
			</div>
			
			<div id="anuncios-loading"></div>
			
			<div class="clear"></div>
			
          </div>
       </div>
       
       <div class="grid_12 last txtcenter row marg2">
	   </div>
       
       <div class="clear"></div>
       
  </div>
</section>
<!-- End. Middle -->