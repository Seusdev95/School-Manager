<?php
get_header();
?>

<style>
/* ====== GRID DE CLASES ====== */
.clases-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 25px;
  padding: 30px;
}
.clase-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.clase-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}
.clase-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}
.clase-card-body {
  padding: 20px;
}
.clase-card h3 {
  margin: 0 0 10px;
  color: #0077b6;
  font-size: 1.4rem;
}
.clase-meta {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 6px;
}
.clase-card .btn {
  display: inline-block;
  margin-top: 10px;
  padding: 10px 14px;
  background-color: #0077b6;
  color: #fff;
  border-radius: 6px;
  text-decoration: none;
  font-weight: bold;
}
.clase-card .btn:hover {
  background-color: #023e8a;
}
</style>

<main>
  <h2 style="text-align:center; margin:20px 0;">Clases disponibles</h2>
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
          <div class="clase-card-body">
            <h3><?php the_title(); ?></h3>
            
            <?php if ($deporte)   echo "<div class='clase-meta'><strong>Deporte:</strong> " . esc_html($deporte) . "</div>"; ?>
            <?php if ($nivel)     echo "<div class='clase-meta'><strong>Nivel:</strong> " . esc_html($nivel) . "</div>"; ?>
            <?php if ($profesor)  echo "<div class='clase-meta'><strong>Profesor:</strong> " . esc_html($profesor) . "</div>"; ?>
            <?php if ($fecha)     echo "<div class='clase-meta'><strong>Fecha:</strong> " . esc_html($fecha) . "</div>"; ?>
            <?php if ($hora)      echo "<div class='clase-meta'><strong>Hora:</strong> " . esc_html($hora) . "</div>"; ?>
            <?php if ($cupos)     echo "<div class='clase-meta'><strong>Cupos:</strong> " . esc_html($cupos) . "</div>"; ?>
            <?php if ($duracion)  echo "<div class='clase-meta'><strong>Duración:</strong> " . esc_html($duracion) . " min</div>"; ?>
            <?php if ($precio)    echo "<div class='clase-meta'><strong>Precio:</strong> $" . esc_html($precio) . " COP</div>"; ?>
            
            <a href="<?php the_permalink(); ?>" class="btn">Ver detalles</a>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="padding:20px;">No hay clases disponibles en este momento.</p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();