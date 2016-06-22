var cadastro = {

	ctrl: false,
	err: false,
	
	init: function() {
		
		this.box = $('#cadastro-box');
		this.foto = $('#cadastro-foto');
		this.cep = $('#cadastro-endereco-cep');
		this.cep_erro = $('#cadastro-endereco-cep-erro');
		this.rua = $('#cadastro-endereco-rua');
		this.numero = $('#cadastro-endereco-numero');
		this.bairro = $('#cadastro-endereco-bairro');
		this.complemento = $('#cadastro-endereco-complemento');
		this.estado = $('#cadastro-endereco-estado');
		this.cidade = $('#cadastro-endereco-cidade');
		this.items = $('._interesses-item');
		
		this.enviar = $('#cadastro-enviar');
		this.loading = $('#cadastro-loading');
		this.ok = $('#cadastro-ok');
		this.ok_email = $('#cadastro-ok-email');
		
		this.cep.mask('99999-999');
		
		_uploadFoto.json._act = 1;
		_uploadFoto.aspect = 1;
		_uploadFoto.txt = 'Foto de perfil';
		_uploadFoto.init();
		
		this.run();
	
	},
	__cep: function() {
	
		$this = this;
		
		this.ctrl = true;
			
		$('.lineform-error',$this.box).removeClass('lineform-error');
		
		this.cep_erro.hide();
				
		$.post('ajax/ajax-cep.php?'+Math.random(),{cep:$this.cep.val()},function(data) {
																									   
			if(!data) return false;
			
			$this.ctrl = false;
					
			if(data.s == 'err')
			{
				$this.rua.val('');
				$this.bairro.val('');
				$this.estado.val('');
				$this.cidade.val('');
				
				$this.cep.parent().addClass('lineform-error');
				$this.cep_erro.show();
						
				return ;
			}
					
			if(data.i.endereco !== undefined)
			{ $this.rua.val(data.i.endereco); }
			else
			{ $this.rua.val(''); }
			
			if(data.i.bairro !== undefined)
			{ $this.bairro.val(data.i.bairro); }
			else
			{ $this.bairro.val(''); }
					
			$this.estado.val(data.i.estado);
			$this.cidade.val(data.i.cidade);
				
		},'JSON');
	
	},
	run: function() {
		
		var $this = this;
		
		this.cep.on('keypress',function(e) {
		
			if($this.ctrl) return ;
			
			if(e.which == 13 && String($this.cep.val()).replace(/[_-]/g,'').length == 8) $this.__cep();
		
		}).on('keyup',function(e) {
		
			var lens = String($this.cep.val()).replace(/[_-]/g,'').length;
			
			if($this.ctrl || !((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) || lens < 8) return false;
			
			$this.__cep();
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$this.cep_erro.hide();
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			var _json = {};
			
			if(!$this.cep.val())
			{
				$this.cep.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.cep;
			}
			
			if(!$this.rua.val())
			{
				$this.rua.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.rua;
			}
			
			if(!$this.numero.val())
			{
				$this.numero.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.numero;
			}
			
			if(!$this.bairro.val())
			{
				$this.bairro.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.bairro;
			}
			
			if(!$this.estado.val())
			{
				$this.estado.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.estado;
			}
			
			if(!$this.cidade.val())
			{
				$this.cidade.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.cidade;
			}
			
			if($this.err)
			{
				$('html,body').animate({scrollTop:$this.err.offset().top},'fast',function() {
				
					$this.err.focus();
					$this.ctrl = false;
				
				});
				
				return ;
			}
			
			var _json = {cep:$this.cep.val(),rua:$this.rua.val(),numero:$this.numero.val(),bairro:$this.bairro.val(),cidade:$this.cidade.val(),estado:$this.estado.val(),i:[]};
			var _url = $this.foto.data('url');
			
			if($this.complemento.val()) _json.complemento = $this.complemento.val();
			if(_url !== undefined && _url) _json.foto = _url;
	
			$this.items.filter(':checked').each(function() { _json.i.push($(this).val()); });
	
			$this.enviar.hide();
			$this.loading.removeClass('dnone');
			
			$.post('ajax/ajax-cadastro02.php?'+Math.random(),_json,function(data) {
			
				if(!data) return ;
				
				if(data.s == 'err')
				{
					document.location = _base+'login/';
				}
				else
				{
					$this.ok_email.text(data.email);
					
					$this.box.slideUp(700,function() {
					
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