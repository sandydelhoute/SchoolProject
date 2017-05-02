
function CallAjax(selector=null)
{
	var _this=this;
	this.selector=selector;
	this.spinner="<div class='fa  fa-refresh fa-spin fa-5x'></div>";

 	this.callAjax=function(route){
  	return $.ajax({
	    type:"GET",
	    url: route,
	    before:function(){
	    	_this.selector.html(this.spinner);
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
