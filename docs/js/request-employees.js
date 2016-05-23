$(document).ready(function() {
    $("#request-employee-add").click(function(){
        var requestId = $(this).data("id");

        $.ajax({url: "/requestEmployees/addEmployee", type: "GET", data: {requestId: requestId}, dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    location.reload();
                }
            });
    });

    $("body").on("click", ".request-employee-remove", function(){
        var $this = $(this);
        var employeeId = $(this).data("employee-id");

        $.ajax({url: "/requestEmployees/removeEmployee", type: "POST", data: {employeeId: employeeId}, dataType: "JSON"})
            .done(function(response) {
                if (!response.result) {
                    $("#flash-errors").html(response.comment);
                } else {
                    $($this).closest(".request-employee-block").hide();
                }
            });
    });
});
