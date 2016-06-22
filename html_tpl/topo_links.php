<div class="grid_12 last">
        	<div class="grid_4">
            	
				<a href="" class="btn-topo vermelho dinline-block vtop" title="Menu" id="_menu" style="margin-left: 12px; margin-right: 0px; float: none;">Menu</a>

            </div>
			<?php if($c->user) { ?>
            <div class="grid_8 last txtright logado marg-logado">
				<a class="logado-nome"><img src="<?php echo $c->user['cadastro_fotoPerfil']; ?>" class="foto-perfil-g-mini" width="25"> Olá, <?php echo $c->user['cadastro_nome']; ?></a>
                <span>|</span>
                <a title="Minha Conta" href="minha-conta/">Minha Conta</a>
                <span>|</span>
                <a title="Sair" class="mar-right" href="sair/">Sair</a>
            </div>
			<?php } else { ?>
			<div class="grid_8 last txtright">
				<a href="" class="btn-topo vermelho mar-right nomobile" title="Cadastre-se" data-scid="_cadastro">Cadastre-se</a>
                <a href="" class="btn-topo cinza2 nomobile" title="Login" data-scid="_login">Login</a>
			</div>
			<?php } ?>
        </div>
        
        <div class="grid_12 last txtcenter">
			<a class="logo dinline-block" title="Anunciadoria" href="">
				<h1>Anunciadoria</h1>
				<img class="responsive" src="img/anunciadoria-logo.png" alt="Anunciadoria">
			</a>
		</div>