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
    // 1. Solo afectamos al campo que se llama "interest"
    if ( $tag['name'] !== 'interest' ) {
        return $tag;
    }

    // 2. Consultamos las Páginas que son "hijas" de Destinations
    $args = array(
        'post_type'      => 'page', // Son páginas normales
        'post_parent'    => 377,    // <--- REEMPLAZA EL 123 POR EL ID DE "DESTINATIONS"
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    );
    
    $tours = get_posts( $args );

    // Si no hay tours hijos, devolvemos el campo intacto
    if ( ! $tours ) {
        return $tag;
    }

    // 3. Reiniciamos la lista dejando solo la opción por defecto
    $tag['raw_values'] = array('Select Your Tour');
    $tag['values']     = array('Select Your Tour');
    $tag['labels']     = array('Select Your Tour');

    // 4. Llenamos el desplegable automáticamente
    foreach ( $tours as $tour ) {
        $tag['raw_values'][] = $tour->post_title;
        $tag['values'][]     = $tour->post_title;
        $tag['labels'][]     = $tour->post_title;
    }

    return $tag;
}