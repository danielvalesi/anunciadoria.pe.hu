<?php
require 'html_tpl/menu.php';
if(!$c->user) require 'html_tpl/topo_cadastro-login.php';
?>

<!-- Header -->
<header id="_topo">
	<section class="fundo<?php echo rand(1,3); ?>">
    <div class="container_grid max1200 responsive">
		
		<?php require 'html_tpl/topo_links.php'; ?>
		
        <section class="pd">
			<div class="container_grid max1200 responsive">
				<div class="grid_12 last txtcenter marg">
					<h1>"O primeiro <span>Market Place</span> para qualquer<br>tipo de anúncio do Mundo"</h1>
					<div class="grid_5 txtright">
					<div class="dinline-block vtop txtcenter" style="max-width:190px;">
					<p class="marg10"><a href="" class="play" data-scid="_video"><img class="responsive maxw100" src="img/icone-play.png"></a></p>
					<p class="bot-funciona marg7" style="margin-bottom:250px;">Como funciona</p>
					</div>
					</div>
					<div class="grid_2">&nbsp;</div>
					<div class="grid_5 txtleft last">
					<div class="dinline-block vtop txtcenter" style="max-width:190px;">
					<p class="marg10"><a href="anuncios/todos/" class="play"><img class="responsive maxw100" src="img/icone-busca.png"></a></p>
					<p class="bot-funciona marg7" style="margin-bottom:250px;">Buscar anúncios</p>
					</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</section>
		
	</div>
    </section>
</header>
<!-- End. Header -->