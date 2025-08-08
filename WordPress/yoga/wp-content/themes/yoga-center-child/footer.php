<!-- Bandeau cookies -->
<!-- <div id="cookie-banner">
  Ce site utilise des cookies pour améliorer votre expérience.
  <a href="/politique-des-cookies">En savoir plus</a>
  <button onclick="document.getElementById('cookie-banner').style.display='none'">J'accepte</button>
</div> -->

<footer>
  <div class="footer-inner">
    <div class="footer-widgets">
      <div class="footer-col">
        <?php if (is_active_sidebar('footer-1')) dynamic_sidebar('footer-1'); ?>
      </div>
      <div class="footer-col">
        <?php if (is_active_sidebar('footer-2')) dynamic_sidebar('footer-2'); ?>
      </div>
      <div class="footer-col">
        <?php if (is_active_sidebar('footer-3')) dynamic_sidebar('footer-3'); ?>
      </div>
    </div>

    <div class="footer-legal">
      <a href="/mentions-legales">Mentions légales</a>
      <a href="/declaration-de-confidentialite">Déclaration de confidentialité</a>
      <a href="/politique-des-cookies">Politique des cookies</a>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> YOGA CENTER Mulhouse. Tous droits réservés.</p>
    </div>
  </div>

  <?php wp_footer(); ?>
</footer>
