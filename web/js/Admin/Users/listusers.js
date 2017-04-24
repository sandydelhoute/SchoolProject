$(document).ready(function(){
var champ="firstname";
var order="";
var routeOrder=Routing.generate('admin_utilisateurs_filter',{ champ: "firstname", order: "asc" });
var routeSearch=Routing.generate('admin_utilisateurs_search',{ serach: "" });

var obj={};
var html="<tr><td>";
html += obj.firstname;
html += "</td><td>";
html += obj.name;
html += "</td><td>";
html += obj.username;
html += "</td><td>";
html += obj.roles;
html += "</td><td>";
html += "<ul><li><a href=''><i class='fa fa-trash-o' aria-hidden='true'></i>delete</a></li>";
html += "<li><a href=''><i class='fa fa-pencil' aria-hidden='true'></i>edit</a></li></ul>";
html += "</td></tr>";
var tableControl = new TableControl(routeOrder,routeSearch,html);
tableControl.eventclick();
});


/*
function resultHtml(data){

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
			return result;
}	
*/

