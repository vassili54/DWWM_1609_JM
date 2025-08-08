<?php get_header(); ?>

<div class="fond-yoga">
  <div class="background-image"></div>
  <div class="contenu">
    <h1>Bienvenue chez YOGA CENTER Mulhouse</h1>
    <p>Plongez dans un univers de bien-être, de mouvement et de sérénité.</p>
    <h2>Journée Portes Ouvertes – 1er septembre</h2>
  </div>
</div>


<section class="evenement">
  <?php
  $args = array(
    'category_name' => 'evenements',
    'posts_per_page' => 1
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>
      <h3><?php the_title(); ?></h3>
      <?php the_excerpt(); ?>
      <a href="<?php the_permalink(); ?>"><button>Lire l’article</button></a>
  <?php endwhile;
  endif;
  wp_reset_postdata();
  ?>
</section>
</main>

<?php get_footer(); ?>
</div>