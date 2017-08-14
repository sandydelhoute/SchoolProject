$(document).ready(function(){
  var routeUpdateRelais="selectrelais";
  var map=new Map(routeUpdateRelais);
  map.init();

});


//icon_geoloc
var Map=function(routeUpdateRelais){

  var map;
  var listRelais;
  var listMarker =[];
  var mapSelector=document.getElementById('mapRelais');
  var address=document.getElementById('adress');
  var geocoder;
  var objAjax=new CallAjax();
  var cityCircle;
  var countRequest=0;
  this.routeUpdateRelais=routeUpdateRelais;
  var _that=this;

  this.init=function()
  {
    allRelais();
    google.maps.event.addDomListener(window, 'load', init_map);
    geocoder=new google.maps.Geocoder();
    geolocalisation();
    searchCP();
    showAll();
  
  }
  var init_map=function() {
    map = new google.maps.Map(mapSelector, {
      zoom:5,
      center: new google.maps.LatLng(46.9199018,3.2377911),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    markerShow(map,true);
    autoComplete();
    var uri = location.pathname.split('/');
    if(typeof uri[3] != 'undefined')
    {
      search(uri[3]);
    }
  }
  var allRelais=function(){
    data=objAjax.callAjax(Routing.generate('allrelais'));
    data.done(function(data){
      listRelais=JSON.parse(data);
      for(var key in listRelais)
      {
          marker = new google.maps.Marker({
          position: new google.maps.LatLng(listRelais[key].coordonates.latitude,listRelais[key].coordonates.longitude),
          animation: google.maps.Animation.DROP,
          icon : "/img/logo/icon_geoloc.png"
        });
        listMarker.push(marker);
      }
    });
  }

  var searchCP=function(){

    $('#RechercheGEo').on('click',function(){
      var addressValue=address.value;
      search(addressValue);
    });
  }
  var search=function(addressSearch = null){
      if(countRequest>=1)
      {
        markerShow(map,true);
      }
      if(typeof cityCircle != 'undefined')
      {
        cityCircle.setMap(null);
      }
      var components={country :'fr'};
      geocoder.geocode( { 'address': addressSearch}, function(results, status) {
        /* Si l'adresse a pu être géolocalisée */
        if (status == google.maps.GeocoderStatus.OK)
        {
          /* Récupération de sa latitude et de sa longitude */
          map.setCenter(results[0].geometry.location);
          map.setZoom(11);
          var circlecity = circle();
          distanceRelais(circlecity);
          countRequest += 1;
        }
      });
  }
  var render=function(index,boolSearch){
    var panel=document.createElement('div');
    panel.className = 'panel default-panel iw-container';
    //panel.id = 'iw-container';
    var panelHead = document.createElement('div');
    panelHead.className = 'panel-heading iw-title';
    var panelBody = document.createElement('div');
    panelBody.className = 'panel-body iw-content';
    var columnAdressRelais = document.createElement('div');
    columnAdressRelais.className = 'col-xs-12';
    var columnText = document.createElement('div');
    columnText.className = 'col-xs-12';
    columnAdressRelais.appendChild(document.createTextNode(listRelais[index].coordonates.address));
    panelBody.appendChild(columnAdressRelais);
    if(boolSearch)
    {
      var containText = document.createTextNode('Voulez-vous selectionner ce point relais ?')
      var columnButton = document.createElement('div');
      columnButton.className = 'col-xs-12';
      var groupButton = document.createElement('div');
      groupButton.className = 'btn-group'
      var buttonSelect = document.createElement('button');
      buttonSelect.className = 'btn btn-green selectRelais';
      buttonSelect.dataset.relais = listRelais[index].id;
      var iconSelect = document.createElement('i');
      iconSelect.className = 'fa fa-check';
  

      buttonSelect.appendChild(iconSelect);
      groupButton.appendChild(buttonSelect);
      columnText.appendChild(containText);
      columnButton.appendChild(groupButton);
      panelBody.appendChild(columnText);
      panelBody.appendChild(columnButton);
    }

    panelHead.appendChild(document.createTextNode(listRelais[index].name));
    panel.appendChild(panelHead);
    panel.appendChild(panelBody);
    return panel;
  }


  var autoComplete=function(){
    var options = {
      types: ['address'],
      componentRestrictions: {country: "fr"}
    };
    var autocomplete = new google.maps.places.Autocomplete(address,options);
    autocomplete.bindTo('bounds', map);
  }



  /* Fonction infoWindow  */
  var attachSecretMessage=function(infowindow) {
    google.maps.event.addListener(infowindow, 'domready', function() {

    $('.selectRelais').click(function() {
      var idRelais=this.getAttribute('data-relais');
      var route = Routing.generate(_that.routeUpdateRelais,{ id : idRelais });
      var objAjax=new CallAjax();
      var data=objAjax.callAjax(route);
      data.done(function(data){
        if(data.response)
        {
          $('#header #relais').text(data.relaisName);
          $('#validateUpdateRelais').addClass("in");
          setTimeout(function(){
            $('#validateUpdateRelais').removeClass("in");
          },3000);
        }
        else
        {
          $('#errorUpdateRelais').addClass("in");
          setTimeout(function(){
            $('#errorUpdateRelais').removeClass("in");
          },3000);

        }
      });

    });
    // Reference to the DIV that wraps the bottom of infowindow
    var iwOuter = $('.gm-style-iw');

    /* Since this div is in a position prior to .gm-div style-iw.
     * We use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
     */
     var iwBackground = iwOuter.prev();
     iwBackground.children(':nth-child(3)').css({display:'none'});

     iwBackground.children(':nth-child(3)').css({display:'none'});
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

  });
  }


  var markerShow=function(map,boolSearch = null)
  { 
    var infowindow = new google.maps.InfoWindow()
    for(var i = 0; i < listMarker.length; i++)
    {
      (function (id) {
        var marker = listMarker[i];
        marker.setMap(map);
        var contentRender=render(i,false);
        listener1 = google.maps.event.addListener(marker, 'click', function () {
          infowindow.setOptions({
            content: contentRender,
            map: map,
            position:marker.latLng
          });
        });
      }(i));
      attachSecretMessage(infowindow);
    }
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
   return cityCircle;
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
        if(typeof cityCircle != 'undefined')
        {
          cityCircle.setMap(null);
        }
        cityCircle = circle();
        distanceRelais(cityCircle);

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


var distanceRelais=function(circle){
   for( var i=0 ;i<listRelais.length;i++){
       var bounds = circle.getBounds()
        var inCircle = bounds.contains(listMarker[i].position);
        if(inCircle)
        {
          var contentRender=render(i,true);
          var infoWindow = new google.maps.InfoWindow();
          google.maps.event.clearInstanceListeners(listMarker[i]);
          google.maps.event.addListener(listMarker[i], 'click', function() {
          infoWindow.setContent(contentRender);
          infoWindow.open(map, marker);
          attachSecretMessage(infoWindow);

          });
        }
        else
        {  
          listMarker[i].setMap(null);   
        }      
    }
  }
  var showAll = function(){
    $('#allMarker').click(function(){
        if(typeof cityCircle != 'undefined')
        {
          cityCircle.setMap(null);
        }
      markerShow(map);
      map.setCenter(new google.maps.LatLng(46.9199018,3.2377911));
      map.setZoom(5);
    });

  }

}