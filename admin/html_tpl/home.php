    <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
		
		<div class="col-sm-6">
		  	<a href="usuarios/listar-usuarios/">
            <div class="information red_info">   
              <div class="information_inner">
              	<div class="info red_symbols"><i class="fa fa-bar-chart-o icon"></i></div>
                <span style="font-size:20px;">Usuários cadastrados</span>
                <h1 class="bolded"><?php echo $c->otxt['total_usuarios']; ?></h1>
              </div>
            </div>
			</a>
          </div>
		  
		  <div class="col-sm-6">
		  	<a href="newsletter/listar-contatos/">
            <div class="information blue_info">   
              <div class="information_inner">
              	<div class="info blue_symbols"><i class="fa fa-bar-chart-o icon"></i></div>
                <span style="font-size:20px;">Newsletter contatos</span>
                <h1 class="bolded"><?php echo $c->otxt['total_newsletters']; ?></h1>
              </div>
            </div>
			</a>
          </div>
		
		<div class="col-sm-6">
		  	<a href="anuncios/pendentes/">
            <div class="information gray_info">   
              <div class="information_inner">
              	<div class="info gray_symbols"><i class="fa fa-bar-chart-o icon"></i></div>
                <span style="font-size:20px;">Anúncios pendentes</span>
                <h1 class="bolded"><?php echo $c->otxt['total_anuncios_0']; ?></h1>
              </div>
            </div>
			</a>
          </div>
		  
		  <div class="col-sm-6">
		  	<a href="anuncios/aprovados/">
            <div class="information green_info">   
              <div class="information_inner">
              	<div class="info green_symbols"><i class="fa fa-bar-chart-o icon"></i></div>
                <span style="font-size:20px;">Anúncios aprovados</span>
                <h1 class="bolded"><?php echo $c->otxt['total_anuncios_1']; ?></h1>
              </div>
            </div>
			</a>
          </div>
		 
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
	  </div>