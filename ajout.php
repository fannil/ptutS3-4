<?php include("./db.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Visite virtuelle de la Doua - ajout de département</title>
    <link rel="stylesheet" href="style/adminStyle.css" />
    <script src="http://code.jquery.com/jquery-1.12.2.js" integrity="sha256-VUCyr0ZXB5VhBibo2DkTVhdspjmxUgxDGaLQx7qb7xY=" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>

  </head>
  <?php
  if(isConnected()){
    include('header.php');
    ?>
  <body>
    <div class="form-basic">
    	<h1>Ajout d'un département</h1>

    	<form method = "POST" action = "handleAdd.php">
    		<p>
    			Nom du département :
    			<input type = 'text' id = "nomDept" name = "nomDept" required/>
    		</p>
    		<p>
    			Description du département :
    			<textarea id = "desc" name = "desc" rows = "10" cols = "50" required></textarea>
        </p>
    		<p>
    			Latitude :
    			<input type = 'number' step = "any" id = "lat" name = "lat" required/>
    		</p>
    		<p>
    			Longitude :
    			<input type = 'number' step = "any" id = "lng" name = "lng" required/>
    		</p>
    		<button type="submit" id="ajouter">Ajouter</button>
    	</form>
    </div>
  </body>
  <?php }
  else {
    echo("<p class = 'err'>Erreur de connexion</p><p>Vous allez être redirigé vers la page de connexion</p>");
    header( "refresh:3; url=admin.php" );
  }
  ?>
</html>
