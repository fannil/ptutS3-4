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
    <link rel="stylesheet" href="colorbox.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="jquery.colorbox.js"></script>

  </head>
  <body><!--
    <p><a class="group1" href="./content/ohoopee1.jpg" title="Me and my grandfather on the Ohoopee." style="display:none">Grouped Photo 1</a></p>
    <p><a class="group1" href="./content/ohoopee2.jpg" title="On the Ohoopee as a child" style="display:none">Grouped Photo 2</a></p>
    <p><a class="group1" href="./content/ohoopee3.jpg" title="On the Ohoopee as an adult" style="display:none">Grouped Photo 3</a></p>
    -->
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
    </ul>
  </div>
    <script>

function initMap() {

  var doua = {lat: 45.783341, lng: 4.874119};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: doua
  });

  var contentStringInfo = '<div id="content">'+
      '<h1 id="firstHeading" class="firstHeading">Le meilleur IUT de la Doua</h1>'+
      '<div id="bodyContent">'+
      '<p>C\'est le meilleur, rien à redire.</p>'+
      '<p><img src="test.jpg" width="600px"></p>'+
      '<p><a class="group1" href="./images/BDE1.jpg" title="BDE 1" rel="group1" onclick=\'$(this).colorbox({rel:\"group1\",href:\"./images/BDE1.jpg\"});return false\'>BDE 1</a></p>'+
      '<p><a class="group1" href="./images/BDE2.jpg" title="BDE 2" rel="group1" onclick=\'$(this).colorbox({rel:\"group1\",href:\"./images/BDE2.jpg\"});return false\'>BDE 2</a></p>'+
      '<p><a class="group1" href="./images/cours.jpg" title="Salle de cours" rel="group1" onclick=\'$(this).colorbox({rel:\"group1\",href:\"./images/cours.jpg\"});return false\'>Salle de cours</a></p>'+
      '<p><a class="group1" href="./images/info.jpg" title="Salle informatique" rel="group1" onclick=\'$(this).colorbox({rel:\"group1\",href:\"./images/info.jpg\"});return false\'>Salle informatique</a></p>'+
      '</div>';

  var contentStringGEA = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">L\'IUT GEA</h1>'+
      '<div id="bodyContent">'+
      '<p>Un autre département</p>'+
      '</div>'+
      '</div>';

  var infowindowInfo = new google.maps.InfoWindow({
    content: contentStringInfo
  });
  
  var infowindowGEA = new google.maps.InfoWindow({
    content: contentStringGEA
  });

  var iutInfo = {lat: 45.786182, lng: 4.883530};
  var markerInfo = new google.maps.Marker({
    position: iutInfo,
    map: map,
    title: 'IUT, Batiment informatique'
  });

  var iutGEA = {lat: 45.786188, lng: 4.882784};
  var markerGEA = new google.maps.Marker({
    position: iutGEA,
    map: map,
    title: 'IUT, Batiment GEA'
  });

  markerInfo.addListener('click', function() {
    infowindowGEA.close();
    infowindowInfo.open(map, markerInfo);
  });

  markerGEA.addListener('click', function() {
    infowindowInfo.close();
    infowindowGEA.open(map, markerGEA);
  });
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key= 
AIzaSyD-j0TS4oRWE6F_q_-SdODcOPsvQDAK8AI&signed_in=true&callback=initMap"></script>
  </body>
</html>