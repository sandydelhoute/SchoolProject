
$(document).ready(function(){
var geocoder=new google.maps.Geocoder();
var map;
var selector=document.getElementById('map');
var listMarkers = new Array();
var i = 0;
var objAjax=new CallAjax();

function allRelais(){
data=objAjax.callAjax(Routing.generate('allrelais'));
data.done(function(data){
	$.each($.parseJSON(data.data), function(key,obj){
	listMarkers.push(obj);
	});
});
}


function searchCP(){
	$('#RechercheGEo').on('click',function(){
		if(typeof cityCircle != 'undefined')
		{
			    cityCircle.setMap(null);
		}


		var address=document.getElementById("adress").value;
		var components={country :'fr'};
		geocoder.geocode( { 'address': address}, function(results, status) {
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
            radius: Math.sqrt(1000) * 100
          });
		 }
		});
});
}


function init_map() {
  	
  	map = new google.maps.Map(selector, {
      zoom: 5,
      center: new google.maps.LatLng(50.8632264,-6.7670346),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    listMarkers.map(function(obj){
      	marker = new google.maps.Marker({
        position: new google.maps.LatLng(obj.coordonates.longitude,obj.coordonates.latitude),
        map: map
      });
      	attachSecretMessage(marker,obj.name);
	});
    }

function attachSecretMessage(marker, secretMessage) {
        var infowindow = new google.maps.InfoWindow({
          content: secretMessage
        });

        marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
 }


 function geolocalisation(){
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
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' : 
    'Error: Your browser doesn\'t support geolocation.');
}



allRelais();
console.log(listMarkers);
google.maps.event.addDomListener(window, 'load', init_map);
geolocalisation();
searchCP();
});



