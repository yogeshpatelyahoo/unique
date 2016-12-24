//var grp_switch = new Switchery(grp_action, { color: '#FF0000', jackColor: '#fff' ,size: 'small'});
	var grp_action = Array.prototype.slice.call(document.querySelectorAll('.group_action'));
    var adminFilters = 'true'; 
	grp_action.forEach(function(html) {
	  var switchery = new Switchery(html, { color: '#64BD63', jackColor: '#fff', secondaryColor:'#FF0000', size:'small' });
	  
	});
	
	var elem = document.querySelector('.js-switch');
	var switchery = new Switchery(elem, { color: '#709cd2', secondaryColor: '#d6de23', jackColor: '#fff', jackSecondaryColor: '#fff' });
	elem.onchange = function() {		
		if(elem.checked) {
			$('.group_type').val('global');
		} else {
			$('.group_type').val('local');
		}
		clearFilters();
		$.ajax({
			   data:{'group_type':$('#group_type').val(), 'clear_filters':'true'},
			   dataType:"html",
			   success:function (data, textStatus) {
				   $(".panel-body").html(data);
				   },
				type:"post",
				url: groupSelectionUrl
			});
		return false;		
		};
		
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
		

		$(document).ready(function(){
			$('.daysFilter').multiselect({ enableFiltering: false,includeSelectAllOption: true,nonSelectedText: 'Select Meeting Days',});
			
			var professionUrl = $('#professionUrl').val();		      
		       category_val = $('#category').val();
		       //alert(category_val);
		       prof_val = $('#profession').val();
		       //alert(prof_val);
		       ajaxChange(professionUrl, category_val);
			$('body').on('change', '.group_action', function() {
				var groupId = $(this).closest('.group_action_wrap').find('.group_id').val();
				var target = $(this);
				var action = $(this).is(':checked');
				if(action) {
					action = 'enable';
				} else {
					action = 'disable';
				}
				$.ajax({
		               'type': 'post',
		               'data': {'group_id': groupId,'action' : action},
		               'url': groupEnableDisable,
		               success: function (msg) {
			               var class_div;
			               if(msg==0) {
							class_div = "";
							target.closest('.group_box').addClass('disabled').removeClass('enabled');
				           } else {
				        	   target.closest('.group_box').addClass('enabled').removeClass('disabled');
					       }
		               }
		           });

				});
			
	    	$('#meeting_time').timepicker({
	            showMeridian:true,
	            minuteStep: 30,
	            showInputs: true,
	            disableFocus: true,
	        });
	       
	        if(reqMeetingTime != '') {	        
	        	$('#meeting_time').val(reqMeetingTime);
	        } else {	        	
	        	$('#meeting_time').val('');
	        }
		});
		
		function clearFilters()
		{
			$('#category,#profession,#meeting_time,#country,#country_id,#state,#state_id,#city,#zip_code,#miles_filter').val('');
			$('#zip_code,#miles_filter').attr('disabled',true);
			var multi = $('.daysFilter').multiselect();
			
		}
		$(document).ready(function(){
	    	$( "#filterBusinessOwners" ).submit(function( event ) {
	        	category_val = $('#category').val();
	        	prof_val 	= $('#profession').val();
	        	country_val = $('#country').val();
	        	state_val 	= $('#state').val();
	        	city_val 	= $('#city').val();
	        	meeting_val = $('#meeting_time').val();        	        	
	    		if (category_val == "" && prof_val =="" && country_val=="" && state_val=="" && meeting_val=="" && city_val=="") {
	    			$( "#errorMsg" ).html('Please select some criteria to apply the filter').show();
	    			setTimeout( "$('#errorMsg').hide();",5000 );
		    		return false;
	    		}
	    		if((category_val !="" && prof_val=="") || (category_val =="" && prof_val!="")) {
	    			$( "#errorMsg" ).html('Please select Profession').show();
	    			$('#profession').addClass('error');
	    			setTimeout( "$('#errorMsg').hide();$('#profession').removeClass('error');",5000 );
		    		return false;
	    		}
	    		return;    		
	    		event.preventDefault();
	    	});  
	        
	    });