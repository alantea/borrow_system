$(function() {
	$( "#datepicker" ).datepicker(
	{
		altField: "#CurrDate",
		altFormat: "yy-mm-dd" ,
		onSelect: function()
		{
			var refresh="日期 : " + getday();
			$( "#CurrDate" ).text( refresh );
			updateTimeTable( getday() );
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

function updateTimeTable(DateString)
{
	$('#loadingIMG').show();
	var request = $.ajax({
		url: "getdaylist.php",
		type: "GET",
		data: { date : DateString },
		dataType: "html"
	});
	request.done(function(msg) {
		$("#TimeTableDiv").html( msg );
		$('#loadingIMG').hide();
	});
}

jQuery(document).ready(function(){
	var refresh="日期 : " + getday();
	$( "#CurrDate" ).text( refresh );
	updateTimeTable(getday());
});
