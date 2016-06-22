<?php
if($c->user['cadastro_tipo'] == 2)
{
	$_cs_menu = ' style="display:none;"';
}
else
{
	$_cs_menu = NULL;
}
?>

<div class="grid_2">
	<a href="minha-conta/" class="bot-menu-lat _mc-menu">Meus dados</a>
	<a href="minha-conta/cadastrar-anuncio/" class="bot-menu-lat _mc-menu"<?php echo $_cs_menu; ?>>Cadastrar espaço de mídia</a>
	<a href="minha-conta/lista-de-anuncios/" class="bot-menu-lat _mc-menu"<?php echo $_cs_menu; ?>>Lista de anúncios</a>
	<a href="minha-conta/mensagens/" class="bot-menu-lat _mc-menu">Mensagens</a>
	<a href="minha-conta/excluir-conta/" class="bot-menu-lat _mc-menu">Excluir conta</a>
</div>
