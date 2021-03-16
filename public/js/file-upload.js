$(document).ready(function() {
    $('#upload-form').submit(function(e) {
        if($('#file').val()) {

            e.preventDefault();
            $(this).ajaxSubmit({
                beforeSubmit: function() {
                    $("#progress-div").css('display','inline');
                    $("#uploading-progress-div").css('visibility','visible');
                    $("#uploading-progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){
                    $("#uploading-progress-bar").width(percentComplete + '%');
                    $("#uploading-progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>');

                    if (percentComplete === 100) {
                        $("#download-div").css('display','inline');
                    }
                },
                success:function (){
                    $("#download-div").css('display','none');
                },
                error: function() {
                },
                resetForm: true
            });
            return false;
        }
    });
});
