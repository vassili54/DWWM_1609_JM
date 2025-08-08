<?php
// ProjetFileRouge/views/acces_membre.php
// Ce fichier est maintenant inclus par CtrlAuth.php quand l'action est 'login'.
// Il n'est plus inclus directement dans index.php.

// Les messages de succès ou d'erreur sont gérés via la session
// et affichés ici pour donner un feedback à l'utilisateur.
?>

<style>
    /* Vos styles existants pour ce panneau */
    .text-on-pannel {
        background: #fff none repeat scroll 0 0;
        height: auto;
        margin-left: 20px;
        padding: 3px 5px;
        position: absolute;
        margin-top: -47px;
        border: 1px solid #337ab7;
        border-radius: 8px;
    }

    .panel {
        margin-top: 27px !important;
    }

    .panel-body {
        padding-top: 30px !important;
    }

    #panelAccesGestion {
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 50px;
    }

    @media (max-width: 768px) {
        #panelAccesGestion {
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

<div class="container">
    <?php
    // Affichage des messages de succès ou d'erreur depuis la session
    if (isset($_SESSION['message_succes'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['message_succes']) . '</div>';
        unset($_SESSION['message_succes']); // Supprimer le message après l'affichage
    }
    if (isset($_SESSION['message_erreur'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['message_erreur']) . '</div>';
        unset($_SESSION['message_erreur']); // Supprimer le message après l'affichage
    }
    ?>

    <div class="panel panel-primary" id="panelAccesGestion">
        <div class="panel-body">
            <h3 class="text-on-pannel text-primary"><strong class="text-uppercase"> Accès gestion</strong></h3>

            <!-- L'action du formulaire pointe maintenant vers index.php?action=login -->
            <form id="verif" name="verif" action="index.php?action=login" method="POST">
                <p style="text-align:center;">
                    <label style="font-family:Verdana, Geneva, sans-serif" for="identifiant">Email : </label>
                    <input class="form-control" id="identifiant" name="identifiant" value="" type="text" autocomplete="email">
                </p>
                <p style="text-align:center; ">
                    <label style="font-family:Verdana, Geneva, sans-serif" for="pwd">Mot de passe : </label>
                    <input class="form-control" type="password" id="pwd" name="pwd" value="" autocomplete="current-password">
                </p>
                <p style="text-align:center; width:100%">
                    <input type="submit" class="btn btn-primary" id="validation" name="validation" value="Valider" style=" text-align:center">
                </p>
            </form>
        </div>
    </div>
</div>
