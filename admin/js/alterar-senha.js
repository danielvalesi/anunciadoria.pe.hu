$(function() {

	var _err;
	var _ctrl;
	var _senha_antiga = $('#_senha-antiga');
	var _senha_erro = $('#_senha-erro');
	var _senha = $('#_senha');
	var _senha_confirmar = $('#_senha-confirmar');
	var _enviar = $('#_enviar');
	var _loading = $('#_loading');
	var _ok = $('#_ok');
	
	_enviar.on('click',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		$('.has-error').removeClass('has-error');
		_senha_erro.hide();
		
		_ctrl = true;
		_err = false;
		
		if(!_senha_antiga.val())
		{
			_senha_antiga.closest('.form-group').addClass('has-error');
			if(!_err) _err = _senha_antiga;
		}
		
		if(!_senha.val())
		{
			_senha.closest('.form-group').addClass('has-error');
			if(!_err) _err = _senha;
		}
		
		if(!_senha_confirmar.val() || _senha.val() != _senha_confirmar.val())
		{
			_senha_confirmar.closest('.form-group').addClass('has-error');
			if(!_err) _err = _senha_confirmar;
		}
		
		if(_err)
		{
			_err.focus();
			_ctrl = false;
			
			return ;
		}
		
		_enviar.hide();
		_loading.show();
		
		$.post('ajax/ajax-alterar_senha.php?'+Math.random(),{senha_antiga:_senha_antiga.val(),senha:_senha.val()},function(data) {
			
			if(!data) return ;
			
			_loading.hide();
			
			if(data == 'err')
			{
				_ctrl = false;
				_enviar.show();
				
				_senha_antiga.closest('.form-group').addClass('has-error');
				_senha_erro.show();
				
				_ctrl = false;
				
				return ;
			}
			
			_ok.show();
			
			setTimeout(function() {
			
				document.location = _base;
			
			},3000);
			
		});
	
	});

});