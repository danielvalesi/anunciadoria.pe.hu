      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            
         <div class="porlets-content">
          <div class="adv-table editable-table">
		  
		  <input type="hidden" id="_purl" value="<?php echo $c->sub01; ?>">
		  
		  		<div class="form-group search_group">
                                <input type="text" placeholder="Buscar anuncio por titulo ou nome, email do anunciante ..." class="form-control" id="_busca"<?php if($c->__cache['anuncios_Front']->_txt) { ?> value="<?php echo $_GET['q']; ?>"<?php } ?>>                 
                                <span class=""><button type="button" class="btn btn-primary btn_space" id="_busca-btn"><i class="fa fa-search"></i> Buscar</button></span>
                          </div>
                    
						<?php if($c->otxt['anuncios']) { ?>
						<div class="row" style="padding-top:10px;">
						<?php echo $c->otxt['anuncios']; ?> 
						</div>
						<?php } else { ?>
						<table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
						<tr class="_erro">
                        	<td>Nada encontrado !</td>
                        </tr>
						</tbody>
                        </table>
						<?php } ?>
						  
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