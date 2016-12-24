function validate(id)
   {
        var data=$('#group'+id).val();
        if(data != '') {
            $('#group'+id).removeClass('error');
        } else {

            $('#group'+id).addClass('error');
        }
   }
   $("#BusinessOwnerAdminMoveGroupMembersForm").submit(function() {
    var selectEls = document.querySelectorAll('select'),
    numSelects = selectEls.length;
    $('select').removeClass("error");//added this to clear formatting when fixed after alert
    var anyInvalid = false;
    for(var x=0;x<numSelects;x++) {
        if (selectEls[x].value === '') {
            $(selectEls[x]).addClass("error");
            anyInvalid = true;
        }}
        if (anyInvalid) {
            //alert('One or more required fields does not have a choice selected... please check your form');
            return false;
        }
   });