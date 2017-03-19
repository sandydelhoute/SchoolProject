
function CallAjaxOrder()
{
	
  var spinner="<div class='fa  fa-refresh fa-spin fa-5x'></div>";
  this.callAjax=function(data,route,render){
  	$.ajax({
	    type:"GET",
	    data: data
	    url: route,
	    beforeSend:function(){
	      $('.listResponse').append(spinner);
	    },
	    sucessSend:function(){},
	    error : function(erreur){console.log(erreur);},
	    complete : function(data,statut)
		    {
		      data.responseJSON.data;
		      $(".fa-refresh").remove();
		      render;

		    }
	      
	  	});
	}

}
