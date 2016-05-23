$(document).ready(function() {
    $(document).on('click', '.btn-addCompanyAdvancedDetail', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addCompanyAdvancedDetail", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addCompanyListAuto', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addCompanyListAuto", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addCompanyDriver', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addCompanyDriver", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addWashAdvancedDetail', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addWashAdvancedDetail", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addServiceWorkRate', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addServiceWorkRate", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addServiceServeOrganisation', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addServiceServeOrganisation", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addTiresAdvancedDetail', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addTiresAdvancedDetail", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $(document).on('click', '.btn-addWashService', function(){
        var $this = $(this);

        $.ajax({url: "/requestDetails/addWashService", type: "GET", dataType: "JSON"})
            .done(function(response) {
                if (response.result) {
                    $($this).closest(".items").find(".advancedDetailBlock").append(response.html);
                }
            });
    });

    $("#btn-addCompanyListAuto-FromFile").change(function(){
        var file = this.files;
        var requestId = $(this).data("id");

        var url = '/requestDetails/addCompanyListAutoFromExcelFile';

        loadFile(file, requestId, url, function(){
            location.reload();
        });
    });

    $("#btn-addCompanyDriver-FromFile").change(function(){
        var file = this.files;
        var requestId = $(this).data("id");

        var url = '/requestDetails/addCompanyDriverFromExcelFile';

        loadFile(file, requestId, url, function(){
            location.reload();
        });
    });

    function loadFile(file, requestId, url, callback) {
        var xhr = new XMLHttpRequest();

        if (xhr.upload && xhr.upload.addEventListener) {

            xhr.onreadystatechange = function(e) {
                if (xhr.readyState == 4) {
                    callback();
                }
            };

            var fd = new FormData();
            fd.append('files', file[0]);
            fd.append('requestId', requestId);

            xhr.open("POST", url, true);

            xhr.setRequestHeader('Cache-Control', 'no-cache');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-File-Name', encodeURIComponent(file.name));

            xhr.send(fd);
        }
    }
});
