$(document).ready(function(){
	var selector=$("#listProduct");
	var routeFilter="productfilterpage";
	var render=function(data){

		data.done(function(data){

			$.each($.parseJSON(data.data), function(key,obj){
			var params={id: obj.id};
			var html= '<div class="col-xs-12 col-md-6">';
				html += '<div class="produits">'
				html += '<div class="img-zoom">';
				var count=0;
				obj.images.map(function(image){
				if(count!=1)
				{
				html += '<img src="'+ image.path +'" alt="'+ image.alt+'" class="img-responsive">';

				}
				count ++;
				})
				console.log(obj.id);
				html += '<a href="'+ Routing.generate('productdetailpage',params) +'" data-fancybox="produits">';
				html += '<div class="detail"></div>';
				html += '</a>';
				html += '</div>';
				html += '<div class="row">';
				html += '<div class="col-xs-12">';
				html += '<h2>'+ obj.name +'</h2>';
				html += '</div>';
				html += '</div>';
				html += ' <div class="col-xs-12"><p>';

        var trimmable = '\u0009\u000A\u000B\u000C\u000D\u0020\u00A0\u1680\u180E\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u2028\u2029\u3000\uFEFF';
        var reg = new RegExp('(?=[' + trimmable + '])');
        var count = 0;
        var description=obj.description.split(reg).filter(function(word) {
            count += word.length;
            return count <= 150;
        }).join('')+'...';
				//html += obj.description.substring(0,100)+'....';
				html += description;
				html += '</p></div>'
				html += '<div class="col-xs-6 text-center">';
				html += '<select id="quantite">';
				for(var i=1;i<=10;i++)
				{
					html += '<option value="'+i+'">'+i+'</option>';
				}
				html += '</select>';
				html += '</div>';
				html += '<div class="col-xs-6">';
				html += '<h3>'+ obj.prixEntier +'€';
				html += '<small>'+obj.prixCentime+'<small>';
				html += '</h3>';
				html += '</div>';
				html += '<div class="row">';
          		html += '<div class="col-xs-6 col-xs-offset-3">';
          		html += '<a class="btn btn-success btn-block" href="#" role="button">';
          		html += '<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i> | Ajouter</a>'
         		html += '</div>';
         		html += '</div>';
        		html += '</div>';

				selector.append(html);
			});
			// $('.pagination').html('');
			// for(var i=1;i<=data.nbPage;i++)
			// {
			// 	$('.pagination').append("<li><a href='"+Routing.generate(routeOrder,{page:i,nbMaxParPage:data.nbMaxParPage,champ:data.champ,order:data.order})+"'>"+i+"</a></li>");
			// }
		})


	}
	var objFilter = new Filter(routeFilter,selector,render);
	objFilter.init();
});


/*
<div class="col-md-4">
          <div class="col-md-12 produits">
            <div class="img-zoom">
            <a href="img/produit-1.jpg" data-fancybox="produits"><img src="img/produit-1.jpg" alt="" class="img-responsive"></a>
            </div>
            <h2>Burritos fajitas</h2>
            <div class="col-md-8">
            <p>Redécouvrez le mexique avec cette recette traditionnelle de burritos/fajitas aux épices du soleil.</p>
          </div>
          <div class="col-md-4">
            <h3>14€<small>90</small></h3>
          </div>
          <div class="col-md-6">
            <a class="btn btn-perso btn-block" href="#" role="button">Détails du produit</a>
          </div>
          <div class="col-md-6">
            <a class="btn btn-success btn-block" href="#" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> | Ajouter au panier</a>
          </div>
          </div>
        </div>

       */