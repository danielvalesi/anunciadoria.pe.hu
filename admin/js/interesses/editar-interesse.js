$(function() {

	var _err;
	var _ctrl;
	var _cid = $('#_cid');
	var _nome = $('#_nome');
	var _add = $('#_subcategoria-add');
	var _items = $('#_items');
	var _enviar = $('#_enviar');
	var _loading = $('#_loading');
	var _ok = $('#_ok');
	var _dels = [];
	
	_add.on('click',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		var _html = $('<div class="form-group"><label>Nome da sub interesse</label><div class="row"><div class="col-sm-8"><input type="text" class="form-control _subcategoria" required="" parsley-trigger="change" name="nick"></div><div class="col-sm-4"><button type="button" class="btn btn-danger btn-block _subcategoria-remover">Remover</button></div></div><div class="clear_both"></div></div>');
		
		_items.append(_html);
		
		var _fix;
		
		setTimeout(function() {
		
			$('html,body').animate({scrollTop:_html.offset().top-80},'fast',function() {
			
				if(_fix) return ;
				
				_fix = true;
			
				$('input[type=text]:eq(0)',_html).focus();
			
			});
							
		},50);
	
	});
	
	$('body').on('click','._subcategoria-remover',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		var own = $(this);
		var cpai = own.closest('.form-group');
		var sid = $('input[type=text]',cpai).data('sid');
		
		if(sid !== undefined) _dels.push(sid);
		
		cpai.remove();
	
	});
	
	_enviar.on('click',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		$('.has-error').removeClass('has-error');
		
		_ctrl = true;
		_err = false;
		
		var _subcats = [];
		var _subcategoria = $('._subcategoria');
		
		_subcategoria.each(function() {
		
			var own = $(this);
			var _sid = own.data('sid');
			
			if(own.val())
			{
				var _ob = {v:own.val()};
				
				if(_sid !== undefined) _ob.id = _sid;
				
				_subcats.push(_ob);
			}
			else
			{
				if(_sid !== undefined)
				{
					own.closest('.form-group').addClass('has-error');
					if(!_err) _err = own;
				}
			}
		
		});
		
		if(_err)
		{
			$('html,body').animate({scrollTop:_err.offset().top-80},'fast',function() {
																					 
				_err.focus();
				_ctrl = false;
			
			});
			
			return ;
		}
		
		_enviar.hide();
		_loading.show();
		
		$.post('ajax/interesses/ajax-editar_interesses.php?'+Math.random(),{cid:_cid.val(),subcats:_subcats,dels:_dels},function(data) {
			
			if(!data) return ;
			
			_loading.hide();
			_ctrl = false;
			
			_ok.show();
			
			setTimeout(function() {
			
				_ok.hide();
				_enviar.show();
			
			},3000);
			
		});
	
	});

});