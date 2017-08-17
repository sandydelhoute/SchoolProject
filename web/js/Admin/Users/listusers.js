$(document).ready(function(){
	var selector = document.getElementById('listresponse');
	var routeOrder='admin_utilisateurs_filter';
	var defaultOrder={ page: 1 , maxPage : 10 ,orderSelect: "First name", order: "asc"};
	var routeSearch='admin_utilisateurs_filter';
	var render=function(data){


		while (selector.hasChildNodes()) {   
		    selector.removeChild(selector.firstChild);
		}

		stopAjax = false ; 
		var html=function(users){
			var liner = document.createElement('tr');
			var columnName = document.createElement('td');
			columnName.appendChild(document.createTextNode(users.firstname));
			var columnUsersName = document.createElement('td');
			columnUsersName.appendChild(document.createTextNode(users.name));
			var columnEmail = document.createElement('td');
			columnEmail.appendChild(document.createTextNode(users.email));
			var columnRole = document.createElement('td');
			columnRole.appendChild(document.createTextNode(users.status.name));
			var columnAction=document.createElement('td');
			var listeAction = document.createElement('ul');
			listeAction.className = 'list-unstyled';
			var actionDelete = document.createElement('li');
			var actionDeleteHref = document.createElement('a');
			actionDeleteHref.href = Routing.generate('admin_utilisateurs_delete',{email: users.email});
			var actionDeleteIcon = document.createElement('i');
			actionDeleteIcon.className='fa fa-trash-o' ;
			var actionEdit = document.createElement('li');
			var actionEditHref = document.createElement('a');
			actionEditHref.href = Routing.generate('admin_utilisateurs_edit',{email: users.email});
			var actionEditIcon = document.createElement('i');
			actionEditIcon.className = 'fa fa-pencil';

			actionEditHref.appendChild(actionEditIcon);
			actionDeleteHref.appendChild(actionDeleteIcon);
			actionDelete.appendChild(actionDeleteHref);
			actionEdit.appendChild(actionEditHref);
			listeAction.appendChild(actionEdit);
			listeAction.appendChild(actionDelete);
			columnAction.appendChild(listeAction);
			liner.appendChild(columnName);
			liner.appendChild(columnUsersName);
			liner.appendChild(columnEmail);
			liner.appendChild(columnRole);
			liner.appendChild(columnAction);
			selector.appendChild(liner);
		}
		
		data.done(function(data){
			$.each($.parseJSON(data.data), function(key,users){
				html(users);
			});
		})


	}
	var tableControl = new TableControl(routeOrder,defaultOrder,render,selector);
	tableControl.init();

	$('.pagination a').on('click',function(e){
		e.preventdefault();

	})
});
