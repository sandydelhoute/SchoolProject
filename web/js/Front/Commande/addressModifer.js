$(document).ready(function(){
  var map=new Map();
  map.init();
  geocoder=new google.maps.Geocoder();
  var address=document.getElementById('inputAdressmodifer');
  var routeModifyAdress='adressmodify';
  var objAjax=new CallAjax();
  $(document).on("click","#Adressmodifer .input-group-addon",function(){
    geocoder.geocode({'address': address.value}, function(results, status) {
          if (status === 'OK') {
            var longitude = results[0].geometry.location.lng();
            var latitude = results[0].geometry.location.lat();
              data=objAjax.callAjax(
                  Routing.generate(
                      routeModifyAdress,
                      {address:address.value,longitude:longitude,latitude:latitude}));
              data.done(function(data){
                if(data.response == true )
                  $('#Adressmodifer .alert-success').removeClass('hide');
                  setTimeout(
                    function(){
                    $('#Adressmodifer .alert-success').addClass('hide');
                    $('#Adressmodifer').removeClass('in');
                  },2000);

              })
            } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
    });
  });


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
    var autocomplete = new google.maps.places.Autocomplete(address,options);
  }

 }

