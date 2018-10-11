import loadScript from './load-script'
export default (selector, googleMapsApiKey) => (place) => {

  let mapElement = document.querySelector(selector)

  if ( mapElement ){
    var map

    window.initMap = function initMap() {
      map = new google.maps.Map(mapElement, {
        center: {lat: 34.0791143, lng: -118.5127801},
        // center: {lat: 34.0694822, lng: -118.4010050},
        zoom: 12,
        mapTypeControl: false,
        styles: [{
          "featureType": "all",
          "stylers": [
            { "saturation": -45 },
            { "lightness": -10 }
          ]
        }, {
          "featureType": "landscape",
          "elementType": "labels",
          "stylers": [
            { "visibility": "off" }
          ]
        }]
      })

      const infowindow = new google.maps.InfoWindow()
      const service = new google.maps.places.PlacesService(map)

      service.getDetails({
        placeId: place.id
      }, function(place, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          var marker = new google.maps.Marker({
            map,
            position: place.geometry.location
          })
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
              place.formatted_address + '</div>')
            infowindow.open(map, this)
          })
        }
      })
    }

    loadScript({
      src: `https://maps.googleapis.com/maps/api/js?key=${googleMapsApiKey}&libraries=places&callback=initMap`,
      async:true,
      defer: true
    })
  }
}
