var anuncios_busca = {

	ctrl: false,
	ctrl_scroll: false,
	ctrl_fx: false,
	ctrl_valor: false,
	_json: {},
	limit: null,
	preco_min: null,
	preco_max: null,
	_bk: null,
	
	init: function() {
	
		if(!this.limit) return ;
		
		this.fx_box = $('#_fx-box');
		this.fx_box_erro = $('#_fx-box-erro');
		
		this.com_foto = $('#anuncios-com-foto');
		
		this.interesses = $('#anuncios-interesses');
		this.aplicados = $('#anuncios-interesses-aplicados');
		this.box = $('#anuncios-box');
		this.loading = $('#anuncios-loading');
		this.ordenar = $('#anuncios-ordenar');
		this.box_over = $('#anuncios-box-over');
		this.box_loading = $('#anuncios-box-loading');
		this.mobfiltrar = $('#anuncios-mobfiltrar');
		
		this.precos_de_txt = $('#anuncios-precos-de-txt');
		this.precos_ate_txt = $('#anuncios-precos-ate-txt');
		
		this.valor_aplicado = $('#anuncios-valor-aplicado');
		this.valor_aplicado_remover = $('#anuncios-valor-aplicado-remover');
		
		this._window = $(window);
		
		this._json.offset = this.limit;
		this._json.limit = this.limit;
		
		if(!this.preco_min && !this.preco_max)
		{
			$('.area-filtro-valor').hide();
		}
		
		this.run();
	
	},
	run: function() {
		
		var $this = this;
		
		var __out = function(t2) {
		
			var _fix;
				
			$('html,body').animate({scrollTop:$this.box.offset().top},400,function() {
				
				if(_fix) return ;
					
				_fix = true;
				
				$this.box_over.fadeIn('fast',function() {
					
					$this.box_loading.removeClass('dnone');
					$this.__post(true,t2);
					
				});
				
			});
		
		};
		
		var __postInteresses = function(iid,_bk) {
			
			$this.fx_box_erro.addClass('dnone');
			$this.fx_box.removeClass('dnone');
			
			$this.ctrl = true;
			$this.ctrl_scroll = false;
		
			$this.ordenar.data('c',1);
			$this._json.offset = 0;
		
			//$this._json.interesses = [];
			
			if(_device == 2) $this.interesses.hide(); // mobile
			
			//if(iid) $this._json.interesses.push(iid);
			
			//$('._interesses-aplicado').each(function() { $this._json.interesses.push($(this).data('iid')); });
			
			__out(true);
		
		};
		
		this.com_foto.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ordenar.data('c') == 1) return ;
			
			if(!$this.com_foto.hasClass('_foto-active'))
			{
				$this.com_foto.addClass('_foto-active');
				$this._json.com_foto = 1;
			}
			else
			{
				$this.com_foto.removeClass('_foto-active');
				delete $this._json.com_foto;
			}
			
			$this.ctrl_fx = true;
			
			__postInteresses();
		
		});
		
		this.mobfiltrar.on('click',function(e) {
		
			e.preventDefault();
			
			var _control = $this.mobfiltrar.data('control');
			
			if(_control !== undefined && _control == 1) return ;
			
			$this.mobfiltrar.data('control',1);
			
			if($this.interesses.is(':visible'))
			{
				$this.interesses.slideUp(400,function() {
				
					$this.mobfiltrar.data('control',0);
				
				});
			}
			else
			{
				$this.interesses.slideDown(400,function() {
				
					$('html,body').animate({scrollTop:$this.interesses.offset().top},400,function() {
					
						$this.mobfiltrar.data('control',0);
					
					});
				
				});
			}
		
		});
		
		$('#anuncios-precos').slider({
			range: true,
			min: this.preco_min,
			max: this.preco_max,
			values: [ this.preco_min, this.preco_max ],
			change: function( event, ui ) {
				
				if($this.ctrl_valor) return ;
				
				$this.precos_de_txt.text('R$ '+ reais($('#anuncios-precos').slider('values',0)));
				$this.precos_ate_txt.text('R$ '+ reais($('#anuncios-precos').slider('values',1)));
				
				$this._json.preco_min = ui.values[0];
				$this._json.preco_max = ui.values[1];
				
				if($this.ordenar.data('c') == 1) return ;
				
				$this._bk = function() {
					
					var _txt = 'R$ '+reais($('#anuncios-precos').slider('values',0))+' - '+'R$ '+reais($('#anuncios-precos').slider('values',1));
					
					$this.valor_aplicado.find('span:eq(0)').text(_txt);
					$this.valor_aplicado.show();
					
				};
				
				$this.ctrl_fx = true;
				
				__postInteresses();
			}
		});
		
		$this.precos_de_txt.text('R$ '+ reais($('#anuncios-precos').slider('values',0)));
		$this.precos_ate_txt.text('R$ '+ reais($('#anuncios-precos').slider('values',1)));
		
		this.valor_aplicado_remover.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ordenar.data('c') == 1) return ;
			
			$this.valor_aplicado.hide().find('span:eq(0)').text('');
			
			delete $this._json.preco_min;
			delete $this._json.preco_max;
			
			$this.ctrl_valor = true;
			
			__postInteresses();
		
		});
		
		$('body').on('click','._interesses-aplicado-remover',function(e) {
		
			e.preventDefault();
			
			if($this.ordenar.data('c') == 1) return ;
			
			$('._interesses_item[data-iid="'+$(this).parent().data('iid')+'"]').removeClass('active');
			
			if($('._interesses-aplicado').length == 1) $this.aplicados.html('');
			
			$(this).parent().remove();
			
			$this._json.interesses = [];
			
			$('._interesses_item').filter('.active').each(function() {
			
				$this._json.interesses.push($(this).data('iid'));
			
			});
			
			__postInteresses();
		
		}).on('click','._interesses_item',function(e) {
			
			if($this.ordenar.data('c') == 1)
			{
				e.preventDefault();
				return ;
			}
			
			if($(this).hasClass('active'))
			{
				$(this).removeClass('active');
			}
			else
			{
				$(this).addClass('active');
			}
			
			$this._json.interesses = [];
			
			$('._interesses_item').filter('.active').each(function() {
			
				$this._json.interesses.push($(this).data('iid'));
			
			});
			
			//__postInteresses($(this).data('iid'));
			
			__postInteresses();
		
		});
		
		this.ordenar.on('change',function(e) {
		
			if($this.ctrl) return ;
			
			var _sel = $('option:selected',$this.ordenar).val();
			
			if(_sel)
			{
				$this._json.ordenar = _sel;
			}
			else
			{
				delete $this._json.ordenar;
			}
			
			$this.ordenar.data('c',1);
			$this._json.offset = 0;
			
			__out();
		
		});
		
		this._window.on('scroll',function() {
		
			if($this.ctrl_scroll || $this.ordenar.data('c') == 1) return ;
		
			if($this._window.scrollTop() >= ($this.loading.offset().top-$this._window.height()))
			{
				$this.ordenar.data('c',1);
				$this.ctrl = true;
				$this.ctrl_scroll = true;
				$this.__post();
			}
		
		});
		
	},
	__post: function(t,t2) {
		
		var $this = this;
		
		if(t2) this._json.fc = 1; else delete this._json.fc;
		
		$.post('ajax/ajax-anuncios_pg.php?'+Math.random(),this._json,function(data) {
		
			if(!data) return ;
			
			if(data.s == 'nr')
			{
				//document.title = $this.ctrl_fx;
				
				if($this.ctrl_fx)
				{
					/* Interesses aplicados */
					var _fix = '';
					
					if(data.fap !== undefined)
					{
						_fix = '';
							
						$.each(data.fap,function(i,v) { _fix+=v; });
						$this.aplicados.html(_fix);
						$this.mobfiltrar.removeClass('dnone');
					}
					else
					{
						$this.aplicados.html('');
						$this.mobfiltrar.addClass('dnone');
					}
					
					$this.fx_box.addClass('dnone');
					$this.fx_box_erro.removeClass('dnone');
					$this.box.html('');
					
					if($this._bk)
					{
						$this._bk();
						$this._bk = null;
					}
				}
				
				$this.ctrl = false;
				$this.ordenar.data('c',0);
				return ;
			}
			
			if(t) $this.box.html('');
				
			$.each(data.i,function(i,v) { $this.box.append(v); });
				
			$this._json.offset+=data.i.length;
			
			if(t2)
			{
				/* Interesses */
				/*var _fix = '';
				
				if(data.f !== undefined)
				{
					_fix = '';
					
					$.each(data.f,function(i,v) { _fix+=v; });
					$this.interesses.html(_fix);
					$this.mobfiltrar.removeClass('dnone');
				}
				else
				{
					$this.interesses.html('');
					$this.mobfiltrar.addClass('dnone');
				}*/
				
				/* Interesses aplicados */
				var _fix = '';
				
				if(data.fap !== undefined)
				{
					_fix = '';
						
					$.each(data.fap,function(i,v) { _fix+=v; });
					$this.aplicados.html(_fix);
				}
				else
				{
					$this.aplicados.html('');
				}
				
				if(data.precos !== undefined)
				{
					$this.ctrl_valor = true;
					
					var _pmin = parseInt(data.precos.minimo);
					var _pmax = parseInt(data.precos.maximo);
					
					//$this._json.preco_min = _pmin;
					//$this._json.preco_max = _pmax;
					
					$('#anuncios-precos').slider('option','min',_pmin);
					$('#anuncios-precos').slider('option','max',_pmax);
					$('#anuncios-precos').slider('option','values',[_pmin,_pmax]);
					
					$this.precos_de_txt.text('R$ '+ reais($('#anuncios-precos').slider('values',0)));
					$this.precos_ate_txt.text('R$ '+ reais($('#anuncios-precos').slider('values',1)));
				}
				
				if($this._bk)
				{
					$this._bk();
					$this._bk = null;
				}
			}
				
			$this.ctrl_fx = false;
			$this.ctrl_scroll = false;
			$this.ctrl = false;
			$this.ordenar.data('c',0);
			
			if(t)
			{
				$this.box_loading.addClass('dnone');
				$this.box_over.fadeOut('fast',function() {
				
					$this.ctrl_valor = false;
				
					if(_device == 2) $('html,body').animate({scrollTop:$this.box.offset().top},400); // mobile
				
				});
			}
		
		},'JSON');
	
	}
	
};

$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 90;  // How many characters are shown by default
    var ellipsestext = '...';
    var moretext = 'Mais info';
    var lesstext = 'Menos info';
    

    $('p.infos-item').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="leia-conteudo"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="btn-item leia-mais">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".leia-mais").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle('fast');
        $(this).prev().toggle('fast');
        return false;
    });
});

$(function() {
    //caches a jQuery object containing the header element
    var menu = $(".menu-lateral");
    		hdr = ($('#_topo').outerHeight() + $('.subheader').outerHeight() + 45 ) ;
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= hdr) {
            menu.addClass("fixed");
            console.log(hdr)
        } else {
            menu.removeClass("fixed");
        }
    });
});
