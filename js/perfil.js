var perfil = {

	ctrl: false,
	err: false,
	cid: null,
	
	init: function() {
		
		this.info = $('#perfil-info');
		
		this.btn = $('#perfil-contato-btn');
		this.box = $('#perfil-contato-box');
		
		this.nome = $('#perfil-contato-nome');
		this.email = $('#perfil-contato-email');
		this.telefone = $('#perfil-contato-telefone');
		this.msg = $('#perfil-contato-msg');
		
		this.enviar = $('#perfil-contato-enviar');
		this.loading = $('#perfil-contato-loading');
		this.ok = $('#perfil-contato-ok');
		
		this.telefone.mask('(99) 9999-9999?9');
		
		this.run();
	
	},
	_reset: function() {
	
		this.nome.val(this.nome.prop('defaultValue'));
		this.email.val(this.email.prop('defaultValue'));
		this.telefone.val('');
		this.msg.val('');	
	
	},
	run: function() {
		
		var $this = this;
		
		this.info.on('click',function(e,fx) {
		
			e.preventDefault();
			
			if($this.info.data('control') !== undefined) return ;
			
			$this.info.data('control',1);
		
			$.post('ajax/ajax-perfil_ver_contato.php?'+Math.random(),{cid:$this.cid},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				$this.info.replaceWith('<span id="perfil-info" class="btn-item ativo">'+data.t+'</span>');
																																																 			},'JSON');
		
		});
		
		this.btn.on('click',function(e,fx) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			
			if($this.btn.hasClass('ativo'))
			{
				$this.box.slideUp(400,function() {
				
					$this.btn.removeClass('ativo');
				
					$this._reset();
					$('.lineform-error',$this.box).removeClass('lineform-error');
				
					$this.ctrl = false;
					
					if(fx) $('html,body').animate({scrollTop:$('#_perfil').offset().top},'fast');
				
				});
			}
			else
			{
				$this.btn.addClass('ativo');
				$this.box.slideDown(400,function() {
				
					$('html,body').animate({scrollTop:$this.box.offset().top},'fast',function() {
					
						$this.ctrl = false;
					
					});
				
				});
			}
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			if(!$this.nome.val())
			{
				$this.nome.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.nome;
			}
			
			if(!$this.email.val() || new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/).test($this.email.val()) === false)
			{
				$this.email.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.email;
			}
			
			if(!$this.telefone.val())
			{
				$this.telefone.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.telefone;
			}
			
			if(!$this.msg.val())
			{
				$this.msg.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.msg;
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
			
			$.post('ajax/ajax-perfil_enviar_contato.php?'+Math.random(),{cid:$this.cid,nome:$this.nome.val(),email:$this.email.val(),telefone:$this.telefone.val(),msg:$this.msg.val()},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				$this.loading.addClass('dnone');
				$this.ok.removeClass('dnone');
				
				$this._reset();
				
				$this.ctrl = false;
				
				setTimeout(function() {
				
					$this.ok.addClass('dnone');
					$this.enviar.removeClass('dnone');
					
					if($this.btn.hasClass('ativo')) $this.btn.trigger('click',[1]);
				
				},3000);
				
			},'JSON');
		
		});
	
	}
	
};