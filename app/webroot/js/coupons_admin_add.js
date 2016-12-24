$(document).ready(function () {
    	$('#expiry_date').datepicker({
        	startDate: "today",
        	autoclose: true,
                format:"mm-dd-yyyy",
        }).on('changeDate', function(ev){
           $('#expiry_date').valid();
          
        });
        $('#start_date').datepicker({
            autoclose: true,
            startDate: "today",
            format:"mm-dd-yyyy",
        }).on('changeDate', function(ev){
           $('#start_date').valid();
            var date2 = $(this).datepicker( "getDate" );
            $('#expiry_date').datepicker('setStartDate',date2);
            $('#expiry_date').val('');
          
        });
        $('.cpn_types').on('ifClicked', function(event){
        	if($(this).val()=='all'){
                $('#usageLimit').removeClass('ignore');
                $('#usageLimit').removeClass('error');
				$('.type_cpn').removeClass('hidden');
			}else{
                $('#usageLimit').addClass('ignore');
				$('.type_cpn').addClass('hidden');
            }
			if($(this).val()=='email'){
                $('#user_email').removeClass('ignore');
                $('#user_email_tagsinput').removeClass('error');
				$('.email_tag').removeClass('hidden');
            }else{
                $('#user_email').addClass('ignore');
                $('.email_tag').addClass('hidden');
            }
               
        	});
        $('.gen_code').click(function(e){
            $("#couponName").focus();
            e.preventDefault();
        	var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for( var i=0; i < 9; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));
			
           	$(this).closest('.form-group').find('#couponName').val(text);
        });
        $("#couponName").keypress(function (event) {
        	var regex = new RegExp("^[a-zA-Z0-9\b]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
               event.preventDefault();
               return false;
            }
        });
        $("#usageLimit").keypress(function (e) {
                 //if the letter is not digit then display error and don't type anything
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
         	return false;
          }
        })
        var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $('#user_email').tagsInput({
            defaultText:'Add email',
            width: 'auto',
            pattern: emailRegex,
            onAddTag:validateThis,
            onTagExist:alertData
        });
    });
    function validateThis(){
        $('#user_email_tagsinput').removeClass('error');
        $('#user_email').valid();
    }
    function alertData(){
        return false;
    } 