<?php include("./db.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Visite virtuelle de la Doua - ajout de département</title>
    <link rel="stylesheet" href="style/adminStyle.css" />
    <script src="js/jquery.js"></script>

  </head>
  <body>
  	<h1>Ajout d'un département</h1>

  	<form method = "POST" action = "handleAdd.php">
  		<p>
  			Nom du département : 
  			<input type = 'text' id = "nomDept" name = "nomDept" required/>
  		</p>
  		<p>
  			Description du département : </p>
  			<textarea id = "desc" name = "desc" rows = "10" cols = "50" required></textarea>
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

  </body>
</html>