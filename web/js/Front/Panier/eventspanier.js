function Panier(routeDelete,routeChangeQuantity,selector=null){
	this.routeDelete=routeDelete;
	this.selector=selector;
	this.routeChangeQuantity=routeChangeQuantity;
	var objAjax=new CallAjax(selector);
	var _this=this;

	this.init=function(){
		changeQuantity();
		deletePanier();
		lostFocus();
	}
	var render=function(data){

		data.done(function(data){
			if(data.total==0)
			{
				$('.command-list').html('Votre panier est vide.');
				$('.price').html('0');
				$('#countpanier').text(0);
			}
			else
			{
				$('.total-price .price').html((data.total.toString()).replace('.','€'));
				$('.fidelite-gain .fidelite-pts').text(data.ptsfidelite);
				console.log('je suis dans le else')
 				$('#countpanier').text(data.panniercount);		
 			}
		});

	}
	var deletePanier=function(){
		$('.delete-product').click(function(){
			var idDelete=$(this).data('product');
			$(this).parents('.command-list-item').remove();
			render(objAjax.callAjax(Routing.generate(_this.routeDelete,{id:idDelete})));
		})
	}
	var changeQuantity=function(){
		$(document).on('change','.quantity',function(){
			var idProduct=$(this).data('product');
			var quantity=parseInt($(this).val());
			var maxStock=parseInt($(this).attr('max'));
			if(quantity>$(this).attr('max'))
			{
				quantity=$(this).attr('max');
				$(this).val(quantity);
			}
			if(quantity<1)
			{
				quantity=1;
				$(this).val(1);
			}

			objAjax.callAjax(Routing.generate(_this.routeChangeQuantity,{id:idProduct,quantity:quantity}));
		})
	}

	var lostFocus=function(){
		$(document).on( "blur",'.quantity',function(){
			var idProduct=$(this).data('product');
			var quantity=parseInt($(this).val());
			var maxStock=parseInt($(this).attr('max'));
			if(quantity>maxStock)
			{
				quantity=$(this).attr('max');
				$(this).val(quantity);
			}

			if(quantity<1)
			{
				quantity=1;
				$(this).val(1);
			}

			objAjax.callAjax(Routing.generate(_this.routeChangeQuantity,{id:idProduct,quantity:quantity}));
		});
	}


}