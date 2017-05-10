$(document).ready(function(){
var routeDeletePanier='deleteproductpage';
var routeChangeQuantity='changequantity';
var panier = new Panier(routeDeletePanier,routeChangeQuantity);
panier.init();

});