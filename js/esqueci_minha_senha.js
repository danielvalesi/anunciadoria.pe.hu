var esqueci_minha_senha = {

	ctrl: false,
	
	init: function() {
	
		this.email = $('#esqueci-senha-email');
		this.enviar = $('#esqueci-senha-enviar');
		this.loading = $('#esqueci-senha-loading');
		this.ok = $('#esqueci-senha-ok');
		this.ok_email = $('#esqueci-senha-ok-email');
		this.erro = $('#esqueci-senha-erro');
		this.box = $('#esqueci-senha-box');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		$('input[id^=esqueci-senha]',this.box).on('keyup',function(e) {
		
			if(e.which == 13) $this.enviar.trigger('click');
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			
			$('.lineform-error',$this.box).removeClass('lineform-error');
			$this.erro.hide();
			
			if(!$this.email.val() || new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/).test($this.email.val()) === false)
			{
				$this.email.parent().addClass('lineform-error');
				
				$('html,body').animate({scrollTop:$this.box.offset().top},'fast',function() {
				
					if(!$this.ctrl) return ;
				
					$this.email.focus();
					$this.ctrl = false;
				
				});
				
				return ;
			}
			
			var _json = {email:$this.email.val()};
		
			$this.enviar.addClass('dnone');
			$this.loading.removeClass('dnone');
			
			$.post('ajax/ajax-esqueci_minha_senha.php?'+Math.random(),_json,function(data) {
			
				if(!data) return ;
				
				if(data.s == 'err')
				{
					$this.loading.addClass('dnone');
					$this.enviar.removeClass('dnone');
					
					$this.email.parent().addClass('lineform-error');
					$this.erro.css('display','block');
				
					$('html,body').animate({scrollTop:$this.box.offset().top},'fast',function() {
					
						if(!$this.ctrl) return ;
					
						$this.email.focus();
						$this.ctrl = false;
					
					});
				}
				else
				{
					$this.ok_email.text(_json.email);
					
					$this.box.slideUp(400,function() {
					
						$this.ok.slideDown(500);
						
						$('html,body').animate({scrollTop:$this.ok.offset().top},500,function() {
					
							if(!$this.ctrl) return ;
					
							$this.ctrl = false;
						
						});
					
					});
				}
				
			},'JSON');
			
		});
		
	}

};