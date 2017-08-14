$(document).ready(function(){
	var selector=document.getElementById("listProduct");
	var routeFilter='productfilterpage';
	var routeAddPanier='addproductpage';
	var render=function(data){
        var loading=document.getElementById("loading");
        var stopAjax = false;
        var html=function(obj){
              var truncate=function(obj){
                var trimmable = '\u0009\u000A\u000B\u000C\u000D\u0020\u00A0\u1680\u180E\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u2028\u2029\u3000\uFEFF';
                var reg = new RegExp('(?=[' + trimmable + '])');
                var count = 0;
                var description=obj.description.split(reg).filter(function(word) {
                    count += word.length;
                    return count <= 150;
                }).join('')+'...';
                return description;
                }

            var htmlImage=function(obj){
                var containerImage = document.createElement('div');
                containerImage.className = "img-zoom";
                var image = document.createElement('img');
                image.className = 'img-responsive';
                var redirectDetail = document.createElement('a');
                redirectDetail.href = Routing.generate('productdetailpage',{id: obj.id});
                var detail = document.createElement('div');
                detail.className = "detail";
                var count=0;
                obj.images.map(function(objImage){
                    if(count<1)
                    {
                        image.src = objImage.path;
                        image.alt = objImage.alt;
                    }
                    count ++;
                })
                redirectDetail.appendChild(detail);
                containerImage.appendChild(image);
                containerImage.appendChild(redirectDetail);
                return containerImage;
            }
            var htmlDescription=function(obj){
                var containerDescription = document.createElement('div');
                containerDescription.className = 'col-xs-12';
                containerDescription.textContent = truncate(obj);
                return containerDescription;
            }

            var htmlTitle=function(obj){
                var line = document.createElement('div');
                line.className = 'row';
                var column = document.createElement('div');
                column.className = 'col-xs-12';
                var title = document.createElement('h2');
                title.innerHTML = obj.name;
                column.appendChild(title);
                line.appendChild(column);
                return line;
            }
            var htmlQuantity = function(obj){
                var columnQuantity = document.createElement('div');
                columnQuantity.className = 'col-xs-6 text-center';
                var inputQuantity = document.createElement("INPUT");
                inputQuantity.className = 'form-control quantity';
                inputQuantity.min = 1;
                inputQuantity.max= obj.stock[0].quantity;
                inputQuantity.step = 1;
                inputQuantity.type = 'number';
                inputQuantity.required = 'required';
                inputQuantity.value = 1;
                columnQuantity.appendChild(inputQuantity);
                return columnQuantity;
            }
            var htmlPrice=function(obj){
                var columnPrice = document.createElement('div');
                columnPrice.className = 'col-xs-6';
                var prix = obj.prix.toString().split(".");
                var priceEntier = document.createElement('h3');
                var priceCents = document.createElement('small');
                priceCents.appendChild(document.createTextNode(prix[1]));
                priceEntier.appendChild(document.createTextNode(prix[0]+'€'))
                priceEntier.appendChild(priceCents);
                columnPrice.appendChild(priceEntier);
                return columnPrice;
            }
            var htmlButton=function(obj){
                var line = document.createElement('div');
                line.className = 'row';
                var column = document.createElement('div');
                column.className ='col-xs-6 col-xs-offset-3';
                var button = document.createElement('button');
                button.className ='btn btn-success btn-block addpanier';
                button.dataset.product = obj.id;
                var icone =  document.createElement('i');
                icone.className = 'fa fa-shopping-cart fa-2x';
                button.appendChild(icone);
                button.appendChild(document.createTextNode('| Ajouter'));
                column.appendChild(button);
                line.appendChild(column);
                return line;

            }
            var htmlStock=function(obj){
                var column = document.createElement('div');
                column.className = 'col-xs-12 text-center';
                var label = document.createElement('label');
                label.className='stock';
                label.appendChild(document.createTextNode('stock:'+obj.stock[0].quantity));
                column.appendChild(label);
                return column; 
            }

            var divProduit = document.createElement('div');
            divProduit.className = 'produits';
            var container = document.createElement('div');
            container.className = "col-xs-12 col-md-6";
            divProduit.appendChild(htmlImage(obj));
            divProduit.appendChild(htmlTitle(obj));
            divProduit.appendChild(htmlDescription(obj));
            divProduit.appendChild(htmlQuantity(obj));
            divProduit.appendChild(htmlPrice(obj));
            divProduit.appendChild(htmlButton(obj));
            divProduit.appendChild(htmlStock(obj));
            container.appendChild(divProduit);
            selector.appendChild(container);
        }


        data.done(function(data){
            if($.parseJSON(data.data).length>0){
                $.each($.parseJSON(data.data), function(key,obj){
                    html(obj);
                });
              
                selector.removeChild(document.getElementById("loading"));
                
            }
            else
            {
                selector.removeChild(document.getElementById("loading"));
                stopAjax = true;
                selector.appendChild(document.createTextNode("Aucun stock présent sur ce points relais"));

            }
        });
    return stopAjax;
	}
	var objFilter = new Filter(routeFilter,routeAddPanier,selector,render,100);
	objFilter.init();
});