<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Evitar acceso directo

// === Registrar el metabox ===
add_action('add_meta_boxes', 'sm_add_class_metaboxes');
function sm_add_class_metaboxes() {
    add_meta_box(
        'sm_class_data',
        __('Datos de la Clase', 'school-manager'),
        'sm_class_metabox_callback',
        'class',
        'normal',
        'default'
    );
}

// === Dibujar el metabox ===
function sm_class_metabox_callback($post) {
    wp_nonce_field('sm_save_class', 'sm_class_nonce');

    // Obtener datos guardados o poner en blanco
    $precio     = get_post_meta($post->ID, '_sm_precio', true) ?: '';
    $duracion   = get_post_meta($post->ID, '_sm_duracion', true) ?: '';
    $deporte    = get_post_meta($post->ID, '_sm_deporte', true) ?: '';
    $nivel      = get_post_meta($post->ID, '_sm_nivel', true) ?: '';
    $profesor   = get_post_meta($post->ID, '_sm_profesor', true) ?: '';
    $fecha      = get_post_meta($post->ID, '_sm_fecha', true) ?: '';
    $hora       = get_post_meta($post->ID, '_sm_hora', true) ?: '';
    $cupos      = get_post_meta($post->ID, '_sm_cupos', true) ?: '';

    $niveles = array(
        'Principiante' => __('Principiante', 'school-manager'),
        'Intermedio'   => __('Intermedio', 'school-manager'),
        'Avanzado'     => __('Avanzado', 'school-manager'),
    );
    ?>
    <style>
      .sm-field { margin-bottom: 12px; }
      .sm-field label { display:block; font-weight:600; margin-bottom:6px; }
      .sm-field input, .sm-field select { width:100%; max-width: 400px; }
    </style>

    <div class="sm-field">
        <label for="sm_precio"><?php _e('Precio ($):', 'school-manager'); ?></label>
        <input type="number" step="0.01" min="0" id="sm_precio" name="_sm_precio" value="<?php echo esc_attr($precio); ?>" />
    </div>

    <div class="sm-field">
        <label for="sm_duracion"><?php _e('Duración (minutos):', 'school-manager'); ?></label>
        <input type="number" step="1" min="0" id="sm_duracion" name="_sm_duracion" value="<?php echo esc_attr($duracion); ?>" />
    </div>

    <div class="sm-field">
        <label for="sm_deporte"><?php _e('Tipo de Deporte:', 'school-manager'); ?></label>
        <input type="text" id="sm_deporte" name="_sm_deporte" value="<?php echo esc_attr($deporte); ?>" />
    </div>

    <div class="sm-field">
        <label for="sm_nivel"><?php _e('Nivel:', 'school-manager'); ?></label>
        <select id="sm_nivel" name="_sm_nivel">
            <option value=""><?php _e('Selecciona un nivel', 'school-manager'); ?></option>
            <?php foreach ($niveles as $key => $label): ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($nivel, $key); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="sm-field">
        <label for="sm_profesor"><?php _e('Profesor asignado:', 'school-manager'); ?></label>
        <input type="text" id="sm_profesor" name="_sm_profesor" value="<?php echo esc_attr($profesor); ?>" />
    </div>

    <div class="sm-field">
        <label for="sm_fecha"><?php _e('Fecha de la clase:', 'school-manager'); ?></label>
        <input type="date" id="sm_fecha" name="_sm_fecha" value="<?php echo esc_attr($fecha); ?>" />
    </div>

    <div class="sm-field">
        <label for="sm_hora"><?php _e('Hora de la clase:', 'school-manager'); ?></label>
        <input type="time" id="sm_hora" name="_sm_hora" value="<?php echo esc_attr($hora); ?>" />
    </div>

    <div class="sm-field">
        <label for="sm_cupos"><?php _e('Cupos disponibles:', 'school-manager'); ?></label>
        <input type="number" id="sm_cupos" name="_sm_cupos" value="<?php echo esc_attr($cupos); ?>" />
    </div>
    <?php
}

// === Guardar datos del metabox ===
add_action('save_post', 'sm_save_class_meta');
function sm_save_class_meta($post_id) {
    if (isset($_POST['post_type']) && $_POST['post_type'] !== 'class') return;
    if (!isset($_POST['sm_class_nonce']) || !wp_verify_nonce($_POST['sm_class_nonce'], 'sm_save_class')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Guardar
    $campos = array(
        '_sm_precio',
        '_sm_duracion',
        '_sm_deporte',
        '_sm_nivel',
        '_sm_profesor',
        '_sm_fecha',
        '_sm_hora',
        '_sm_cupos'
    );

    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            update_post_meta($post_id, $campo, sanitize_text_field($_POST[$campo]));
        }
    }
}