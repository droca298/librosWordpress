<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content='<?php bloginfo('name'); ?>'/>
    <title><?php bloginfo('name'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/Imagenes/favicon.ico">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>
<body>
<div class="contenido">
    <nav class="navbar navbar-expand-lg bg-primary">
        <a href="<?php bloginfo('url'); ?>/"><img style="height: 9vh;" src="<?php bloginfo('template_directory'); ?>/Imagenes/logo-libro.png" alt="Logo" /></a>
        <button class="navbar-toggler" style="outline-color: black;" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">LCDL</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <span class="navbar-brand text-light">La casa del libro</span>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link white" href="<?php bloginfo('url'); ?>/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link white" href="#">Buscar libro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link white" href="#">Sección Oficial</a>
                </li>
            </ul>
        </div>
    </nav>

