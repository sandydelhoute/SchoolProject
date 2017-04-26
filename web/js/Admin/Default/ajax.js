
function CallAjax(selector=null)
{
	this.selector=selector;
	this.spinner="<div class='fa  fa-refresh fa-spin fa-5x'></div>";

 	this.callAjax=function(route){
  	return $.ajax({
	    type:"GET",
	    url: route,
	    before:function(){
	    	this.selector.append(this.spinner);
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
