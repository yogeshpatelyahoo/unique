function resetForm() {
        $("select option:selected").attr('selected', false);
        $("select option:first").attr('selected', true);
    }
   $(document).ready(function(){
    	$( "#filterBusinessOwners" ).submit(function( event ) {
        	category_val = $('#category').val();
        	prof_val 	= $('#profession').val();
        	country_val = $('#country').val();
        	state_val 	= $('#state').val();
        	city_val 	= $('#city').val();
        	meeting_val = $('#meeting_time').val();        	        	
    		if (category_val == "" && prof_val =="" && country_val=="" && state_val=="" && meeting_val=="" && city_val == "") {
    			$( "#errorMsg" ).show();
    			setTimeout( "$('#errorMsg').hide();",5000 );
	    		return false;
    		}
    		return;    		
    		event.preventDefault();
    	});  
        
    });
   function exportBusinessOwners(){
	   	flterparmas = 'category='+category_val+'&profession='+profession_val+'&country='+country_val+'&state='+state_val+'&meeting_time='+meeting_val;    	
		$("#search_params").val($('form.sidebar-search').serialize());
		$("#filter_params").val(flterparmas);
   }   
   $(document).ready(function(){
	   $('body').on('change', '#perpage', function(){
		   
		   $.ajax({async:true, 
			   data:$('#searching,#perpage,#category,#profession,#meeting_time,#state,#country,#country_id').serializeArray(),
			   dataType:"html",
			   success:function (data, textStatus) {
				   $(".panel-body").html(data);
				   },
				type:"post",
				url:filterUrl
				});
           });		   
	   
       var professionUrl = $('#professionUrl').val();
       category_val = $('#category').val();
       //alert(category_val);
       prof_val = $('#profession').val();
       //alert(prof_val);
       ajaxChange(professionUrl, category_val);
   });
   function ajaxChange(professionUrl,categoryId) {        
       //alert(professionId);
       var divUpdate = 'professionDiv';
       if (categoryId!= '') {
           $.ajax({
               'type': 'post',
               'data': {'categoryId': categoryId,'professionId' : professionId},
               'url': professionUrl,
               success: function (msg) {
                   //console.log(msg);
                   $('#' + divUpdate).html(msg);
               }
           });
       }
       if (categoryId == '') {
           $('#professionDiv').html("<select id='profession' class='form-control' name='data[businessOwner][profession_id]'><option value=''>Select Profession</option></select>");
       }
   }