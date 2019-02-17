<?php

register_nav_menus(array(
    'menu-superior' => 'Menú Superior',
));

add_action('init', 'registro_cpt_film');


function registro_cpt_film()
{
    $etiquetas = array(
        'name' => _x('Libros', 'film'),
        'singular_name' => _x('Libro', 'film'),
        'add_new' => _x('Añadir un nuevo libro', 'film'),
        'add_new_item' => _x('Añadir un nuevo libro', 'film'),
        'edit_item' => _x('Editar Libro', 'film'),
        'new_item' => _x('Nuevo Libro', 'film'),
        'view_item' => _x('Ver libro', 'film'),
        'search_items' => _x('Buscar libro', 'film'),
        'not_found' => _x('No se han encontrado libros', 'film'),
        'not_found_in_trash' => _x('No se han encontrado libros en la
papelera', 'film'),
        'parent_item_colon' => _x('Libros superior:', 'film'),
        'menu_name' => _x('Libros', 'film'),
    );
    $args = array(
        'labels' => $etiquetas,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_in_menu' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies' => array('post_tag'),
        'rewrite' => array('slug' => 'films', 'with_front' => false),
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'description' => 'Films proyectados en el festival',
    );
    register_post_type('film', $args);
}

add_action('init', 'registro_taxonomias_film');

function registro_taxonomias_film()
{
    $etiquetas = array(
        'name' => _x('Géneros', 'taxonomy general name'),
        'singular_name' => _x('Género', 'taxonomy singular name'),
        'add_new' => _x('Añadir Género', 'género'),
        'add_new_item' => ('Añadir Género'),
        'edit_item' => ('Editar Género'),
        'new_item' => ('Nuevo Género'),
        'view_item' => ('Ver Género'),
        'search_items' => ('Buscar Géneros'),
        'not_found' => ('No encontrado'),
        'not_found_in_trash' => ('No encontrado'),
    );
    $tipo_objeto = array('film');
    $args = array(
        'labels' => $etiquetas,
        'show_ui' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'Generos'),
    );
    register_taxonomy('genero', $tipo_objeto, $args);
}

add_action("admin_init", "añadir_metaboxes"); //hook de añadir_metaboxes

function añadir_metaboxes()
{
    add_meta_box("metabox-film", "Ficha del Film", "mostrar_metaboxes",
        "film", "normal", "high");
}

function mostrar_metaboxes()
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    $custom = get_post_custom($post->ID);
    if (isset($custom)) {
        if (empty($custom["autor"][0])) { // De director a autor
            $custom["autor"][0] = NULL;
        }
        if (empty($custom["cartel"][0])) {
            $custom["cartel"][0] = NULL;
        }
        if (empty($custom["unidades"][0])) { //De estreno a unidades
            $custom["unidades"][0] = NULL;
        }
        if (empty($custom["nacionalidad"][0])) {
            $custom["nacionalidad"][0] = NULL;
        }
        if (empty($custom["precio"][0])) { //De oficial a precio
            $custom["precio"][0] = NULL;
        }
        if (empty($custom["isbn"][0])) { //De trailer a isbn
            $custom["isbn"][0] = NULL;
        }
        $autor = $custom["autor"][0];
        $cartel = $custom["cartel"][0];
        $unidades = $custom["unidades"][0];
        $nacionalidad = $custom["nacionalidad"][0];
        $precio = $custom["precio"][0];
        $isbn = $custom["isbn"][0];
    } else {
        $autor = NULL;
        $cartel = NULL;
        $unidades = NULL;
        $nacionalidad = NULL;
        $precio = NULL;
        $isbn = NULL;
    }
    ?>

    <style type="text/css">
        <?php include('css/admin-film.css');?>
    </style>
    <div><label>Autor: </label><input type="text" name="autor"
                                          value="<?php echo $autor ?>"/></div>
    <div><label>Cartel: </label><input type="url" name="cartel" value="<?php
        echo $cartel ?>"/></div>
    <div><label>Unidades: </label><input type="number" name="unidades" value="<?php
        echo $unidades ?>"/></div>
    <div><label>Nacionalidad: </label><input type="text" name="nacionalidad"
                                            value="<?php echo $nacionalidad ?>"/></div>
    <div><label>Precio/u: </label><input type="number" name="precio" value="<?php
        echo $precio ?>"/></div>
    <div><label>ISBN: </label><input type="text" name="isbn" value="<?php
        echo $isbn ?>"/></div>
    <?php
}

add_action('save_post', 'guardar_metaboxes');

function guardar_metaboxes()
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    } else {
        if ($post) {
            update_post_meta($post->ID, "autor", $_POST["autor"]);
            update_post_meta($post->ID, "cartel", $_POST["cartel"]);
            update_post_meta($post->ID, "unidades", $_POST["unidades"]);
            update_post_meta($post->ID, "nacionalidad", $_POST["nacionalidad"]);
            update_post_meta($post->ID, "isbn", $_POST["isbn"]);
            update_post_meta($post->ID, "precio", $_POST["precio"]);
        }
    }
}

add_filter("manage_edit-film_columns", "gestor_columnas_film");

function gestor_columnas_film($columns)
{
    $columnas = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Libro",
        "descripcion" => "Sinopsis",
        "autor" => "Autor",
        "cartel" => "Cartel",
        "nacionalidad" => "Nacionalidad",
        "géneros" => "Géneros",
        "precio" => "Precio",
        "isbn" => "ISBN",
    );
    return $columnas;
}

add_action("manage_posts_custom_column", "gestor_columnas_custom");

function gestor_columnas_custom($column)
{
    global $post;
    $custom = get_post_custom();
    switch ($column) {
        case "descripcion":
            the_excerpt();
            break;
        case "autor":
            echo $custom["autor"][0];
            break;
        case "cartel";
            echo $custom["cartel"][0];
            break;
        case "unidades";
            echo $custom["unidades"][0];
            break;
        case "nacionalidad";
            echo $custom["nacionalidad"][0];
            break;
        case "géneros";
            echo get_the_term_list($post->ID, 'genero');//Incluimos un listado de las categorías a las que pertenece la película
            break;
        case "precio";
            echo $custom["precio"][0];
            break;
        case "isbn";
            echo $custom["isbn"][0];
            break;
    }
}

add_filter('excerpt_length', 'longitud_excerpt');

function longitud_excerpt($length)
{
    return 25;
}

add_filter('excerpt_more', 'mi_excerpt_leermas');

function mi_excerpt_leermas()
{
    global $post;
    return '<br/><br/><a class="btn btn-warning text-light btn-block" href="' . get_permalink($post->ID) . '"> Leer más...</a>';
}

?>