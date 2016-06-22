$(function() {
		   
	var _busca = $('#_busca');
	var _busca_btn = $('#_busca-btn');
	
	_busca_btn.on('click',function(e) {
	
		e.preventDefault();
		
		if(!_busca.val())
		{
			_busca.focus();
			return ;
		}
		
		document.location = _base+'newsletter/listar-contatos/?q='+urlencode(_busca.val());
	
	});
	
	_busca.on('keyup',function(e) {
	
		if(e.which == 13) _busca_btn.trigger('click');
	
	});
	
	$('a.delete').on('click',function(e) {
	
		e.preventDefault();
		
		if(confirm('Confirmar ?')) document.location = _base+$(this).attr('href');
	
	});

});