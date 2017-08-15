function TableControl(routeFilter,defaultOrder,render,selector = null ){

	this.defaultOrder=defaultOrder;
	this.routeFilter=routeFilter;
	this.render=render;
	this.selector=selector;
	this.nbMaxParPage=10;
	this.currentPage=1;
	var objAjax= new CallAjax();



	var callAjax=function(data){
			render(objAjax.callAjax(Routing.generate(routeFilter,data)));		
		}

		this.init = function(){
			this.render(objAjax.callAjax(Routing.generate(routeFilter,defaultOrder)));
			this.eventClickDesc();
			this.eventClickAsc();
			this.eventClickSearch();
			this.eventClickSort();
			this.eventChangeNbrMax();
		}


		this.eventClickDesc = function(){	
			$('.table').on('click','.fa-sort-desc',function(){
				var orderSelect = $(this).parent().find('label').html();
				var order = "desc";
				$(this).removeClass('fa-sort-desc').addClass('fa-sort-asc');
				var data={orderSelect:orderSelect,order:order};
				callAjax(data);
			});
		}

		this.eventClickAsc = function(){
			$('.table').on('click','.fa-sort-asc',function(){
				orderSelect = $(this).parent().find('label').html();
				order = "asc";
				$(this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
				var data={orderSelect:orderSelect,order:order};
				callAjax(data);
			});
		}
		this.eventClickSearch = function(){
			$('.search-btn').on('click',function(){
				var search = $('.search-input').val();
				var data={orderSelect:camp ,order:champ,champ:search};
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
