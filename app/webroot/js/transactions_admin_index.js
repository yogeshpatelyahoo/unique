    var disableFor='';	
    $(document).ready(function() {
    	$('#end').datepicker({
        	autoclose: true,
            format:"mm-dd-yyyy",
        }).on('changeDate', function(ev){
		if($('#start').val() != '' && $('#end').val() != '') {
		var start = new Date($('#start').val().replace(/-/g, "/"));
		var end = new Date($('#end').val().replace(/-/g, "/"));
		if (start.getTime() > end.getTime()) {
			//alert("The first date is after the second date!");
			$("#start").datepicker( "option", "maxDate", null );
			$("#start").datepicker( "option", "minDate", null );
			$("#start").val('');
			} 
		}
            var date = $(this).datepicker( "getDate" );
            $('#start').datepicker('setEndDate',date);          
        });

		$('#start').datepicker({
            autoclose: true,
            format:"mm-dd-yyyy",
        }).on('changeDate', function(ev){        
		if($('#end').val() != '') {
		var start = new Date($('#start').val().replace(/-/g, "/"));
		var end = new Date($('#end').val().replace(/-/g, "/"));
		if (start.getTime() > end.getTime()) {
			$("#end").datepicker( "option", "maxDate", null );
			$("#end").datepicker( "option", "minDate", null );
			$("#end").val('');
			} 
		}
			var date2 = $(this).datepicker( "getDate" );
            $('#end').datepicker('setStartDate',date2);          
        });
});