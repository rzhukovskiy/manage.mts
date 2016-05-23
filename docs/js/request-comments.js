$(document).ready(function() {
    $("#request-comment-add-confirm").click(function(){
        var data = {
            requestId: $("#request-id").val(),
            text: $("#comment-text").val()
        };

        $.ajax({url: "/requestComments/addComment", type: "POST", data: data, dataType: "JSON"})
            .done(function(response) {
                if (!response.result) {
                    $("#flash-errors").html(response.comment);
                } else {
                    $("#request-cooments").prepend(response.html);
                }

                $('#requestCommentNew').modal('hide');
            });
    });
});
