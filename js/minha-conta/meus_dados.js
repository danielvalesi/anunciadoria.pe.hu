var meus_dados = {

	ctrl: false,
	err: false,
	
	init: function() {
		
		this.box = $('#cadastro-box');
		
		this.senhaAtual = $('#cadastro-senhaAtual');
		this.senhaNova = $('#cadastro-senhaNova');
		this.senhaNovaConfirmar = $('#cadastro-senhaNovaConfirmar');
		this.senhaAtual_erro = $('#cadastro-senhaAtual-erro');
		
		this.nome = $('#cadastro-nome');
		this.email = $('#cadastro-email');
		this.email_erro = $('#cadastro-email-erro');
		this.telefone = $('#cadastro-telefone');
		this.sobre = $('#cadastro-sobre');
		
		this.url = $('#cadastro-url');
		this.url_erro = $('#cadastro-url-erro');
		this.url_view1 = $('#cadastro-url-view1');
		this.url_view2 = $('#cadastro-url-view2');
		
		this.cpf = $('#cadastro-cpf');
		this.nascimento = $('#cadastro-nascimento');
		this.cpf_erro = $('#cadastro-cpf-erro');
		
		this.cnpj = $('#cadastro-cnpj');
		this.razaoSocial = $('#cadastro-razaoSocial');
		this.ie = $('#cadastro-ie');
		this.ieIsento = $('#cadastro-ieIsento');
		this.cnpj_erro = $('#cadastro-cnpj-erro');
		
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
		this.ck = this.cpf.is(':visible');
		
		if(this.ck)
		{
			this.nascimento.mask('99/99/9999');
			this.cpf.mask('999.999.999-99');
		}
		else
		{
			this.cnpj.mask('99.999.9999999-99');
		}
		
		this.telefone.mask('(99) 9999-9999?9');
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
		
		var _fx;
		
		this.url.on('keyup',function(e) {
		
			if(!_fx)
			{
				_fx = setTimeout(function() {
				
					$this.url.val(__urlAmigavel($this.url.val()));
					clearTimeout(_fx);
					
					if($this.url_view1.hasClass('dnone')) $this.url_view1.removeClass('dnone');
					
					$this.url_view2.html($this.url.val());
					
					_fx = false;
				
				},1000);
			}
		
		}).on('keypress',function(e) {
		
			if($this.ctrl)
			{
				e.preventDefault();
				return ;
			}
		
		});
		
		this.ieIsento.on('click',function(e) {
		
			if($this.ctrl)
			{
				e.preventDefault();
				return ;
			}
			
			if($this.ieIsento.prop('checked'))
			{
				$this.ie.attr('disabled',1).val('');
			}
			else
			{
				$this.ie.removeAttr('disabled');
			}
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$this.email_erro.hide();
			$this.cpf_erro.hide();
			$this.cnpj_erro.hide();
			$this.cep_erro.hide();
			$this.url_erro.hide();
			$this.senhaAtual_erro.hide();
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			var _json = {};
			
			if($this.ck)
			{
				if(!$this.cpf.val() || !verificaCPF($this.cpf.val()))
				{
					$this.cpf.parent().addClass('lineform-error');
					if(!$this.err) $this.err = $this.cpf;
				}
			}
			else
			{
				if(!$this.cnpj.val() || !verificaCNPJ($this.cnpj.val()))
				{
					$this.cnpj.parent().addClass('lineform-error');
					if(!$this.err) $this.err = $this.cnpj;
				}
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
			
			if($this.ck)
			{
				if(!$this.nascimento.val())
				{
					$this.nascimento.parent().addClass('lineform-error');
					if(!$this.err) $this.err = $this.nascimento;
				}
			}
			else
			{
				if(!$this.razaoSocial.val())
				{
					$this.razaoSocial.parent().addClass('lineform-error');
					if(!$this.err) $this.err = $this.razaoSocial;
				}
				
				if(!$this.ieIsento.prop('checked'))
				{	
					if(!$this.ie.val())
					{
						$this.ie.parent().addClass('lineform-error');
						if(!$this.err) $this.err = $this.ie;
					}
					else
					{
						_json.ie = $this.ie.val();
					}
						
				}
			}
			
			if($this.senhaAtual.val())
			{
				_json.senhaAtual = $this.senhaAtual.val();
				
				if(!$this.senhaNova.val())
				{
					$this.senhaNova.parent().addClass('lineform-error');
					if(!$this.err) $this.err = $this.senhaNova;
				}
				
				if(!$this.senhaNovaConfirmar.val() || $this.senhaNova.val()!=$this.senhaNovaConfirmar.val())
				{
					$this.senhaNovaConfirmar.parent().addClass('lineform-error');
					if(!$this.err) $this.err = $this.senhaNovaConfirmar;
				}
				else
				{
					_json.senhaNova = $this.senhaNova.val();
				}
			}
			
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
			
			if($this.ck)
			{
				_json.cpf = $this.cpf.val();
				_json.nascimento = $this.nascimento.val();
			}
			else
			{
				_json.cnpj = $this.cnpj.val();
				_json.razaoSocial = $this.razaoSocial.val();
			}
			
			_json.nome = $this.nome.val();
			_json.email = $this.email.val();
			_json.telefone = $this.telefone.val();
			_json.cep = $this.cep.val();
			_json.rua = $this.rua.val();
			_json.numero = $this.numero.val();
			_json.bairro = $this.bairro.val();
			_json.cidade = $this.cidade.val();
			_json.estado = $this.estado.val();
			_json.i = [];
			
			var _url = $this.foto.data('url');
			
			if($this.url.val()) _json.url = $this.url.val();
			if($this.sobre.val()) _json.sobre = $this.sobre.val();
			if($this.complemento.val()) _json.complemento = $this.complemento.val();
			if(_url !== undefined && _url) _json.foto = _url;
	
			$this.items.filter(':checked').each(function() { _json.i.push($(this).val()); });
	
			$this.enviar.addClass('dnone');
			$this.loading.removeClass('dnone');
			
			$.post('ajax/minha-conta/ajax-meus_dados.php?'+Math.random(),_json,function(data) {
			
				if(!data) return ;
				
				if(data.s == 'err')
				{
					document.location = _base+'login/';
				}
				else if(data.s == 'err_senha')
				{
					$this.loading.addClass('dnone');
					$this.enviar.removeClass('dnone');
					
					$this.senhaAtual.parent().addClass('lineform-error');
					
					$this.senhaAtual_erro.show();
					
					$('html,body').animate({scrollTop:$this.senhaAtual.offset().top},'fast',function() {
				
						if(!$this.ctrl) return ;
					
						$this.senhaAtual.focus();
						$this.ctrl = false;
				
					});
				}
				else if(data.s == 'err_url')
				{
					$this.loading.addClass('dnone');
					$this.enviar.removeClass('dnone');
					
					$this.url.parent().addClass('lineform-error');
					
					$this.url_erro.show();
					
					$('html,body').animate({scrollTop:$this.url.offset().top},'fast',function() {
				
						if(!$this.ctrl) return ;
					
						$this.url.focus();
						$this.ctrl = false;
				
					});
				}
				else if(data.s == 'err_email')
				{
					$this.loading.addClass('dnone');
					$this.enviar.removeClass('dnone');
					
					$this.email.parent().addClass('lineform-error');
					
					$this.email_erro.show();
					
					$('html,body').animate({scrollTop:$this.email.offset().top},'fast',function() {
				
						if(!$this.ctrl) return ;
					
						$this.email.focus();
						$this.ctrl = false;
				
					});
				}
				else if(data.s == 'err_doc')
				{
					$this.loading.addClass('dnone');
					$this.enviar.removeClass('dnone');
					
					var _fixdoc;
					
					if(_json.tipo == 1)
					{
						_fixdoc = $this.cpf;
						$this.cpf_erro.show();
					}
					else
					{
						_fixdoc = $this.cnpj;
						$this.cnpj_erro.show();
					}
					
					_fixdoc.parent().addClass('lineform-error');
					
					$('html,body').animate({scrollTop:_fixdoc.offset().top},'fast',function() {
				
						if(!$this.ctrl) return ;
					
						_fixdoc.focus();
						$this.ctrl = false;
				
					});
				}
				else
				{
					if(typeof _json.senhaAtual !== "undefined")
					{
						$this.senhaAtual.val('');
						$this.senhaNova.val('');
						$this.senhaNovaConfirmar.val('');
					}
					
					$this.loading.addClass('dnone');
					$this.ok.removeClass('dnone');
					
					$this.ctrl = false;
					
					setTimeout(function() {
					
						$this.ok.addClass('dnone');
						$this.enviar.removeClass('dnone');
					
					},3000);
				}
				
			},'JSON');
		
		});
	
	}
	
};