function Filter(routeFilter,routeAdd,selector,render){

  this.routeAdd=routeAdd;
  var dataFilter={priceMin:0,priceMax:100};
  this.render=render;
  this.routeFilter=routeFilter;
  var _this = this;
  var objAjax=new CallAjax(selector);

  

  this.init=function(){
    filterAllergene();
    filterCategorie();
   clickApply();
   resetfilter();
   priceParams();
   addPanier();
   render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));
 }
 var render=function(data){
   _this.render(data);
 }
 var clickApply=function(){
  $('#applyfilter').click(function(){
    filterAllergene();
    filterCategorie();
    filterPrice();
    console.log(dataFilter.categorie);
    console.log(dataFilter.allergene);
  render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));
});
}

var filterAllergene=function(){
  var listAllergene=[];
  $('.allergenes-filter').each(function(){
    if($(this).prop('checked'))
    listAllergene.push($(this).val());
  });
  if(listAllergene.length == 0)
    listAllergene=null
  dataFilter.allergene=listAllergene;

}
var filterCategorie=function(){
  var listCategorie=[];

  $('.categories-filter').each(function(){
     if($(this).prop('checked'))
      listCategorie.push($(this).val());
    });
  // if(listCategorie.length == 0)
  // {
  //   listCategorie=null;
  // }
    dataFilter.categorie=listCategorie;
      console.log( dataFilter.categorie);


}
var filterPrice=function(){
    dataFilter.priceMin = $( "#range" ).slider( "values", 0 );
    dataFilter.priceMax = $( "#range" ).slider( "values", 1 );

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

var addPanier=function(){
$('#listProduct').on('click','.addpanier',function(e){
var idProduct=$(this).data('product');
var quantity=$(this).parents('.produits').find('.quantity').val();
objAjax.callAjax(Routing.generate(_this.routeAdd,{id:idProduct,quantity:quantity}));
})
}

}
