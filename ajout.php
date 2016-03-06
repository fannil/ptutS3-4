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

    <script type="text/javascript">check();</script>

    <!--
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
              thisDropzone.createThumbnailFromUrl(mockfile, 'dptImg/' + value.name);
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
    -->
  </body>
</html>