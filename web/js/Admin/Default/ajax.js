
function CallAjax(html)
{
	this.html=html;
	//console.log(this.html);
 	this.callAjax=function(route,selector){
 		console.log(selector);
  	$.ajax({
	    type:"GET",
	    url: route,
	    beforeSend:function(){

	    },
	    sucessSend:function(){
	    			console.log("error");
		},
	    error : function(erreur){
	    },
	    complete : function(data,statut)
		    {
		    		data.responseJSON.data.map(function(obj){
		    		console.log(obj);
		    		//selector.after(html);
		    		});
		    		
		    }
	      
	  	});
	}

}
