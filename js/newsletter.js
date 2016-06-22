var newsletter = {

	ctrl: false,
	err: false,
	
	init: function() {
		
		this.box = $('#newsletter-box');
		this.email = $('#newsletter-email');
		this.enviar = $('#newsletter-enviar');
		this.loading = $('#newsletter-loading');
		this.ok = $('#newsletter-ok');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		this.email.on('keyup',function(e) {
		
			if(e.which == 13) $this.enviar.trigger('click');
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			if(!$this.email.val() || new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/).test($this.email.val()) === false)
			{
				$this.email.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.box;
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
			
			$.post('ajax/ajax-newsletter.php?'+Math.random(),{email:$this.email.val()},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				$this.loading.addClass('dnone');
				$this.ok.removeClass('dnone');
				
				$this.ctrl = false;
				
				$this.email.val('');
				
				setTimeout(function() {
				
					$this.ok.addClass('dnone');
					$this.enviar.removeClass('dnone');
				
				},3000);
			
			},'JSON');
		
		});
	
	}
	
};