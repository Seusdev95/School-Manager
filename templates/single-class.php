<?php
get_header();
?>

<style>
.clase-detalle {
  max-width: 900px;
  margin: 30px auto;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.clase-detalle img {
  max-width: 100%;
  border-radius: 6px;
  margin-bottom: 15px;
}
.clase-detalle h1 { color: #0077b6; }
.clase-meta {
  background-color: #f0f8ff;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 15px;
}
.clase-meta p { margin: 5px 0; }
.reservar-btn {
  display:inline-block;
  padding:10px 14px;
  background:#0077b6;
  color:#fff;
  text-decoration:none;
  border-radius:6px;
}
.reservar-btn:hover { background:#023e8a; }
</style>

<main>
  <?php if (have_posts()): while (have_posts()): the_post();

    // Inicializar campos personalizados
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
      <h1><?php the_title(); ?></h1>
      <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>

      <div class="clase-meta">
        <?php if ($deporte)   echo "<p><strong>Deporte:</strong> " . esc_html($deporte) . "</p>"; ?>
        <?php if ($nivel)     echo "<p><strong>Nivel:</strong> " . esc_html($nivel) . "</p>"; ?>
        <?php if ($profesor)  echo "<p><strong>Profesor:</strong> " . esc_html($profesor) . "</p>"; ?>
        <?php if ($fecha)     echo "<p><strong>Fecha:</strong> " . esc_html($fecha) . "</p>"; ?>
        <?php if ($hora)      echo "<p><strong>Hora:</strong> " . esc_html($hora) . "</p>"; ?>
        <?php if ($cupos)     echo "<p><strong>Cupos disponibles:</strong> " . esc_html($cupos) . "</p>"; ?>
        <?php if ($duracion)  echo "<p><strong>Duración:</strong> " . esc_html($duracion) . " minutos</p>"; ?>
        <?php if ($precio)    echo "<p><strong>Precio:</strong> $" . esc_html($precio) . " COP</p>"; ?>
      </div>

      <div class="clase-descripcion">
        <?php the_content(); ?>
      </div>

      <!-- Futuro: botón de reserva -->
      <!-- <a class="reservar-btn" href="#">Reservar</a> -->
    </article>
  <?php endwhile; endif; ?>
</main>

<?php
get_footer();
?>