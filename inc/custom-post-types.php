<?php
// Archivo: custom-post-types.php
// Descripción: Registro de Custom Post Types para Esferas y Tejedores.

function registrar_cpts_personalizados() {
    // CPT para "Esferas"
    register_post_type('esferas', array(
        'labels' => array(
            'name' => __('Esferas', 'textdomain'),
            'singular_name' => __('Esfera', 'textdomain'),
            'add_new' => __('Añadir nueva Esfera', 'textdomain'),
            'add_new_item' => __('Añadir nueva entrada para Esferas', 'textdomain'),
            'edit_item' => __('Editar entrada para Esferas', 'textdomain'),
            'new_item' => __('Nueva entrada para Esferas', 'textdomain'),
            'view_item' => __('Ver entrada para Esferas', 'textdomain'),
            'search_items' => __('Buscar en Esferas', 'textdomain'),
            'not_found' => __('No se encontraron entradas para Esferas', 'textdomain'),
            'menu_name' => __('Esferas', 'textdomain'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'esferas'),
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
