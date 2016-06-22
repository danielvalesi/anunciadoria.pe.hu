var sugerir_segmento = {

	ctrl: false,
	
	init: function() {
		
		this.box = $('#sugerir-segmento-box');
		this.nome = $('#sugerir-segmento-nome');
		this.check = $('#sugerir-segmento');
		this.enviar = $('#sugerir-segmento-enviar');
		this.loading = $('#sugerir-segmento-loading');
		this.ok = $('#sugerir-segmento-ok');
		this.todos = $('._interesses-todos');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		$('._interesses-item').on('click',function(e) {
		
			if($this.ctrl)
			{
				e.preventDefault();
				return ;
			}
			
			var own = $(this);
			var cpai = own.parent().parent();
			
			if(!own.prop('checked')) $('._interesses-todos',cpai).prop('checked',0);
		
		});
		
		this.todos.each(function() {
		
			var own = $(this);
			var cpai = own.parent().parent();
			
			if($('._interesses-item:not(:checked)',cpai).length == 0) own.prop('checked',1);
		
		});
		
		this.todos.on('click',function(e) {
		
			if($this.ctrl)
			{
				e.preventDefault();
				return ;
			}
			
			var own = $(this);
			var cpai = own.parent().parent();
			
			if(own.prop('checked'))
			{ $('input[type=checkbox]',cpai).prop('checked',1); }
			else
			{ $('input[type=checkbox]',cpai).prop('checked',0); }
		
		});
		
		this.check.on('click',function(e) {
			
			if($this.ctrl)
			{
				e.preventDefault();
				return ;
			}
			
			$this.ctrl = true;
			
			if($this.check.prop('checked'))
			{
				$this.box.fadeIn(400,function() {
				
					$this.nome.focus();
					$this.ctrl = false;
				
				});
			}
			else
			{
				$this.box.fadeOut(400,function() {
				
					$this.nome.val('');
					$this.ctrl = false;
					
				});
			}
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			if(!$this.nome.val())
			{
				$this.nome.focus();
				return ;
			}
			
			$this.ctrl = true;
			
			$this.enviar.hide();
			$this.loading.css('display','block');
			
			$.post('ajax/ajax-sugerir_segmento.php?'+Math.random(),{nome:$this.nome.val()},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				$this.loading.hide();
				$this.ok.css('display','block');
				$this.nome.val('');
				
				$this.ctrl = false;
				
				setTimeout(function() {
				
					$this.ok.hide();
					$this.enviar.css('display','block');
				
				},3000);
			
			},'JSON');
		
		});
	
	}
	
};