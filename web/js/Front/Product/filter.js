function Filter(routeFilter,selector,render){

var _this = this
this.render=render;
this.routeFilter=routeFilter;
var defaultFilter={allergene:[],priceMin:0,priceMax:100};
var objAjax=new CallAjax();

this.init=function(){
	defaultAllergene();
	clickApply();
	filterPrice();
	render(objAjax.callAjax(Routing.generate(this.routeFilter,defaultFilter)));
}
var clickApply=function(){
$('applyfilter').on('click',function(){
});
}
var defaultAllergene=function(){
var listAllergene=[];
$('.allergenes-filter').each(function(){
listAllergene.push($(this).val());
});
defaultFilter.allergene=listAllergene;
console.log(defaultFilter);
}

var filterPrice=function(){
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
}
