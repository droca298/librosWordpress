<?php get_header(); ?>
    <section class="container">
        <article class="col-md-12">
            <?php global $post;
            if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-6">
                    <h2><?php the_title(); ?></h2>
                    <?php
                    $director = get_post_meta(get_the_id(), 'director', TRUE);
                    $estreno = get_post_meta(get_the_id(), 'estreno', TRUE);
                    $nacionalidad = get_post_meta(get_the_id(), 'nacionalidad',
                        TRUE);
                    $cartel = get_post_meta(get_the_id(), 'cartel', TRUE);
                    $trailer = get_post_meta(get_the_id(), 'trailer', TRUE);
                    $duracion = get_post_meta(get_the_id(), 'duracion', TRUE);
                    echo '<img src=' . $cartel . ' />'; ?>
                </div>
                <div class="col-md-6">
                    <br/>
                    <?php
                    echo '<p class="negrita">Sinopsis:';
                    the_content();
                    echo '<p><span class="negrita">Director/a:</span>
' . $director . '</p>';
                    echo '<p><span class="negrita">Fecha de estreno:</span>
' . $estreno . '</p>';
                    echo '<p><span class="negrita">Nacionalidad:</span>
' . $nacionalidad . '</p>';
                    echo '<p><a href="' . $trailer . '">Enlace al trailer</p>';
                    ?>
                </div>
            <?php
            endwhile;
            else: ?><p>Lo sentimos, no se han encontrado películas
                que cumplan las condiciones de búsqueda.</p>
            <?php endif; ?>
        </article>
        <div class="col-md-12">
            <br/>
            <a href="<?php bloginfo('url'); ?>/">Volver al inicio</a>
            <br/>
        </div>
    </section>
<?php get_footer(); ?>