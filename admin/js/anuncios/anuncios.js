$(function() {
		   
	var _busca = $('#_busca');
	var _busca_btn = $('#_busca-btn');
	
	$('._anuncio-motivo-enviar').on('click',function(e) {
	
		e.preventDefault();
		
		var own = $(this);
		var cpai = own.closest('.contact_people');
			
		var control = cpai.data('control');
		
		if(control !== undefined && control == 1) return ;
		
		cpai.data('control',1);
		
		var msg = $('._anuncio-motivo-msg',cpai);
	
		if(!msg.val())
		{
			$('html,body').animate({scrollTop:msg.offset().top},'fast',function() {
			
				if(cpai.data('control') == 0) return ;
			
				msg.focus();
				cpai.data('control',0);
			
			});
			
			return ;
		}
	
		var loading = $('._anuncio-motivo-loading',cpai);
		var ok = $('._anuncio-motivo-ok',cpai);
	
		own.hide();
		loading.show();
		
		$.post('ajax/anuncios/ajax-enviar_motivo.php?'+Math.random(),{aid:cpai.data('aid'),msg:msg.val()},function(data) {
		
			if(!data || data.s != 'ok') return ;
			
			loading.hide();
			ok.show();
			
			setTimeout(function() { document.location = _base+$('._tstatus',cpai).filter('.btn-primary').attr('href'); },2000);
							 
		},'JSON');
	
	});
	
	$('._tstatus').on('click',function(e) {
	
		e.preventDefault();
		
		var own = $(this);
		
		if(own.hasClass('btn-primary'))
		{
			var cpai = own.closest('.contact_people');
			
			var control = cpai.data('control');
		
			if(control !== undefined && control == 1) return ;
			
			cpai.data('control',1);
			
			var anuncio_motivo = $('._anuncio-motivo',cpai);
			
			anuncio_motivo.slideDown(400,function() {
			
				$('html,body').animate({scrollTop:anuncio_motivo.offset().top-60},400,function() {
													   
					$('textarea:eq(0)',anuncio_motivo).focus();
					cpai.data('control',0);
				
				});
			
			});
		}
		else
		{
			if(confirm('Confirmar ?')) document.location = _base+$(this).attr('href');
		}
	
	});
	
	_busca_btn.on('click',function(e) {
	
		e.preventDefault();
		
		if(!_busca.val())
		{
			_busca.focus();
			return ;
		}
		
		document.location = _base+'anuncios/'+$('#_purl').val()+'/?q='+urlencode(_busca.val());
	
	});
	
	_busca.on('keyup',function(e) {
	
		if(e.which == 13) _busca_btn.trigger('click');
	
	});

	$('._anuncio-cats-btn').on('click',function(e) {
		
		e.preventDefault();
	
		var own = $(this);
		var cpai = own.closest('.contact_people');
		var control = cpai.data('control');
		
		if(control !== undefined && control == 1) return ;
		
		cpai.data('control',1);
		
		var box = $('._anuncio-cats-box',cpai);
		
		if(box.is(':visible'))
		{
			box.slideUp(400,function() {
			
				$('>i',own).addClass('fa-plus-square-o').removeClass('fa-minus-square-o');
				cpai.data('control',0);	
			
			});
		}
		else
		{
			$('>i',own).addClass('fa-minus-square-o').removeClass('fa-plus-square-o');
			box.slideDown(400,function() {
			
				cpai.data('control',0);	
			
			});
		}
	
	});

});