<?php get_header(); ?>
    <section class="container">
        <?php
        isset($_GET["s"]) ? $palabra = $_GET["s"] : $palabra = NULL;
        isset($_GET["director"])
            ? $director = $_GET["director"] : $director = NULL;
        isset($_GET["genero"]) ? $genero = $_GET["genero"] : $genero = NULL;
        isset($_GET["oficial"]) ?
            $oficial = $_GET["oficial"] : $oficial = NULL;//Esta variable la utilizamos para buscar las películas que participan en la sección oficial. No la utilizamos en  buscar.php.
        if (!$oficial) {
            $args = array(
                'post_type' => 'film',
                'genero' => $genero,
                's' => $palabra,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'director',
                        'value' => $director,
                        'compare' => 'LIKE'
                    ),
                ),
            );
        } else {
            ?> <h2>Películas participantes en la sección oficial</h2>
            <?php
            $args = array(
                'post_type' => 'film',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'oficial',
                        'value' => $oficial,
                        'compare' => '='
                    ),
                ),
            );
        }
        query_posts($args);
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="col-md-12">
                <h3><a href="<?php echo get_permalink(); ?>"> <?php the_title();
                        ?></a></h3>
                <?php the_excerpt(); ?>
            </div>
            <?php endwhile; else: ?>
            <p class="col-md-12">Lo
                sentimos, no se han en
                contrado películas que
                cumplan las condicione
                s de búsqueda.</p>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>