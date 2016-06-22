var mensagens = {

	ctrl: false,
	ctrl_scroll: false,
	_json: {},
	limit: null,
	
	init: function() {
	
		if(!this.limit) return ;
		
		this.box = $('#msgs-box');
		this.loading = $('#msgs-loading');
		this.busca = $('#loja-busca-input');
		this.busca_btn = $('#loja-busca-btn');
		
		this._window = $(window);
		
		this._json.offset = this.limit;
		this._json.limit = this.limit;
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		$('body').on('click','._msg-deletar',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._msg-item');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			var confirmacao = $('._msg-confirmacao',cpai);
			
			confirmacao.fadeIn(400,function() {
			
				$('html,body').animate({scrollTop:confirmacao.offset().top},400,function() {
				
					cpai.data('control',0);
				
				});
			
			});
		
		}).on('click','._msg-confirmacao > a',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._msg-item');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			if(own.data('act') == '0')
			{
				$('._msg-confirmacao',cpai).fadeOut(400,function() {
				
					$('html,body').animate({scrollTop:cpai.offset().top},400,function() {
				
						cpai.data('control',0);
				
					});
				
				});
			}
			else
			{
				$('._msg-confirmacao',cpai).hide();
				$('._msg-confirmacao-loading',cpai).show();
				
				$.post('ajax/minha-conta/ajax-deletar_mensagem.php?'+Math.random(),{mid:cpai.data('mid')},function(data) {
				
					if(!data) return ;
					
					if(data.s == 'err')
					{
						document.location = _base+'login/';
					}
					else
					{
						if($('._msg-item').length == 1)
						{
							document.location = _base+'minha-conta/mensagens/?no_cache='+Math.random()+'#msgs';
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
		
			if($this.busca.val()) document.location = _base+'minha-conta/mensagens/?q='+encodeURIComponent($this.busca.val());
		
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
		
		$.post('ajax/minha-conta/ajax-mensagens_pg.php?'+Math.random(),this._json,function(data) {
		
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