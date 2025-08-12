<?php
/**
 * Plugin Name: School Manager
 * Description: Plugin para gestionar clases, profesores, inventario y pagos en escuelas de deportes acuáticos.
 * Version: 1.0
 * Author: Juan Useche
 */

if (!defined('ABSPATH')) {
    exit;
}
// Sobrescribir la plantilla del listado
add_filter('template_include', function($template) {
    if (is_post_type_archive('class')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/archive-class.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    if (is_singular('class')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/single-class.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
});
// Custom Post Types
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-post-types.php';

// Custom Taxonomies
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-taxonomies.php';

// Si tienes otras funciones, se cargan aquí
require_once plugin_dir_path( __FILE__ ) . 'includes/class-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-meta-boxes.php';
