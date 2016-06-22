var login_topo = {

	ctrl: false,
	err: false,
	
	init: function() {
		
		this.box = $('#login-topo-box');
		this.email = $('#login-topo-email');
		this.senha = $('#login-topo-senha');
		this.erro = $('#login-topo-erro');
		this.enviar = $('#login-topo-enviar');
		this.loading = $('#login-topo-loading');
		
		this.run();
	
	},
	resetar: function() {
	
		this.erro.hide();
		$('.lineform-error',this.box).removeClass('lineform-error');
		this.email.val('');
		this.senha.val('');
	
	},
	run: function() {
		
		var $this = this;
		
		$('input[id^=login-topo]',this.box).on('keyup',function(e) {
		
			if(e.which == 13) $this.enviar.trigger('click');
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$this.erro.hide();
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			if(!$this.email.val())
			{
				$this.email.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.email;
			}
			
			if(!$this.senha.val())
			{
				$this.senha.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.senha;
			}
			
			if($this.err)
			{
				$('html,body').animate({scrollTop:$this.err.offset().top},'fast',function() {
				
					$this.err.focus();
					$this.ctrl = false;
				
				});
				
				return ;
			}
	
			$this.enviar.hide();
			$this.loading.css('display','block');
			
			$.post('ajax/ajax-login.php?'+Math.random(),{email:$this.email.val(),senha:$this.senha.val()},function(data) {
			
				if(!data) return ;
				
				if(data.s == 'err')
				{
					$this.loading.hide();
					$this.enviar.show();
					
					$this.email.parent().addClass('lineform-error');
					
					$this.erro.show();
					
					$('html,body').animate({scrollTop:$this.email.offset().top},'fast',function() {
				
						if(!$this.ctrl) return ;
					
						$this.email.focus();
						$this.ctrl = false;
				
					});
				}
				else
				{
					if(typeof __BK !== "undefined")
					{ document.location = _base+__BK+'/'; }
					else
					{ document.location = _base+'minha-conta/'; }
				}
				
			},'JSON');
		
		});
	
	}
	
};