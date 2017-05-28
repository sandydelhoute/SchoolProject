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
  var cityCircle;
  var infowindow;

  var allRelais=function(){
    data=objAjax.callAjax(Routing.generate('allrelais'));
    data.done(function(data){
      listMarkers=JSON.parse(data);
    });
  }

  this.init=function(){
    allRelais();
    geolocalisation();
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
      console.log(results);
          map.setCenter(results[0].geometry.location);
          map.setZoom(11);
          circle();
          distanceRelais(results[0].geometry.location)
        }
      });
    });
  }
  var render=function(obj){
    var adresseRelais = InverseAdresse(obj.coordonates.latitude,obj.coordonates.longitude);
    console.log(adresseRelais);
    var panel=document.createElement('div');
    panel.className = 'panel default-panel';
    panel.id = 'iw-container';
    var panelHead = document.createElement('div');
    panelHead.className = 'panel-heading iw-title';
    var panelBody = document.createElement('div');
    panelBody.className = 'panel-body';
    panelBody.id = 'iw-content';
    var columnAdressRelais = document.createElement('div');
    columnAdressRelais.className = 'col-xs-12';
    var columnText = document.createElement('div');
    columnText.className = 'col-xs-12';
    var containText = document.createTextNode('Voulez-vous selectionner ce point relais ?')
    var columnButton = document.createElement('div');
    columnButton.className = 'col-xs-12';
    var groupButton = document.createElement('div');
    groupButton.className = 'btn-group'
    var buttonSelect = document.createElement('button');
    buttonSelect.className = 'btn btn-green selectRelais';
    buttonSelect.dataset.relais = obj.id;
    var iconSelect = document.createElement('i');
    iconSelect.className = 'fa fa-check';
    var buttonCancel = document.createElement('button');
    buttonCancel.className = 'btn btn-danger';
    var iconCancel = document.createElement('i');
    iconCancel.className = 'fa fa-ban' ;

    buttonSelect.appendChild(iconSelect);
    buttonCancel.appendChild(iconCancel);
    groupButton.appendChild(buttonSelect);
    groupButton.appendChild(buttonCancel);
    columnText.appendChild(containText);
    columnButton.appendChild(groupButton);
    columnAdressRelais.appendChild(document.createTextNode(adresseRelais))
    panelBody.appendChild(columnAdressRelais);
    panelBody.appendChild(columnText);
    panelBody.appendChild(columnButton);
    panelHead.appendChild(document.createTextNode(obj.name));
    panel.appendChild(panelHead);
    panel.appendChild(panelBody);
    return panel;
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
      position: new google.maps.LatLng(listMarkers[key].coordonates.latitude,listMarkers[key].coordonates.longitude),
      map: map
    });
    attachSecretMessage(marker,render(listMarkers[key]));
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

/* Fonction de géocodage inversé  */
var InverseAdresse=function(latitude,longitude){
  latitude = parseFloat(latitude);
  longitude = parseFloat(longitude);
  var geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(latitude,longitude);
  var resultGeocoder;
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    /* Si le géocodage inversé a réussi */
    if (status == google.maps.GeocoderStatus.OK) {
      resultGeocoder = (results[0].formatted_address);
    }
  });
  console.log(resultGeocoder)
  return resultGeocoder;
}

/* Fonction infoWindow  */
var attachSecretMessage=function(marker, render) {
  infowindow = new google.maps.InfoWindow({
    content: render
  });
  google.maps.event.addListener(infowindow, 'domready', function() {

    // Reference to the DIV that wraps the bottom of infowindow
    var iwOuter = $('.gm-style-iw');

    /* Since this div is in a position prior to .gm-div style-iw.
     * We use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
     */
     var iwBackground = iwOuter.prev();

     iwOuter.children(':nth-child(1)').css({display:'block'})
    // Removes background shadow DIV
    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    // Removes white background DIV
    iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    // Moves the infowindow 115px to the right.
    iwOuter.parent().parent().css({left: '115px'});

    // Moves the shadow of the arrow 76px to the left margin.
    iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

    // Moves the arrow 76px to the left margin.
    iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

    // Changes the desired tail shadow color.
    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

    // Reference to the div that groups the close button elements.
    var iwCloseBtn = iwOuter.next();

    // Apply the desired effect to the close button
    iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

    // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
    if($('.iw-content').height() < 140){
      $('.iw-bottom-gradient').css({display: 'none'});
    }

    // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
    iwCloseBtn.mouseout(function(){
      $(this).css({opacity: '1'});
    });

    var selectRelais = document.getElementsByClassName('selectRelais');
    selectRelais.addEventListener('click',function(){
      objAjax.callAjax(Routing.generate('selectRelais',{id:id}));
    },false);

  });
  marker.addListener('click', function() {
    infowindow.open(marker.get('map'), marker);
  });

}



var circle=function(){
 cityCircle =new google.maps.Circle({
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


var geolocalisation=function(){
  $('#RechercheGeo').on('click',function(){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map.setCenter(pos);
        map.setZoom(13);
        circle();
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


var distanceRelais=function(location){
  var service = new google.maps.DistanceMatrixService();
  for(var key in listMarkers)
  {  
    var destination=new google.maps.LatLng(listMarkers[key].coordonates.latitude,listMarkers[key].coordonates.longitude);
    service.getDistanceMatrix(
    {
    origins: [location],
    destinations: [destination],
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC,
    avoidHighways: false,
    avoidTolls: false
    },
  function(response,status){
    if(response.rows[0].elements[0].distance.value<5000)
    {
      console.log(listMarkers[key])
    }
  
  });
  }
}

}