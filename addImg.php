<?php include("./db.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Visite virtuelle de la Doua - ajout de département</title>
    <link rel="stylesheet" href="style/adminStyle.css" />
    <link rel="stylesheet" href="style/dropzone.css" />
    <script src="js/jquery.js"></script>
    <script src = "js/dropzone.js"></script>

  </head>
  <?php 
  if(isConnected()){
    include('header.php'); 
    ?>

  <body>
    <h1>Ajoutez des images</h1>
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
              thisDropzone.createThumbnailFromUrl(mockfile, 'dptImg/<?php echo(getCookieId()); ?>/' + value.name);
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

    <p><a href="ajout.php"><img src = "images/ok.png" width = "15px"/>Terminer</a></p>

  </body>
  
  <?php }
  else {
    echo("<p class = 'err'>Erreur de connexion</p><p>Vous allez être redirigé vers la page de connexion</p>");
    header( "refresh:3; url=admin.php" );
  }
  ?>

</html>