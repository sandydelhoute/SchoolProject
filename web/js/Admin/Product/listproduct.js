$(document).ready(function(){
var routeOrder="";
var routeSearch="";
var spinner="<div class='fa  fa-refresh fa-spin fa-5x'></div>";
var filter={'champs':'firstname',"order":'asc'};
var tableControl= new TableControl(routeOrder,routeSearch,filter);
tableControl.eventclick();
tableControl.render=function(){
result='';
	var beginLiner="<tr><td>";
	var endLiner="</tr></td>";
	var beginTd="<td>";
	var endTd="</td>";
	var actionDelete="<ul><li><a href=''><i class='fa fa-trash-o' aria-hidden='true'></i>delete</a></li>";
	var actionEdit="<li><a href=''><i class='fa fa-pencil' aria-hidden='true'></i>edit</a></li></ul>";
	$.each(data,function(index,obj)
			{
			result+=beginLiner;
			result+=obj.firstname;
			result+=endTd;
			result+=beginTd;
			result+=obj.name;
			result+=endTd;
			result+=beginTd;
			result+=obj.username;
			result+=endTd;
			result+=beginTd;
			result+=obj.roles;
			result+=beginTd;
			result+=actionDelete+actionEdit;
			result+=endTd;
			result+=endLiner;
			});
			$('.listresponse').append(result);
}
tableControl.beforeSend=function(){
	$('.listresponse').append(spinner);
}
});