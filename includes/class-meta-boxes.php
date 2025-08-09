<?php
// Evita el acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Hook para registrar los metaboxes
add_action('add_meta_boxes', 'sm_add_class_meta_boxes');

// Hook para guardar los datos
add_action('save_post', 'sm_save_class_meta_boxes');

// Función que crea los campos en el panel de edición
function sm_add_class_meta_boxes() {
    add_meta_box(
        'sm_class_details',         // ID del metabox
        'Detalles de la Clase',     // Título visible
        'sm_render_class_fields',   // Función que dibuja los campos
        'sm_clase',                 // Tipo de post al que aplica
        'normal',                   // Contexto
        'high'                      // Prioridad
    );
}

// Renderiza los campos personalizados
function sm_render_class_fields($post) {
    // Recuperamos valores guardados anteriormente (si existen)
    $precio = get_post_meta($post->ID, '_sm_precio', true);
    $duracion = get_post_meta($post->ID, '_sm_duracion', true);
    $nivel = get_post_meta($post->ID, '_sm_nivel', true);
    $deporte = get_post_meta($post->ID, '_sm_deporte', true);

    ?>
    <label for="sm_precio">Precio ($):</label><br>
    <input type="number" name="sm_precio" id="sm_precio" value="<?php echo esc_attr($precio); ?>"><br><br>

    <label for="sm_duracion">Duración (minutos):</label><br>
    <input type="number" name="sm_duracion" id="sm_duracion" value="<?php echo esc_attr($duracion); ?>"><br><br>

    <label for="sm_deporte">Tipo de Deporte:</label><br>
    <input type="text" name="sm_deporte" id="sm_deporte" value="<?php echo esc_attr($deporte); ?>"><br><br>

    <label for="sm_nivel">Nivel:</label><br>
    <select name="sm_nivel" id="sm_nivel">
        <option value="Principiante" <?php selected($nivel, 'Principiante'); ?>>Principiante</option>
        <option value="Intermedio" <?php selected($nivel, 'Intermedio'); ?>>Intermedio</option>
        <option value="Avanzado" <?php selected($nivel, 'Avanzado'); ?>>Avanzado</option>
    </select>
    <?php
}

// Guarda los valores cuando el post se actualiza
function sm_save_class_meta_boxes($post_id) {
    // Evita errores en guardado automático
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Guardamos los campos si existen
    if (isset($_POST['sm_precio'])) {
        update_post_meta($post_id, '_sm_precio', sanitize_text_field($_POST['sm_precio']));
    }
    if (isset($_POST['sm_duracion'])) {
        update_post_meta($post_id, '_sm_duracion', sanitize_text_field($_POST['sm_duracion']));
    }
    if (isset($_POST['sm_deporte'])) {
        update_post_meta($post_id, '_sm_deporte', sanitize_text_field($_POST['sm_deporte']));
    }
    if (isset($_POST['sm_nivel'])) {
        update_post_meta($post_id, '_sm_nivel', sanitize_text_field($_POST['sm_nivel']));
    }
}