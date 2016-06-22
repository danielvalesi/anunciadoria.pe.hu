<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="header_bar">
    <!--\\\\\\\ header Start \\\\\\-->
    <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <div class="logo" style="display:block"><span class="theme_color">Administrador</span></div>
      <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
    </div>
    <!--\\\\\\\ brand end \\\\\\-->
    <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
      
      <div class="top_right_bar">
        
        <div class="user_admin dropdown" style="margin-top:7px;"> <a href="javascript:void(0);" data-toggle="dropdown"><img src="images/user.png" style="border-radius:22px;" /><span class="user_adminname">Anunciadoria</span> <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <div class="top_pointer"></div>
			<li> <a href="alterar-senha/"><i class="fa fa-cog"></i> Alterar senha </a></li>
            <li> <a href="sair/"><i class="fa fa-power-off"></i> Sair</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <!--\\\\\\\ header top bar end \\\\\\-->
  </div>
  <!--\\\\\\\ header end \\\\\\-->
  <div class="inner">
    <!--\\\\\\\ inner start \\\\\\-->
    <div class="left_nav">
      <!--\\\\\\\left_nav start \\\\\\-->
      <div class="left_nav_slidebar">
        <ul>
         <?php echo $c->_Menu(); ?>
        </ul>
      </div>
    </div>
	<!--\\\\\\\left_nav end \\\\\\-->
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
           <?php if(isset($c->_titulo[0])) { ?><h1><?php echo $c->_titulo[0]; ?></h1><?php } ?>
          <?php if(isset($c->_titulo[1])) { ?><h2 class=""><?php echo $c->_titulo[1]; ?></h2><?php } ?>
        </div>
		<?php if(isset($c->_nav[0])) { ?>
        <div class="pull-right">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo $c->_nav[0]; ?></li>
			<?php if(isset($c->_nav[1])) { ?><li class="active"><?php echo $c->_nav[1]; ?></li><?php } ?>
          </ol>
        </div>
		<?php } ?>
      </div>