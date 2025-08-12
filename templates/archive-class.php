<?php
get_header();
?>

<style>
.clases-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
  padding: 20px;
}
.clase-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  background-color: white;
  box-shadow: 0 2px 5px rgba(0,0,0,0.08);
  transition: 0.3s;
}
.clase-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.clase-card img {
  max-width: 100%;
  border-radius: 6px;
}
.clase-card h3 {
  margin-top: 10px;
  color: #0077b6;
}
.clase-card p { margin: 5px 0; }
.clase-card a {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 12px;
  background-color: #0077b6;
  color: white;
  text-decoration: none;
  border-radius: 5px;
}
.clase-card a:hover { background-color: #023e8a; }
</style>

<main>
  <h2 style="text-align:center; margin-top:20px;">Clases disponibles</h2>
  <div class="clases-container">
    <?php if (have_posts()): ?>
      <?php while (have_posts()): the_post();

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
        <article class="clase-card">
          <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
          <h3><?php the_title(); ?></h3>
          
          <?php if ($deporte)   echo "<p>Deporte: " . esc_html($deporte) . "</p>"; ?>
          <?php if ($nivel)     echo "<p>Nivel: " . esc_html($nivel) . "</p>"; ?>
          <?php if ($profesor)  echo "<p>Profesor: " . esc_html($profesor) . "</p>"; ?>
          <?php if ($fecha)     echo "<p>Fecha: " . esc_html($fecha) . "</p>"; ?>
          <?php if ($hora)      echo "<p>Hora: " . esc_html($hora) . "</p>"; ?>
          <?php if ($cupos)     echo "<p>Cupos: " . esc_html($cupos) . "</p>"; ?>
          <?php if ($duracion)  echo "<p>Duración: " . esc_html($duracion) . " minutos</p>"; ?>
          <?php if ($precio)    echo "<p>Precio: $" . esc_html($precio) . " COP</p>"; ?>
          
          <a href="<?php the_permalink(); ?>">Ver detalles</a>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="padding:20px;">No hay clases disponibles en este momento.</p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
?>