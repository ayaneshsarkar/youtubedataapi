<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/maps.css">
  <title>Google Maps</title>
</head>
<body>

  <div class="container">
    <h3 class="title">My Google Maps Demo</h3>
    <div class="googleMap" style="width: 100%; padding: 0 4rem;">
      <div id="map" style="width: 100%"></div>
    </div>
  </div>
  
  <!-- AIzaSyBLzBKwQyJJ_TvGf6atpmgN7NZw3BBMJjY -->

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=_YOUR_API_KEY_&callback=initMap">
  </script>
  <script src="../js/maps.js"></script>
</body>
</html>