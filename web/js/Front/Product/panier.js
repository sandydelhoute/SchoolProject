function Panier(routeadd,routedelete,selector){
var _this=this;
this.routeadd=routeadd;
this.selector=selector;
var objAjax=new CallAjax(selector);

this.addpanier=function(){
$('#listProduct').on('click','.addpanier',function(e){
var idProduct=$(this).data('product');
var quantity=$(this).parents('.produits').find('.quantity').val();
objAjax.callAjax(Routing.generate(_this.routeadd,{id:idProduct,quantity:quantity}));
})
}

this.deletepanier=function(){
$('#listProduct').on('click','.delete-product',function(e){
var idProduct=$(this).data('product');
objAjax.callAjax(Routing.generate(_this.routedelete,{id:idProduct,quantity:quantity}));
})
}

}