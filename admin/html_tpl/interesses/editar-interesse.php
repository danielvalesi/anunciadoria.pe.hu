      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      
      <div class="row">
        <div class="col-md-6">
          <div class="block-web">
            
            <div class="porlets-content">
				<input type="hidden" id="_cid" value="<?php echo $c->sub02; ?>">
                <div class="form-group">
                  <label><strong>Nome do interesse</strong></label>
                  <input type="text" name="nick" parsley-trigger="change" required class="form-control" value="<?php echo $c->otxt['infos']['interesse_nome']; ?>" readonly="readonly">
                </div><!--/form-group-->
				<div id="_items">
				<?php if($c->otxt['subs']) { echo $c->otxt['subs']; } else { ?>
					<div class="form-group">
						<label>Nome do sub interesse</label>
						<div class="row">                 
							<div class="col-sm-8"><input type="text" class="form-control _subcategoria" required="" parsley-trigger="change" name="nick"></div>
							<div class="col-sm-4"><button type="button" class="btn btn-primary btn-block" id="_subcategoria-add">Adicionar</button></div>
						</div>
						<div class="clear_both"></div>
					</div>
				<?php } ?>
				</div>
                <a href="" class="btn btn-primary" id="_enviar">Confirmar</a>
				<span class="btn btn-default disabled" style="display:none;" id="_loading">Aguarde ...</span>
				<span class="btn btn-success" style="display:none;" id="_ok">Sucesso !</span>
            
            </div><!--/porlets-content-->
          </div><!--/block-web--> 
        </div><!--/col-md-6-->
        
         
      </div><!--/row-->
      
     





      
        
        
        
        
        
        
        
        
    
      </div>
      <!--\\\\\\\ container  end \\\\\\-->