var minha_conta = {
	
	ctrl: false,
	
	init: function() {
	
		this.menu = $('._mc-menu');
		
		this.run();
	
	},
	run: function() {
	
		var $this = this;
		
		var _url = String(document.location);
		
		if(_url.indexOf('minha-conta/editar-anuncio') !== -1) return ;
		
		if(_url.indexOf('minha-conta/cadastrar-anuncio') !== -1) this.menu.eq(1).addClass('ativo');
		else if(_url.indexOf('minha-conta/lista-de-anuncios') !== -1) this.menu.eq(2).addClass('ativo');
		else if(_url.indexOf('minha-conta/mensagens') !== -1) this.menu.eq(3).addClass('ativo');
		else if(_url.indexOf('minha-conta/excluir-conta') !== -1) this.menu.eq(4).addClass('ativo');
		else this.menu.eq(0).addClass('ativo');
	
	}

};