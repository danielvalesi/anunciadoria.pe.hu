<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo $c->base; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anunciadoria - Administrador</title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=0">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="shortcut icon" type="image/x-icon" href="../icon.ico">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	
<script type="text/javascript">
var _ctrl;
var _base = '<?php echo $c->base; ?>';
var _mobile = <?php echo ($c->is_mobile())?1:0; ?>;
</script>

<script src="js/jquery-2.1.0.js"></script>
<script src="js/login.js"></script>

</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="login_page">
  <div class="login_content">
  <div class="panel-heading border login_heading" style="padding:0;"><img src="images/area-gerenciamento.jpg"></div>	
  <form role="form" class="form-horizontal">
      <div class="form-group">
        
        <div class="col-sm-12">
          <input type="email" placeholder="Usuário" id="_login" class="form-control">
		  <p class="help-block text-left" style="display:none;" id="_erro"><i class="fa fa-times-circle"></i> Usuário ou senha incorretos !</p>
        </div>
      </div>
      <div class="form-group">
        
        <div class="col-sm-12">
          <input type="password" placeholder="Senha" id="_senha" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class=" col-sm-12">
          <div class="checkbox checkbox_margin">
              <button class="btn btn-primary pull-right" type="submit" id="_enviar">Acessar</button>
			  <button class="btn btn-default disabled pull-right" type="submit" id="_loading" style="display:none;">Aguarde ...</button>
          </div>
        </div>
      </div>
  </form>
 </div>
 </div>
</div>
<!--\\\\\\\ wrapper end\\\\\\-->

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>

</body>
</html>