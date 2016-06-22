var cadastrar_anuncio = {

	ctrl: false,
	err: false,
	aid: null,
	
	init: function() {
		
		this.box = $('#cadastro-box');
		
		this.titulo = $('#cadastro-titulo');
		this.telefone = $('#cadastro-telefone');
		this.valor = $('#cadastro-valor');
		this.valorTipo = $('#cadastro-valorTipo');
		this.descricao = $('#cadastro-descricao');
		
		this.cep = $('#cadastro-endereco-cep');
		this.cep_erro = $('#cadastro-endereco-cep-erro');
		this.rua = $('#cadastro-endereco-rua');
		this.numero = $('#cadastro-endereco-numero');
		this.bairro = $('#cadastro-endereco-bairro');
		this.complemento = $('#cadastro-endereco-complemento');
		this.estado = $('#cadastro-endereco-estado');
		this.cidade = $('#cadastro-endereco-cidade');
		this.items = $('._interesses-item');
		this.fotos = $('._upload-view');
		
		this.extra = $('#cadastro-endereco-extra');
		this.bairro_txt = $('#cadastro-endereco-bairro-txt');
		
		this.enviar = $('#cadastro-enviar');
		this.loading = $('#cadastro-loading');
		this.ok = $('#cadastro-ok');
		
		this.telefone.mask('(99) 9999-9999?9');
		this.cep.mask('99999-999');
		this.valor.maskMoney({prefix:'', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
		
		_uploadFoto.json._act = 2;
		_uploadFoto.aspect = 200/125;
		_uploadFoto.txt = 'Foto do an&uacute;ncio';
		_uploadFoto.__callback = function() {
		
			$('.a-icon-foto-del',_uploadFoto._o).removeClass('dnone');
		
			_uploadFoto.end();
			_uploadFoto.ctrl = false;
		
		};
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
			
			if(data.i.extra !== undefined)
			{
				$this.extra.removeClass('dnone');
			}
			else
			{
				if(!$this.extra.hasClass('dnone')) $this.extra.addClass('dnone');
				$this.bairro_txt.val('');
			}
					
			$this.estado.val(data.i.estado);
			$this.cidade.val(data.i.cidade);
				
		},'JSON');
	
	},
	run: function() {
		
		var $this = this;
		
		var _val = $this.valorTipo.data('val');
		
		if(_val !== undefined)
		{
			$this.valorTipo.val(_val);
			setTimeout(function() { $this.valorTipo.trigger('change'); },20);
		}
		
		this.cep.on('keypress',function(e) {
		
			if($this.ctrl) return ;
			
			if(e.which == 13 && String($this.cep.val()).replace(/[_-]/g,'').length == 8) $this.__cep();
		
		}).on('keyup',function(e) {
		
			var lens = String($this.cep.val()).replace(/[_-]/g,'').length;
			
			if($this.ctrl || !((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) || lens < 8) return false;
			
			$this.__cep();
		
		});
		
		$('.a-icon-foto-del').on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
		
			var own = $(this);
			var cpai = own.closest('._upload-box');
			
			$('._upload-view',cpai).attr('src','fotos/sem-foto-anuncio.jpg').data('url','');
			own.addClass('dnone');
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			$this.err = false;
			
			$this.cep_erro.hide();
			$('.lineform-error',$this.box).removeClass('lineform-error');
			
			if(!$this.titulo.val())
			{
				$this.titulo.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.titulo;
			}
			
			if(!$this.telefone.val())
			{
				$this.telefone.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.telefone;
			}
			
			/*if(!$this.valor.val())
			{
				$this.valor.parent().addClass('lineform-error');
				if(!$this.err) $this.err = $this.valor;
			}*/
			
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
			
			var _json = {titulo:$this.titulo.val(),telefone:$this.telefone.val(),cep:$this.cep.val(),rua:$this.rua.val(),numero:$this.numero.val(),bairro:$this.bairro.val(),cidade:$this.cidade.val(),estado:$this.estado.val(),i:[],f:[]};
			
			if($this.aid) _json.aid = $this.aid;
			
			if($this.valor.val()) _json.valor = ConverterDinheiro($this.valor.val());
			if($('option:selected',$this.valorTipo).val()) _json.valorTipo = $('option:selected',$this.valorTipo).val();
			if($this.descricao.val()) _json.descricao = $this.descricao.val();
			if($this.complemento.val()) _json.complemento = $this.complemento.val();
			if($this.extra.is(':visible') && $this.bairro_txt.val()) _json.bairro_txt = $this.bairro_txt.val();
	
			$this.items.filter(':checked').each(function() { _json.i.push($(this).val()); });
			
			$this.fotos.each(function() {
			
				var own = $(this);
				var _url = own.data('url');
				
				if(_url !== undefined && _url) _json.f.push(_url);
			
			});
			
			var _url = ($this.aid)?'editar':'cadastrar';
	
			$this.enviar.addClass('dnone');
			$this.loading.removeClass('dnone');
			
			$.post('ajax/minha-conta/ajax-'+_url+'_anuncio.php?'+Math.random(),_json,function(data) {
			
				if(!data) return ;
				
				if(data.s == 'err')
				{
					document.location = _base+'login/';
				}
				else
				{
					$this.loading.addClass('dnone');
					$this.ok.removeClass('dnone');
					
					if(!$this.aid)
					{
						$this.titulo.val('');
						$this.telefone.val('');
						$this.valor.val('');
						$this.valorTipo.prop('selectedIndex',0).prev('span:eq(0)').html($this.valorTipo.data('def'));
						$this.descricao.val('');
						$this.cep.val('');
						$this.rua.val('');
						$this.numero.val('');
						$this.bairro.val('');
						$this.complemento.val('');
						$this.estado.val('');
						$this.cidade.val('');
						$this.bairro_txt.val('');
						if(!$this.extra.hasClass('dnone')) $this.extra.addClass('dnone');
						if(sugerir_segmento.check.prop('checked')) sugerir_segmento.check.trigger('click');
						$('.listas2 input[type=checkbox]').prop('checked',0);
						$this.fotos.attr('src','fotos/sem-foto-anuncio.jpg').data('url','');
					}
					
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