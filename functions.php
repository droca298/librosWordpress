<?php

register_nav_menus(array(
    'menu-superior' => 'Menú Superior',
));

add_action('init', 'registro_cpt_film');


function registro_cpt_film()
{
    $etiquetas = array(
        'name' => _x('Film', 'film'),
        'singular_name' => _x('Film', 'film'),
        'add_new' => _x('Añadir Film', 'film'),
        'add_new_item' => _x('Añadir Film', 'film'),
        'edit_item' => _x('Editar Film', 'film'),
        'new_item' => _x('Nuevo Film', 'film'),
        'view_item' => _x('Ver Film', 'film'),
        'search_items' => _x('Buscar Film', 'film'),
        'not_found' => _x('No se han encontrado films', 'film'),
        'not_found_in_trash' => _x('No se han encontrado films en la
papelera', 'film'),
        'parent_item_colon' => _x('Film superior:', 'film'),
        'menu_name' => _x('Films', 'film'),
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
        if (empty($custom["director"][0])) {
            $custom["director"][0] = NULL;
        }
        if (empty($custom["cartel"][0])) {
            $custom["cartel"][0] = NULL;
        }
        if (empty($custom["estreno"][0])) {
            $custom["estreno"][0] = NULL;
        }
        if (empty($custom["nacionalidad"][0])) {
            $custom["nacionalidad"][0] = NULL;
        }
        if (empty($custom["oficial"][0])) {
            $custom["oficial"][0] = NULL;
        }
        if (empty($custom["trailer"][0])) {
            $custom["trailer"][0] = NULL;
        }
        $director = $custom["director"][0];
        $cartel = $custom["cartel"][0];
        $estreno = $custom["estreno"][0];
        $nacionalidad = $custom["nacionalidad"][0];
        $oficial = $custom["oficial"][0];
        $trailer = $custom["trailer"][0];
    } else {
        $director = NULL;
        $cartel = NULL;
        $estreno = NULL;
        $nacionalidad = NULL;
        $oficial = NULL;
        $trailer = NULL;
    }
    ?>

    <style type="text/css">
        <?php include('css/admin-film.css');?>
    </style>
    <div><label>Director/a:</label><input type="text" name="director"
                                          value="<?php echo $director ?>"/></div>
    <div><label>Cartel:</label><input type="text" name="cartel" value="<?php
        echo $cartel ?>"/></div>
    <div><label>Estreno:</label><input type="text" name="estreno" value="<?php
        echo $estreno ?>"/></div>
    <div><label>Nacionalidad:</label><input type="text" name="nacionalidad"
                                            value="<?php echo $nacionalidad ?>"/></div>
    <div><label>Trailer:</label><input type="url" name="trailer" value="<?php
        echo $trailer ?>"/></div>
    <div><label>Concurso:</label>
    <select name="oficial">
        <option value="no">No participa en la Sección Oficial</option>
        <option value="si" <?php if ($oficial == "si") echo "Selected"; ?>
        >Participa en la Sección Oficial
        </option>
    </select>
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
            update_post_meta($post->ID, "director", $_POST["director"]);
            update_post_meta($post->ID, "cartel", $_POST["cartel"]);
            update_post_meta($post->ID, "estreno", $_POST["estreno"]);
            update_post_meta($post->ID, "nacionalidad", $_POST["nacionalidad"]);
            update_post_meta($post->ID, "trailer", $_POST["trailer"]);
            update_post_meta($post->ID, "oficial", $_POST["oficial"]);
        }
    }
}

add_filter("manage_edit-film_columns", "gestor_columnas_film");

function gestor_columnas_film($columns)
{
    $columnas = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Film",
        "descripcion" => "Sinopsis",
        "director" => "Director",
        "cartel" => "Cartel",
        "nacionalidad" => "Nacionalidad",
        "géneros" => "Géneros",
        "oficial" => "Sección Oficial",
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
        case "director":
            echo $custom["director"][0];
            break;
        case "cartel";
            echo $custom["cartel"][0];
            break;
        case "estreno";
            echo $custom["estreno"][0];
            break;
        case "nacionalidad";
            echo $custom["nacionalidad"][0];
            break;
        case "géneros";
            echo get_the_term_list($post->ID, 'genero');//Incluimos un listado de las categorías a las que pertenece la película
            break;
        case "oficial";
            if ($custom["oficial"][0] == "si") {
                echo 'Sí';
            } else {
                echo 'No';
            };//Si la película participa en la sección oficial lo indicamos con 'Sí' o 'No'
            break;
    }
}

add_filter('excerpt_length', 'longitud_excerpt');

function longitud_excerpt($length)
{
    return 10;
}

add_filter('excerpt_more', 'mi_excerpt_leermas');

function mi_excerpt_leermas()
{
    global $post;
    return '<a href="' . get_permalink($post->ID) . '"> Leer más...</a>';
}

?>