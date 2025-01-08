<?php

/**
 * Encola los estilos del tema padre y del tema hijo.
 *
 * Esta función se encarga de cargar los estilos CSS del tema padre y del tema hijo
 * en el orden correcto, asegurando que el estilo del tema hijo dependa del estilo
 * del tema padre.
 *
 * @return void
 */
function twentytwentyfour_child_enqueue_styles()
{
    // Encola el estilo del tema padre
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );
    // Encola el estilo del tema hijo, dependiente del estilo del tema padre
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}



/**
 * Encola los estilos del tema hijo.
 *
 * Esta función se engancha al hook 'wp_enqueue_scripts' para encolar
 * los estilos del tema hijo, asegurando que se carguen después de los
 * estilos del tema padre.
 */
add_action('wp_enqueue_scripts', 'twentytwentyfour_child_enqueue_styles');

/**
 * Incluye el archivo que contiene los Custom Post Types.
 * 
 * Este archivo define y registra los tipos de publicaciones personalizadas
 * utilizados en el tema hijo de Twenty Twenty-Four.
 * 
 * @package TwentyTwentyFourChild
 */
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';

// // Desactiva la barra de administración para usuarios que no pueden editar publicaciones
// add_action('after_setup_theme', function () {
//     if (!current_user_can('edit_posts')) { // Revisa si el usuario no tiene permiso para editar publicaciones
//         add_filter('show_admin_bar', '__return_false'); // Desactiva la barra de administración
//     }
// });

// // Redirige a la página de inicio si un usuario sin permisos intenta acceder al área de administración
// add_action('init', function () {
//     if (is_admin() && !current_user_can('edit_posts') && !defined('DOING_AJAX')) {
//         wp_safe_redirect(home_url()); // Redirige a la página de inicio
//         exit; // Termina la ejecución del script
//     }
// });

/**
 * Filtro para cambiar el texto de RSVP dinámicamente.
 *
 * Este filtro utiliza una función anónima para verificar si el dominio es 'event-tickets'
 * y el texto original es 'RSVP Here'. Si ambas condiciones se cumplen, cambia el texto a
 * 'Confirma tu asistencia'. De lo contrario, devuelve el texto traducido original.
 *
 * @param string $translated El texto traducido.
 * @param string $original El texto original sin traducir.
 * @param string $domain El dominio del texto.
 * @return string El texto modificado o el texto traducido original.
 */
add_filter('gettext', function ($translated, $original, $domain) {
    // Verifica si el dominio es 'event-tickets' y el texto original es 'RSVP Here'
    if ($domain === 'event-tickets' && $original === 'RSVP Here') {
        // Si es así, cambia el texto a 'Confirma tu asistencia'
        return 'Confirma tu asistencia';
    }
    // Si no, devuelve el texto traducido original
    return $translated;
}, 10, 3);

add_action('admin_head', function () {
    ob_start(function ($output) {
        // Busca el contenedor HTML de la notificación y lo elimina
        return preg_replace('/<div class="error wppb-serial-notification".*?<\/div>/s', '', $output);
    });
});
