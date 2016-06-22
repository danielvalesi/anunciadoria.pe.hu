var nova_senha = {

	ctrl: false,
	err: false,
	cid: null,
	
	init: function() {
	
		if(!this.cid) return ;
	
		this.box = $('#nova-senha-box');
		this.input = $('#nova-senha-input');
		this.input_confirmar = $('#nova-senha-input-confirmar');
		this.enviar = $('#nova-senha-enviar');
		this.loading = $('#nova-senha-loading');
		this.ok = $('#nova-senha-ok');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		$('input[id^=nova-senha]',this.box).on('keyup',function(e) {
		
			if(e.which == 13) $this.enviar.trigger('click');
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			if(!$this.input.val())
			{
				$this.input.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.input;
			}
			
			if(!$this.input_confirmar.val() || $this.input.val() != $this.input_confirmar.val())
			{
				$this.input_confirmar.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.input_confirmar;
			}
			
			if($this.err)
			{
				$('html,body').animate({scrollTop:$this.err.offset().top},'fast',function() {
				
					$this.err.focus();
					$this.ctrl = false;
					
				});
				
				return ;
			}
			
			$this.enviar.addClass('dnone');
			$this.loading.removeClass('dnone');
			
			$.post('ajax/ajax-nova_senha.php?'+Math.random(),{cid:$this.cid,senha:$this.input.val()},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				$this.loading.addClass('dnone');
				$this.ok.removeClass('dnone');
				
				setTimeout(function() { document.location = _base+'minha-conta/'; },3000);
				
			},'JSON');
			
		});
		
	}

};