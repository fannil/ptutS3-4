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
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script> var mapMarkers = []; </script>
  <link rel="stylesheet" href="style/slimbox2.css" type="text/css" />

  <script type="text/javascript" src="js/slimbox2.js"></script>

</head>
<body>

  <div id="map"></div>
  <div id="dptsOverview">
    <div id="dptsOverviewContent">
      <img id="close" src="images/cross.png" alt="Fermer" width="30px"/>
      <h2>Liste des départements</h2><hr/>
      <input type="text" placeholder="Rechercher un département" id="searchDpt"></input>
      <?php
      $dpts = getIdDepartements();
      foreach($dpts as $idDepartement){
        $infos = getInfos($idDepartement);
        ?>

        <p class="selectDpt" id="<?php echo $idDepartement; ?>"><?php echo $infos['titre']; ?></p>

        <?php } ?>

      </div>
    </div>

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
          <a class="marq" href="#" onclick="showDpts();">
            <span>Liste des marqueurs</span>
          </a>
        </li>
        <li>
          <a class="admin" href="./admin.php">
            <span>Administrateur</span>
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
        '<a href=\"#\" ' +
        'onclick=\'jQuery.slimbox([[\"dptImg/1/BDE1.jpg\", \"caption 1\"], [\"dptImg/1/BDE2.jpg\", \"caption 2\"]], 0);return false;\' rel="groupe1">' +
        '<img src="dptImg/1/BDE1.jpg"/><img src="dptImg/1/BDE2.jpg"/>'
        '</a>' +
        '</div>' +
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

          mapMarkers["<?php echo $idDepartement; ?>"] = marker<?php echo $idDepartement; ?>;

          <?php }  ?>
        }

        </script>
        <script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-j0TS4oRWE6F_q_-SdODcOPsvQDAK8AI&signed_in=true&callback=initMap" async defer>
        </script>

        <script>
        var showed = false;
        function showDpts(){
          //$('#dptsOverview').toggle('slow', function(){});
          if(showed){
            $("#dptsOverview").hide('slide', {direction: 'left'}, 200);
            showed = false;
          }
          else{
            $("#dptsOverview").show('slide', {direction: 'left'}, 200);
            showed = true;
          }
        }

        $(document).ready(function(){
          $("#dptsOverview").hide();
          $("#close").click(function(){
            showDpts();
          });
          $(".selectDpt").click(function(){
            var markerId = $(this).attr('id');
            google.maps.event.trigger(mapMarkers[markerId], 'click');
          });

          $("#searchDpt").keyup(function(){             //Filtre les départements sur le menu de gauche. Source : http://jsfiddle.net/umaar/t82gZ/

            // Retrieve the input field text
            var filter = $(this).val();

            // Loop through the comment list
            $(".selectDpt").each(function(){

              // If the list item does not contain the text phrase fade it out
              if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();

                // Show the list item if the phrase matches
              } else {
                $(this).show();
              }
            });
          });

        });

        </script>

      </body>
      </html>
