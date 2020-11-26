<!doctype html>
<html>
	<head>
	<meta charset="<?php echo _CHARSET_; ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />

	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo _MSFW_PATH_._DEFAULT_VIEW_PATH_; ?>_img/common/favicon.ico"/>
	<?php foreach ($links as $link) { ?>
	<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
	<?php } ?>
	<?php foreach ($styles as $style) { ?>
	<link rel="<?php echo $style['rel']; ?>" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
	<?php } ?>
  <?php foreach ($jQueryScripts as $jQueryScript) { ?>
		<script src="<?php echo $jQueryScript['src']; ?>"></script>
    <?php
      if($jQueryScript['id'] != "$")
      {
    ?>
			<script type="text/javascript">
        var <?php echo $jQueryScript['id']; ?> = $.noConflict(true);
      </script>
    <?php  
      }
    ?>
	<?php } ?>
	<?php foreach ($scripts as $script) { ?>
	<script src="<?php echo $script; ?>"></script>
	<?php } ?>
	<script><!--
	jQuery(document).ready(function(){
		<?php foreach ($in_readyCodes as $in_readyCode) { ?>
			<?php echo $in_readyCode; ?>
			<?php } ?>
		});
	<?php foreach ($in_scripts as $in_script) { ?>
		<?php echo $in_script; ?>
		<?php } ?>
	//--></script>
</head>
<body>

<center>

<div id="body">

<!--[if lt IE 9]>
<div id="IEFix"></div>
<![endif]-->
<?php if($controlador != "login" && $controlador != "recuperar"){ ?>
<div id="generalHeader" ondragstart="return false" draggable="false">
	<p class="Titulo1">ADMINISTRADOR DE DE PREGUNTADOS</p>
	<div class="header_container">
		<div class="header_usuario">
			<p class="Titulo2">BIENVENIDO: <?php echo utf8_decode($usuario->nombres).' '.utf8_decode($usuario->apellidos); ?></p>
		</div>
		<div class="header_buttons">
			<input class="btn btn-warning" type="button" name="menu" value="Menu" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/home'" />
			<input class="btn btn-danger" type="button" name="cerrar_sesion" value="Cerrar sesion" onclick="MSHeader.cerrar_sesion();" />
		</div>
	</div>
	
</div>
<?php }?>