/**
 * ajaxChange() to fetch State /City list on country selection
 * @param url
 * @param location_id: country id
 * @param location_type: type of list to be fetched 1: state list, 2:city list
 */

function getStateList(countryId) {
    var ajaxUrl = "<?php echo Router::url(array('controller'=>'users','action'=>'get-state-city'));?>";    
    if (countryId!= '') {
        $.ajax({
            'type': 'post',
            'data': {'countryId': countryId},
            'url': ajaxUrl,
            success: function (msg) {
                $('#stateDiv').html(msg);
            }
        });
    }
    if (countryId == '') {
        $('#stateDiv').html("<select id='state' class='form-control' name='data[BusinessOwner][state_id]'><option value=''>Select State</option></select>");
    }
}
function clearZip()
{
	if($('#state').val() == ''){
		$('#zipCode').val('');
		$('.zone').css('display','none');
		$('#zipCode').css("border", '1px solid #d5d5d5');
		$(".errorMember").remove();
		$('#zipCode').attr('disabled',true);
	} else {
		$('#zipCode').removeAttr('disabled');
	}
}
function clearBizZip()
{
	if($('#biz_state').val() == ''){
		$('#biz_zipcode').val('');
		$('#biz_zipcode').css("border", '1px solid #d5d5d5');
		$(".errorMember2").remove();
		$('#biz_zipcode').attr('disabled',true);
	} else {
		$('#biz_zipcode').removeAttr('disabled');
	}
}
$(function(){
	$("#profession_name").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: BASE_URL+PAGE+"/profession-check",
                dataType: "json",
                'type' : 'post',
                data: {category : $("#categoryId").val(),profession : request.term},
                success: function( data ) {
                    if(!data.length){
                    	$('.addprofession').html('');
                    	var addprofession = '<a href="'+BASE_URL+'admin/professions/addProfession"><button class="btn btn-bricky go-back pull-right" type="button">Add Profession</button></a>';
                    	$('.addprofession').html(addprofession);
                      var result = [
                       {
                       label: 'No matches found', 
                       value: response.term
                       }
                     ];
                       response(result);
                     } else {
                     	/*var uid = $('#pid').val();
                     	var pid = $('#profession_id').val();
                     	$('.addprofession').html('');
                    	var addprofession = '<a href="'+BASE_URL+'admin/professions/updateProfession/'+uid+'/'+pid+'"><button class="btn btn-bricky go-back pull-right" type="button">Update Profession</button></a>';
                    	$('.addprofession').html(addprofession);*/
                        response( $.map( data, function( item ) {
                            return {
                                label: item.label,
                                value: item.label,
                                link:item.value
                            }
                        }));
                    }
                         
                    }
            });
        },
        minLength: 1,
        change: function (event, ui){
            if (!ui.item) {
            	$('.addprofession').html('');
            	var addprofession = '<a href="'+BASE_URL+'admin/professions/addProfession"><button class="btn btn-bricky go-back pull-right" type="button">Add Profession</button></a>';
            	$('.addprofession').html(addprofession);
            	$('#profession_id').val('');
                this.value = '';
            } /*else {
                 $('#profession_id').val(ui.item.link);
            }*/
        },
    	select:function(event, ui){
    		if(ui.item.link != undefined){
    			$('#profession_id').val(ui.item.link);
	         	var uid = $('#pid').val();
	         	var pid = $('#profession_id').val();
	         	$('.addprofession').html('');
	        	var addprofession = '<a href="'+BASE_URL+'admin/professions/updateProfession/'+uid+'/'+pid+'"><button class="btn btn-bricky go-back pull-right" type="button">Update Profession</button></a>';
	        	$('.addprofession').html(addprofession);
    		}         	
    	}
  });

    $("#country").autocomplete({
            //source: "countrylist",
            //minLength: 2,
            source: function( request, response ) {
                $.ajax({
                    url: BASE_URL+PAGE+"/get-country-list",
                    dataType: "json",
                    'type' : 'post',
                    data: {country: request.term},
                    success: function( data ) {
                    	$('#state').val('');
                    	clearZip();
                        if(!data.length){
                          var result = [
                           {
                           label: 'No matches found', 
                           value: response.term
                           }
                         ];
                           response(result);
                         } else {
                            response( $.map( data, function( item ) {
                                if($('#country_id').next('.error').length>0) {
                                    $('#country_id').next().hide();
                                }
                                return {
                                    label: item.label,
                                    value: item.label,
                                    link:item.value
                                }
                            }));
                        }
                             
                        }
                });
            },
            minLength: 1,
            change: function (event, ui){
            if (!ui.item) {
            	$('#miles_filter, #zip_code').val('');
            	$('#miles_filter, #zip_code').attr('disabled', true);
                this.value = '';
                $('#country_id').val('');
                 $('#state').val('');
                 $('#state_id').val('');
            } else {
                 $('#country_id').val(ui.item.link);
                 if(adminFilters == 'true') {
             		$('#miles_filter, #zip_code').attr('disabled', false);
             	}
                  $('#state').val('');
                  $('#state_id').val('');
            }
        } 

  });
    
    $("#biz_country").autocomplete({
        //source: "countrylist",
        //minLength: 2,
        source: function( request, response ) {
            $.ajax({
                url: BASE_URL+PAGE+"/get-country-list",
                dataType: "json",
                'type' : 'post',
                data: {country: request.term},
                success: function( data ) {
                	$('#biz_state').val('');
                	clearBizZip();
                    if(!data.length){
                      var result = [
                       {
                       label: 'No matches found', 
                       value: response.term
                       }
                     ];
                       response(result);
                     } else {
                        response( $.map( data, function( item ) {
                            if($('#biz_country_id').next('.error').length>0) {
                                $('#biz_country_id').next().hide();
                            }
                            return {
                                label: item.label,
                                value: item.label,
                                link:item.value
                            }
                        }));
                    }
                         
                    }
            });
        },
        minLength: 1,
        change: function (event, ui){
        if (!ui.item) {
            this.value = '';
            $('#biz_country_id').val('');
             $('#biz_state').val('');
             $('#biz_state_id').val('');
        } else {
             $('#biz_country_id').val(ui.item.link);
              $('#biz_state').val('');
              $('#biz_state_id').val('');
        }
    } 

});
    
