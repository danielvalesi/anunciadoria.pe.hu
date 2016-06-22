var cadastro_topo = {

	ctrl: false,
	err: false,
	
	init: function() {
		
		this.box = $('#cadastro-topo-box');
		this.tipo = $('.cadastro-topo-tipo');
		this.doc = $('#cadastro-topo-doc');
		this.nome = $('#cadastro-topo-nome');
		this.email = $('#cadastro-topo-email');
		this.senha = $('#cadastro-topo-senha');
		this.senha_confirmar = $('#cadastro-topo-senha-confirmar');
		this.senha_confirmar_erro = $('#cadastro-topo-senha-confirmar-erro');
		this.email_erro = $('#cadastro-topo-email-erro');
		this.telefone = $('#cadastro-topo-telefone');
		this.sobre = $('#cadastro-topo-sobre');
		this.termos = $('#cadastro-topo-termos');
		this.termos_erro = $('#cadastro-topo-termos-erro');
		this.termos_txt = $('#cadastro-topo-termosTXT');
		this.news = $('#cadastro-topo-news');
		
		this.cpf = $('#cadastro-topo-cpf');
		this.nascimento = $('#cadastro-topo-nascimento');
		this.cpf_erro = $('#cadastro-topo-cpf-erro');
		
		this.cnpj = $('#cadastro-topo-cnpj');
		this.razaoSocial = $('#cadastro-topo-razaoSocial');
		this.ie = $('#cadastro-topo-ie');
		this.ieIsento = $('#cadastro-topo-ieIsento');
		this.cnpj_erro = $('#cadastro-topo-cnpj-erro');
		
		this.fisica = $('.cadastro-topo-fisica');
		this.juridica = $('.cadastro-topo-juridica');
		
		this.enviar = $('#cadastro-topo-enviar');
		this.loading = $('#cadastro-topo-loading');
		this.ok = $('#cadastro-topo-ok');
		
		this.telefone.mask('(99) 9999-9999?9');
		this.nascimento.mask('99/99/9999');
		this.cpf.mask('999.999.999-99');
		this.cnpj.mask('99.999.9999999-99');
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
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
		
		this.tipo.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.tipo.removeClass('active');
			$(this).addClass('active');
		
		});
		
		this.doc.on('change',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			if($('option:selected',$this.doc).val() == 1)
			{
				$this.juridica.hide();
				
				$this.nome.attr('placeholder','Nome');
				
				$this.cnpj.val('');
				$this.razaoSocial.val('');
				$this.ie.removeAttr('disabled').val('');
				$this.ieIsento.prop('checked',0);
				$this.cnpj_erro.hide();
				
				$this.fisica.show();
			}
			else
			{
				$this.fisica.hide();
				
				$this.nome.attr('placeholder','Nome fantasia');
				
				$this.cpf.val('');
				$this.nascimento.val('');
				$this.cpf_erro.hide();
				
				$this.juridica.show();
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
			$this.termos_erro.hide();
			$this.senha_confirmar_erro.hide();
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			var _json = {};
			var _doc = $('option:selected',$this.doc).val();
			
			if(!$this.nome.val())
			{
				$this.nome.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.nome;
			}
			
			if(_doc == 1)
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
			
			if(_doc == 1)
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
			
			if(!$this.senha.val())
			{
				$this.senha.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.senha;
			}
			
			if(!$this.senha_confirmar.val())
			{
				$this.senha_confirmar.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.senha_confirmar;
			}
			
			if($this.senha.val() != $this.senha_confirmar.val())
			{
				$this.senha_confirmar_erro.show();
				if(!$this.err) $this.err = $this.senha_confirmar;
			}
			
			if(!$this.termos.prop('checked'))
			{
				$this.termos_erro.show();
				$this.termos_txt.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.termos_txt;
			}
			
			if($this.err)
			{
				$('html,body').animate({scrollTop:$this.err.offset().top},'fast',function() {
				
					$this.err.focus();
					$this.ctrl = false;
				
				});
				
				return ;
			}
			
			_json.tipo = $this.tipo.filter('.active').data('tipo');
			_json.nome = $this.nome.val();
			_json.email = $this.email.val();
			_json.telefone = $this.telefone.val();
			_json.senha = $this.senha.val();
			
			if($this.sobre.val()) _json.sobre = $this.sobre.val();
			if($this.news.prop('checked')) _json.news = 1;
			
			if(_doc == 1)
			{
				_json.cpf = $this.cpf.val();
				_json.nascimento = $this.nascimento.val();
			}
			else
			{
				_json.cnpj = $this.cnpj.val();
				_json.razaoSocial = $this.razaoSocial.val();
			}
			
			$this.enviar.hide();
			$this.loading.css('display','block');
			
			$.post('ajax/ajax-cadastro.php?'+Math.random(),_json,function(data) {
			
				if(!data) return ;
				
				if(data.s == 'ok')
				{
					document.location = _base+'cadastro/';
				}
				else if(data.s == 'err_email')
				{
					$this.loading.hide();
					$this.enviar.show();
					
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
					$this.loading.hide();
					$this.enviar.show();
					
					var _fixdoc;
					
					if(_doc == 1)
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
			
			},'JSON');
		
		});
	
	}
	
};