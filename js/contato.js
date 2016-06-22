var contato = {

	ctrl: false,
	err: false,
	def: null,
	
	init: function() {
		
		this.box = $('#contato-box');
		this.tipo = $('#contato-tipo');
		this.nome = $('#contato-nome');
		this.email = $('#contato-email');
		this.assunto = $('#contato-assunto');
		this.telefone = $('#contato-telefone');
		this.msg = $('#contato-msg');
		this.enviar = $('#contato-enviar');
		this.loading = $('#contato-loading');
		this.ok = $('#contato-ok');
		
		this.telefone.mask('(99) 9999-9999?9');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		if(this.def)
		{
			this.assunto.prop('selectedIndex',this.def);
			setTimeout(function() { $this.assunto.trigger('change'); },20);
		}
		
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
			
			if($this.err)
			{
				$('html,body').animate({scrollTop:$this.err.offset().top},'fast',function() {
				
					$this.err.focus();
					$this.ctrl = false;
				
				});
				
				return ;
			}
			
			var _json = {tipo:$this.tipo.val(),nome:$this.nome.val(),email:$this.email.val()};
			
			if($this.telefone.val()) _json.telefone = $this.telefone.val();
			if($('option:selected',$this.assunto).val()) _json.assunto = $('option:selected',$this.assunto).val();
			if($this.msg.val()) _json.msg = $this.msg.val();
			
			$this.enviar.hide();
			$this.loading.css('display','block');
			
			$.post('ajax/ajax-contato.php?'+Math.random(),_json,function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				$this.loading.hide();
				$this.ok.css('display','block');
				
				$this.ctrl = false;
				
				$this.nome.val('');
				$this.email.val('');
				$this.telefone.val('');
				$this.msg.val('');
				$this.assunto.prop('selectedIndex',0).prev('span:eq(0)').html($this.assunto.data('def'));
				
				setTimeout(function() {
				
					$this.ok.hide();
					$this.enviar.css('display','block');
				
				},3000);
			
			},'JSON');
		
		});
	
	}
	
};