$(document).ready(function(){
var routeOrder="";
var routeSearch="";
var filter={'champs':'firstname',"order":'asc'};
var tableControl= new TableControl(routeOrder,routeSearch,filter);
tableControl.eventclick();
});