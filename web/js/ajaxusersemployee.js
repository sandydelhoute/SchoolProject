$(document).ready(function(){

	var filter;
	callAjaxUsersEmployee();
	$('.table').on('click','.fa-sort-desc',function(){
	   	filter=$(this).parent().find('label').html();
	   	$(this).removeClass('fa-sort-desc').addClass('fa-sort-asc');
	   	filterDesc(filter);
	});

	$('.table').on('click','.fa-sort-asc',function(){
	  	filter=$(this).parent().find('label').html();
	   	$(this).removeClass('fa-sort-asc').addClass('fa-sort-desc');
	   	filterAsc(filter);
	});

	$('.search-btn').on('click',function(){
		filter=$('.search-input').val();
		filterWord(filter);
	});
	$('.table').on('click','.fa-sort',function(){
		$('.fa-sort-asc').removeClass('fa-sort-asc').addClass('fa-sort');
		$('.fa-sort-desc').removeClass('fa-sort-desc').addClass('fa-sort');
		$(this).removeClass('fa-sort').addClass('fa-sort-asc');
	});
});
/*function pagination(nbParPage,divSelect,divPager,model)
{   
    //Initialisation
    var nbElem = $(divSelect).length;
    var nbPage = Math.ceil(nbElem / nbParPage);
    var pageLoad = 1;
     
    $(divSelect).each(function(index) {
        if (index < nbParPage)
            $(divSelect).eq(index).show();
        else
            $(divSelect).eq(index).hide();
    });
     
    //Reset & vérification
    function reset() {
        if (nbPage < 2) $(divPager).hide();
        if (pageLoad == nbPage) $(divPager + ' span.suivant').hide(); else $(divPager + ' span.suivant').show();
        if (pageLoad == 1) $(divPager + ' span.precedent').hide(); else $(divPager + ' span.precedent').show();
        $(divPager + ' ul li').removeClass('selected');
        $(divPager + ' ul li').eq(pageLoad -1).addClass('selected');
    }
     
    //Pagination génération
    if (model != 1) {
        $(divPager).html('<ul></ul>');
        for(i = 1; i <= nbPage; i++) $(divPager + ' ul').append('<li>' + i + '</li>');
     
        //Changement click page
        $(divPager + ' ul li').click(function() {
            if ($(this).index() + 1 != pageLoad) {
                pageLoad = $(this).index() + 1;
                $(divSelect).hide();
                 
                $(divSelect).each(function(i) {
                    if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
                });
                 
                reset();
            }
        });
    }
     
    //Suivant Précédent
    if (model == 1) {
        $(divPager).prepend('<span class="precedent">Precedent</span>');
        $(divPager).append('<span class="suivant">Suivant></span>');
    } else if (model == 3) {
        $(divPager + ' ul').before('<span class="precedent">Precedent</span>');
        $(divPager + ' ul').after('<span class="suivant">Suivant</span>');
    }
     
    //Evènement click sur suivant
    $(divPager + ' span.suivant').click(function() {
        if (pageLoad < nbPage) {
            pageLoad += 1;
            $(divSelect).hide();
             
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
             
            reset();
        }
    });
     
    //Evènement click sur précédent
    $(divPager + ' span.precedent').click(function() {
        if (pageLoad -1 >= 1) {
            pageLoad -= 1;
            $(divSelect).hide();
             
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
             
            reset();
        }
    });
     
    reset();
}
*/
function callAjaxUsersEmployee()
{

	var spinner="<div class='fa  fa-refresh fa-spin fa-5x'></div>";
	$.ajax({
		type:"POST",
		url:'http://admin.mealandbox.fr/app_dev.php/users2/1',
		beforeSend:function() {
			$('.listResponse').append(spinner);
		},
		sucessSend:function() {},
		error : function(erreur){console.log(erreur);},
		complete : function(data,statut)
		{
			list=data.responseJSON.data;
			$(".fa-refresh").remove();
			resultHtml(data.responseJSON.data);
		
		}
			
	});
}
function filterDesc(filter){
	console.log(filter);
/* result.sort();*/
}
function filterAsc(filter){
		console.log(filter);

}
filterWord=function filterWord(word){
var listfilter=new Array();
var regex='\\b(.*)'+word+'(.*)\\b';
//resultFilter=list.match(new RegExp(regex,'i'));
//resultHtml(resultFilter);
$.each(list,function(index,obj){
listfilter=obj.firstname.match(new RegExp(regex,'i'))
});
console.log(list);
}



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
			$('.listresponse').append(result);
}	

/*
	<i class="fa fa-sort-desc" aria-hidden="true"></i>
<i class="fa fa-sort-asc" aria-hidden="true"></i>
<i class="fa fa-sort" aria-hidden="true"></i>*/
