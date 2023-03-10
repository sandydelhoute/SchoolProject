function Filter(routeFilter,routeAddPanier,selector,render,offset){

  this.routeAddPanier=routeAddPanier;
  this.render=render;
  this.routeFilter=routeFilter;
  this.selector=selector;
  this.offset=offset;
  var ajaxready=true;
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
    scroll();
  }
  
  var render=function(data){
   return _this.render(data);
 }

 var clickApply=function(){
  $('#applyfilter').click(function(){
        objAjax.selector=_this.selector;
    filterAllergene();
    filterCategorie();
    filterPrice();
    if(dataFilter.categorie.length > 0)
    {
     ajaxready = true;
     _this.selector.innerHTML='';
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
    var produitadd=$(this);
    objAjax.selector=null;
      var idProduct=$(this).data('product');
      var quantity=$(this).parents('.produits').find('.quantity').val();
      //var stock = $(produitadd).parents('.produits').find('.stock').text().split(":");
      var stock =$(produitadd).parents('.produits').find('.quantity').attr('max');
      if(quantity>parseInt(stock))
      {
        quantity=parseInt(stock);
        $(this).parents('.produits').find('.quantity').val(quantity);
      }
      if(quantity<1)
      {
        quantity=1;
        $(this).parents('.produits').find('.quantity').val(1);

      }
      var data=objAjax.callAjax(Routing.generate(_this.routeAddPanier,{id:idProduct,quantity:quantity}));
        data.done(function(data){
                $('#countpanier').text(data.paniercount);
                if(data.stock>1)
                $(produitadd).parents('.produits').find('.stock').text("stock:"+data.stock);
                else
                   $(produitadd).parents('.produits').parent().hide();
        });
  })
}


var scroll=function(){
  $(window).scroll(function() {
    objAjax.selector=null;
    if ( ajaxready == false)
      return;
    if($(window).scrollTop() > ($(document).height()-$(window).height()-10)){
     ajaxready=false;
     dataFilter.offsetMin = dataFilter.offsetMin + _this.offset;
     dataFilter.offsetMax = dataFilter.offsetMax + _this.offset + 1 ;
     ajaxready=render(objAjax.callAjax(Routing.generate(_this.routeFilter,dataFilter)));

   }
 });
}

}
