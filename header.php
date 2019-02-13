<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content='<?php bloginfo('name'); ?>'/>
    <title><?php bloginfo('name'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>
<body>
<div class="contenido">
    <header>
        <div class="row">
            <h1 class="col-md-  7 col-xs-  12"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
            <div class="col-md-5">
                <ul>
                    <li><a href="/index.php">Inicio</a></li>
                    <li><a href="/index.php/buscar/">Buscar Películas</a></li>
                    <li><a href="">Sección Oficial</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class='col-md-12'>
                    <a href="#">Iniciar sesión</a>
                </div>
                <div class='col-md-12'>
                    <a href="#">Registrarse</a>
                </div>
            </div>
        </div>

    </header>