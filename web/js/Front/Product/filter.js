function Filter(routeFilter,routeAdd,selector,render,offset){

  this.routeAdd=routeAdd;
  this.render=render;
  this.routeFilter=routeFilter;
  this.selector=selector;
  var ajaxready=true;

  this.offset=offset;

  var _this = this;
  var objAjax=new CallAjax(selector);
  var dataFilter={priceMin:0,priceMax:100,offsetMin:0,offsetMax:this.offset};

  

  this.init=function(){
    filterAllergene();
    filterCategorie();
    clickApply();
    resetfilter();
    priceParams();
    addPanier();
    render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));
    console.log(ajaxready);
    scroll();
  }
  var render=function(data){
   return _this.render(data);
 }
 var clickApply=function(){
  $('#applyfilter').click(function(){
    filterAllergene();
    filterCategorie();
    filterPrice();
    if(dataFilter.categorie.length > 0)
    {
     ajaxready = true;
     _this.selector.html('');
     dataFilter.offsetMin=0;
     dataFilter.offsetMax=_this.offset;
     render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));
   }
   else
   {
    _this.selector.text('Votre recherche ne peut aboutir si aucune categorie est cochée')
  }
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
  dataFilter.categorie=listCategorie;


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
   $( '#range' ).each(function(){

    var options = $(this).slider( 'option' );

    $(this).slider( 'values', [ options.min, options.max ] );

  });
   $( "#rangeinput" ).val( $( "#range" ).slider( "values", 0 ) +
    "€ -" + $( "#range" ).slider( "values", 1 )+"€" );
   $('.allergenes-filter').each(function(){
    $(this).prop('checked', false);
  });
   $('.categories-filter').each(function(){
    $(this).prop('checked',true);
  });
 });
}

var addPanier=function(){
  $('#listProduct').on('click','.addpanier',function(e){
    var countPanier=parseInt($('#countpanier').text());
    var idProduct=$(this).data('product');
    var quantity=$(this).parents('.produits').find('.quantity').val();
    $('#countpanier').text(countPanier + 1 );
    objAjax.callAjax(Routing.generate(_this.routeAdd,{id:idProduct,quantity:quantity}));
  })
}


var scroll=function(){
  $(window).scroll(function() {
    if ( ajaxready == false)
      return;
    if($(window).scrollTop() > ($(document).height()-$(window).height()-200)){
     ajaxready=false;
     console.log("je suis dans le id du scroll");
     dataFilter.offsetMin = dataFilter.offsetMin + _this.offset;
     dataFilter.offsetMax = dataFilter.offsetMax + _this.offset + 1 ;
     ajaxready=render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));
     // render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));
     // ajaxready = true;
     console.log(ajaxready);
   }
 });
}

}
