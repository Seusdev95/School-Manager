<?php

function school_manager_register_custom_post_types() {
    register_post_type('school_class', array(
        'labels' => array(
            'name' => 'Clases',
            'singular_name' => 'Clase',
            'add_new_item' => 'Agregar nueva clase',
            'edit_item' => 'Editar clase',
            'new_item' => 'Nueva clase',
            'view_item' => 'Ver clase',
            'all_items' => 'Todas las clases',
            'search_items' => 'Buscar clases',
            'not_found' => 'No se encontraron clases',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
}

add_action('init', 'school_manager_register_custom_post_types');