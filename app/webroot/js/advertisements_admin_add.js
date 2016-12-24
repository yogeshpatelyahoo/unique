 $(document).ready(function(){
        Ladda.bind('.ladda-button', {
            timeout: 2000
        });
        // Bind progress buttons and simulate loading progress
        Ladda.bind('.progress-demo button', {
            callback: function (instance) {
                var progress = 0;
                var interval = setInterval(function () {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);
                    if (progress === 1) {
                        instance.stop();
                        clearInterval(interval);
                    }
                }, 200);
            }
        });
        
    if ($('#professionCategory').val() != '') {
        var profCatId = $('#professionCategory').val();
        getProfessionList(profCatId);
    }
    });
    
    
function getProfessionList(catID) {
	
    var professionId = $('#professionSelected').val();
    if (catID != '') {
        $.ajax({
            'type': 'post',
            'data': {'categoryId': catID, 'professionId' : professionId},
            'url': ajaxUrl,
            success: function (response) {
                $('#professionLabel').show();
                $('#professionDiv').html(response);
                if (professionIdSelected != '') {
                    $('#profession').val(professionIdSelected);
                }
                professionIdSelected = '';
            }
        });
    } else {
        $('#professionLabel').hide();
    }
}
