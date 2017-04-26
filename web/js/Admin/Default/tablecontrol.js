function TableControl(routeOrder,routeSearch,defaultOrder,selector,render){

	this.defaultOrder=defaultOrder;
	this.routeOrder=routeOrder;
	this.routeSearch=routeSearch;
	this.render=render;
	this.selector=selector;
	this.nbMaxParPage=10;
	this.currentPage=1;
	var objAjax= new CallAjax(selector);



	var callAjax=function(data){
			render(objAjax.callAjax(Routing.generate(routeOrder,data)));		
		}

		this.init = function(){
			this.defaultOrder.nbMaxParPage=this.nbMaxParPage;
			this.defaultOrder.page=this.currentPage;
			this.render(objAjax.callAjax(Routing.generate(routeOrder,defaultOrder)));
			this.eventClickDesc();
			this.eventClickAsc();
			this.eventClickSearch();
			this.eventClickSort();
			this.eventChangeNbrMax();
		}


		this.eventClickDesc = function(){	
			$('.table').on('click','.fa-sort-desc',function(){
				var champ = $(this).parent().find('label').html();
				var order = "desc";
				$(this).removeClass('fa-sort-desc').addClass('fa-sort-asc');
				var data={page:this.currentPage,champ:champ,order:order};
				callAjax(data);
			});
		}

		this.eventClickAsc = function(){
			$('.table').on('click','.fa-sort-asc',function(){
				champ = $(this).parent().find('label').html();
				order = "asc";
				$(this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
				var data={page:this.currentPage,nbMaxParPage:this.nbMaxParPage,champ:champ,order:order};
				callAjax(data);
			});
		}
		this.eventClickSearch = function(){
			$('.search-btn').on('click',function(){
				var search = $('.search-input').val();
				var data={search:search};
				callAjax(data);
			});
		}

		this.eventClickSort = function(){	  
			$('.table').on('click','.fa-sort',function(){
				$('.fa-sort-asc').removeClass('fa-sort-asc').addClass('fa-sort');
				$('.fa-sort-desc').removeClass('fa-sort-desc').addClass('fa-sort');
				$(this).removeClass('fa-sort').addClass('fa-sort-asc');
			});
		}

		this.eventChangeNbrMax = function(){	  
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
				var data={page:1,nbMaxParPage:this.nbMaxParPage,champ:champ,order:order};
				callAjax(data);
			});

		}

	}
