(function ($) {
    $(function () {
        var addCount = function (event) {
            event.preventDefault();
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $(this).parent().parent().find("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {

                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }
                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        }

        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).parent().parent().parent().find('.multiple-form-group.example'); // .form-group
            var $formGroupClone = $formGroup.clone();

            $formGroupClone.show();
            $formGroupClone.removeClass("example");
            $formGroupClone.appendTo($(this).parent().parent().parent().find('.items'));

            $('.multiple-form-group:not(.example) .select-ts').selectize({
                create: true,
                sortField: 'text'
            });
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            if($(this).parent().parent().parent().find('.multiple-form-group').size() > 2) {
                var $lastFormGroupLast = $(this).parent().parent().parent().find('.multiple-form-group:not(.example):last');

                $lastFormGroupLast.remove();
            }
        };

        var selectFormGroup = function (event) {
            event.preventDefault();

            var $selectGroup = $(this).closest('.input-group-select');
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();

            $selectGroup.find('.concept').text(concept);
            $selectGroup.find('.input-group-select-val').val(param);

        }

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        var setActive = function (event) {
            event.preventDefault();
            $(this).addClass("active");
        }

        var resetActive = function (event) {
            event.preventDefault();
            $(".btn-ts-modal").removeClass("active");
        }

        var setActiveValue = function (event) {
            event.preventDefault();
            var activeBut = $(this).find('h6').text();
            $(".active").parent().parent().find("input").val(activeBut);
            $('.close').click();
        }

        function FormValidate(t) {
            //event.preventDefault();

            if ( $("input[name=name]").val()
                && $("input[name=city]").val()
                && $("input[name=phone]").val() ) {
                return true;
            } else {
                if ( !$("input[name=name]").val() ) {
                    $("input[name=name]").parent().addClass("has-error");
                } else {
                    $("input[name=name]").parent().removeClass("has-error");
                }

                if ( !$("input[name=index]").val() ) {
                    $("input[name=index]").parent().addClass("has-error");
                } else {
                    $("input[name=index]").parent().removeClass("has-error");
                }

                if ( !$("input[name=street]").val() ) {
                    $("input[name=street]").parent().addClass("has-error");
                } else {
                    $("input[name=street]").parent().removeClass("has-error");
                }

                if ( !$("input[name=house]").val() ) {
                    $("input[name=house]").parent().addClass("has-error");
                } else {
                    $("input[name=house]").parent().removeClass("has-error");
                }

                if ( !$("input[name=time-from]").val() ) {
                    $("input[name=time-from]").parent().addClass("has-error");
                } else {
                    $("input[name=time-from]").parent().removeClass("has-error");
                }

                if ( !$("input[name=time-to]").val() ) {
                    $("input[name=time-to]").parent().addClass("has-error");
                } else {
                    $("input[name=time-to]").parent().removeClass("has-error");
                }

                if ( !$("input[name=director-name]").val() ) {
                    $("input[name=director-name]").parent().addClass("has-error");
                } else {
                    $("input[name=director-name]").parent().removeClass("has-error");
                }

                if ( !$("input[name=director-email]").val() ) {
                    $("input[name=director-email]").parent().addClass("has-error");
                } else {
                    $("input[name=director-email]").parent().removeClass("has-error");
                }

                if ( !$("input[name=director-phone]").val() ) {
                    $("input[name=director-phone]").parent().addClass("has-error");
                } else {
                    $("input[name=director-phone]").parent().removeClass("has-error");
                }

                if ( !$("input[name=doc-name]").val() ) {
                    $("input[name=doc-name]").parent().addClass("has-error");
                } else {
                    $("input[name=doc-name]").parent().removeClass("has-error");
                }

                if ( !$("input[name=doc-email]").val() ) {
                    $("input[name=doc-email]").parent().addClass("has-error");
                } else {
                    $("input[name=doc-email]").parent().removeClass("has-error");
                }

                if ( !$("input[name=doc-phone]").val() ) {
                    $("input[name=doc-phone]").parent().addClass("has-error");
                } else {
                    $("input[name=doc-phone]").parent().removeClass("has-error");
                }

                if ( !$("input[name=firm]").val() ) {
                    $("input[name=firm]").parent().addClass("has-error");
                } else {
                    $("input[name=firm]").parent().removeClass("has-error");
                }

                if ( !$("input[name=email]").val() ) {
                    $("input[name=email]").parent().addClass("has-error");
                } else {
                    $("input[name=email]").parent().removeClass("has-error");
                }

                if ( !$("input[name=phone]").val() ) {
                    $("input[name=phone]").parent().addClass("has-error");
                } else {
                    $("input[name=phone]").parent().removeClass("has-error");
                }

                if ( !$("input[name=city]").val() ) {
                    $("input[name=city]").parent().addClass("has-error");
                } else {
                    $("input[name=city]").parent().removeClass("has-error");
                }
                return false;
            }
        }

        $(document).on('click', '.btn-number', addCount);
        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);
        $(document).on('click', '.btn-ts-modal', setActive);
        $(document).on('click', '.close', resetActive);
        $(document).on('click', '.btn-ts-select', setActiveValue);


        var options = {
            clearForm: true,
            success: showResponse
        };

        $('.wash-form').submit(function() {
            if(FormValidate($(this))){
                $(".wash-form").ajaxSubmit(options);
            }
            return false;
        });

        function showResponse(){
            $("body .container").html('<div class="alert alert-info text-center" role="alert">Спасибо, Ваша заявка успешно отправлена!<br /> Наш специалист свяжется с Вами в ближайшее время!</div>');
        }

    });
})(jQuery);
