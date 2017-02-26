$(document).ready(function(){
	
var container=$('#product_images');
var index=container.find(':input').length;


function addImage(container)
{
var template=container.attr('data-prototype')
.replace(/__name__label__/g,'image n°'+(index+1))
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


$('#add_image').click(function(e){
	addImage(container);
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