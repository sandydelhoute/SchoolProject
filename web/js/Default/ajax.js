
function CallAjax(selector=null)
{
	var _this=this;
	this.selector=selector;
	console.log(selector);
	this.spinner="<div class='fa  fa-refresh fa-spin fa-5x' id='spinner'></div>";
 	this.loading='<div id="loading" class="progress progress-striped active page-progress-bar"><div class="progress-bar" style="width: 100%;"></div></div>';
 	this.callAjax=function(route){
  	return $.ajax({
	    type:"GET",
	    url: route,
	    beforeSend:function(){
	    	console.log(_this.selector)
	    	if(_this.selector != null)
	    		_this.selector.append(_this.loading);
	    },
	    success:function(data,statut){
	    	if(_this.selector != null)
	    		$('#loading').remove();
  		},
	    error : function(erreur){
	    },
	    complete : function(data,statut)
		    {
	  		}
		});
  	}

}