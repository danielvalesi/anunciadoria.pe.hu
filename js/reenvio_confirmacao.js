var reenvio_confirmacao = {

	ctrl: false,
	
	init: function() {
		
		this.enviar = $('#reenvio-confirmacao-enviar');
		this.loading = $('#reenvio-confirmacao-loading');
		this.ok = $('#reenvio-confirmacao-ok');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
	
			$this.enviar.hide();
			$this.loading.removeClass('dnone');
			
			$.post('ajax/ajax-reenvio_confirmacao.php?'+Math.random(),{},function(data) {
			
				if(!data) return ;
				
				if(data.s == 'err')
				{
					document.location = _base+'login/';
				}
				else
				{
					$this.loading.hide();
					$this.ok.removeClass('dnone');
				}
				
			},'JSON');
		
		});
	
	}
	
};