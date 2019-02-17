<?php get_header(); ?>
    <section class="container">
        <?php
        $args = array(
            'post_type' => 'film',
            'showposts' => '6',
            'orderby' => 'rand',
        );
        query_posts($args);
        ?>
        <div class="row">
        <?php
        if (have_posts()) : while (have_posts()) : the_post(); ?>



            <div class="card col-md-4 col-sm-6 col-xs-12" style="width: 18rem;">
                <?php
                $cartel = get_post_meta(get_the_id(), 'cartel', TRUE);
                ?>

                <img style="height: 190px; width: 150px; display: block; margin: auto;" src="<?= $cartel ?>" class="card-img-top" alt="Cartel pelicula" />
                <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>
                    <a class="card-body"><?php the_excerpt(); ?></a>

                </div>
            </div>



            <?php endwhile; ?>
        </div>
<?php endif; ?>
    </section>
<?php get_footer(); ?>