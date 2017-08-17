$(document).ready(function(){
  var routeFilter="admin_produit_filter";
  var defaultOrder={ page: 1 , maxPage : 10 ,orderSelect: "Name", order: "asc"};
  var selector = document.getElementById('listresponse');
  var render=function(data){
    var html=function(product){

      var liner = document.createElement('tr');
      var columnName = document.createElement('td');
      columnName.appendChild(document.createTextNode(product.name));
      var columnImage = document.createElement('td');
      var imageContainer = document.createElement('img');
      imageContainer.className = 'img-responsive';
      imageContainer.width = 100;
      var countImage = 0;
      product.images.map(function(image){

        if(countImage == 0)
        {
          imageContainer.src = image.path;
          imageContainer.alt = image.alt;
        }
        countImage++ ;
      })
      columnImage.appendChild(imageContainer);
      var columnAllergene = document.createElement('td');
      var containerUlAllergene = document.createElement('ul');
      containerUlAllergene.className ='list-unstyled';
      product.allergenes.map(function(allergene){
        var containerLiAllergene=document.createElement('li');
        containerLiAllergene.appendChild(document.createTextNode(allergene.name));
        containerUlAllergene.appendChild(containerLiAllergene);

      })
      columnAllergene.appendChild(containerUlAllergene);
      var columnDescription = document.createElement('td');
      columnDescription.appendChild(document.createTextNode(product.description));
      var columnPrix= document.createElement('td');
      columnPrix.appendChild(document.createTextNode(product.prix));
      var columnAction=document.createElement('td');
      var listeAction = document.createElement('ul');
      listeAction.className ='list-unstyled';
      var actionDelete = document.createElement('li');
      var actionDeleteHref = document.createElement('a');
      actionDeleteHref.href = Routing.generate('admin_produits_delete',{product: product.id});
      var actionDeleteIcon = document.createElement('i');
      actionDeleteIcon.className='fa fa-trash-o' ;
      var actionEdit = document.createElement('li');
      var actionEditHref = document.createElement('a');
      actionEditHref.href = Routing.generate('admin_produits_edit',{product: product.id});
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
      liner.appendChild(columnImage);
      liner.appendChild(columnAllergene);
      liner.appendChild(columnDescription);
      liner.appendChild(columnPrix);
      liner.appendChild(columnAction);
      selector.appendChild(liner);
    }
    data.done(function(data){
      if($.parseJSON(data.data).length>0){
        while (selector.hasChildNodes()) {   
          selector.removeChild(selector.firstChild);
        }
        $.each($.parseJSON(data.data), function(key,obj){
         html(obj);

       });
      }
    });
  }

  var tableControl= new TableControl(routeFilter,defaultOrder,render,selector);
  tableControl.init();

});