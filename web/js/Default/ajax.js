
function CallAjax(selector=null)
{
	this.selector=selector;
	var div=document.createElement('div');
	div.className="progress progress-striped active page-progress-bar";
	div.id="loading";
	var divChild=document.createElement('div');
	divChild.className='progress-bar';
	div.appendChild(divChild);
	this.loading=div;
	var _this=this;

 	this.callAjax=function(route){
  	return $.ajax({
	    type:"GET",
	    url: route,
	    xhr: function () {
        	var xhr = new window.XMLHttpRequest();
			var loading=document.getElementById("loading");
	        xhr.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
               if(_this.selector != null)
                loading.querySelector(".progress-bar").style.width =Math.round(percentComplete * 100) + "%";
            }

		}, false);
        return xhr;
    	},
	    beforeSend:function(){
	    	if(_this.selector != null)
	    	{
	    		_this.selector.appendChild(_this.loading);
	    		
	    	}
	    },
	    success:function(data,statut){
		    	if(_this.selector != null)
	    		{


	    		}
  		},
	    error : function(erreur){
	    },
	    complete : function(data,statut)
		    {

	  		}
		});
  	}

}