function Panier(routeDelete,routeChangeQuantity,selector=null){
	this.routeDelete=routeDelete;
	this.selector=selector;
	this.routeChangeQuantity=routeChangeQuantity;
	var objAjax=new CallAjax(selector);
	var _this=this;

	this.init=function(){
		console.log(_this.routeChangeQuantity)
		changeQuantity();
		deletePanier();
	}
	var render=function(data){

		data.done(function(data){
			console.log(data);
			if(data.total==0)
			{
				$('.command-list').html('Votre panier est vide.');
				$('.price').html('0');
				$('#countpanier').text(0);
			}
			else
			{
			$('.total-price .price').html((data.total.toString()).replace('.','€'));
			$('.fidelite-gain .fidelite-pts').html(data.ptsfidelite);
			$('#panniercount').text(data.paniercount);
			}
		});

	}
	var deletePanier=function(){
		$('.delete-product').click(function(){
			var type = 'product';
			var idDelete=$(this).data('product');
			if(typeof idDelete == 'undefined')
			{
			 idDelete=$(this).data('menu');
			 type='menu';
			}
			$(this).parents('.command-list-item').remove();
			render(objAjax.callAjax(Routing.generate(_this.routeDelete,{id:idDelete,type:type})));
		})
	}
	var changeQuantity=function(){
		$('.quantity').bind('change',function(){
			console.log(_this.routeChangeQuantity)
			var idProduct=$(this).data('product');
			var quantity=$(this).val();
			objAjax.callAjax(Routing.generate(_this.routeChangeQuantity,{id:idProduct,quantity:quantity}));
		})
	}


}