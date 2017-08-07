$(document).ready(function(){

  var map=new Map();
  map.init();
  geocoder=new google.maps.Geocoder();

});


var Map=function(){

	this.init=function(){
		autoComplete();
	};
  var address=document.getElementById('inputAdressmodifer');

  var autoComplete=function(){
    var options = {
      types: ['address'],
      componentRestrictions: {country: "fr"}
    };
    console.log(address);
    var autocomplete = new google.maps.places.Autocomplete(address,options);
    //autocomplete.bindTo('bounds', map);
  }

 }