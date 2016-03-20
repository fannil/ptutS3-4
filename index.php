<?php include("./db.php");
//$dpts = getIdDepartements();
$dpts[0] = 1;
/*
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
  if($images.length != 0) {
    $aTag = '<a href=\"#\" onclick=\'jQuery.slimbox([';
    $imgs = "";
    $first = true;
  foreach($images as $image){
    if($first){
      $aTag .= '["dptImg/' . $idDepartement . '/' . $image["link"] . '", "' . $image["nom"] . '"]';
      $first = false;
    }
    else{
      $aTag .= '["dptImg/' . $idDepartement . '/' . $image["link"] . '", "' . $image["nom"] . '"]';
    }
    $imgs .= '<img src = "' . $image["link"] . '" alt = "' . $image["nom"] . '" />';
  }

  $aTag .= '], 0);return false;\' rel="groupe' . $idDepartement . '">';
  echo ( '\'' . $aTag . '\' + \n\'');
  echo ( '\'' . $imgs . ' </a>\' + \n');
  //var_dump($aTag . "\n\n" . $imgs);die;
}}

die;
//var_dump(getImages(1));die();
*/

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

  <link rel="stylesheet" href="style/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <!-- slimbox -->
  <link rel="stylesheet" href="style/slimbox/slimbox2.css" type="text/css" />
  <script type="text/javascript" src="js/slimbox2.js"></script>

  <script> var mapMarkers = []; </script>

</head>
<body>

  <div id="map"></div>
  <div id="dptsOverview">
    <div id="dptsOverviewContent">
      <img class="close" src="images/cross.png" alt="Fermer" width="30px" id="closeDpts"/>
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

    <div id="aboutOverview">
      <div id="aboutOverviewContent">
        <img class="close" src="images/cross.png" alt="Fermer" width="30px" id="closeAbout"/>
        <h2>Qui sommes-nous ?</h2><hr/>
        <p class="overviewPar">   Nous sommes une petite équipe de quatre étudiants en deuxième année de DUT informatique et nous avons créé ce site dans le cadre de notre
          projet tuteuré de S3 et S4. Ce site est une maquette, il s'agit d'un outil permettant d'effectuer une visite virtuelle de plusieurs lieux
          mais aussi de configurer une visite virtuelle via une interface web (pages administrateurs). <br/><br/>
          Bonne visite sur notre site ! </p>
        </div>
      </div>

      <div id="contactOverview">
        <div id="contactOverviewContent">
          <img class="close" src="images/cross.png" alt="Fermer" width="30px" id="closeContact"/>
          <h2>Nous contacter</h2><hr/>
          <p class="overviewPar">Pour nous contacter, merci de nous envoyer un mail à l'adresse suivante : admin@admin.fr</p>
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
            <a class="about" href="#" onclick="showAbout();">
              <span>A propos</span>
            </a>
          </li>

          <li>
            <a class="contact" href="#" onclick="showContact();">
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
          <?php
          $images = getImages($idDepartement);
          if(count($images) != 0) {
            $aTag = '<a href=\"#\" onclick=\\\'jQuery.slimbox([';
            $imgs = "";
            $first = true;
          foreach($images as $image){
            if($first){
              $aTag .= '[\\"dptImg/' . $idDepartement . '/' . $image["link"] . '\\", \\"' . $image["nom"] . '\\"]';
              $first = false;
            }
            else{
              $aTag .= ', [\\"dptImg/' . $idDepartement . '/' . $image["link"] . '\\", \\"' . $image["nom"] . '\\"]';
            }
            $imgs .= '<img src = "dptImg/' . $idDepartement . "/" . $image["link"] . '" alt = "' . $image["nom"] . '" />';
          }

          $aTag .= '], 0);return false;\\\' rel="groupe' . $idDepartement . '">';
          echo ( '\'' . $aTag . '\' + ');
          echo ( '\'' . $imgs . ' </a>\' +');
          //var_dump($aTag . "\n\n" . $imgs);die;
        }
          ?>
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
            if(showedcont) showContact();
            if(showedab) showAbout();
          }
        }

        var showedab = false;
        function showAbout(){
          //$('#aboutOverview').toggle('slow', function(){});
          if(showedab){
            $("#aboutOverview").hide('slide', {direction: 'left'}, 200);
            showedab = false;
          }
          else{
            $("#aboutOverview").show('slide', {direction: 'left'}, 200);
            showedab = true;
            if(showedcont) showContact();
            if(showed) showDpts();
          }
        }

        var showedcont = false;
        function showContact(){
          //$('#aboutOverview').toggle('slow', function(){});
          if(showedcont){
            $("#contactOverview").hide('slide', {direction: 'left'}, 200);
            showedcont = false;
          }
          else{
            $("#contactOverview").show('slide', {direction: 'left'}, 200);
            showedcont = true;
            if(showed) showDpts();
            if(showedab) showAbout();
          }
        }

        $(document).ready(function(){
          //Assigner l'action à la croix de fermeture pour chaque panneau
          $("#dptsOverview").hide();
          $("#closeDpts").click(function(){
            showDpts();
          });
          $("#contactOverview").hide();
          $("#closeContact").click(function(){
            showContact();
          });
          $("#aboutOverview").hide();
          $("#closeAbout").click(function(){
            showAbout();
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

                // Show the list item if the phrase matches and increase the count by 1
              } else {
                $(this).show();
              }
            });
          });

        });

        </script>

      </body>
      </html>
