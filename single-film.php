<?php get_header(); ?>
    <section class="container">
        <article class="col-md-12">
            <?php global $post;
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-6">
                    <h2><?php the_title(); ?></h2>
                    <?php
                    $autor = get_post_meta(get_the_id(), 'autor', TRUE);
                    $unidades = get_post_meta(get_the_id(), 'unidades', TRUE);
                    $nacionalidad = get_post_meta(get_the_id(), 'nacionalidad',
                        TRUE);
                    $cartel = get_post_meta(get_the_id(), 'cartel', TRUE);
                    $isbn = get_post_meta(get_the_id(), 'isbn', TRUE);
                    $precio = get_post_meta(get_the_id(), 'precio', TRUE);
                    ?>
                </div>
                <div class="col-md-12">
                    <br/>


                    <div class="media">
                        <img src="<?php echo $cartel ?> " class="align-self-start mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0">Sinopsis</h5>
                            <p class="text-justify"> <?php the_content() ?></p>
                        </div>

                        <div class="card" style="width: 18rem;">
                            <div class="card-header">
                                <span style="font-weight: bold" class="text-uppercase">Información adicional</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php  echo '<p><span class="negrita">Autor/a: </span> ' . $autor . '</p>'; ?></li>
                                <li class="list-group-item"><?php  echo '<p><span class="negrita">ISBN: </span> ' . $isbn . '</p>'; ?></li>
                                <li class="list-group-item"><?php echo '<p><span class="negrita">Nacionalidad: </span> ' . $nacionalidad . '</p>'; ?></li>
                                <li class="list-group-item"><?php echo '<p><span class="negrita">Unidades: </span> ' . $unidades . '/u' . '</p>';?></li>
                                <li class="list-group-item"><?php echo '<p><span class="negrita">Precio/u: </span> ' . $precio . '€' . '</p>'; ?></li>
                            </ul>
                        </div>
                    </div>



                </div>
            <?php
            endwhile;
            else: ?><p>Lo sentimos, no se han encontrado películas
                que cumplan las condiciones de búsqueda.</p>
            <?php endif; ?>
        </article>
        <div class="col-md-12">
            <br/>
            <a class="btn btn-block btn-success text-light" href="<?php bloginfo('url'); ?>/">Volver al inicio</a>
            <br/>
        </div>
    </section>
<?php get_footer(); ?>