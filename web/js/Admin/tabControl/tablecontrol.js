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
			if(data.nbPage>1)
				pagination(data.page,data.maxPage,data.nbPage);					
		
		});
		eventClickDesc();
		eventClickAsc();
		eventClickSearch();
		eventClickSort();
		eventChangeNbrMax();
		eventPaginationclick();
	}

	var pagination=function(page,maxPage,nbPage){

		while (paginationContainer.hasChildNodes()) {   
		    paginationContainer.removeChild(paginationContainer.firstChild);
		}
				
		if(parseInt(page)>1)
		{
			var liLeft = document.createElement('li');
			var linkPrevious = document.createElement('a');
			linkPrevious.href = Routing.generate(that.routeFilter,{page:parseInt(page)-1,maxPage:maxPage,orderSelect:that.defaultOrder.orderSelect,order:that.defaultOrder.order,champ:that.defaultOrder.champ,});
			linkPrevious.dataset.page=parseInt(page)-1;
			linkPrevious.appendChild(document.createTextNode('<'));
			liLeft.appendChild(linkPrevious);
			paginationContainer.appendChild(liLeft);
		}
		for(var i=1;i<=nbPage;i++)
		{
			var liContainer = document.createElement('li');
			if(i == parseInt(page))
				liContainer.className = 'active';
			var linkPage = document.createElement('a');
			linkPage.dataset.page= i ;
			linkPage.href = Routing.generate(that.routeFilter,{page:page,maxPage:maxPage,orderSelect:that.defaultOrder.orderSelect,order:that.defaultOrder.order,champ:that.defaultOrder.champ});
			linkPage.appendChild(document.createTextNode(i));
			liContainer.appendChild(linkPage);
			paginationContainer.appendChild(liContainer);
		}
		if(parseInt(page)<parseInt(nbPage))
		{
			var liRight = document.createElement('li');
			var linkNext = document.createElement('a');
			linkNext.href = Routing.generate(that.routeFilter,{page:parseInt(page)+1,maxPage:maxPage,orderSelect:that.defaultOrder.orderSelect,order:that.defaultOrder.order,champ:that.defaultOrder.champ});
			linkNext.dataset.page= parseInt(page)+1 ;
			linkNext.appendChild(document.createTextNode('>'));
			liRight.appendChild(linkNext);
			var liDoubleRight = document.createElement('li');
			var linkDoubleRight = document.createElement('a');
			linkDoubleRight.dataset.page= nbPage ;
			linkDoubleRight.href = Routing.generate(that.routeFilter,{page:nbPage,maxPage:maxPage,orderSelect:'',order:data.order,champ:data.champ});
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
			that.defaultOrder.order = order ;
			that.defaultOrder.orderSelect = orderSelect; 
			data=objAjax.callAjax(Routing.generate(routeFilter,that.defaultOrder));
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
			that.defaultOrder.order = order;
			that.defaultOrder.orderSelect = orderSelect; 
			data=objAjax.callAjax(Routing.generate(routeFilter,that.defaultOrder));
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
			that.defaultOrder.champ = search ;
			data=objAjax.callAjax(Routing.generate(routeFilter,that.defaultOrder));
			render(data);
			data.done(function(data){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);
			});
		});
	}

	var eventPaginationclick=function(){
		$(document).on('click','.pagination  a',function(e) {
    		e.preventDefault();
    		that.defaultOrder.page= $(this).attr('data-page');
    		data=objAjax.callAjax(Routing.generate(routeFilter,that.defaultOrder));
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
			$(this).removeClass('fa-sort').addClass('fa-sort-desc');
			orderSelect = $(this).parent().find('label').html();
			order = "asc";
			that.defaultOrder.order = order;
			that.defaultOrder.orderSelect = orderSelect; 
			data=objAjax.callAjax(Routing.generate(routeFilter,that.defaultOrder));
			render(data);
			data.done(function(data){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);		
			});

		});
	}

	var eventChangeNbrMax = function(){	  
		$('.nbrForPage').change(function() {
			that.defaultOrder.maxPage=$(this).val();
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
			that.defaultOrder.nbPage = champ ; 
			data=objAjax.callAjax(render(objAjax.callAjax(Routing.generate(routeFilter,that.defaultOrder))));
			data.done(function(data){
					if(data.nbPage>1)
						pagination(data.page,data.maxPage,data.nbPage);
			});		
		});

	}

}
