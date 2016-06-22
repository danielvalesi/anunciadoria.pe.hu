<!DOCTYPE html>
<html lang="pt-br, pt" dir="ltr">
<head>
	<base href="<?php echo $c->base; ?>" />
	<meta http-equiv="Content-Language" content="pt-br, pt">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="robots" content="noindex,nofollow">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="shortcut icon" type="image/x-icon" href="icon.ico">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css' />
	
	<!-- Open Graph meta tags -->
	<meta property="og:site_name" content="Anunciadoria">
	<?php if($c->og) { ?>
	<meta property="og:title" content="<?php echo $c->og['title']; ?>">
	<meta property="og:description" content="<?php echo $c->og['description']; ?>">
	<meta property="og:image" content="<?php echo $c->base.$c->og['image']; ?>">
	<meta property="og:url" content="<?php echo $c->base.$c->og['url']; ?>/">
	<?php } else { ?>
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	<meta property="og:image" content="<?php echo $c->base; ?>og300x300.jpg">
	<meta property="og:url" content="<?php echo $c->base; ?>">
	<?php } ?>
	<meta property="og:type" content="website">
	<!-- End. Open Graph meta tags -->
	
	<?php if($c->seo) { ?>
	<meta name="description" lang="pt-br, pt" content="<?php echo $c->seo['description']; ?>">
	<meta name="keywords" lang="pt-br, pt" content="<?php echo $c->seo['keywords']; ?>">
	<?php } else { ?>
	<meta name="description" lang="pt-br, pt" content="">
	<meta name="keywords" lang="pt-br, pt" content="">
	<?php } ?>

	<title>Anunciadoria</title>

	<!--[if lt IE 9]>
	<script type="text/javascript" src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">
	<link rel="stylesheet" type="text/css" href="css/crop.css">
	<link rel="stylesheet" type="text/css" href="css/cropper.min.css">
	<?php if($c->pn == 'anuncios' and $c->sub01) { ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<?php } ?>
	<!-- End. CSS -->
	
	<!-- jQuery -->
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<?php if($c->pn == 'anuncios' and $c->sub01) { ?>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="js/jquery.ui.touch-punch.min.js"></script>
	<?php } ?>
	<!-- End. jQuery -->
	
	<script type="text/javascript" src="js/init.js?v=1"></script>
	<script type="text/javascript" src="js/funcs.js"></script>
	<?php echo $c->otxt['js_files']; ?>
	<script type="text/javascript">
	var _ctrl;
	var _base = '<?php echo $c->base; ?>';
	var _device = <?php echo $c->__Device(); ?>;
	<?php echo $c->otxt['js_global']; ?>
	$(function() {
	
	<?php echo $c->otxt['js_ready']; ?>
	
	});
	</script>

</head>

<body class="relative">