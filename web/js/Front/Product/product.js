$(document).ready(function(){
	var selector=$("#listProduct");
	var routeFilter='productfilterpage';
	var routeAddPanier='addproductpage';
	var render=function(data){

		data.done(function(data){
			selector.html('');
			//if($.parseJSON(data.data)>0)
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
				html += description;
				html += '</p></div>'
				html += '<div class="col-xs-6 text-center">';
				html += '<input type="number" class="form-control quantity" value="1" min="1"  step="1" required="required"></input>'
				html += '</div>';
				html += '<div class="col-xs-6">';
				var prix=obj.prix.toString().split(".");
				html += '<h3>'+prix[0]+'â‚¬';
				html += '<small>'+prix[1]+'</small>';
				html += '</h3>';
				html += '</div>';
				html += '<div class="row">';
          		html += '<div class="col-xs-6 col-xs-offset-3">';
          		html += '<button class="btn btn-success btn-block addpanier" data-product="'+obj.id+'">';
          		html += '<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i> | Ajouter</button>'
         		html += '</div>';
         		html += '</div>';
        		html += '</div>';

				selector.append(html);
			});
		})


	}
	var objFilter = new Filter(routeFilter,routeAddPanier,selector,render);
	objFilter.init();

});