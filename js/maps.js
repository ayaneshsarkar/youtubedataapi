function initMap() {
  const options = {
    zoom: 16,
    center: {lat: 22.4428644, lng: 88.3808139}
  };
  
  const map = new google.maps.Map(document.getElementById('map'), options);

  const moniMedical = {lat:22.4454106, lng: 88.3826651}

  addMarker({latlng: moniMedical, content: '<h3>Moni Medical</h3>'});
  addMarker({latlng: options.center, content: '<h3>Home</h3>'});

  function addMarker(props) {
    const marker = new google.maps.Marker({ position: props.latlng, map: map });

    if(props.content) {
      const infoWindow = new google.maps.InfoWindow({content: props.content});

      marker.addListener('click', function() {
        infoWindow.open(map, marker);
      });
    }
  }
}