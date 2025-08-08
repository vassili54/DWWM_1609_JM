
 <body> <div class="container">

       
<!--votre navbar ici -->

   <div class="navbar-wrapper">
    
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-header">
            <!-- Responsive Navbar Part 1:-->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1" >
                     <span class="sr-only">Apparaitre/Disparaitre Navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                      
                    </button>
            <a class="navbar-brand" href="#"><div id="logo"></div></a>
            </div>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="navbar-collapse collapse" id="collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Accueil</a></li>
                <li><a href="#about">Agence</a></li>
                <li><a href="#contact">Services</a></li>
                <!-- Read about Bootstrap dropdowns at https://getbootstrap.com/2.3.0/javascript.html#dropdowns -->
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
                <li><a href="#">Gestion des biens</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->
