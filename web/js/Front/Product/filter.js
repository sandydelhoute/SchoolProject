function Filter(routeFilter,selector,render){

  var _this = this
  var defaultFilter={priceMin:0,priceMax:100,allergene:[],categorie:[]};
  var objAjax=new CallAjax();
  this.render=render;
  this.routeFilter=routeFilter;
  

  this.init=function(){
   defaultAllergene();
   clickApply();
   resetfilter();
   priceParams();
   render(objAjax.callAjax(Routing.generate(_this.routeFilter,defaultFilter)));
 }
 var render=function(data){
   _this.render(data);
 }
 var clickApply=function(){
  $('#applyfilter').click(function(){
    console.log('je suis dans le click');
    var listAllergene=[];
    var listCategorie=[];
    var priceMin= $( "#range" ).slider( "values", 0 );
    var priceMax=$( "#range" ).slider( "values", 1 );
    $('.allergenes-filter').each(function(){
      listAllergene.push($(this).val());
    });
    $('.categories-filter').each(function(){
      listCategorie.push($(this).val());
    });

  var filter={allergene:listAllergene,priceMin:priceMin,priceMax:priceMax};
  render(objAjax.callAjax(Routing.generate(_this.routeFilter,filter)));
});
}
var defaultAllergene=function(){
  var listAllergene=[];
  var listCategorie=[];
  $('.allergenes-filter').each(function(){
    if(!$(this).checked)
    listAllergene.push($(this).val());
  });
  $('.categories-filter').each(function(){
     if($(this).checked)
      listCategorie.push($(this).val());
    });
 
  if(listCategorie.length == 0)
  {
    listCategorie=null;
    console.log('je suis dans le null');
  }
  if(listAllergene.length == 0)
    listAllergene=null
   console.log(listCategorie)
  defaultFilter.allergene=listAllergene;
  defaultFilter.categorie=listCategorie;

}

var priceParams=function(){
 $( "#range" ).slider({
  range: true,
  min: 0,
  max: 100,
  values: [ 0, 100 ],
  slide: function( event, ui ) {
    $( "#rangeinput" ).val( ui.values[ 0 ] +"€" + "-" + ui.values[ 1 ]+"€" );
  }
});
  $( "#rangeinput" ).val( $( "#range" ).slider( "values", 0 ) +
  "€ -" + $( "#range" ).slider( "values", 1 )+"€" );
}

var resetfilter=function(){
$('#resetfilter').click(function(){
  console.log('je suis dans le reset');
   $( '#range' ).each(function(){

      var options = $(this).slider( 'option' );

      $(this).slider( 'values', [ options.min, options.max ] );

    });
  $( "#rangeinput" ).val( $( "#range" ).slider( "values", 0 ) +
  "€ -" + $( "#range" ).slider( "values", 1 )+"€" );
  $('.allergenes-filter').each(function(){
    $(this).prop('checked', true);
  });
  $('.categories-filter').each(function(){
  $(this).prop('checked',false);
  });
});
}

}
