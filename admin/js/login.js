$(function() {

	var _err;
	var _ctrl;
	var _login = $('#_login');
	var _senha = $('#_senha');
	var _enviar = $('#_enviar');
	var _loading = $('#_loading');
	var _erro = $('#_erro');
	
	_enviar.on('click',function(e) {
	
		e.preventDefault();
		
		if(_ctrl) return ;
		
		$('.has-error').removeClass('has-error');
		_erro.hide();
		
		_ctrl = true;
		_err = false;
		
		if(!_login.val())
		{
			_login.closest('.form-group').addClass('has-error');
			if(!_err) _err = _login;
		}
		
		if(!_senha.val())
		{
			_senha.closest('.form-group').addClass('has-error');
			if(!_err) _err = _senha;
		}
		
		if(_err)
		{
			_err.focus();
			_ctrl = false;
			
			return ;
		}
		
		_enviar.hide();
		_loading.show();
		
		$.post('ajax/ajax-login.php?'+Math.random(),{login:_login.val(),senha:_senha.val()},function(data) {
			
			if(!data) return ;
			
			if(data == 'err')
			{
				_loading.hide();
				_enviar.show();
				
				_login.closest('.form-group').addClass('has-error');
				_erro.show();
				
				_ctrl = false;
				
				return ;
			}
			
			document.location.reload();
		
		});
	
	});

});