$("#biz_state").autocomplete({
    
    source: function( request, response ) {
        $.ajax({
            url: BASE_URL+PAGE+"/get-state-list",
            dataType: "json",
            'type' : 'post',
            data:   {
                        country : $("#biz_country").val(),
                        state : request.term
                    },
            success: function( data ) {
                if(!data.length){
                	clearBizZip();
                    if($("#biz_country_id").val()!=''){
                         var result = [
                   {
                   label: 'No matches found ', 
                   value: response.term,
                   }
                 ];
                    } else {
                  var result = [
                   {
                   label: 'Select Country ', 
                   value: response.term
                   }
                 ];}
                   response(result);
                 } else {
                    response( $.map( data, function( item ) {
                        if($('#biz_state_id').next('.error').length>0) {
                            $('#biz_state_id').next().hide();
                        }
                        return {
                            label: item.label,
                            value: item.label,
                            link: item.value
                        }
                    }));
                }
                     
                }
        });
    },
    minLength: 1,
    change: function (event, ui){
    if (!ui.item) {
        this.value = '';
        $('#biz_state_id').val('');
    } else {
         $('#biz_state_id').val(ui.item.link);
    }
} 
});

    $("#state").autocomplete({
        
            source: function( request, response ) {
                $.ajax({
                    url: BASE_URL+PAGE+"/get-state-list",
                    dataType: "json",
                    'type' : 'post',
                    data:   {
                                country : $("#country").val(),
                                state : request.term
                            },
                    success: function( data ) {
                        if(!data.length){
                        	clearZip();
                            if($("#country_id").val()!=''){
                                 var result = [
                           {
                           label: 'No matches found ', 
                           value: response.term,
                           }
                         ];
                            } else {
                          var result = [
                           {
                           label: 'Select Country ', 
                           value: response.term
                           }
                         ];}
                           response(result);
                         } else {
                            response( $.map( data, function( item ) {
                                if($('#state_id').next('.error').length>0) {
                                    $('#state_id').next().hide();
                                }
                                return {
                                    label: item.label,
                                    value: item.label,
                                    link: item.value
                                }
                            }));
                        }
                             
                        }
                });
            },
            minLength: 1,
            change: function (event, ui){
            if (!ui.item) {
                this.value = '';
                $('#state_id').val('');
            } else {
                 $('#state_id').val(ui.item.link);
            }
        } 
  });

