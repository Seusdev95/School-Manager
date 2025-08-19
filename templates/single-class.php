<?php
get_header();
?>

<style>
.clase-detalle {
  max-width: 900px;
  margin: 30px auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  overflow: hidden;
}
.clase-header {
  position: relative;
}
.clase-header img {
  width: 100%;
  height: 280px;
  object-fit: cover;
}
.clase-body {
  padding: 25px;
}
.clase-body h1 {
  margin-bottom: 15px;
  color: #0077b6;
}
.clase-meta {
  margin: 10px 0;
  font-size: 1rem;
  color: #444;
}
.clase-meta strong {
  color: #000;
}
.reservar-btn {
  display:inline-block;
  padding:12px 16px;
  background:#0077b6;
  color:#fff;
  border-radius:6px;
  text-decoration:none;
  font-weight: bold;
}
.reservar-btn:hover { background:#023e8a; }
</style>

<main>
  <?php if (have_posts()): while (have_posts()): the_post();

    // Inicializar variables personalizadas
    $precio    = get_post_meta(get_the_ID(), '_sm_precio', true) ?: '';
    $duracion  = get_post_meta(get_the_ID(), '_sm_duracion', true) ?: '';
    $deporte   = get_post_meta(get_the_ID(), '_sm_deporte', true) ?: '';
    $nivel     = get_post_meta(get_the_ID(), '_sm_nivel', true) ?: '';
    $profesor  = get_post_meta(get_the_ID(), '_sm_profesor', true) ?: '';
    $fecha     = get_post_meta(get_the_ID(), '_sm_fecha', true) ?: '';
    $hora      = get_post_meta(get_the_ID(), '_sm_hora', true) ?: '';
    $cupos     = get_post_meta(get_the_ID(), '_sm_cupos', true) ?: '';
  ?>
    <article class="clase-detalle">
      <div class="clase-header">
        <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
      </div>
      <div class="clase-body">
        <h1><?php the_title(); ?></h1>

        <?php if ($deporte)   echo "<div class='clase-meta'><strong>Deporte:</strong> " . esc_html($deporte) . "</div>"; ?>
        <?php if ($nivel)     echo "<div class='clase-meta'><strong>Nivel:</strong> " . esc_html($nivel) . "</div>"; ?>
        <?php if ($profesor)  echo "<div class='clase-meta'><strong>Profesor:</strong> " . esc_html($profesor) . "</div>"; ?>
        <?php if ($fecha)     echo "<div class='clase-meta'><strong>Fecha:</strong> " . esc_html($fecha) . "</div>"; ?>
        <?php if ($hora)      echo "<div class='clase-meta'><strong>Hora:</strong> " . esc_html($hora) . "</div>"; ?>
        <?php if ($cupos)     echo "<div class='clase-meta'><strong>Cupos disponibles:</strong> " . esc_html($cupos) . "</div>"; ?>
        <?php if ($duracion)  echo "<div class='clase-meta'><strong>Duración:</strong> " . esc_html($duracion) . " min</div>"; ?>
        <?php if ($precio)    echo "<div class='clase-meta'><strong>Precio:</strong> $" . esc_html($precio) . " COP</div>"; ?>

        <div class="clase-descripcion">
          <?php the_content(); ?>
        </div>
        <!-- Botón y formulario de reserva -->
<a class="reservar-btn" href="#formulario-reserva">Reservar esta clase</a>

<hr style="margin:40px 0 20px 0;">

<div id="formulario-reserva" style="background:#f8f9fa; padding:22px; border-radius:7px; max-width:500px; margin:30px auto 0 auto;">
  <h3 style="margin-top:0;">Solicitar reserva</h3>
  <form method="POST">
    <input type="hidden" name="clase_reservada" value="<?php echo esc_attr(get_the_ID()); ?>">
    <div style="margin-bottom:12px;">
      <label for="sm_nombre">Tu nombre:</label>
      <input type="text" id="sm_nombre" name="sm_nombre" required style="width:100%;">
    </div>
    <div style="margin-bottom:12px;">
      <label for="sm_email">Tu correo:</label>
      <input type="email" id="sm_email" name="sm_email" required style="width:100%;">
    </div>
    <div style="margin-bottom:12px;">
      <label for="sm_mensaje">Mensaje:</label>
      <textarea id="sm_mensaje" name="sm_mensaje" rows="3" style="width:100%;"></textarea>
    </div>
    <button type="submit" class="reservar-btn">Enviar solicitud</button>
  </form>
  <?php
  // Procesar el formulario y enviar email al admin
  if (
      isset($_POST['clase_reservada'])
      && isset($_POST['sm_nombre'])
      && isset($_POST['sm_email'])
      && is_email($_POST['sm_email'])
  ) {
      $clase_id   = intval($_POST['clase_reservada']);
      $nombre     = sanitize_text_field($_POST['sm_nombre']);
      $email      = sanitize_email($_POST['sm_email']);
      $mensaje    = sanitize_textarea_field($_POST['sm_mensaje']);
      $clase_titulo = get_the_title($clase_id);
      $admin_email = get_option('admin_email');
      $body = "Reserva para la clase: $clase_titulo \nNombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";
      wp_mail($admin_email, "Reserva enviada desde la web", $body, array('Reply-To:' . $email));
      echo '<div style="margin-top:12px;color:green;">¡Gracias! Tu solicitud ha sido enviada.</div>';
  }
  ?>
</div>

        <a class="reservar-btn" href="#">Reservar esta clase</a>
      </div>
    </article>
  <?php endwhile; endif; ?>
</main>

<?php
get_footer();