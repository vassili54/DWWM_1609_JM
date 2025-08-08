<style>
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
    /* for text on pannel */
    margin-top: 27px !important;
  }

  .panel-body {
    padding-top: 30px !important;
  }

  /* Styles pour le panneau "Accès Gestion" */
#panelAccesGestion {
  max-width: 500px; /* Ajustez cette valeur à la largeur souhaitée. J'ai mis 500px, vous pouvez essayer 400px, 600px, etc. */
  margin-left: auto;
  margin-right: auto;
  margin-top: 50px; /* Ajoute une marge au-dessus pour espacer du contenu précédent, ajustez si besoin */
}

/* Pour que ça reste bien sur les petits écrans */
@media (max-width: 768px) {
  #panelAccesGestion {
    max-width: 90%; /* Sur les écrans plus petits, prend 90% de la largeur pour ne pas être trop serré */
    margin-left: auto;
    margin-right: auto;
  }
}
  
</style>

<?php





echo '
   
   <div class="container">
  <div class="panel panel-primary" id="panelAccesGestion">
    <div class="panel-body">
      <h3 class="text-on-pannel text-primary"><strong class="text-uppercase"> Accès gestion</strong></h3>
     
    
   <form id="verif"  name="verif" action="' . $_SERVER['PHP_SELF'] . '" method="POST" >
					
 <p style="text-align:center;"><label style="font-family:Verdana, Geneva, sans-serif" for="identifiant"> email  </label>
 
 <input  class="form-control"  id="identifiant" name="identifiant" value="" type="text"></p>
 
 <p style="text-align:center; "><label  style="font-family:Verdana, Geneva, sans-serif" for="pwd" >Mot de passe : </label>
   <input class="form-control" type="password" id="pwd" name="pwd" value="" /></p>
                        <p style="text-align:center; width:100%">
						<input type="submit" class="btn btn-primary" id="validation" name="validation" value="Valider" style=" text-align:center"  ></p>
                   </form>
				   </div>
  </div>
  <div>';

?>