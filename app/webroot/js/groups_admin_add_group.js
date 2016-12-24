$(document).ready(function () {
	// set datepicker
    $('.date-picker').datepicker({
        autoclose: true,
        startDate: "today",
        endDate: '+30d',
        format:"mm-dd-yyyy",
    }).on('changeDate', function(ev){
        $('.date-picker').valid();
        var date2 = $( ".date-picker" ).datepicker( "getDate" );
        var timezone = $( "#addTimeZone" ).html();
        var month = date2.getMonth() +1;
        var currentDate = date2.getFullYear()+"-"+month+"-"+date2.getDate()
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'data': {'date': currentDate,'timezone' : timezone},
            'url': 'addGroup',
            success: function (response) {
            	$("#check").html('');
            	if(response.length > 0){
            		for(var i=0;i<response.length;i++){
            			var obj = response[i];
            			for(var key in obj){
            				$("#check").append('<option value="'+key+'">'+obj[key]+'</option>');
            			}
            		}
            		date2.setDate(date2.getDate()+14);
            		$('#next').datepicker({format:"mm-dd-yyyy"});
            		$('#next').datepicker('setDate', date2);
            		var nextDate = $('#next').val();
            		$('#second_meeting_date').val(nextDate);
            	} else {
            		$("#check").append('<option value="">No time slots available</option>');
            	}            	
            }
        });
        
    });
});