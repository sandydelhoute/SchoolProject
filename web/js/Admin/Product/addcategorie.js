$(document).ready(function(){
	
var container=$('#product_categories');
var index=container.find(':input').length;


function addCategorie(container)
{
var template=container.attr('data-prototype')
.replace(/__name__label__/g,'categorie n°'+(index+1))
.replace(/__name__/g,index);
var prototype=$(template);
addDeleteLink(prototype);
container.append(prototype);
index++;
}
function addDeleteLink(prototype){
var deleteLink=$('<div class="btn btn-danger">Supprimer</div>');
prototype.append(deleteLink);
deleteLink.click(function(e){
prototype.remove();
e.preventDefault();
return false;
});
}


$('#add_categorie').click(function(e){
	addCategorie(container);
	e.preventDefault();
	return false;
});

if(index=0)
	{addImage(container)}
else{
container.children('div').each(
	function()
	{
		addDeleteLink($(this));
	})
}


});