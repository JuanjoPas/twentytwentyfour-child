<?php

/**
 * Encola los estilos del tema padre y del tema hijo.
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
 */
add_action('wp_enqueue_scripts', 'twentytwentyfour_child_enqueue_styles');

/**
 * Incluye el archivo que contiene los Custom Post Types.
 * @package TwentyTwentyFourChild
 */
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';

/**
 * Elimina la notificación de activación de la licencia de WP Page Builder.
 */
add_action('admin_head', function () {
    ob_start(function ($output) {
        // Busca el contenedor HTML de la notificación y lo elimina
        return preg_replace('/<div class="error wppb-serial-notification".*?<\/div>/s', '', $output);
    });
});
ob_start(function ($output) {
    // Busca el contenedor HTML de la notificación y lo elimina
    return preg_replace('/<div class="error wppb-serial-notification".*?<\/div>/s', '', $output);
});

/**
 * Filtra la pantalla de inicio de sesión para eliminar el selector de idioma.
 */
add_filter('login_display_language_dropdown', '__return_false');

/**
 * Eliminados por no ser necesarios
 * 
 * // Desactiva la barra de administración para usuarios que no pueden editar publicaciones
 * add_action('after_setup_theme', function () {
 *  if (!current_user_can('edit_posts')) { // Revisa si el usuario no tiene permiso para editar publicaciones
 *       add_filter('show_admin_bar', '__return_false'); // Desactiva la barra de administración
 *   }
 *});
 *
 * // Redirige a la página de inicio si un usuario sin permisos intenta acceder al área de administración
 * add_action('init', function () {
 *    if (is_admin() && !current_user_can('edit_posts') && !defined('DOING_AJAX')) {
 *        wp_safe_redirect(home_url()); // Redirige a la página de inicio
 *        exit; // Termina la ejecución del script
 *    }
 *});
 **/

/**
 * Redirige wp-login.php a la página personalizada de acceso.
 */
function redirect_wp_login_to_custom_page()
{
    // URL personalizada de la página de acceso
    $login_page = home_url('/acceso/');

    // Detectar si el usuario está intentando acceder a wp-login.php
    $current_url = $_SERVER['REQUEST_URI'];

    // Excluir la acción de logout
    if (
        strpos($current_url, 'wp-login.php') !== false
        && $_SERVER['REQUEST_METHOD'] === 'GET'
        && (! isset($_GET['action']) || $_GET['action'] !== 'logout')
    ) {
        // Redirigir a la página de acceso personalizada
        wp_redirect($login_page);
        exit;
    }
}
add_action('init', 'redirect_wp_login_to_custom_page');

/**
 * Filtro para cambiar textos dinámicamente en diferentes plugins.
 */
add_filter('gettext', function ($translated, $original, $domain) {
    // Lista de textos a reemplazar por dominio
    $translations = [
        'event-tickets' => [ // Dominio para el plugin Event Tickets
            'RSVP Here' => 'Confirma tu asistencia',
        ],
        'rcp' => [ // Dominio para Restrict Content Pro
            'Account Overview' => 'Resumen de cuenta',
            'Payment History' => 'Historial de pagos',
        ],
        // Agrega más dominios y textos aquí
        // 'otro-plugin' => [
        //     'Texto original' => 'Texto cambiado',
        // ],
    ];

    // Verifica si el dominio tiene traducciones definidas
    if (isset($translations[$domain])) {
        // Si el texto original coincide, realiza el cambio
        if (isset($translations[$domain][$original])) {
            return $translations[$domain][$original];
        }
    }

    // Si no coincide, devuelve el texto original traducido
    return $translated;
}, 10, 3);
