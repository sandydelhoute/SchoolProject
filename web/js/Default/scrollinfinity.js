
function InfiniteScroll(route,selector,render){
  var _this=this;
  var objAjax=new CallAjax();
  this.param={offsetmin:0,offsetmax:3};
  this.ajaxready = true;
  this.render=render;
  this.route=route;

 var render=function(data){
   _this.render(data);
 }
	
this.init=function(){
  render(objAjax.callAjax(Routing.generate(_this.route,_this.param)));
	scroll();
}

var scroll=function(){
	 $(window).scroll(function() {
    console.log("scrolTop "+$(window).scrollTop());
    console.log($(window).height());
    console.log("document "+$(document).height());
    console.log("windows "+$(window).height());
    console.log("document - height "+($(document).height()-$(window).height()-200));
    if ( _this.ajaxready == false) 
    return;			
if($(window).scrollTop() > ($(document).height()-$(window).height()-200)){
    	  _this.ajaxready=false;
      console.log("je suis dans le id du scroll");
    _this.param.offsetmin = _this.param.offsetmin + _this.param.offsetmax;
    _this.param.offsetmax = _this.param.offsetmax * 2 ;
    render(objAjax.callAjax(Routing.generate(_this.route,_this.param)));
  _this.ajaxready=true;

    }
  });
}


// var render=function(data){
//   console.log('je suis dans le reder');
// 	  $('#grid').append(_this.render);
// }
		//$('#content #loader').fadeIn(400);
		//$('#content #loader').fadeOut(400);			

         // $('#content #loader').before(data);
         //  $('#content .hidden').fadeIn(400);
         /// || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()
}