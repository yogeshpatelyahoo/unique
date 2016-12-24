$(document).ready(function() {       
        $(".deletesubscriber").on("click", function() {
            var action = $(this).attr('data-action');
            disableFor=$(this).attr('data-id');
            $("form").attr('action', action);
        });
        $('.closeModel').click(function(){
          $("#"+disableFor).tooltip('disable');
        });
        $('.deletesubscriber').hover(function(){
            $('.deletesubscriber').tooltip('enable');
        });
        $('#deleteConfirmation').on('hide.bs.modal', function (e) {
           $("#"+disableFor).tooltip('disable');  
        });

        $('.cursor').click(function(){
    		affiliateId = $(this).attr('affiliate-val');
    		$.ajax({
    			url: affiliateDetailUrl,
    	        context: document.body,
    	        method: "POST",
    	        data: { affiliateId: affiliateId},
    	        success: function(data){
    	            $("#popup").html(data);
    	        },
    	    });
    	});

        $('.cursor').hover(function(){
            $('.cursor').tooltip('enable');
        });
        	
    });