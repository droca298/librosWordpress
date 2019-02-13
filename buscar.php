<?php
/*
Template Name: Buscar
*/
get_header(); ?>
    <section class="container">
        <h2>Búsqueda de películas</h2>
        <form class="col-md-6" name="sear
ch" method="get" action="<?php
        bloginfo('url');
        ?>">
            <div class="form-group">
                <label for="s">Búsqueda por palabra clave:</label>
                <input id="s" type="text" name="s"
                >
            </div>
            <div class="form-group">
                <label for="director">Búsqueda por director/a: </label>
                <input id="director" type="text" name="director"
                >
            </div>
            <div class="form-group">
                <label>Búsqueda por género:</label>
                <select name="genero" id="genero">
                    <?php
                    $generos = get_terms('genero');
                    foreach ($generos as $genero) {
                        echo '<option value="' . $genero->name . '">' . $genero->name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <button class="btn btn-default"
                        type="submit">Buscar
                </button>
            </div>
        </form>
    </section>
<?php get_footer(); ?>