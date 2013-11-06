$(function() {
	$( "#datepicker" ).datepicker(
	{
		altField: "#alternate",
		altFormat: "yy-mm-dd" ,
		onSelect: function()
		{
			var refresh="日期 : " + getday();
			$( ".CurrDate" ).text( refresh );
		}
	});
});

function getday()
{
	var dat = $( "#datepicker" ).datepicker('getDate' );
	var year = dat.getFullYear() + "-";
	var month = ( dat.getMonth() + 1) + "-";
	var day = dat.getDate();
	return year + month + day;
}

jQuery(document).ready(function(){
	var refresh="日期 : " + getday();
	$( ".CurrDate" ).text( refresh );
});
