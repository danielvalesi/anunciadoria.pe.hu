<?php
require 'html_tpl/menu.php';
if(!$c->user) require 'html_tpl/topo_cadastro-login.php';
?>

<!-- Header -->
<header id="_topo">
	<div class="container_grid max1200 responsive">
		
		<?php require 'html_tpl/topo_links.php'; ?>
		
	</div>
</header>
<!-- End. Header -->