<?php
// Archivo: custom-post-types.php
// Descripción: Registro de Custom Post Types para Esfera y Tejedores.

function registrar_cpts_personalizados()
{
    // CPT para "Esfera"
    register_post_type('esfera', array(
        'labels' => array(
            'name' => __('Esfera', 'textdomain'),
            'singular_name' => __('Esfera', 'textdomain'),
            'add_new' => __('Añadir nueva Esfera', 'textdomain'),
            'add_new_item' => __('Añadir nueva entrada para Esfera', 'textdomain'),
            'edit_item' => __('Editar entrada para Esfera', 'textdomain'),
            'new_item' => __('Nueva entrada para Esfera', 'textdomain'),
            'view_item' => __('Ver entrada para Esfera', 'textdomain'),
            'search_items' => __('Buscar en Esfera', 'textdomain'),
            'not_found' => __('No se encontraron entradas para Esfera', 'textdomain'),
            'menu_name' => __('Esfera', 'textdomain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'esfera'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true, // Habilita el editor de bloques
    ));

    // CPT para "Tejedores"
    register_post_type('tejedores', array(
        'labels' => array(
            'name' => __('Tejedores', 'textdomain'),
            'singular_name' => __('Tejedor', 'textdomain'),
            'add_new' => __('Añadir nuevo Tejedor', 'textdomain'),
            'add_new_item' => __('Añadir nueva entrada para Tejedores', 'textdomain'),
            'edit_item' => __('Editar entrada para Tejedores', 'textdomain'),
            'new_item' => __('Nueva entrada para Tejedores', 'textdomain'),
            'view_item' => __('Ver entrada para Tejedores', 'textdomain'),
            'search_items' => __('Buscar en Tejedores', 'textdomain'),
            'not_found' => __('No se encontraron entradas para Tejedores', 'textdomain'),
            'menu_name' => __('Tejedores', 'textdomain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'tejedores'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true, // Habilita el editor de bloques
    ));
}
add_action('init', 'registrar_cpts_personalizados');
