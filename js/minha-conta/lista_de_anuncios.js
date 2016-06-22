var lista_de_anuncios = {

	ctrl: false,
	ctrl_scroll: false,
	_json: {},
	limit: null,
	
	init: function() {
	
		if(!this.limit) return ;
		
		this.box = $('#anuncios-box');
		this.loading = $('#anuncios-loading');
		this.busca = $('#loja-busca-input');
		this.busca_btn = $('#loja-busca-btn');
		
		this._window = $(window);
		
		this._json.offset = this.limit;
		this._json.limit = this.limit;
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		$('body').on('click','._anuncio-deletar',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._anuncio-item');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			var confirmacao = $('._anuncio-confirmacao',cpai);
			
			confirmacao.fadeIn(400,function() {
			
				$('html,body').animate({scrollTop:confirmacao.offset().top},400,function() {
				
					cpai.data('control',0);
				
				});
			
			});
		
		}).on('click','._anuncio-confirmacao > a',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._anuncio-item');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			if(own.data('act') == '0')
			{
				$('._anuncio-confirmacao',cpai).fadeOut(400,function() {
				
					$('html,body').animate({scrollTop:cpai.offset().top},400,function() {
				
						cpai.data('control',0);
				
					});
				
				});
			}
			else
			{
				$('._anuncio-confirmacao',cpai).hide();
				$('._anuncio-confirmacao-loading',cpai).show();
				
				$.post('ajax/minha-conta/ajax-deletar_anuncio.php?'+Math.random(),{aid:cpai.data('aid')},function(data) {
				
					if(!data) return ;
					
					if(data.s == 'err')
					{
						document.location = _base+'login/';
					}
					else
					{
						if($('._anuncio-item').length == 1)
						{
							document.location = _base+'minha-conta/lista-de-anuncios/?no_cache='+Math.random()+'#anuncios';
						}
						else
						{
							cpai.fadeOut(400,function() { cpai.remove(); });
						}
					}
				
				},'JSON');
			}
		
		});
		
		this.busca.on('keyup',function(e) {
			
			if(e.which == 13) $this.busca_btn.trigger('click');
			
		});
		
		this.busca_btn.on('click',function(e) {
										   
			e.preventDefault();
		
			if($this.busca.val()) document.location = _base+'minha-conta/lista-de-anuncios/?q='+encodeURIComponent($this.busca.val());
		
		});
		
		this._window.on('scroll',function() {
		
			if($this.ctrl_scroll) return ;
		
			if($this._window.scrollTop() >= ($this.loading.offset().top-$this._window.height()))
			{
				$this.ctrl_scroll = true;
				$this.__post();
			}
		
		});
		
	},
	__post: function(t) {
		
		var $this = this;
		
		$.post('ajax/minha-conta/ajax-lista_de_anuncios_pg.php?'+Math.random(),this._json,function(data) {
		
			if(!data || data.s == 'nr') return ;
			
			if(data.s == 'err')
			{
				document.location = _base+'login/';
			}
			else
			{
				$.each(data.i,function(i,v) { $this.box.append(v); });
				
				$this._json.offset+=data.i.length;
				
				$this.ctrl_scroll = false;
			}
		
		},'JSON');
	
	}
	
};