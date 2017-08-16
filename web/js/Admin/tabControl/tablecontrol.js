function TableControl(routeFilter,defaultOrder,render,selector = null ){

	this.defaultOrder=defaultOrder;
	this.routeFilter=routeFilter;
	this.render=render;
	this.selector=selector;
	this.nbMaxParPage=10;
	this.currentPage=1;
	var paginationContainer = document.getElementById('pagination');
	var objAjax= new CallAjax();
	var that = this; 

	this.init = function(){
		data = objAjax.callAjax(Routing.generate(routeFilter,defaultOrder));
		this.render(data)
		data.done(function(data){
			console.log("e suis dans data done du tab controle");
			if(data.nbPage>1)
				pagination(data.page,data.maxPage,data.nbPage);					
		
		});
		eventClickDesc();
		eventClickAsc();
		eventClickSearch();
		eventClickSort();
		eventChangeNbrMax();
	}

	var pagination=function(page,maxPage,nbPage){

		var childPaginationContainer = paginationContainer.childNodes;
		console.log(childPaginationContainer);
		console.log(childPaginationContainer.length);
		for(var i = 0 ; i <=childPaginationContainer.length ; i++)
		{					
			console.log("removechild");
			console.log(childPaginationContainer[i]);

			paginationContainer.removeChild(childPaginationContainer[i]);	

		}
		
		if(page>1)
		{
			var liLeft = document.createElement('li');
			var linkPrevious = document.createElement('a');
			linkPrevious.href = Routing.generate(that.routeFilter,{page:page,maxPage:maxPage,orderSelect:'',order:data.order,champ:data.champ,});
			linkPrevious.appendChild(document.createTextNode('<'));
			liLeft.appendChild(linkPrevious);
			paginationContainer.appendChild(liLeft);
		}
		for(var i=1;i<=nbPage;i++)
		{
			var liContainer = document.createElement('li')
			var linkPage = document.createElement('a');
			linkPage.href = Routing.generate(that.routeFilter,{page:page,maxPage:maxPage,orderSelect:'',order:data.order,champ:data.champ});
			linkPage.appendChild(document.createTextNode(i));
			liContainer.appendChild(linkPage);
			paginationContainer.appendChild(liContainer);
		}
		if(page<nbPage)
		{
			var liRight = document.createElement('li');
			var linkNext = document.createElement('a');
			linkNext.href = Routing.generate(that.routeFilter,{page:page,maxPage:maxPage,orderSelect:'',order:data.order,champ:data.champ});
			linkNext.appendChild(document.createTextNode('>'));
			liRight.appendChild(linkNext);
			var liDoubleRight = document.createElement('li');
			var linkDoubleRight = document.createElement('a');
			liDoubleRight.appendChild(linkDoubleRight);
			linkDoubleRight.appendChild(document.createTextNode('>>'));
			paginationContainer.appendChild(liRight);
			paginationContainer.appendChild(liDoubleRight);
		}
	}
	var eventClickDesc = function(){	
		$('.table').on('click','.fa-sort-desc',function(){
			var orderSelect = $(this).parent().find('label').html();
			var order = "desc";
			$(this).removeClass('fa-sort-desc').addClass('fa-sort-asc');
			var urlParams={orderSelect:orderSelect,order:order};
			data=objAjax.callAjax(Routing.generate(routeFilter,urlParams));
			render(data);
			data.done(function(data){
				$.each($.parseJSON(data.data), function(key,users){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);
				});
			});
		});
	}

	var eventClickAsc = function(){
		$('.table').on('click','.fa-sort-asc',function(){
			orderSelect = $(this).parent().find('label').html();
			order = "asc";
			$(this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
			var urlParams={orderSelect:orderSelect,order:order};
			data=objAjax.callAjax(Routing.generate(routeFilter,urlParams));
			render(data);
			data.done(function(data){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);		
			});
		});
	}
	var eventClickSearch = function(){
		$('.search-btn').on('click',function(){
			var search = $('.search-input').val();
			var urlParams={orderSelect:camp ,order:champ,champ:search};
			data=objAjax.callAjax(Routing.generate(routeFilter,urlParams));
			render(data);
			data.done(function(data){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);
			});
		});
	}

	var eventClickSort = function(){	  
		$('.table').on('click','.fa-sort',function(){
			$('.fa-sort-asc').removeClass('fa-sort-asc').addClass('fa-sort');
			$('.fa-sort-desc').removeClass('fa-sort-desc').addClass('fa-sort');
			$(this).removeClass('fa-sort').addClass('fa-sort-asc');
		});
	}

	var eventChangeNbrMax = function(){	  
		$('.nbrForPage').change(function() {
			this.nbMaxParPage=$(this).val();
			var champ;
			var selectOrder=$('.fa-sort-asc')
			var order='asc';
			if(typeof order != 'undefined')
			{
				selectOrder=$('.fa-sort-asc');
				order='desc';
			}
			selectOrder.each(function(){
				champ=$(this).parent().find('label').html();
			});
			var urlParams={page:1,nbMaxParPage:this.nbMaxParPage,champ:champ,order:order};
			data=objAjax.callAjax(render(objAjax.callAjax(Routing.generate(routeFilter,urlParams))));
			data.done(function(data){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);
			});		
		});

	}

}
