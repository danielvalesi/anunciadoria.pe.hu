$(function() {

	var _err;
	var _ctrl;
	var _nome = $('#_nome');
	var _add = $('#_subcategoria-add');
	var _items = $('#_items');
	var _enviar = $('#_enviar');
	var _loading = $('#_loading');
	var _ok = $('#_ok');
	
	_add.on('click',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		_items.append('<div class="form-group"><label>Nome da subcategoria</label><div class="row"><div class="col-sm-8"><input type="text" class="form-control _subcategoria" required="" parsley-trigger="change" name="nick"></div><div class="col-sm-4"><button type="button" class="btn btn-danger btn-block _subcategoria-remover">Remover</button></div></div><div class="clear_both"></div></div>');
	
	});
	
	$('body').on('click','._subcategoria-remover',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		$(this).closest('.form-group').remove();
	
	});
	
	_enviar.on('click',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		$('.has-error').removeClass('has-error');
		
		_ctrl = true;
		_err = false;
		
		if(!_nome.val())
		{
			_nome.closest('.form-group').addClass('has-error');
			if(!_err) _err = _nome;
		}
		
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
			_err.focus();
			_ctrl = false;
			
			return ;
		}
		
		_enviar.hide();
		_loading.show();
		
		$.post('ajax/categorias/ajax-adicionar_categoria.php?'+Math.random(),{nome:_nome.val(),subcats:_subcats},function(data) {
			
			if(!data) return ;
			
			_loading.hide();
			_ctrl = false;
			
			_nome.val('');
			_subcategoria.eq(0).val('');
			_subcategoria.filter(':gt(0)').closest('.form-group').remove();
			_ok.show();
			
			setTimeout(function() {
			
				_ok.hide();
				_enviar.show();
			
			},3000);
			
		});
	
	});

});