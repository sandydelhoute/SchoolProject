$(document).ready(function(){
	var selector=document.getElementById("grid");
	var routePosts='actualityscrollpage';
	var routeDetailPosts='actualitydetailpage';
	var render=function(data){
		var stopAjax = false;

		var html=function(posts){
			var trimmable = '\u0009\u000A\u000B\u000C\u000D\u0020\u00A0\u1680\u180E\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u2028\u2029\u3000\uFEFF';
			var reg = new RegExp('(?=[' + trimmable + '])');
			var count = 0;
			var description=posts.content.split(reg).filter(function(word) {
			    count += word.length;
			    return count <= Math.random() * (posts.content.length - 0) + posts.content.length;
			}).join('')+'...';
			var dateFormat = new Date(posts.datepublish).toISOString().substr(0, 19).replace('T', ' ').replace('-','/').replace('-','/');

			var article = document.createElement('article');

			var imageContainer = document.createElement('img');
			imageContainer.className = 'img-responsive';
                var count=0;
			posts.images.map(function(image){
				if(count<1)
                {
					imageContainer.src = image.path;
					imageContainer.alt = image.alt;
				}
                 count ++;
			});

			var title = document.createElement('h3');
			title.appendChild(document.createTextNode(posts.title));
			var date = document.createElement('p');
			date.className = "DateArticle";
			date.appendChild(document.createTextNode(dateFormat));
			var content = document.createElement('p');
			content.className = "ContenuArticle";
			content.appendChild(document.createTextNode(description));
			var articleHref = document.createElement('a');
			articleHref.href = Routing.generate(routeDetailPosts,{id:posts.id});
			articleHref.appendChild(document.createTextNode('Lire La suite'));
			article.appendChild(imageContainer);
			article.appendChild(title);
			article.appendChild(date);
			article.appendChild(content);
			article.appendChild(articleHref);
			salvattore.appendElements(document.querySelector('#grid'),[article]);

		}

		data.done(function(data){
        	var loading=document.getElementById("loading");
        	selector.removeChild(document.getElementById("loading"));
			if($.parseJSON(data.data).length>0){
				$.each($.parseJSON(data.data), function(key,obj){
					html(obj);
				})
			}
			else{
				stopAjax = true;
			}
		});

    return stopAjax;

	}
	var objInfiniteScroll = new InfiniteScroll(routePosts,selector,render,6);
	objInfiniteScroll.init();


});
