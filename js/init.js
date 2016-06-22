$(function() {
	
	var _fx;
	var _topo = $('#_topo');
	var _topo_cadastro_login = $('._topo-cadastro-login');
	var _select = $('select');
	
	_select.each(function() {
	
		var own = $(this);
		var _span = own.prev('span:eq(0)');
		
		own.data('def',_span.html());
		own.data('c',0);
		
		var _selfx = $('option:selected',own);
		
		if(_selfx.val()) _span.html(_selfx.html());
	
	});
	
	_select.on('change',function(e) {
	
		var own = $(this);
		
		if(_ctrl || own.data('c') == 1)
		{
			e.preventDefault();
			return ;
		}
		
		var _span = own.prev('span:eq(0)');
		var _val = $('option:selected',own);
		
		if(_val.val())
		{
			_span.html(_val.html());
		}
		else
		{
			_span.html(own.data('def'));
		}
	
	});
	
	$('[data-scid]').on('click',function(e) {
	
		e.preventDefault();
		
		var own = $(this);
		var scid = own.data('scid');
		var nx = $('#'+scid);
		
		if(_ctrl || nx.length == 0) return ;
		
		_fx = true;
		
		var _speed = (scid == '_cadastro' && _device == 2)?1200:400;
		var fix;
		
		var sc = function() {
		
			$('html,body').animate({scrollTop:nx.offset().top},400,function() {
					
				if(fix) return ;
				
				_fx = false;
				fix = true;
					
				if(scid == '_cadastro')
				{
					
				}
				else if(scid == '_login')
				{
					login_topo.email.focus();
				}
				else if(scid == '_contato')
				{
					contato.nome.focus();
				}
					
			});
		
		};
		
		if(!nx.is(':visible'))
		{
			if(_menu.hasClass('active'))
			{
				_menu_box.animate({left:'-300px'},400,function() {
				
					_menu.removeClass('active');
				
					nx.slideDown(_speed,function() {
				
						sc();
				
					});
				
				});
			}
			else
			{
				nx.slideDown(400,function() {
				
					sc();
				
				});
			}
		}
		else
		{
			if(_menu.hasClass('active'))
			{
				_menu_box.animate({left:'-300px'},400,function() {
				
					_menu.removeClass('active');
					sc();
				
				});
			}
			else
			{
				sc();
			}
		}
	
	});
	
	var _menu_ctrl = false;
	var _menu = $('#_menu');
	var _menu_box = $('#_menu-box');
	var _menu_fechar = $('#_menu-fechar');
	var _reseta = function() {
	
		_topo_cadastro_login.hide();
		//setTimeout(function() { $(window).scrollTop(0); },50);
		$(window).scrollTop(0);
		login_topo.resetar();
		
		setTimeout(function() {
		
			if($(window).scrollTop() != 0)
			{
				_reseta();
			}
		
		},100);
	
	};
	
	if(_device < 3) _menu_box.css('height',$(window).height());
	
	_menu_fechar.on('click',function(e) {
	
		e.preventDefault();
		
		_menu.trigger('click');
	
	});
	
	_menu.on('click',function(e) {
	
		e.preventDefault();
		
		if(_menu_ctrl) return ;
		
		_menu_ctrl = true;
		
		if(_menu.hasClass('active'))
		{
			_menu_box.animate({left:'-300px'},400,function() {
															 
				_menu.removeClass('active');
				_menu_ctrl = false;
				
			});
		}
		else
		{
			if(_topo_cadastro_login.is(':visible')) _reseta();
			
			_menu.addClass('active');
			_menu_box.animate({left:'0px'},400,function() {
															 
				_menu_ctrl = false;
				
			});
		}
	
	});
	
	$(window).on('scroll',function() {
	
		if(!_fx && _topo_cadastro_login.is(':visible') && $(this).scrollTop() >= _topo.offset().top) _reseta();
	
	}).on('resize',function() {
	
		if(_device < 3) _menu_box.css('height',$(window).height());
	
	}).on('load',function() {
	
		var _url = String(document.location);
		
		if(_url.indexOf('contato') !== -1) setTimeout(function() { $('[data-scid="_contato"]').trigger('click'); },300);
		else if(_url.indexOf('login') !== -1) setTimeout(function() { $('[data-scid="_login"]').trigger('click'); },300);
		else if(_url.indexOf('video') !== -1) setTimeout(function() { $('[data-scid="_video"]').trigger('click'); },300);
	
	});

});