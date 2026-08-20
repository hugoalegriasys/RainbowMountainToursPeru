<?php

use App\Providers\ThemeServiceProvider;
use Roots\Acorn\Application;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

add_filter( 'wpcf7_form_tag', 'dinamizar_lista_de_tours', 10, 2 );

function dinamizar_lista_de_tours( $tag, $replace ) {
    if ( $tag['name'] !== 'interest' ) {
        return $tag;
    }

    $args = array(
        'post_type'      => 'page',
        'post_parent'    => 377,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $tours = get_posts( $args );

    if ( ! $tours ) {
        return $tag;
    }

    $tag['raw_values'] = array('Select Your Tour');
    $tag['values']     = array('Select Your Tour');
    $tag['labels']     = array('Select Your Tour');

    foreach ( $tours as $tour ) {
        $tag['raw_values'][] = $tour->post_title;
        $tag['values'][]     = $tour->post_title;
        $tag['labels'][]     = $tour->post_title;
    }

    return $tag;
}

// Registrar Custom Post Type para Tours
function registrar_cpt_tours() {
    $labels = array(
        'name'                  => _x( 'Tours', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Tour', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Tours', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Tour', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Añadir nuevo', 'textdomain' ),
        'add_new_item'          => __( 'Añadir nuevo Tour', 'textdomain' ),
        'new_item'              => __( 'Nuevo Tour', 'textdomain' ),
        'edit_item'             => __( 'Editar Tour', 'textdomain' ),
        'view_item'             => __( 'Ver Tour', 'textdomain' ),
        'all_items'             => __( 'Todos los Tours', 'textdomain' ),
        'search_items'          => __( 'Buscar Tours', 'textdomain' ),
        'not_found'             => __( 'No se encontraron tours.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No hay tours en la papelera.', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'tours' ), // Esto hará que tus URLs sean midominio.com/tours/nombre-del-tour
        'capability_type'    => 'post',
        'has_archive'        => true, // Permite tener una página de archivo
        'hierarchical'       => true, // Permite tener orden (menu_order) como las páginas
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-backpack', // Ícono de mochila
        'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
        'show_in_rest'       => true, // Habilita el editor de bloques (Gutenberg) si lo necesitas
    );

    register_post_type( 'tour', $args );
}
add_action( 'init', 'registrar_cpt_tours' );