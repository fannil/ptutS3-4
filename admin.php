<?php include("./db.php");
if(isConnected()) header("Location: modifier.php");
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
      <button type = "submit">Connexion</button>
    </form>

  </body>
</html>