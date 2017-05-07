function Panier(routeDelete,selector=null){
	this.routeDelete=routeDelete;
	this.selector=selector;
	var objAjax=new CallAjax(selector);
	var _this=this;

	this.init=function(){
		changeQuantity();
		deletePanier();
	}

	var deletePanier=function(){
		$('.delete-product').click(function(){
			var idProduct=$(this).data('product');
			render(objAjax.callAjax(Routing.generate(_this.routeDelete,{id:idProduct})));
		})
	}
	var changeQuantity=function(){
		$('.quantity').bind('keyup mouseup',function(){
			console.log('je suis dans le change');
		})
	}



	var render=function(data){

		data.done(function(data){
			$('.total-price .price').html((data.total.toString()).replace('.','€'));
			if(data.total==0)
			{
				$('.command-list').html('Votre panier est vide.');
				$('.price').html('0');
			}
			else
			{
				$('.total-price .price').html((pricetotal.toString()).replace('.','€'));
				$('.fidelite-gain .fidelite-pts').html(data.ptsfidelite);

			}
		}

	}
}