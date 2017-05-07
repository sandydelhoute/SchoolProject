
function CallAjax(selector=null)
{
	var _this=this;
	this.selector=selector;
	this.spinner="<div class='fa  fa-refresh fa-spin fa-5x'></div>";
	console.log(selector);
 	this.callAjax=function(route){
  	return $.ajax({
	    type:"GET",
	    url: route,
	    before:function(){
	    	_this.selector.html(this.spinner).delai(1000);
	    },
	    sucess:function(data,statut){

  					},
	    error : function(erreur){
	    },
	    complete : function(data,statut)
		    {
	  		}
		});
  	}

}
