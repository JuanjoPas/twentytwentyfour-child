<?php
// Cargar estilos del tema padre y del tema hijo
function twentytwentyfour_child_enqueue_styles() {
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
add_action('wp_enqueue_scripts', 'twentytwentyfour_child_enqueue_styles');

// Incluir el archivo con los Custom Post Types.
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';
 // Incluir el archivo con los Custom Post Types.