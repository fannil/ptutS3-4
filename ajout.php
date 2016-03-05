<?php include("./db.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Visite virtuelle de la Doua - ajout de département</title>
    <link rel="stylesheet" href="adminStyle.css" />

  </head>
  <body>
  	<h1>Ajout d'un département</h1>

  	<form method = "POST" action = "handleAdd.php">
  		<p>
  			Nom du département : 
  			<input type = 'text' id = "nomDept" name = "nomDept"/>
  		</p>
  		<p>
  			Description du département : </p>
  			<textarea id = "desc" name = "desc" rows = "10" cols = "50"></textarea>
  		<p>
  			Latitude : 
  			<input type = 'number' step = "any" id = "lat" name = "lat"/>
  		</p>
  		<p>
  			Longitude : 
  			<input type = 'number' step = "any" id = "lng" name = "lng"/>
  		</p>
  		<button type="submit">Ajouter</button>
  	</form>

  </body>
</html>