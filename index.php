<?php include("./db.php"); 
  $dpts = getIdDepartements();
  //var_dump(getImages(1));die();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Visite virtuelle de la Doua</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100vh;
      }
    </style>

    <!-- ColorBox part -->
    <link rel="stylesheet" href="style/colorbox.css" />
    <link rel="stylesheet" href="style/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/jquery.colorbox.js"></script>

  </head>
  <body>
    <div id="map"></div>
    <div id="menu">
    <ul id="navigationMenu">
      <li>
        <a class="home" href="#">
              <span>Accueil</span>
          </a>
      </li>

      <li>
        <a class="about" href="#">
              <span>A propos</span>
          </a>
      </li>

      <li>
        <a class="contact" href="#">
              <span>Contactez nous</span>
          </a>
      </li>
          <li>
        <a class="marq" href="#">
              <span>Liste des marqueurs</span>
        </a>
      </li>
          <li>
        <a class="autre" href="#">
              <span>??</span>
          </a>
      </li>


    </ul>
  </div>
    <script>

function initMap() {
  var doua = {lat: 45.783341, lng: 4.874119};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: doua
  });

  var infoWindow = new google.maps.InfoWindow();

  <?php
    foreach($dpts as $idDepartement){
      $infos = getInfos($idDepartement);
?>
    var contentString<?php echo $idDepartement; ?> = '<div id=\"content\">'+
      '<h1 id=\"firstHeading\" class=\"firstHeading\"><?php echo $infos['titre']; ?></h1>' +
      '<div id=\"bodyContent\">'+
      '<p> <?php echo $infos['description']; ?></p>'+
      '<div class="imgLinks">' +
      <?php
      $images = getImages($idDepartement);
      foreach($images as $image){ 
        ?>
        '<p class = "imgLink"><a class=\"group<?php echo $idDepartement; ?> imgLink\" href=\"./images/<?php echo $image["link"]; ?>\" title=\"<?php echo $image["nom"]; ?>\" ' +
        'rel=\"group<?php echo $idDepartement; ?>\" onmouseover=\'$(this).colorbox({rel:\"group<?php echo $idDepartement; ?>\",href:\"./dptImg/<?php echo $idDepartement; ?>/<?php echo $image["link"]; ?>\", maxWidth:\"95%\", maxHeight:\"95%\"});return false\'>' +
        '<img src = \"./dptImg/<?php echo $idDepartement; ?>/<?php echo $image["link"]; ?>\"/></a></p>' +      //Utiliser this.child, event listender sur le chargement de la bulle
        <?php }
      ?>
      '</div>'
      '</div>';

      var iutInfo = {lat: <?php echo $infos['lat'];  ?>, lng: <?php echo $infos['lng'];  ?>};

      var marker<?php echo $idDepartement; ?> = new google.maps.Marker({
      position: iutInfo,
      map: map,
      title: '<?php echo $infos['titre'];  ?>'
    });

  marker<?php echo $idDepartement; ?>.addListener('click', function() {
    infoWindow.close();
    infoWindow.setContent(contentString<?php echo $idDepartement; ?>);
    infoWindow.open(map, marker<?php echo $idDepartement; ?> );
  });

    <?php }  ?>
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-j0TS4oRWE6F_q_-SdODcOPsvQDAK8AI&signed_in=true&callback=initMap">
  </script>

  </body>
</html>