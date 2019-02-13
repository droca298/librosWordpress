<?php get_header(); ?>
    <section class="container">
        <?php
        $args = array(
            'post_type' => 'film',
            'showposts' => '6',
            'orderby' => 'rand',
        );
        query_posts($args);
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="col-md-4 col-sm-6 col-xs-12">
                <p><a href="<?php echo get_permalink(); ?>"> <?php the_title();
                        ?></a></p>
                <?php
                $cartel = get_post_meta(get_the_id(), 'cartel', TRUE);
                ?>
                <img src="<?= $cartel ?>" alt="Cartel pelicula" />





            </article>
            <?php endwhile; ?>
<?php endif; ?>
    </section>
<?php get_footer(); ?>