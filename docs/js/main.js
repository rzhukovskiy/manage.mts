$(document).ready(function() {
    $(".request-index-next").click(function() {
        var requestId = $(this).data("id");
        $("#nextWork-requestId").val(requestId);

        $("#requestWork").modal();
    });

    $(".request-index-next-confirm").click(function() {
        var requestId = $("#nextWork-requestId").val();
        var employeeGroupId = $("#nextWork-employee-group").val();
        var comment = $("#nextWork-comment").val();

        var data = {
            id: requestId,
            employeeGroupId: employeeGroupId,
            comment: comment
        };

        $.ajax({url: "/request/nextWork", type: "GET", dataType: "JSON", data: data})
            .done(function(response) {
                if (response.result) {
                    location.reload();
                }
            });
    });

    var today = new Date();
    var yesterday = today.setDate(today.getDate() - 1);
    $('#date-from').datetimepicker({
        locale: 'ru',
        format: 'YYYY-MM-DD',
        defaultDate: yesterday,
        icons: {
            previous: 'fa fa-angle-double-left',
            next: 'fa fa-angle-double-right'
        }
    });

    $(".request-index-finish").click(function(){
        var requestId = $(this).data("id");

        var data = {
            id: requestId
        };

        $.ajax({url: "/request/finishWork", type: "GET", dataType: "JSON", data: data})
            .done(function(response) {
                if (response.result) {
                    location.href = document.referrer;
                }
            });
    });

    $(".request-index-refuse").click(function(){
        var requestId = $(this).data("id");

        var data = {
            id: requestId
        };

        $.ajax({url: "/request/refuseWork", type: "GET", dataType: "JSON", data: data})
            .done(function(response) {
                if (response.result) {
                    location.href = document.referrer;
                }
            });
    });




    $(document).on('click', '.btn-number', function(){
        var fieldName = $(this).attr('data-field');
        var type      = $(this).attr('data-type');
        var input = $(this).parent().parent().find("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
            } else if(type == 'plus') {
                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
            }
        } else {
            input.val(0);
        }
    });
    $(document).on('click', '.btn-ts-modal', function(event){
        event.preventDefault();
        $(this).addClass("activeTypeSelect");
    });

    $(document).on('click', '.btn-removeAdvancedDetail', function(event){
        event.preventDefault();

        $(this).closest(".form-group").remove();
    });

    $(document).on('click', '.btn-ts-select', function(event) {
        event.preventDefault();

        var inputType = $(".activeTypeSelect").closest('.input-group').find("input");
        var selectedType = $(this).find('h6').text();
        $(inputType).val(selectedType);

        $('.close').click();
    });

    $("#agreement_file").change(function(){
        var file = this.files;
        var requestId = $(this).data("id");

        var url = '/request/saveAgreement';

        var xhr = new XMLHttpRequest();

        if (xhr.upload && xhr.upload.addEventListener) {

            xhr.onreadystatechange = function (e) {
                if (xhr.readyState == 4) {
                    $("#request-agreement-file-block").html('<a href="/request/getAgreement?id=' + requestId + '">' + file[0].name + '</a>');
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
    });

    $("body").on("click", "#request-agreement-file-link", function(){
        var requestId = $(this).data("request-id");
        var filename = $(this).text();

        $.ajax({url: "/request/getAgreement?id=" + requestId, type: "POST"})
            .done(function(response) {
                if (response.result  === false) {
                    $("#flash-errors").html('<span class="alert alert-danger">' + response.comment + '</span>');
                } else {
                    var blob = new Blob([response]);
                    saveAs(blob, filename);
                }
            });
    });



    $(".request-index-delete").click(function(){
        var requestId = $(this).data("id");
        if (confirm("Вы уверены, что хотете удалить заявку?")) {
            $.ajax({url: "/admin/deleteFromArchive?id=" + requestId, type: "POST"})
                .done(function(response) {
                    if (!response.result) {
                        $("#flash-errors").html(response.comment);
                    } else {
                        document.location.href = document.referrer;
                    }
                });
        }
    });

    $("body").on("click", ".request-employee-mail", function(){
        var currentTable = $(this).closest(".table");

        $("#request-employee-mail-name").val($(currentTable).find(".employee-name").text());
         $("#request-employee-mail-email").val($(currentTable).find(".employee-email").text());

        $("#request-employee-mail-modal").modal();
    });

    $(".request-employee-mail-confirm").click(function() {
        var data = {
            name: $("#request-employee-mail-name").val(),
            email: $("#request-employee-mail-email").val(),
            subject: $("#request-employee-mail-subject").val(),
            text: $("#request-employee-mail-text").val()
        };

        $.ajax({url: "/request/sendMail", data: data, type: "POST"})
            .done(function(response) {
                $("#request-employee-mail-modal").modal("hide");
            });
    });

    setTimeout(CheckContactTime, 10000);
});

var PageTitleNotification = {
    Vars:{
        OriginalTitle: document.title,
        Interval: null
    },
    On: function(notification, intervalSpeed){
        var _this = this;
        _this.Vars.Interval = setInterval(function(){
            document.title = (_this.Vars.OriginalTitle == document.title)
                ? notification
                : _this.Vars.OriginalTitle;
        }, (intervalSpeed) ? intervalSpeed : 1000);
    },
    Off: function(){
        clearInterval(this.Vars.Interval);
        document.title = this.Vars.OriginalTitle;
    }
}

function CheckContactTime() {
    $.ajax({url: "/request/checkContactTime"})
        .done(function(response) {
            if(response.request) {
                $.noty.closeAll();
                PageTitleNotification.Off();

                var request = response.request;
                var employee = response.employee;
                noty({
                    text: '<h4 style="text-align: center">Запланированный звонок в <br/>' + request.name +
                    '!</h4><strong>Город:</strong> ' + request.address_city +
                    '<div style="color: #069;margin: 10px 0 5px 0; font-weight: bold;">Дата следующей связи:</div>' +
                    '<form id="request">' +
                    '<input class="form-control datetime" type="text" value="' + request.next_communication_date + '" name="Request[next_communication_date]" id="next_communication_date" />' +
                    '<div style="color: #069;margin: 10px 0 5px 0; font-weight: bold;">Статус клиента:</div>' +
                    '<textarea class="form-control input-large" name="Request[status]" id="status" style="width: 100%; height: 200px">' + request.status + '</textarea>' +
                    '</form>' +
                    '<div style="color: #069;margin: 10px 0 5px 0; font-weight: bold;">Сотрудник:</div> ' +
                    '<div style="background: #fff; color: #000; padding: 5px;"><strong>Имя:</strong> ' + employee.name +
                    '<br/><strong>Должность:</strong> ' + employee.position +
                    '<br/><strong>Email:</strong> ' + employee.email +
                    '<br/><strong>Тел.:</strong> ' + employee.phone + '</div>',
                    layout: 'center',
                    type: 'warning',
                    textAlign: 'left',
                    buttons: [
                        {
                            addClass: 'btn btn-success', text: 'Сохранить', onClick: function($noty) {
                                $.ajax({url: "/request/update?id=" + request.id, type: "POST", data: $("#request").serialize()}).done(function(response) {
                                    if (location.href.search('request') >= 0) {
                                        location.reload();
                                    }
                                });
                                $noty.close();
                                PageTitleNotification.Off();
                            }
                        },
                        {
                            addClass: 'btn btn-danger', text: 'Отложить на 5 минут', onClick: function($noty) {
                                $.ajax({url: "/request/delayContact?id=" + request.id}).done(function(response) {
                                    if (location.href.search('request') >= 0) {
                                        location.reload();
                                    }
                                });
                                $noty.close();
                                PageTitleNotification.Off();
                            }
                        },
                    ]
                });

                $('.datetime').datetimepicker({'language':'ru','showClear':false,'autoclose':true,'format':'dd.mm.yyyy hh:ii','todayHighlight':true});
                PageTitleNotification.On('Срочно! Надо звонить!');
            } else {
                setTimeout(CheckContactTime, 10000);
            }
        });
}