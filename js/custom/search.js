$(document).ready(init);

function init(){
	$("#search").addClass('active');
}

$(function() {
	$( "#start" ).datepicker( { 
		dateFormat : "yy-mm-dd",
		onClose: function( selectedDate ) {
			$( "#end" ).datepicker( "option", "minDate", selectedDate );
		}
	});

	$( "#end" ).datepicker( {
		dateFormat : "yy-mm-dd",
		onClose: function( selectedDate ) {
			$( "#start" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	
	$( "#selectall" ).click(function(){
		$("input[name='select_loc[]']").each(function(){
			$(this).prop("checked",true);
		});
	});

	$( "#disselectall" ).click(function(){
		$("input[name='select_loc[]']").each(function(){
			$(this).prop("checked",false);
		});
	});
	
	$( "#formsubmit").click(function(event){
		event.preventDefault();
		var loc = false;
		var error_msg = "";
		if( $("#start").val() == "" || $("#end").val() == "" )
		{
			error_msg += "請輸入區間\n";
		}
		$("input[name='select_loc[]']").each(function(){
			if( $(this).prop("checked") )
			{
				loc = true;
			}
		});
		if( !loc )
		{
			error_msg += "請至少選擇一個場地";
		}
		if( error_msg != "" )
		{
			alert( error_msg );
			return false;
		}
			
		var request = $.ajax({
			url: "getsearchlist.php",
			type: "POST",
			data: $("#search_form").serialize(),
			dataType: "html"
		});
		request.done(function(msg) {
			$("#search_table").html( msg );
		    var target = "#search_table";
	        $('html, body').animate({
       	        scrollTop: $(target).offset().top - 50
     	            }, 1500);
			});
	});
});
