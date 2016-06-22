<div class="menu-princ" id="_menu-box">
	<a class="fechar" href="" id="_menu-fechar"><img src="img/clo-menu.png" class="responsive"></a>
	<?php if($c->user) { ?>
	<div class="txtcenter">
    	<div class="responsive marg25">
       	<img src="<?php echo $c->user['cadastro_fotoPerfil']; ?>" alt="<?php echo $c->user['cadastro_nome']; ?>" title="<?php echo $c->user['cadastro_nome']; ?>" class="foto-perfil-menu responsive maxx">
        </div>
        <p class="titulo"><?php echo $c->user['cadastro_nome']; ?></p>
    </div>
	<?php } else { ?>
    <div class="txtcenter">
    	<div class="responsive marg25">
       	<img src="img/foto-anunciadoria.jpg" alt="" title="" class="foto-perfil-menu responsive maxx">
        </div>
        <p class="titulo">Seja bem vindo!</p>
    </div>
	<?php } ?>
    <div class="list0">
    	<ul>
        	<li><a href="">Home</a></li>
            <li><a href="quem-somos">Quem somos</a></li>
            <li><a href="como-funciona/">Como funciona</a></li>
			<li><a href="anuncios/">Buscar anúncios</a></li>
			<?php if($c->user) { ?>
			<li><a href="minha-conta/">Minha conta</a></li>
            <?php } else { ?>
			<li><a href="" data-scid="_cadastro">Cadastre-se</a></li>
            <li><a href="" data-scid="_login">Login</a></li>
			<?php } ?>
			<li><a href="sugestoes/">Sugestões</a></li>
            <li><a href="e-seguro/">É Seguro</a></li>
            <li><a href="glossario/">Glossário de Mídias</a></li>
            <?php if($c->pn == 'index' or $c->pn == 'contato') { ?>
			<li><a href="" data-scid="_contato">Contato</a></li>
			<?php } else { ?>
			<li><a href="contato/">Contato</a></li>
			<?php } ?>
            <li style="margin-top:15px;"><a href="https://www.facebook.com/anunciadoria" target="_blank">Facebook</a></li>
            <li><a href="https://www.instagram.com/anunciadoria" target="_blank">Instagram</a></li>
			<li><a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank">Youtube</a></li>
        </ul>
    </div>
    <div class="direitos-menu"><a href="termos-de-uso/">Termo e políticas de uso.</a><br>
Todos os direitos reservados.</div>
</div>
