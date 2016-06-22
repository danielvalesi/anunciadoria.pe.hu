var excluir_conta = {

	ctrl: false,
	
	init: function() {
		
		this.btn = $('#conta-btn');
		this.confirmacao = $('#conta-confirmacao');
		this.confirmacao_loading = $('#conta-confirmacao-loading');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		this.btn.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			
			$this.confirmacao.fadeIn(400,function() {
			
				$('html,body').animate({scrollTop:$this.confirmacao.offset().top},400,function() {
				
					$this.ctrl = false;
				
				});
			
			});
		
		});
		
		$('> a',this.confirmacao).on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			
			var own = $(this);
			
			if(own.data('act') == '0')
			{
				$this.confirmacao.fadeOut(400,function() {
				
					$this.ctrl = false;
				
				});
			}
			else
			{
				$this.confirmacao.hide();
				$this.confirmacao_loading.show();
				
				$.post('ajax/minha-conta/ajax-deletar_conta.php?'+Math.random(),{},function(data) {
				
					if(!data) return ;
					
					if(data.s == 'err')
					{
						document.location = _base+'login/';
					}
					else
					{
						document.location = _base;
					}
				
				},'JSON');
			}
		
		});
		
	}
	
};