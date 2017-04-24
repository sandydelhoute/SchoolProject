function TableControl(routeOrder,routeSearch,html){
	var champ=null,order=null,search=null;
	this.routeOrder=routeOrder;
	this.routeSearch=routeSearch;
	this.html=html;
	this.selector=$(".table");
	this.objAjax= new CallAjax(html);
	this.objAjax.callAjax(routeOrder,this.selector);
	console.log("je suis dans le construc");

	this.eventclick = function(){
		console.log("je suis dans le evenclick");
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


		    this.objAjax.callAjax(routeOrder,selector);
		  });
	}
	
	var eventClickAsc = function(){
			  $('.table').on('click','.fa-sort-asc',function(){
			      champ = $(this).parent().find('label').html();
			      order = "asc";
			      $(this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
			  });
	}
	var eventClickSearch = function(){
		$('.search-btn').on('click',function(){
			    var search = $('.search-input').val();
			  	var data="search="+search;
		    this.ajax.callAjax(routeSearch,selector);
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
