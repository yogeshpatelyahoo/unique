$(document).ready(function(){
    $('.date-picker').datepicker({
        autoclose: true,
        startDate: "today",
        endDate: '+12m',
        format:"mm-dd-yyyy",
    });

    $('#scheduling_time').timepicker({
        showMeridian:true,
        minuteStep: 1,
        showInputs: true,
        disableFocus: true,
        defaultTime: currentTime
    });

    if ($('#professionCategory').val() != '' && typeof ( $('#professionCategory').val() ) !='undefined' ) {
        var profCatId = $('#professionCategory').val();
        //console.log($('#professionCategory').val());
        getProfessionList(profCatId);
    }

    $('form#sendNewsletterForm').submit(function(){
        //$('#newsSubmitButton').prop('disabled', true);
        //$('#newsBackButton').prop('disabled', true);
    });

    $('#scheduleButton').on('click', function() {
        $('#scheduleDiv').show();
        $('#sendScheduleButtonDiv').hide();
        $('#ScheduleButtonDiv').show();
        //alert('check');
    });
});

    
function getProfessionList(catID) {
    $('#professionList').show();
    var professionId = $('#professionSelected').val();        
    if (catID != '') {
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'data': {'categoryId': catID},
            'url': ajaxUrl,
            success: function (response) {
            	$("#profession").html('');
            	if(response.length > 0){
                    //$("#profession").attr("multiple", "multiple");
            		for(var i=0;i<response.length;i++){
            			var obj = response[i];
            			for(var key in obj){
            				$("#profession").append('<option value="'+key+'">'+obj[key]+'</option>');
            			}
            		}
            	} else {
            		$("#profession").append('<option value="">No Profession</option>');
            	}            	
            }
        });
    } else {
    	$("#profession").html('');
		var option = new Option('Select Profession', '');
		$('#profession').append($(option));
    }
}

$('#subscriber_list').on('change', function() {
	$('#professionList').hide();
	if(this.value=='register_user') {
        $("#professionCategory").attr("required", "required");
        $('#professionCategoryEdit').attr("required", "required");
		$('#professionCategoryList').show();
	} else {
        $("#professionCategory").attr("required", false);
        $('#professionCategoryEdit').attr("required", false);
		$('#professionCategoryList').hide();
    }
});