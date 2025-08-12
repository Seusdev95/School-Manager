<?php
// Evita el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Registrar Custom Post Type: Clases
 */
function sm_register_post_type_class() {

    $labels = array(
        'name'                  => _x( 'Clases', 'Post Type General Name', 'school-manager' ),
        'singular_name'         => _x( 'Clase', 'Post Type Singular Name', 'school-manager' ),
        'menu_name'             => __( 'Clases', 'school-manager' ),
        'name_admin_bar'        => __( 'Clase', 'school-manager' ),
        'add_new_item'          => __( 'Añadir Nueva Clase', 'school-manager' ),
        'new_item'              => __( 'Nueva Clase', 'school-manager' ),
        'edit_item'             => __( 'Editar Clase', 'school-manager' ),
        'view_item'             => __( 'Ver Clase', 'school-manager' ),
        'all_items'             => __( 'Todas las Clases', 'school-manager' ),
        'search_items'          => __( 'Buscar Clases', 'school-manager' ),
        'not_found'             => __( 'No se encontraron clases', 'school-manager' ),
        'not_found_in_trash'    => __( 'No se encontraron clases en la papelera', 'school-manager' ),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'clases' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more', // Icono en el admin
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies'            => array( 'sport', 'level' ), // Conecta con tus taxonomías
        'show_in_rest'          => true, // Compatible con el editor de bloques
    );

    register_post_type( 'class', $args );
}
add_action( 'init', 'sm_register_post_type_class' );
