<!-- Cropping modal -->
    <div class="modal" tabindex="-1" style="display:none;" id="_uploadfoto-popup">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
            <div class="modal-header">
              <button type="button" class="close" id="_uploadfoto-fechar">&times;</button>
              <h4 class="modal-title" id="_uploadfoto-txt"></h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">
			  
                <!-- Crop and preview -->
                <div class="row-avatar">
                  <div class="col-xs-12 col-sm-9 col-lg-9">
                    <div class="avatar-wrapper"><img src="img/clear.png" border="0" id="_uploadfoto-img"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg _uploadfoto-preview"></div>
                  </div>
                </div>

                <div class="row-avatar avatar-btns">
				<div class="_up-rotate"><span>Rotacionar</span><a href="" class="_up-rotate-esq" id="_uploadfoto-rot-esq"></a><a href="" class="_up-rotate-dir" id="_uploadfoto-rot-dir"></a></div>
				<div class="clear"></div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block avatar-save" id="_uploadfoto-enviar">Confirmar</button>
                  </div>
                </div>
              </div>
            </div>
        
        </div>
      </div>
    </div>
<!-- /.modal -->

<!-- Loading state -->
    <div class="avatar-loading" tabindex="-1" style="display:none;" id="_uploadfoto-loading"></div>
	<div class="modal-backdrop" style="display:none;" id="_uploadfoto-overlay"></div>