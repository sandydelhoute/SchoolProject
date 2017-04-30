function Panier(route){
this.route=route;
var _this=this;
var objAjax=new CallAjax();

this.addpanier=function(){
$('#listProduct').on('click','.addpanier',function(e){
var idProduct=$(this).data('product');
var quantity=$(this).parents('.produits').find('.quantity').val();
objAjax.callAjax(Routing.generate(_this.route,{id:idProduct,quantity:quantity}));
})
}

}