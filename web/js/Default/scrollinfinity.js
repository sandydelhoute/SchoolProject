
function InfiniteScroll(route,selector,render,offset){
  var _this=this;
  var objAjax=new CallAjax();
  this.param={offsetmin:0,offsetmax:offset};
  this.render=render;
  this.route=route;
  this.offset=offset;
  var ajaxready=true;

  var render=function(data){
    return _this.render(data);
 }
 
 this.init=function(){
  render(objAjax.callAjax(Routing.generate(_this.route,_this.param)));
  scroll();
}

var scroll=function(){
  $(window).scroll(function() {
    if ( ajaxready == false) 
      return;			
    if($(window).scrollTop() > ($(document).height()-$(window).height()-200)){
     ajaxready=false;
     console.log("je suis dans le id du scroll");
     _this.param.offsetmin = _this.param.offsetmin + _this.offset;
     _this.param.offsetmax = _this.param.offsetmax + _this.offset + 1 ;
     ajaxready=render(objAjax.callAjax(Routing.generate(_this.route,_this.param)));
     ;

   }
 });
}
		//$('#content #loader').fadeIn(400);
		//$('#content #loader').fadeOut(400);			

         // $('#content #loader').before(data);
         //  $('#content .hidden').fadeIn(400);
         /// || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()
       }