var anuncios_topo = {

	ctrl: false,
	
	init: function() {
		
		this.estado = $('#_anuncios-estado');
		this.cidade = $('#_anuncios-cidade');
		this.bairro = $('#_anuncios-bairro');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		this.estado.on('change',function() {
		
			var _sel = $('option:selected',$this.estado).val();
			
			if(_sel) _sel += '/';
			
			document.location = _base+'anuncios/'+_sel;
		
		});
		
		this.cidade.on('change',function() {
		
			var _sel = $('option:selected',$this.cidade).val();
			
			if(_sel) _sel += '/';
			
			document.location = _base+'anuncios/'+$('option:selected',$this.estado).val()+'/'+_sel;
		
		});
		
		this.bairro.on('change',function() {
		
			var _sel = $('option:selected',$this.bairro).val();
			
			if(_sel) _sel += '/';
			
			document.location = _base+'anuncios/'+$('option:selected',$this.estado).val()+'/'+$('option:selected',$this.cidade).val()+'/'+_sel;
		
		});
		
	}
	
};