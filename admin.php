<?php include("./db.php");
if(isConnected()) header("Location: modifier.php");
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
  <body>
    <div class="form-basic">
    	<h1>Page administrateur</h1>
      <h2>Connexion</h2>

      <?php
      if(isset($_GET["err"])){
        if($_GET["err"] == 1) echo("<p class = 'err'>L'identifiant ou le mot de passe est invalide</p>");
        else if($_GET["err"] == 2) echo("<p class = 'err'>Formulaire incomplet</p>");
      }

      ?>

      <form method = "POST" action = "connect.php">
        <p>Identifiant : <input type = "text" id = "id" name = "id" required></p>
        <p>Mot de passe : <input type = "password" id = "pwd" name = "pwd" required></p>
        <button type="button" onclick="location.href='./index.php';">Retour index</button>
        <button type = "submit">Connexion</button>
      </form>

    <div>
  </body>
</html>
