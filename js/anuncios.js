var anuncios = {

	ctrl: false,
	
	init: function() {
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		var _reset = function(cpai) {
			
			$('.perfil-contato-nome',cpai).val($('.perfil-contato-nome',cpai).prop('defaultValue'));
			$('.perfil-contato-email',cpai).val($('.perfil-contato-email',cpai).prop('defaultValue'));
			$('.perfil-contato-telefone',cpai).val('');
			$('.perfil-contato-msg',cpai).val('');
		
		};
		
		$('body').on('click','.perfil-contato-enviar',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._perfil-anuncio');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			var err = false;
			var box = $('._perfil-anuncio-box',cpai);
			var nome = $('.perfil-contato-nome',cpai);
			var email = $('.perfil-contato-email',cpai);
			var telefone = $('.perfil-contato-telefone',cpai);
			var msg = $('.perfil-contato-msg',cpai);
			var loading = $('.perfil-contato-loading',cpai);
			var ok = $('.perfil-contato-ok',cpai);
			var btn = $('._perfil-anuncio-msg',cpai);
			
			$('.lineform-error',box).removeClass('lineform-error');
			
			if(!nome.val())
			{
				nome.parent().addClass('lineform-error');
				if(!err) err = nome;
			}
			
			if(!email.val() || new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/).test(email.val()) === false)
			{
				email.parent().addClass('lineform-error');
				if(!err) err = email;
			}
			
			if(!telefone.val())
			{
				telefone.parent().addClass('lineform-error');
				if(!err) err = telefone;
			}
			
			if(!msg.val())
			{
				msg.parent().addClass('lineform-error');
				if(!err) err = msg;
			}
			
			if(err)
			{
				$('html,body').animate({scrollTop:err.offset().top},'fast',function() {
				
					err.focus();
					cpai.data('control',0);
				
				});
				
				return ;
			}
	
			own.addClass('dnone');
			loading.removeClass('dnone');
			
			$.post('ajax/ajax-anuncio_enviar_contato.php?'+Math.random(),{aid:cpai.data('aid'),nome:nome.val(),email:email.val(),telefone:telefone.val(),msg:msg.val()},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				loading.addClass('dnone');
				ok.removeClass('dnone');
				
				_reset(cpai);
				
				cpai.data('control',0);
				
				setTimeout(function() {
				
					ok.addClass('dnone');
					own.removeClass('dnone');
					
					if(btn.hasClass('ativo')) btn.trigger('click',[1]);
				
				},3000);
				
			},'JSON');
		
		}).on('click','._perfil-anuncio-msg',function(e,fx) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._perfil-anuncio');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			var box = $('._perfil-anuncio-box',cpai);
			
			if(own.hasClass('ativo'))
			{
				box.slideUp(400,function() {
				
					own.removeClass('ativo');
				
					_reset(cpai);
					$('.lineform-error',box).removeClass('lineform-error');
				
					cpai.data('control',0);
					
					if(fx) $('html,body').animate({scrollTop:cpai.offset().top},'fast');
				
				});
			}
			else
			{
				var telefone = $('.perfil-contato-telefone',cpai);
				if(telefone.data('mks') === undefined)
				{
					telefone.mask('(99) 9999-9999?9');
					telefone.data('mks',1);
				}
				
				own.addClass('ativo');
				box.slideDown(400,function() {
				
					$('html,body').animate({scrollTop:box.offset().top},'fast',function() {
					
						cpai.data('control',0);
					
					});
				
				});
			}
		
		}).on('click','._perfil-anuncio-contato',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._perfil-anuncio');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
		
			$.post('ajax/ajax-anuncio_ver_contato.php?'+Math.random(),{aid:cpai.data('aid')},function(data) {
			
				if(!data || data.s != 'ok') return ;
				
				own.replaceWith('<span class="btn-item ativo">'+data.t+'</span>');
				cpai.data('control',0);
																																																 			},'JSON');
		
		}).on('click','._perfil-anuncio-foto-dir',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._perfil-anuncio');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			var foto = $('._perfil-anuncio-foto',cpai);
			var loading = $('._perfil-anuncio-foto-loading',cpai);
			var over = $('._perfil-anuncio-foto-over',cpai);
			var _fotos = cpai.data('fotos');
			var _ix = parseInt(cpai.data('ix'))+1;
			
			if($('._perfil-anuncio-foto-esq',cpai).hasClass('dnone')) $('._perfil-anuncio-foto-esq',cpai).removeClass('dnone');
			
			if(_ix == (_fotos.length-1)) own.addClass('dnone');
			
			over.fadeIn('fast',function() {
			
				loading.removeClass('dnone');
				
				foto.on('load',function() {
											  
					loading.addClass('dnone');
					over.fadeOut('fast',function() {
					
						cpai.data('ix',_ix);
						cpai.data('control',0);
					
					});
				
				});
				
				setTimeout(function() { foto.attr('src','fotos/anuncios/'+_fotos[_ix]); },50);
			
			});
			
		}).on('click','._perfil-anuncio-foto-esq',function(e) {
		
			e.preventDefault();
			
			var own = $(this);
			var cpai = own.closest('._perfil-anuncio');
			var control = cpai.data('control');
			
			if(control !== undefined && control) return ;
			
			cpai.data('control',1);
			
			var foto = $('._perfil-anuncio-foto',cpai);
			var loading = $('._perfil-anuncio-foto-loading',cpai);
			var over = $('._perfil-anuncio-foto-over',cpai);
			var _fotos = cpai.data('fotos');
			var _ix = parseInt(cpai.data('ix'))-1;
			
			if($('._perfil-anuncio-foto-dir',cpai).hasClass('dnone')) $('._perfil-anuncio-foto-dir',cpai).removeClass('dnone');
			
			if(_ix == 0) own.addClass('dnone');
			
			over.fadeIn('fast',function() {
			
				loading.removeClass('dnone');
				
				foto.on('load',function() {
											  
					loading.addClass('dnone');
					over.fadeOut('fast',function() {
					
						cpai.data('ix',_ix);
						cpai.data('control',0);
					
					});
				
				});
				
				setTimeout(function() { foto.attr('src','fotos/anuncios/'+_fotos[_ix]); },50);
			
			});
			
		});
		
	}
	
};