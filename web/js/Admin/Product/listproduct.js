$(document).ready(function(){
var routeFilter="admin_utilisateurs_filter";
var defaultOrder={"orderSelect":'firstname',"order":'asc'};
var selector = document.getElementById('listresponse');
var render=function(data){
  stopAjax = false ; 
  var html=function(users){
    var liner = document.createElement('tr');
    var columnName = document.createElement('td');
        columnName.appendChild(document.createTextNode(users.name));
        var columnUsersName = document.createElement('td');
      columnUsersName.appendChild(document.createTextNode(users.firstname));
      var columnEmail = document.createElement('td');
      columnEmail.appendChild(document.createTextNode(users.email));
      var columnRole = document.createElement('td');
      columnRole.appendChild(document.createTextNode(users.status.name));
      var columnAction=document.createElement('td');
      var listeAction = document.createElement('ul');
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
        if($.parseJSON(data.data).length>0){
              $.each($.parseJSON(data.data), function(key,obj){
               html(obj);
                
                });
              
              // selector.removeChild(document.getElementById("loading"));
                
            }
            else
            {
                selector.removeChild(document.getElementById("loading"));
                stopAjax = true;
                selector.appendChild(document.createTextNode("Aucun stock présent sur ce points relais"));

            }
        });
    return stopAjax;
  }

var tableControl= new TableControl(routeFilter,defaultOrder,render,selector);
tableControl.init();

});