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
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.

function initMap() {
  var doua = {lat: 45.783341, lng: 4.874119};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: doua
  });

  var contentStringInfo = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Le meilleur IUT de la Doua</h1>'+
      '<div id="bodyContent">'+
      '<p>C\'est le meilleur, rien à redire.</p>'+
      '</div>'+
      '<img src="test.jpg" width="600px"'+
      '</div>';

  var contentStringGEA = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">L\'IUT GEA</h1>'+
      '<div id="bodyContent">'+
      '<p>Un peu moins bien mais c\'est un IUT quand même.</p>'+
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