<!-- ProjetFileRouge/views/menu.php -->

<div class="navbar-wrapper">
  <div class="navbar navbar-inverse">
    <!-- NOUVEAU : Revenir à la classe 'container' -->
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1">
          <span class="sr-only">Apparaitre/Disparaitre Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <div id="logo"></div>
          <!-- Le texte "Immo du chateau" ne doit pas être ici s'il est déjà dans l'image ou ailleurs -->
        </a>
      </div>
      <div class="navbar-collapse collapse" id="collapse-1">
        <!-- Liens de navigation principaux alignés à gauche -->
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Accueil</a></li>
          <li><a href="#about">Agence</a></li>
          <li><a href="#contact">Services</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Achats/ventes<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?lib_cat=appartement">Appartements</a></li>
              <li><a href="index.php?lib_cat=maison individuelle">Maisons</a></li>
              <li class="divider"></li>
              <li class="nav-header">Spécial investisseur</li>
              <li><a href="index.php?lib_cat=local professionnel">locaux professionnels</a></li>
              <li><a href="index.php?lib_cat=terrain">Terrains</a></li>
            </ul>
          </li>
          <li><a href="#contact">Simulateur de crédit</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Locations<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Appartements</a></li>
              <li><a href="#">Maisons</a></li>
              <li><a href="#">locaux professionnels</a></li>
              <li class="divider"></li>
              <li class="nav-header">Spécial loueur</li>
              <li><a href="#">Garages</a></li>
              <li><a href="#">Terrains</a></li>
            </ul>
          </li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="index.php?action=gestion_biens">Gestion des biens</a></li>
          <?php endif; ?>
        </ul>

        <!-- Liens spécifiques à l'utilisateur alignés à droite -->
        <ul class="nav navbar-nav navbar-right">
          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="#">Bienvenue, <?= htmlspecialchars($_SESSION['user_prenom']) ?></a></li>
            <li><a href="index.php?action=logout">Déconnexion</a></li>
          <?php else: ?>
            <li><a href="index.php?action=login">Accès gestion</a></li>
          <?php endif; ?>
        </ul>
      </div><!--/.navbar-collapse -->
    </div> <!-- /.container -->
  </div><!-- /.navbar -->
</div><!-- /.navbar-wrapper -->