var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	  clearTimeout (timer);
	  timer = setTimeout(callback, ms);
	 };
	})();
	$('#zipCode').keyup(function() {
		if($('#zipCode').val() != '' && $('#zipCode').val().length > 2){
			$('#zipCode').addClass('loadinggif');
			delay(function(){
		    var country = $('#country').val();
		    var state = $('#state').val();
		    var zip = $('#zipCode').val();
		    $.ajax({
	            'type': 'post',
	            //'dataType': 'json',
	            'data': {'country': country , 'state': state , 'zip': zip},
	            url: BASE_URL+PAGE+"/check-zip-get-timezone",
	            success: function (data, textStatus) {
	            	var jsonData = JSON.parse(data);
	            	if(jsonData.code == 200){
	            		$('#zipCode').removeClass('loadinggif');
	            		$('.zone').css('display','block');
	            		$('#zipCode').css("border", '1px solid #d5d5d5');
	            		$(".errorMember").remove();
	          			$(".custom").remove();
	          			if($('#addTimeZone').length > 0){
	          				$('#GroupFirstMeetingDate').val(''); 
	          				$('#addTimeZone').html(jsonData.response);
	          			}
	            		
	            	} else {
	            		$('#zipCode').removeClass('loadinggif');
	            		$('.zone').css('display','none');
	            		$('#zipCode').css("border", "1px solid #c83a2a");
	            		$(".errorMember").remove();
	          			$(".custom").remove();
	          			$( ' <div class="clearfix custom"></div><label class="errorMember" style="color:#c83a2a;">'+jsonData.response+'</label>' ).insertAfter( "#zipCode" );
	            	}           	
	            }
	        });
		  }, 500 );
		} else {
    		$(".errorMember").remove();
  			$(".custom").remove();
		}  
	});
	$('#biz_zipcode').keyup(function() {
		if($('#biz_zipcode').val() != '' && $('#biz_zipcode').val().length > 2){
			delay(function(){
		    var country = $('#biz_country').val();
		    var state = $('#biz_state').val();
		    var zip = $('#biz_zipcode').val();
		    $.ajax({
	            'type': 'post',
	            //'dataType': 'json',
	            'data': {'country': country , 'state': state , 'zip': zip},
	            url: BASE_URL+PAGE+"/check-zip-get-timezone",
	            success: function (data, textStatus) {
	            	var jsonData = JSON.parse(data);
	            	if(jsonData.code == 200){
	            		$('#biz_zipcode').css("border", '1px solid #d5d5d5');
	            		$(".errorMember2").remove();
	          			$(".custom2").remove();
	            		$('#addTimeZone').html(jsonData.response);
	            	} else {
	            		$('#biz_zipcode').css("border", "1px solid #c83a2a");
	            		$(".errorMember2").remove();
	          			$(".custom2").remove();
	          			$( ' <div class="clearfix custom2"></div><label class="errorMember2" style="color:#c83a2a;">'+jsonData.response+'</label>' ).insertAfter( "#biz_zipcode" );
	            	}           	
	            }
	        });
		  }, 500 );
		} else {
    		$(".errorMember2").remove();
  			$(".custom2").remove();
		}  
	});
});