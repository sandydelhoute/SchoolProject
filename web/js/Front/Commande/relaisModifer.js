$(document).ready(function(){
	var routeModifyRelais='selectrelais';
	var objAjax=new CallAjax();
	$(document).on('click','#updateRelais',function(){
		var selectValue = $('#selectRelais .form-control option:selected').attr('data-id');
		console.log(selectValue)
		var data = objAjax.callAjax( Routing.generate(routeModifyRelais,{id:selectValue}));
		data.done(function(data){
			if(data.response)
			{
				$('#header #relais').text(data.relaisName);
				$('#selectRelais .alert-success').removeClass("hide");
				setTimeout(function(){
					$('#selectRelais .alert-success').addClass("hide");
				},3000);
			}
			else
			{
				$('#selectRelais .alert-danger').removeClass("hide");
				setTimeout(function(){
					$('#selectRelais .alert-danger').addClass("hide");
				},3000);

			}
		})

	});


});