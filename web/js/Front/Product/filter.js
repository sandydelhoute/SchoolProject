function Filter(routeFilter,selector,render){
this.render=render;
this.routeFilter=routeFilter;
var defaultFilter={allergene:[],priceMin:0,priceMax:100};
var objAjax=new CallAjax();

this.init=function(){
	defaultAllergene();
	clickApply();
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
}
