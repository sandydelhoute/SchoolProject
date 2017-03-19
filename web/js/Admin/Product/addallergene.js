$(document).ready(function(){
	
var container=$('#product_allergenes');
var index=container.find(':input').length;


function addAllergene(container)
{
var template=container.attr('data-prototype')
.replace(/__name__label__/g,'allergene n°'+(index+1))
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
index --;
return false;
});
}


$('#add_allergene').click(function(e){
	addAllergene(container);
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