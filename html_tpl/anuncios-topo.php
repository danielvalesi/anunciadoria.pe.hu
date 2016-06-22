<div class="grid_12 last marg">
       	  <div class="row2 responsive">
            <div class="form-contato grid_12 last adapt">
                
                <div class="grid_3">
                	<span class="lineform smallControl">
					<div class="selecao">
                    <span>Selecionar estado</span>
                     <select id="_anuncios-estado">
                      <option class="cor" value="todos">Selecionar estado</option>
					  <option class="cor" value="todos"<?php if($c->sub01 == 'todos') { ?> selected="selected"<?php } ?>>Todos</option>
                      <?php echo $c->otxt['estados']; ?>
					 </select>
                    </div>
					</span>
                 </div>
                 <div class="grid_5">
                	<span class="lineform smallControl">
					<div class="selecao">
                    <span>Selecionar cidade</span>
                    <select id="_anuncios-cidade">
					<?php if($c->otxt['cidades']) { ?>
					 <option class="cor" value="">Selecionar cidade</option>
					<?php echo $c->otxt['cidades']; } ?>
					</select>
                    </div>
					</span>
                 </div>
                 <div class="grid_4 last">
                	<span class="lineform smallControl">
					<div class="selecao">
                    <span>Selecionar bairro</span>
                    <select id="_anuncios-bairro">
					<?php if($c->otxt['bairros']) { ?>
					 <option class="cor" value="">Selecionar bairro</option>
					<?php echo $c->otxt['bairros']; } ?>
					</select>
                    </div>
					</span>
                 </div>
                 
            </div>
                <div class="clear"></div>
            </div>
        </div>