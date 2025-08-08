<?php
/* Template Name: Contact */
get_header(); ?>

<div id="page-wrapper">
  <main>
    <h1>Contactez-nous</h1>
    <p>📍 7 rue de la mairie, 68100 Mulhouse</p>
    <p>📅 Ouvert du lundi au samedi, de 8h à 23h</p>

    <h2>📬 Formulaire de contact</h2>
    <?php echo do_shortcode('[contact-form-7 id="123" title="Formulaire de contact"]'); ?>

    <h2>🗺️ Nous trouver</h2>
    <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=7.33%2C47.75%2C7.35%2C47.77&layer=mapnik" width="100%" height="300" frameborder="0"></iframe>
  </main>

  <?php get_footer(); ?>
</div>