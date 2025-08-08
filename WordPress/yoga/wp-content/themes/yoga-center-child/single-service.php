<?php get_header(); ?>
<main style="max-width: 800px; margin: auto; padding: 40px 20px;">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
    <article <?php post_class(); ?>>

      <h1 style="margin-bottom: 10px;"><?php the_title(); ?></h1>
      <p style="font-size: 0.9em; color: #835b1f;">
        <em> <?php the_category(', '); ?></em>
      </p>

      <div style="margin-top: 20px;">
        <?php the_excerpt(); ?><br>
        <?php  echo "Durée : ". get_field('duree_du_service')." heure(s) <br>"; echo "Prix : ".get_field('prix')."€"; // Exemple de récupération d'un champ personnalisé ?>
      </div>

      <hr style="margin: 40px 0; border: none; border-top: 1px solid #b69351;">

      <section id="comments">
        <?php comments_template(); ?>
      </section>

    </article>

  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>