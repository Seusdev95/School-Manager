<?php
// Evita el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Taxonomía: Deportes
 */
function sm_register_taxonomy_sport() {

    $labels = array(
        'name'              => _x( 'Deportes', 'taxonomy general name', 'school-manager' ),
        'singular_name'     => _x( 'Deporte', 'taxonomy singular name', 'school-manager' ),
        'search_items'      => __( 'Buscar Deportes', 'school-manager' ),
        'all_items'         => __( 'Todos los Deportes', 'school-manager' ),
        'parent_item'       => __( 'Deporte Padre', 'school-manager' ),
        'parent_item_colon' => __( 'Deporte Padre:', 'school-manager' ),
        'edit_item'         => __( 'Editar Deporte', 'school-manager' ),
        'update_item'       => __( 'Actualizar Deporte', 'school-manager' ),
        'add_new_item'      => __( 'Añadir Nuevo Deporte', 'school-manager' ),
        'new_item_name'     => __( 'Nombre del Nuevo Deporte', 'school-manager' ),
        'menu_name'         => __( 'Deportes', 'school-manager' ),
    );

    $args = array(
        'hierarchical'      => true, 
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'deporte' ),
    );

    register_taxonomy( 'sport', array( 'class' ), $args );
}
add_action( 'init', 'sm_register_taxonomy_sport' );

/**
 * Taxonomía: Niveles
 */
function sm_register_taxonomy_level() {

    $labels = array(
        'name'              => _x( 'Niveles', 'taxonomy general name', 'school-manager' ),
        'singular_name'     => _x( 'Nivel', 'taxonomy singular name', 'school-manager' ),
        'search_items'      => __( 'Buscar Niveles', 'school-manager' ),
        'all_items'         => __( 'Todos los Niveles', 'school-manager' ),
        'parent_item'       => __( 'Nivel Padre', 'school-manager' ),
        'parent_item_colon' => __( 'Nivel Padre:', 'school-manager' ),
        'edit_item'         => __( 'Editar Nivel', 'school-manager' ),
        'update_item'       => __( 'Actualizar Nivel', 'school-manager' ),
        'add_new_item'      => __( 'Añadir Nuevo Nivel', 'school-manager' ),
        'new_item_name'     => __( 'Nombre del Nuevo Nivel', 'school-manager' ),
        'menu_name'         => __( 'Niveles', 'school-manager' ),
    );

    $args = array(
        'hierarchical'      => true, 
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'nivel' ),
    );

    register_taxonomy( 'level', array( 'class' ), $args );
}
add_action( 'init', 'sm_register_taxonomy_level' );