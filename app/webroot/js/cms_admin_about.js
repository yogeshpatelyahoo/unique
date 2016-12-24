$(document).ready(function() {
        CKEDITOR.replace('page_content', {
            filebrowserUploadUrl : browserUploadUrl,
            filebrowserWindowWidth  : 800,
            filebrowserWindowHeight : 500
        });
        CKEDITOR.disableAutoInline = true;      
    });