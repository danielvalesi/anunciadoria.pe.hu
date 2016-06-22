var perfil_anunciante = {

	ctrl: false,
	ctrl_scroll: false,
	_json: {},
	limit: null,
	
	init: function() {
	
		if(!this.limit) return ;
		
		this.box = $('#perfil-anuncios-box');
		this.loading = $('#perfil-anuncios-loading');
		this.ordenar = $('#perfil-anuncios-ordenar');
		this.box_over = $('#perfil-anuncios-box-over');
		this.box_loading = $('#perfil-anuncios-box-loading');
		
		this._window = $(window);
		
		this._json.cid = perfil.cid;
		this._json.offset = this.limit;
		this._json.limit = this.limit;
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		this.ordenar.on('change',function(e) {
		
			if($this.ctrl) return ;
			
			var _sel = $('option:selected',$this.ordenar).val();
			
			if(_sel)
			{
				$this._json.ordenar = _sel;
			}
			else
			{
				delete $this._json.ordenar;
			}
			
			$this.ordenar.data('c',1);
			$this._json.offset = 0;
			
			var _fix;
				
			$('html,body').animate({scrollTop:$this.box.offset().top},400,function() {
				
				if(_fix) return ;
					
				_fix = true;
				
				$this.box_over.fadeIn('fast',function() {
					
					$this.box_loading.removeClass('dnone');
					$this.__post(true);
					
				});
				
			});
		
		});
		
		this._window.on('scroll',function() {
		
			if($this.ctrl_scroll || $this.ordenar.data('c') == 1) return ;
		
			if($this._window.scrollTop() >= ($this.loading.offset().top-$this._window.height()))
			{
				$this.ordenar.data('c',1);
				$this.ctrl = true;
				$this.ctrl_scroll = true;
				$this.__post();
			}
		
		});
		
	},
	__post: function(t) {
		
		var $this = this;
		
		$.post('ajax/ajax-perfil_anuncios_pg.php?'+Math.random(),this._json,function(data) {
		
			if(!data || data.s == 'nr')
			{
				$this.ctrl = false;
				$this.ordenar.data('c',0);
				return ;
			}
			
			if(t) $this.box.html('');
				
			$.each(data.i,function(i,v) { $this.box.append(v); });
				
			$this._json.offset+=data.i.length;
				
			$this.ctrl_scroll = false;
			$this.ctrl = false;
			$this.ordenar.data('c',0);
			
			if(t)
			{
				$this.box_loading.addClass('dnone');
				$this.box_over.fadeOut('fast');
			}
		
		},'JSON');
	
	}
	
};