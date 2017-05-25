$(document).ready(function(){

var map=new Map();
map.init();

});



var Map=function(){
  
  var i = 0;
  var map;
  var listMarkers;
  var mapSelector=document.getElementById('map');
  var address=document.getElementById('adress');
  var geocoder=new google.maps.Geocoder();
  var objAjax=new CallAjax();

    var allRelais=function(){
      data=objAjax.callAjax(Routing.generate('allrelais'));
      data.done(function(data){
        listMarkers=JSON.parse(data);
      });
    }

  this.init=function(){
    allRelais();
    //geolocalisation();
    searchCP();
    google.maps.event.addDomListener(window, 'load', init_map);

  }

  var searchCP=function(){
    $('#RechercheGEo').on('click',function(){
      if(typeof cityCircle != 'undefined')
      {
            cityCircle.setMap(null);
      }


      var addressValue=address.value;
      var components={country :'fr'};
      geocoder.geocode( { 'address': addressValue}, function(results, status) {
      /* Si l'adresse a pu être géolocalisée */
      if (status == google.maps.GeocoderStatus.OK) {
      /* Récupération de sa latitude et de sa longitude */
      // document.getElementById('lat').value = results[0].geometry.location.lat();
      map.setCenter(results[0].geometry.location);
      map.setZoom(13);
      var cityCircle =new google.maps.Circle({
              strokeColor: '#02b253',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FFBE3B',
              fillOpacity: 0.35,
              map: map,
              center: map.center,
              radius: 5000
            });
       }
      });
  });
  }


  var init_map=function() {
     var options = {
      types: ['address'],
      componentRestrictions: {country: "fr"}
    };
      map = new google.maps.Map(mapSelector, {
        zoom: 5,
        center: new google.maps.LatLng(50.8632264,-6.7670346),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      for(var key in listMarkers)
      {
          marker = new google.maps.Marker({
          position: new google.maps.LatLng(listMarkers[key].coordonates.longitude,listMarkers[key].coordonates.latitude),
          map: map
        });
          attachSecretMessage(marker,listMarkers[key].name);
      }
        var autocomplete = new google.maps.places.Autocomplete(address,options);
        autocomplete.bindTo('bounds', map);
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var addressReturn = '';
          if (place.address_components) {
            addressReturn = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });
      }

  var attachSecretMessage=function(marker, secretMessage) {
          var infowindow = new google.maps.InfoWindow({
            content: secretMessage
          });

          marker.addListener('click', function() {
            infowindow.open(marker.get('map'), marker);
          });
   }


   var geolocalisation=function(){
    $('#RechercheGeo').on('click',function(){
      console.log('je suis dnas la geolocalisation');
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          infoWindow.setPosition(pos);
          infoWindow.setContent('Location found.');
          map.setCenter(pos);
        }, function() {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }
      });
  }
  var handleLocationError=function(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(browserHasGeolocation ?
      'Error: The Geolocation service failed.' : 
      'Error: Your browser doesn\'t support geolocation.');
  }
}