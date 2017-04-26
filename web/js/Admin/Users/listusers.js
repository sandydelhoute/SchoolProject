$(document).ready(function(){
	var selector=$(".table tr");
	var routeOrder='admin_utilisateurs_filter';
	var defaultOrder={ champ: "firstname", order: "asc" };
	var routeSearch='admin_utilisateurs_search';
	var render=function(data){

		data.done(function(data){
			$.each($.parseJSON(data.data), function(key,obj){
				var html="<tr><td>";
				html += obj.firstname;
				html += "</td><td>";
				html += obj.name;
				html += "</td><td>";
				html += obj.username;
				html += "</td><td>";
				html += obj.roles;
				html += "</td><td>";
				html += "<ul><li><a href='"+Routing.generate('admin_utilisateurs_delete',{ email: obj.username })+"'><i class='fa fa-trash-o' aria-hidden='true'></i>delete</a></li>";
				html += "<li><a href='"+Routing.generate('admin_utilisateurs_edit',{ email: obj.username })+"'><i class='fa fa-pencil' aria-hidden='true'></i>edit</a></li></ul>";
				html += "</td></tr>";
				selector.after(html);
			});
			$('.pagination').html('');
			for(var i=1;i<=data.nbPage;i++)
			{
				$('.pagination').append("<li><a href='"+Routing.generate(routeOrder,{page:i,nbMaxParPage:data.nbMaxParPage,champ:data.champ,order:data.order})+"'>"+i+"</a></li>");
			}
		})


	}
	var tableControl = new TableControl(routeOrder,routeSearch,defaultOrder,selector,render);
	tableControl.init();

	$('.pagination a').on('click',function(e){
		e.preventdefault();

	})
});
