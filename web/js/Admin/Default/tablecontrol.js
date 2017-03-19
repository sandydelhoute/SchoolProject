function TableControl(routeOrder,routeSearch,defaultData,render){
	var champ=null,order=null,search=null;
	var ajax= new CallAjaxOrder(render);
	this.routeOrder=routeOrder;
	this.routeSearch=routeSearch;
	this.render=render;
	this.data=defaultData;
	
	this.eventclick = function(){
		eventClickDesc();
		eventClickAsc();
		eventClickSearch();
		eventClickSort();
	}

	var eventClickDesc = function(){	
		$('.table').on('click','.fa-sort-desc',function(){
		    var champ = $(this).parent().find('label').html();
		   	var order = "desc";
		    $(this).removeClass('fa-sort-desc').addClass('fa-sort-asc');
			var data="champ="+champ+"&order="+order;
		    ajax.callAjax(data,route,render);
		  });
		//return liste;
	}
	
	var eventClickAsc = function(){
			  $('.table').on('click','.fa-sort-asc',function(){
			      champ = $(this).parent().find('label').html();
			      order = "asc";
			      $(this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
		      //var liste = ajax.callAjaxOrder( filter ,routeOrder);
			  });
			  		//return liste;

	}
	var eventClickSearch = function(){
		$('.search-btn').on('click',function(){
			    var search = $('.search-input').val();
			  	var data="search="+search;
		    ajax.callAjax(data,route,render);
			  });
	}

	var eventClickSort = function(){	  
		  $('.table').on('click','.fa-sort',function(){
		    $('.fa-sort-asc').removeClass('fa-sort-asc').addClass('fa-sort');
		    $('.fa-sort-desc').removeClass('fa-sort-desc').addClass('fa-sort');
		    $(this).removeClass('fa-sort').addClass('fa-sort-asc');
		  });
	}
}
