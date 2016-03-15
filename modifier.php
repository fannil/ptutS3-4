<?php include("./db.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Visite virtuelle de la Doua - modification de département</title>
    <link rel="stylesheet" href="style/adminStyle.css" />
    <link rel="stylesheet" href="style/dropzone.css" />
    <script src="js/jquery.js"></script>
    <script src = "js/dropzone.js"></script>
    <script src = "js/ack.js"></script>

  </head>
  <?php 
  if(isConnected()){
    include('header.php'); 
  ?>

  <body>
  	<div class="form-basic">
      <h1>Modification d'un département</h1>

      <?php
      if(isset($_GET["id"]) && $_GET["id"] != null){
        $idDepartement = $_GET["id"];
        $_POST["id"] = $idDepartement;
        $infos = getInfos($idDepartement);
        setcookie("dptId", $idDepartement);

        if(isset($_GET["mod"])){
          if($_GET["mod"] == 0) echo("<p class = 'err'>La modification n'a pas pu être effectuée</p>");
          else if($_GET["mod"] == 1) echo("<p class = 'success'>Modification effectuée</p>");
        }
        ?>

      <form method = "POST" action = "handleMod.php">
        <p>
          Nom du département : 
          <input type = 'text' id = "nomDept" name = "nomDept" value = "<?php echo $infos['titre']; ?>" required/>
        </p>
        <p>
          Description du département : 
          <textarea id = "desc" name = "desc" rows = "10" cols = "50" required><?php echo $infos['description']; ?></textarea>
        </p>
        <p>
          Latitude : 
          <input type = 'number' step = "any" id = "lat" name = "lat" value = "<?php echo $infos['lat']; ?>" required/>
        </p>
        <p>
          Longitude : 
          <input type = 'number' step = "any" id = "lng" name = "lng" value = "<?php echo $infos['lng']; ?>" required/>
        </p>
        <button type="submit" id="modifier">Modifier</button>
      </form>      

      <form action = "upload.php" class = "dropzone" id = "imgAdd"></form>

      <script>

        Dropzone.options.imgAdd = {
          addRemoveLinks: true,

          removedfile: function(file) {
            var _ref;
            deleteFile(file.name);
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
          },

          acceptedFiles: "image/*",

          init: function(){
            thisDropzone = this;
            $.get('upload.php', function(data){
              $.each(data, function(key, value){
                var mockfile = {name: value.name, size: value.size};
                thisDropzone.emit("addedfile", mockfile);
                thisDropzone.createThumbnailFromUrl(mockfile, 'dptImg/<?php echo($idDepartement); ?>/' + value.name);
                thisDropzone.emit("success", mockfile);
                thisDropzone.emit("complete", mockfile);
              });
            });
          }
        };

        function deleteFile($fileName){
          $.ajax({
            url: "delete.php",
            type: "POST",
            data: { 'name': $fileName}
            });
        }


      </script>

      <a href="modifier.php">Retour à la sélection de département</a>

      <?php } 
      else{
      ?>

      <h2>Sélectionner le département à modifier</h2>

        <?php
          $dpts = getIdDepartements();

          if(isset($_GET["del"]) && $_GET["del"] != null){
            if($_GET["del"] == -1) echo("<p class = 'err'>La suppression n'a pas pu être effectuée</p>");
            else echo("<p class = 'success'>Suppression effectuée</p>");
          }

          foreach($dpts as $idDepartement){
            $infos = getInfos($idDepartement);
        ?>

        <div class = "dptMod"><p>Id : <?php echo $idDepartement; ?>. Nom : <?php echo $infos['titre']; ?></p>
          <p class = "tab"><a href="modifier.php?id=<?php echo $idDepartement; ?>"><img src = "images/edit.png" width = "15px"/> Modifier</a>
          <a href = "deleteDpt.php?id=<?php echo $idDepartement; ?>" onclick = "ack()"><img src = "images/cross.png" width = "15px"/> Supprimer</a></p></div>

        <?php } ?>
      <?php } ?>
    <div>
  </body>
  <?php } 
  else {
    echo("<p class = 'err'>Erreur de connexion</p><p>Vous allez être redirigé vers la page de connexion</p>");
    header( "refresh:3; url=admin.php" );
  }
  ?>  
</html>