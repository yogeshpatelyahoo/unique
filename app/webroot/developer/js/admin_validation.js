/**
 * this file contains the validations for admin panel
 */

$(document).ready(function (e) {
    $("#discountedMember").keydown(function (event) {
        if (event.keyCode == 32) {
            event.preventDefault();
        }
    });
    $("#discountedMember").keyup(function (event) {
        str = $(this).val();
        str = str.replace(/-/g, '');
        $(this).val(str);
    });
    $("#membershipPrice").keydown(function (event) {
        if (event.keyCode == 32) {
            event.preventDefault();
        }
    });
    $("#membershipPrice").keyup(function (event) {
        str = $(this).val();
        str = str.replace(/-/g, '');
        $(this).val(str);
    });
    $("#discountedPrice").keydown(function (event) {
        if (event.keyCode == 32) {
            event.preventDefault();
        }
    });
    $("#discountedPrice").keyup(function (event) {
        str = $(this).val();
        str = str.replace(/-/g, '');
        $(this).val(str);
    });

    if ($('#discountedMember').length > 0) {
        $('#discountedPrice').attr('disabled', true);
        if ($('#discountedMember').val().length > 0 && $('#discountedMember').val()!=0)
            $('#discountedPrice').attr('disabled', false);
        else
            $('#discountedPrice').attr('disabled', true);
        $('#discountedMember').keyup(function () {
            if ($(this).val().length > 0 && $(this).val() < 21 && $(this).val() > 0)
            {
                $('#discountedPrice').attr('disabled', false);
            }
            else
            {
                $('#discountedPrice').val('');
                $('#discountedPrice').removeClass('error');
                $('#discountedPrice').next().hide();
                $('#discountedPrice').attr('disabled', true);
            }

        });
    }
    
    var isValid = false;
    jQuery.validator.addMethod("complete_url", function(val, elem) {
        // if no url, don't do anything
        if (val.length == 0) { return true; }

        // if user has not entered http:// https:// or ftp:// assume they mean http://
        
        if(!/^(https?|ftp):\/\//i.test(val)) {
            val = 'http://'+val; // set both the value
            
            $(elem).val(val); // also update the form element
        }
        // now check if valid url
        // http://docs.jquery.com/Plugins/Validation/Methods/url
        // contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
        return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
    });
    /* Jquery Add Extra Method Validation Starts*/


    /* Jquery Add Extra Method Validation Ends*/

    /** admin login page js **/
    $('#password').keydown(function (event) {
        if (event.keyCode == '32') {
            event.preventDefault();
        }
    });

    /** admin login validation */
    $("#UserLoginForm").validate({
        onfocusout: false,
        rules: {
            'data[User][user_email]': {
                required: true,
                email: true,
            },
            'data[User][password]': {
                required: true,
            }
        },
        messages: {
            'data[User][user_email]': {
                required: "This field is required",
                email: "Please enter valid e-mail",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    /** admin forgot Password form validation js */
    $("#UserForgotPasswordForm").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            'data[User][email]': {
                required: true,
                email: true,
            },
        },
        messages: {
            'data[User][user_email]': {
                required: "This field is required",
                email: "Please enter valid e-mail",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    /** admin reset password form validation js */
    $('#UserPassword').keydown(function (event) {
        if (event.keyCode == '32') {
            event.preventDefault();
        }
    });
    $('#UserCpassword').keydown(function (event) {
        if (event.keyCode == '32') {
            event.preventDefault();
        }
    });

    $("#UserResetPasswordForm").validate({
        rules: {
            'data[User][password]': {
                required: true,
                minlength: 6,
                maxlength: 15,
            },
            'data[User][cpassword]': {
                required: true,
                equalTo: "#UserPassword"
            },
        },
        messages: {
            'data[User][password]': {
                required: "This field is required",
                minlength: "<?php echo __('Minimum 6 and Maximum 15 characters are allowed'); ?>",
                maxlength: "<?php echo __('Minimum 6 and Maximum 15 characters are allowed'); ?>",
            },
            'data[User][cpassword]': {
                required: "This field is required",
                equalTo: "Passwords entered in new password and confirm Password field does not match"
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    /*plan module validation*/
    $.validator.addMethod("lessThan", function (value, max, min) {
        return parseFloat(value) < parseFloat($(min).val());
    }, "Discounted price should be less than membership fee"
            );
    $.validator.addMethod('isPositive', function (value, element) {
        if (value >>> 0 === parseFloat(value) || value == '') {
            isValid = true;
        }
        else {
            isValid = false;
        }
        return isValid; // return bool here if valid or not.
    }, 'Please enter number');

    $.validator.addMethod("decimalCheck", function (value, element) {
        return this.optional(element) || /^\d{0,5}(\.\d{0,2})?$/i.test(value);
    }, "You must include two decimal places");


    /** profession module js **/
    $.validator.addMethod("customname", function (value, element) {
        var i = /^[A-Za-z \- . ]+$/;
        return this.optional(element) || (i.test(value) > 0);
    }, "Profession name can contain period, space and hyphen only including alphabets");




    /** profession category module js **/
    $("#addProfessionCategoryForm").validate({
        rules: {
            'data[ProfessionCategory][name]': {
                required: true,
                minlength: 3,
                maxlength: 35,
                remote: {
                    url: BASE_URL+"admin/categories/checkCategoryExist",
                    type: "post"
                }
            }

        },
        messages: {
            'data[ProfessionCategory][name]': {
                required: "This field is required",
                minlength: "Minimum of 3 and maximum of 35 characters allowed for Category name",
                maxlength: "Minimum of 3 and maximum of 35 characters allowed for Category name",
                remote: "Category name already exist"
            }

        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    //edit profession category validation
    $("#editProfessionCategoryForm").validate({
        rules: {
            'data[ProfessionCategory][name]': {
                required: true,
                minlength: 3,
                maxlength: 35,
                remote: {
                    url: BASE_URL+"admin/categories/checkCategoryExist/"+$('#categoryEditId').val(),
                    type: "post"
                }
            }
        },
        messages: {
            'data[ProfessionCategory][name]': {
                required: "This field is required",
                minlength: "Minimum of 3 and maximum of 35 characters allowed for Category name",
                maxlength: "Minimum of 3 and maximum of 35 characters allowed for Category name",
                remote: "Category name already exist"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    /** Add Group validation*/
    $.validator.addMethod("conditionCheck", function (value, element) {
        var i = /^[A-Za-z0-9 .-]+$/;
        return this.optional(element) || (i.test(value) > 0);
    }, "Only Alphanumeric Characters,Space,Period and Hyphen are allowed");
    $.validator.addMethod("alphaNumericSpaceDash", function (value, element) {
        var i = /^[A-Za-z0-9 -]+$/;
        return this.optional(element) || (i.test(value) > 0);
    }, "Only Alphanumeric Characters,Space,and Hyphen are allowed");


    
    /** webcasts validations*/
      
    /** youtube link validation method*/
    $.validator.addMethod("youtubeLink", function (value, element) {
        var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
        return this.optional(element) || (p.test(value) > 0);
    }, "Please enter a valid YouTube link");

    
    /** Add advertisement validations */
    
    $.validator.addMethod("uploadImage", function (val, element) {
        if(element.files[0] && element.files[0].size > 2000000) {
            return false;
        } else {
            return true;
        }
      }, "Image size should be less than or equals to 2 MB");
    
    $.validator.addMethod("targetUrl", function (value, element) {
        var i = /(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
        return (i.test(value) > 0);
    }, "Please enter valid URL (Like- http://www.example.com)");
    
    
 // add change password validation for admin
    $('#userChangePasswordForm').validate({
        rules: {
        	'data[User][current_password]': {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[User][new_password]': {
            	required: true,
                nowhitespace: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[User][cpassword]': {
                required: true,
                equalTo: "#newPassword"
            },         
        },
        messages: {
        	'data[User][current_password]':{
            	required: 'This field is required',
            	minlength: "Password should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "Password should be minimum 6 characters and maximum 20 characters.",
            },
            'data[User][new_password]':{
            	required: 'This field is required',
            	nowhitespace: "Space is not allowed in password.",
            	minlength: "Password should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "Password should be minimum 6 characters and maximum 20 characters.",
            },
            'data[User][cpassword]':{
            	required: "This field is required",
                equalTo: "Password does not match"
            }, 
        },        
        submitHandler: function (form) {
     		form.submit();
     	}
    });
    
 // Users form validations
    $('#addUsersForm').validate({
        rules: {
        	'data[User][fname]': {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[User][lname]': {
            	required: true,
                nowhitespace: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[User][user_email]': {
                required: true,
                email: true
            }, 
            'data[User][phone]' :{
            	required: true,
            },
            'data[User][username]' :{
            	required: true,
            },
            'data[User][password]' :{
            	required: true,
            }
        },
        messages: {
        	'data[User][fname]':{
            	required: 'This field is required',
            	minlength: "First Name should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "First Name should be minimum 6 characters and maximum 20 characters.",
            },
            'data[User][lname]':{
            	required: 'This field is required',
            	nowhitespace: "Space is not allowed in password.",
            	minlength: "Last Name should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "Last Name should be minimum 6 characters and maximum 20 characters.",
            },
            'data[User][user_email]':{
            	required: "This field is required",
            	email: "Enter valid email"
            }, 
            'data[User][phone]' :{
            	required: 'This field is required',
            },
            'data[User][username]' :{
            	required: 'This field is required',
            },
            'data[User][password]' :{
            	required: 'This field is required',
            }
        },        
        submitHandler: function (form) {
     		form.submit();
     	}
    });
    
    $('#addCandidateForm, #editCandidate').validate({
        rules: {
        	'data[Candidate][fname]': {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[Candidate][lname]': {
            	required: true,
                nowhitespace: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[Candidate][email_id]': {
                required: true,
                email: true
            }, 
            'data[Candidate][phone]' :{
            	required: true,
            },
            'data[Candidate][comment]' :{
            	required:true
            },
            'data[Candidate][category_id]' :{
            	required: true,
            },
            'data[Candidate][resume_file]' :{
            	required: true,
            }
        },
        messages: {
        	'data[Candidate][fname]':{
            	required: 'This field is required',
            	minlength: "First Name should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "First Name should be minimum 6 characters and maximum 20 characters.",
            },
            'data[Candidate][lname]':{
            	required: 'This field is required',
            	nowhitespace: "Space is not allowed in password.",
            	minlength: "Last Name should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "Last Name should be minimum 6 characters and maximum 20 characters.",
            },
            'data[Candidate][email_id]':{
            	required: "This field is required",
            	email: "Enter valid email"
            }, 
            'data[Candidate][phone]' :{
            	required: 'This field is required',
            },
            'data[Candidate][category_id]' :{
            	required: 'This field is required',
            },
            'data[Candidate][comment]' :{
            	required: 'This field is required',
            },
            'data[Candidate][resume_file]' :{
            	required: 'This field is required',
            }
        },        
        submitHandler: function (form) {
     		form.submit();
     	}
    });
    
    $('#addCompanyForm, #editCompany').validate({
        rules: {
        	'data[Company][name]': {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
            'data[Company][email_id]': {
                required: true,
                email: true
            }, 
            'data[Company][phone]' :{
            	required: true,
            },
            'data[Company][about]' :{
            	required:true
            },
            'data[Company][category_id]' :{
            	required: true,
            },
            'data[Company][technologies]' :{
            	required: true,
            }
        },
        messages: {
        	'data[Company][name]':{
            	required: 'This field is required',
            	minlength: "First Name should be minimum 6 characters and maximum 20 characters.",
	        	maxlength: "First Name should be minimum 6 characters and maximum 20 characters.",
            },
            'data[Candidate][email_id]':{
            	required: "This field is required",
            	email: "Enter valid email"
            }, 
            'data[Candidate][phone]' :{
            	required: 'This field is required',
            },
            'data[Candidate][category_id]' :{
            	required: 'This field is required',
            },
            'data[Candidate][about]' :{
            	required: 'This field is required',
            },
            'data[Candidate][resume_file]' :{
            	required: 'This field is required',
            }
        },        
        submitHandler: function (form) {
     		form.submit();
     	}
    });
    
    
    
});
/**
     * ajaxChange() to fetch State /City list on country selection
     * @param url
     * @param countryId: country id
     * @added by Laxmi Saini
     */
    function ajaxChange(url,countryId){
        url=$('#ajaxUrl').val();
        var divUpdate = 'stateDiv';
         if(countryId != ''){
            $.ajax({
             'type':'post',
             'data':{'countryId':countryId},
             'url':url,
             success:function(msg){                 
                 $('#'+divUpdate).html(msg);
             }
         });
        }
        if(countryId == ''){
            $('#stateDiv').html("<select id='state' class='form-control' name='data[groups][state_id]'><option value=''>Select State</option></select>");
        }        
    }
