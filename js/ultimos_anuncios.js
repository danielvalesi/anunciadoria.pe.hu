var ultimos_anuncios = {

	ctrl: false,
	ctrl_scroll: false,
	_json: {},
	limit: null,
	
	init: function() {
	
		if(!this.limit) return ;
		
		this.box = $('#anuncios-box');
		this.loading = $('#anuncios-loading');
		
		this._window = $(window);
		
		this._json.offset = this.limit;
		this._json.limit = this.limit;
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
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
		
		$.post('ajax/ajax-ultimos_anuncios_pg.php?'+Math.random(),this._json,function(data) {
		
			if(!data || data.s == 'nr') return ;
			
			$.each(data.i,function(i,v) { $this.box.append(v); });
				
			$this._json.offset+=data.i.length;
				
			$this.ctrl_scroll = false;
		
		},'JSON');
	
	}
	
};