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

require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-meta-boxes.php';
