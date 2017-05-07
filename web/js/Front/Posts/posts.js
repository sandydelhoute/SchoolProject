$(document).ready(function(){	
	var selector=$("#grid");
	var routePosts='actualityscrollpage';
	var routeDetailPosts='actualitydetailpage';
	var render=function(data){
		console.log('je suis dans le render')
		data.done(function(data){
			//if(data.length)
			$.each($.parseJSON(data.data), function(key,obj){
			var html='<article>';
			obj.images.map(function(image){
	      	html+='<img class="img-responsive" src="/'+image.path+'" alt=""/>';
	     	});
	     	html+='<h3>'+obj.title+'</h3></a>';
	      	html+='<p class="DateArticle">'+obj.datepublish+'</p>';
	      	html+='<p class="ContenuArticle">'
	        var trimmable = '\u0009\u000A\u000B\u000C\u000D\u0020\u00A0\u1680\u180E\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u2028\u2029\u3000\uFEFF';
	        var reg = new RegExp('(?=[' + trimmable + '])');
	        var count = 0;
	        var description=obj.content.split(reg).filter(function(word) {
	            count += word.length;
	            return count <= Math.random() * (obj.content.length - 50) + 50;
	        }).join('')+'...';
	        html += description;
	        html += '</p>';
	        html += '<a href="'+Routing.generate(routeDetailPosts,{id:obj.id})+'">';
	       	html += 'suite';
	       	html += '</a>';
	       	html += '</article>';
			var item=document.createElement('article');
			salvattore.appendElements(document.querySelector('#grid'),[item]);
			item.outerHTML =html;
		})
	});
	}
	var objInfiniteScroll = new InfiniteScroll(routePosts,selector,render);
	objInfiniteScroll.init();


});
