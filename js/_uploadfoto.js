var _uploadFoto = {

	_o: null,
	aspect: null,
	json: {src:null,x:null,y:null,height:null,width:null,_act:null},
	img: null,
	popup: null,
	overlay: null,
	loading: null,
	enviar: null,
	fechar: null,
	act: null,
	ck: false,
	view: null,
	_w: null,
	txt: null,
	
	__callback: null,
	
	init: function() {
	
		this.img = $('#_uploadfoto-img');
		this.popup = $('#_uploadfoto-popup');
		this.overlay = $('#_uploadfoto-overlay');
		this.loading = $('#_uploadfoto-loading');
		this.enviar = $('#_uploadfoto-enviar');
		this.fechar = $('#_uploadfoto-fechar');
		this.rot_esq = $('#_uploadfoto-rot-esq');
		this.rot_dir = $('#_uploadfoto-rot-dir');
		
		$('#_uploadfoto-txt').html(this.txt);
		
		this.run();
	
	},
	end: function() {
	
		$('body').removeClass('modal-open');
		this.img.cropper('destroy');
	
	},
	run: function() {
		
		var $this = this;
		
		this.rot_esq.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.img.cropper("rotate", -45);
		
		});
		
		this.rot_dir.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.img.cropper("rotate", 45);
		
		});
		
		this.fechar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.popup.fadeOut('fast');
			$this.overlay.fadeOut('fast',function() {
			
				$this.end();
			
			});
		
		});
		
		this.enviar.on('click',function(e) {
		
			e.preventDefault();
			
			if($this.ctrl) return ;
			
			$this.ctrl = true;
			
			$this.loading.fadeIn(400,function() {
			
				$.post('ajax/ajax-crop.php?'+Math.random(),$this.json,function(data) {
				
					if(!data) return ;
					
					$this.view.show().attr('src',data.n+'?'+Math.random()).data('url',data.url);
					
					$this.loading.fadeOut('fast',function() {
					
						$this.popup.hide();
						$this.overlay.hide();
						
						if($this.__callback)
						{
							$this.__callback(data);
							return ;
						}
						
						$this.end();
						$this.ctrl = false;
					
					});
					
					
				
				},'JSON');
			
			});
		
		});
		
		$(window).on('resize',function() {
		
			if($('body').hasClass('modal-open') && $(this).width() != $this._w)
			{
				$this.fechar.trigger('click');
			}
		
		});
	
	},
	crop: function(c) {
		
		if(this.ck) return ;
	
		var $this = this;
		
		$this.json.src = c;
		
		this.overlay.fadeIn('fast',function() {
	
			$this._w = $(window).width();
	
			$this.popup.show();
			$('body').addClass('modal-open');
			
			$this.img.attr('src',null);
			
			$this.img.on('load',function() {
			
				$this.img.cropper({
					aspectRatio: $this.aspect,
					autoCropArea: 1,
					preview: '._uploadfoto-preview',
					strict: false,
					crop: function(data) {
						
						$this.json.x = data.x;
						$this.json.y = data.y;
						$this.json.height = Math.ceil(data.height);
						$this.json.width = data.width;
						$this.json.rotate = data.rotate;
					
					}
				});
			
			});
			
			setTimeout(function() { $this.img.attr('src',c); },50);
		
		});
	
	}

};

var __upload = function(c) {

	var own = $(c);
	var ext = String(own.val()).slice(-3).toLowerCase();
	
	_uploadFoto._o = own.closest('._upload-box');
	
	if(ext != 'jpg' && ext != 'gif' && ext != 'png')
	{
		return ;
	}
	
	var btn = $('._upload-btn',_uploadFoto._o).hide();
	var form = $('form:eq(0)',_uploadFoto._o);
	var view = $('._upload-view',_uploadFoto._o);
	
	var loading = $('._upload-loading',_uploadFoto._o);
	
	btn.hide();
	loading.show();
	
	form.ajaxSubmit({success:function(responseText, statusText, xhr, $form) {			
												
		if(!responseText) return false;
		
		if(responseText == 'err')
		{
			document.location = _base+'login/';
		}
		else
		{
			loading.hide();
			btn.show();
			
			_uploadFoto.view = view;
			_uploadFoto.crop(responseText);
		}
		
	}});
	
};