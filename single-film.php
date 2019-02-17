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
                    echo '<img src=' . $cartel . ' />'; ?>
                </div>
                <div class="col-md-6">
                    <br/>
                    <?php
                    echo '<p class="negrita">Sinopsis:';
                    the_content();
                    echo '<p><span class="negrita">Autor/a: </span> ' . $autor . '</p>';
                    echo '<p><span class="negrita">ISBN: </span> ' . $isbn . '</p>';
                    echo '<p><span class="negrita">Nacionalidad: </span> ' . $nacionalidad . '</p>';
                    echo '<p><span class="negrita">Unidades: </span> ' . $unidades . '/u' . '</p>';
                    echo '<p><span class="negrita">Precio/u: </span> ' . $precio . '€' . '</p>';

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