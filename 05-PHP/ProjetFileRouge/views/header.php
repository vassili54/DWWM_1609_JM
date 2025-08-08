<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>ImmoChateau</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Vos styles CSS intégrés -->
    <style>
        /* GLOBAL STYLES
        -------------------------------------------------- */
        body {
            padding-bottom: 40px;
            color: #5a5a5a;
        }

        .nav-header {
            text-align:center;
            font-style:italic;
        }

        /* CUSTOMIZE THE NAVBAR
        -------------------------------------------------- */
        /* Special class on .container surrounding .navbar, used for positioning it into place. */
        #logo{
            background-image:url("public/img/logochateau1.png");
            height:70px;
            width:124px;
            margin-top:-1px;
            /* margin-left: -16px; */ /* Cette ligne a été supprimée précédemment */
            flex-shrink: 0; /* Empêche le logo de rétrécir */
        }
        .navbar-brand {
            padding-top:0px;
            display: flex; /* Active Flexbox */
            align-items: center; /* Centre verticalement les éléments */
            gap: 10px; /* Espace entre le logo et le texte (ajustez si besoin) */
            height: 70px; /* Assure que la zone cliquable est la même hauteur que le logo */
            line-height: normal; /* Réinitialise la hauteur de ligne pour le texte */
            padding-left: 15px; /* Padding à gauche pour le logo */
            padding-right: 15px; /* Padding à droite pour l'espace */
        }
        .navbar-brand .brand-text {
            color: #fff; /* Couleur du texte "Immo du chateau" */
            font-size: 1.2em; /* Taille du texte */
            font-weight: bold;
            white-space: nowrap; /* Empêche le texte de passer à la ligne */
        }

        /* Ajuster le navbar-wrapper pour qu'il ne force pas la pleine largeur */
        .navbar-wrapper {

            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            margin-top: 20px;
            margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
            max-width: 1400px;
            width: 95%;
            margin-left: auto; /* Centre le wrapper horizontalement */
            margin-right: auto;
        }

        /* NOUVEAU : Cible le .navbar qui a aussi la classe .container pour ajuster sa largeur et le centrer */
      

        /* Supprimer la règle précédente qui ciblait .navbar.container, car la structure a changé */
        .navbar .container {
            width: 95%;
            max-width: 1400px;
            height: 0px; /* Hauteur de la barre de navigation */
        } 


        /* Remove border and change up box shadow for more contrast */
        .navbar .navbar-inner { /* Cette règle est pour Bootstrap 2, peut être non utilisée */
            border: 0;
            -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
            -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
        }

        /* Downsize the brand/project name a bit */
        .navbar .brand { /* Cette règle est pour Bootstrap 2, peut être non utilisée */
            padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
            font-size: 16px;
            font-weight: bold;
            text-shadow: 0 1px 1px rgba(0,0,0,.5);
        }

        /* Navbar links: increase padding for taller navbar */
        .navbar .nav > li > a {
            padding: 15px 20px;
        }

        /* Offset the responsive button for proper vertical alignment */
        .navbar .btn-navbar { /* Cette règle est pour Bootstrap 2, peut être non utilisée */
            margin-top: 10px;
        }

        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------------- */
        /* Carousel base class */
        .carousel {
            margin-bottom: 60px;
        }

        .carousel .container {
            position: relative;
            z-index: 9;
        }

        .carousel-control {
            height: 30%;
            margin-top: 10%;
            font-size: 120px;
            text-shadow: 0 1px 1px rgba(0,0,0,.4);
            background-color: transparent;
            border: 0;
            z-index: 10;
        }

        .carousel .item {
            height: 500px;
        }
        .carousel img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 500px;
        }

        .carousel-caption {
            background-color: transparent;
            position: static;
            max-width: 550px;
            padding: 0 20px;
            margin-top: 200px;
        }
        .carousel-caption h1,
        .carousel-caption .lead {
            margin: 0;
            line-height: 1.25;
            color: #fff;
            text-shadow: 0 1px 1px rgba(0,0,0,.4);
        }
        .carousel-caption .btn {
            margin-top: 10px;
        }

        /* MARKETING CONTENT
        -------------------------------------------------- */
        /* Center align the text within the three columns below the carousel */
        .marketing .span4 {
            text-align: center;
        }
        .marketing h2 {
            font-weight: normal;
        }
        .marketing .span4 p {
            margin-left: 10px;
            margin-right: 10px;
        }

        /* Featurettes
        ------------------------- */
        .featurette-divider {
            margin: 80px 0; /* Space out the Bootstrap <hr> more */
        }
        .featurette {
            padding-top: 120px; /* Vertically center images part 1: add padding above and below text. */
            overflow: hidden; /* Vertically center images part 2: clear their floats. */
        }
        .featurette-image {
            margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
        }

        /* Give some space on the sides of the floated elements so text doesn't run right into it. */
        .featurette-image.pull-left {
            margin-right: 40px;
        }
        .featurette-image.pull-right {
            margin-left: 40px;
        }

        /* Thin out the marketing headings */
        .featurette-heading {
            font-size: 50px;
            font-weight: 300;
            line-height: 1;
            letter-spacing: -1px;
        }

        /* RESPONSIVE CSS
        -------------------------------------------------- */
        @media (max-width: 979px) {
        /* .container.navbar-wrapper {
            margin-bottom: 0;
            width: auto;
        }
        .navbar-inner {
            border-radius: 0;
            margin: -20px 0;
        }
        .carousel .item {
            height: 500px;
        }
        .carousel img {
            width: auto;
            height: 500px;
        }
        .featurette {
            height: auto;
            padding: 0;
        }
        .featurette-image.pull-left,
        .featurette-image.pull-right {
            display: block;
            float: none;
            max-width: 40%;
            margin: 0 auto 20px;
        }*/
        }

        @media (max-width: 767px) {
        /* .navbar-inner {
            margin: -20px;
        }
        .carousel {
            margin-left: -20px;
            margin-right: -20px;
        }
        .carousel .container {
        }
        .carousel .item {
            height: 300px;
        }
        .carousel img {
            height: 300px;
        }
        .carousel-caption {
            width: 65%;
            padding: 0 70px;
            margin-top: 100px;
        }
        .carousel-caption h1 {
            font-size: 30px;
        }
        .carousel-caption .lead,
        .carousel-caption .btn {
            font-size: 18px;
            line-height: 1.5;
        }*/
        }
        /* input[type='text'] { margin:15px 20px; background-color:#E6E6E6; } */
        label { margin-left:10px;margin-right:10px}
        fieldset {margin-top:50px; width:50%; margin-left:auto; margin-right:auto;}
        #btnsub { width:100%; text-align:right}
        #echeance {width:100%; text-align:left}
        #echeance input[type='text'] { width:40%;}

        .currencyinput {
            border: 1px inset #ccc;
        }
        .currencyinput input {
            border: 0;
        }

        /* Styles pour les cartes de biens immobiliers */
        /* ******************************************************************* */
        /* NOUVELLES RÈGLES POUR DES HAUTEURS DE CARTE UNIFORMES ET UN LAYOUT COHÉRENT */
        /* ******************************************************************* */
        .container-liste {
            padding-right: 15px; /* Paddings latéraux pour le contenu */
            padding-left: 15px;
            margin-right: auto;  /* Centre le conteneur sur la page */
            margin-left: auto;   /* Centre le conteneur sur la page */
        }

        /* Assure que le conteneur principal de la liste des biens (la rangée Bootstrap) utilise Flexbox */
        .row.bien-list-container {
            display: flex;
            flex-wrap: wrap; /* Permet aux colonnes de passer à la ligne suivante */
            align-items: stretch; /* **Crucial** : Rend toutes les colonnes (et donc les cartes) d'une même rangée de même hauteur */
            margin-top: 30px;
            margin-left: -15px; /* <--- REMETTEZ CELA ! */
            margin-right: -15px; /* <--- REMETTEZ CELA ! */
        }

        /* Ajoute une marge inférieure aux colonnes pour l'espacement entre les rangées de cartes */
        /* Ciblez les classes de colonnes spécifiques que vous utilisez dans accueil.php */
        .col-xs-12,
        .col-sm-4, /* Cible correctement vos colonnes sm-4 */
        .col-md-3 { /* Cible correctement vos colonnes md-3 */
            margin-bottom: 30px; /* Espace en dessous de chaque carte */
        }

        /* Styles pour la carte de propriété individuelle (le panneau) */
        .bien-card {
            height: 100%; /* **Crucial** : Fait en sorte que la carte prenne 100% de la hauteur de sa colonne parente étirée */
            display: flex; /* Active Flexbox pour la carte elle-même */
            flex-direction: column; /* Empile le contenu de la carte verticalement */
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden; /* Assure que le contenu (comme les images, le texte tronqué) ne déborde pas */
            box-shadow: 0 2px 5px rgba(0,0,0,.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .bien-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,.2);
        }

        /* Conteneur d'image à l'intérieur de la carte */
        .bien-photo-container {
            height: 200px; /* Hauteur fixe pour tous les conteneurs d'image */
            overflow: hidden;
            display: flex; /* Utilise Flexbox pour centrer l'image */
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .bien-photo {
            width: 100%;
            height: 100%;
            object-fit: cover; /* **Crucial** : Recadre l'image pour remplir le conteneur sans la déformer */
            display: block; /* Supprime l'espace supplémentaire sous l'image */
        }

        /* Corps de la carte */
        .panel-body {
            flex-grow: 1; /* **Crucial** : Permet au corps de prendre tout l'espace vertical restant à l'intérieur de la carte */
            display: flex; /* Active Flexbox pour le contenu à l'intérieur du body */
            flex-direction: column; /* Empile le contenu du body verticalement */
            padding: 15px;
            text-align: left;
        }

        /* Titre de la propriété */
        .panel-body h4 {
            /* Définir explicitement line-height pour un calcul de hauteur cohérent */
            line-height: 1.2em; /* Hauteur de ligne pour le titre */
            height: calc(1.2em * 3); /* **Plus robuste** : Calcule la hauteur en fonction de la hauteur de ligne pour 3 lignes */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Limite le titre à 3 lignes */
            -webkit-box-orient: vertical;
            margin-top: 0;
            margin-bottom: 10px;
            color: #337ab7;
            font-size: 1.4em;
        }

        /* Styles généraux des paragraphes à l'intérieur de la carte */
        .bien-card p {
            margin-bottom: 5px; /* Espacement sous les paragraphes d'information */
            font-size: 0.9em;
            line-height: 1.4em; /* Hauteur de ligne explicite pour un espacement cohérent */
        }

        /* Description de la propriété */
        .bien-description {
            font-style: italic;
            color: #777;
            margin-bottom: 10px; /* Espace avant le bouton */

            /* **Crucial** : Assurez-vous que ces propriétés sont actives pour la troncation. */
            /* Définir explicitement line-height pour un calcul de hauteur cohérent */
            line-height: 1.4em; /* Hauteur de ligne pour la description */
            height: calc(1.4em * 3); /* **Plus robuste** : Calcule la hauteur en fonction de la hauteur de ligne pour 3 lignes */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Limite la description à 3 lignes */
            -webkit-box-orient: vertical;
            font-size: 0.85em;
            
            flex-shrink: 0; /* **Nouveau** : Empêche la description de rétrécir si le contenu est plus court que sa hauteur maximale */
            /* flex-grow: 1; */ /* **Modifié** : Supprimé flex-grow de la description elle-même pour laisser la hauteur explicite la contrôler.
                                                     Le flex-grow du panel-body devrait suffire à pousser le bouton vers le bas. */
        }

        /* Bouton "Voir les détails" */
        .panel-body .btn.btn-primary {
            margin-top: auto; /* **Crucial** : Pousse le bouton vers le bas du conteneur flex (panel-body) */
            display: block; /* Rend le bouton en bloc pour qu'il prenne toute la largeur */
            width: 100%; /* S'assure qu'il prend toute la largeur de son parent (panel-body) */
            text-align: center;
            padding: 8px 15px;
            font-size: 0.9em;
        }

        /* ... (Vos autres styles liés aux formulaires, currencyinput, etc.) ... */
    </style>
</head>
<body>