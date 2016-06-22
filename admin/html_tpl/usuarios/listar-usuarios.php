      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            
         <div class="porlets-content">
          <div class="adv-table editable-table">
		  
		  				<div style="margin-bottom:15px;" class="row">
                  <div class="col-lg-12">
                   
				   <a class="btn btn-success fileinput-button _upload-btn" style="margin-bottom:0px;" href="ajax/usuarios/ajax-download_usuarios.php"> <i class="fa fa-download"></i>  <span>&nbsp;Download dos usuarios (<?php echo $c->otxt['total_usuarios']; ?>)</span></a>
                    
                     </div>
                </div>
					  
                          <div class="form-group search_group">
                                <input type="text" placeholder="Buscar usu&aacute;rios por nome ou e-mail ..." class="form-control" id="_busca"<?php if($c->__cache['usuarios_Front']->_txt) { ?> value="<?php echo $_GET['q']; ?>"<?php } ?>>                 
                                <span class=""><button type="button" class="btn btn-primary btn_space" id="_busca-btn"><i class="fa fa-search"></i> Buscar</button></span>
                          </div>
                    
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <?php if($c->otxt['usuarios']) { ?>
							  <tr>
                                  <th>Nome</th>
								  <th>E-mail</th>
								  <th>Tipo de cadastro</th>
								  <th colspan="2">Adicionado em</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php echo $c->otxt['usuarios']; } else { ?>
                              <tr class="_erro">
                                  <td>Nada encontrado !</td>
                              </tr>
							  <?php } ?>
							  </tbody>
                          </table>
						  
						  <?php if($c->otxt['paginacao']) { ?>
						  <div class="row">
						  	<div class="col-md-12">
								<div class="dataTables_paginate paging_bootstrap pagination">
									<ul>
										<?php echo $c->otxt['paginacao']; ?>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						  
                      </div>
 
            </div><!--/porlets-content-->  
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
    
      </div>
      <!--\\\\\\\ container  end \\\\\\-->