<script>
    jQuery(document).ready(function() {

        $("<?= $validator['selector']; ?>").each(function() {
            $(this).validate({
                errorElement: 'span',
                errorClass: 'help-block error-help-block',
                // ignore: ":hidden:not(.selectpicker)",

                errorPlacement: function(error, element) {
                    if (element.parent('.input-group').length ||
                        element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                        // else just place the validation message immediately after the input
                    } else if (element.parent('.bootstrap-select').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // add the Bootstrap error class to the control group
                },

                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])) : ?>

                    ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>

                /*
                 // Uncomment this to mark as validated non required fields
                 unhighlight: function(element) {
                 $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                 },
                 */
                success: function(element) {
                    $(element).closest('.form-group').removeClass('has-error'); // remove the Boostrap error class from the control group
                },

                focusInvalid: false, // do not focus the last invalid input
                <?php if (Config::get('jsvalidation.focus_on_error')) : ?>
                    invalidHandler: function(form, validator) {

                        console.log('validator.numberOfInvalids()', validator.numberOfInvalids());

                        if (!validator.numberOfInvalids())
                            return;

                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top
                        }, <?= Config::get('jsvalidation.duration_animate') ?>);
                        $(validator.errorList[0].element).focus();

                    },
                <?php endif; ?>
                submitHandler: function(form) {
                    console.log('dropzone', dropzone);
                    console.log('customSubmit', customSubmit);

                    var checkboxes = $(this).find("input[type=checkbox]");
                    $.each(checkboxes, function(key, val) {
                        // console.log($(val).attr('name'), $(this).is(':checked'));
                        $('<input />').attr('type', 'hidden').attr('name', $(val).attr('name')).attr('value', $(this).is(':checked')).appendTo($(form));
                    });

                    if (dropzone || customSubmit) return false;

                    //$(form).find('.error-help-block').remove();
                    // let's select and cache all the fields
                    var $inputs = $(form).find("input, select, button, textarea");

                    // remove froala credit
                    $froalaTexts = $(form).find('textarea');
                    $.each($froalaTexts, function(index, elem) {
                        var content = $(elem).val();
                        var creditPosition = content.indexOf('<p data-f-id="pbf"');
                        if (creditPosition >= 0) {
                            content = content.substr(0, creditPosition);
                            $(elem).val(content);
                        }
                    });

                    // serialize the data in the form
                    var serializedData = $(form).serializeArray();

                    // let's disable the inputs for the duration of the ajax request
                    $inputs.prop("disabled", true);

                    var submitMethod = $(form).find('[name="_method"]').val() || 'POST';
                    var submitURL = $(form).attr('action');
                    var redirectUrl = decodeURIComponent($(form).attr('redirect-url'));
                    var $modal = $('#modal-simple-create');

                    console.log('redirect to:' + redirectUrl);

                    $.ajax({
                        type: 'POST',
                        url: submitURL,
                        data: serializedData,
                        success: function(resp) {
                            console.log('ajax request successful')

                            if (Loading !== undefined)
                                Loading.hide();

                            if (submitMethod == 'PUT') {
                                App.showSuccess(resp);
                                setTimeout(function() {
                                    $inputs.prop("disabled", false);
                                    /*if (redirectUrl && redirectUrl != undefined && redirectUrl != 'undefined')
                                        window.location.href = redirectUrl;*/
                                }, 500);
                            } else {

                                App.showSuccess(resp);

                                var pathArray = location.pathname.split('/');

                                if ($modal.length) {
                                    var table = $modal.parents('body').find('.table');

                                    if ($.fn.DataTable.isDataTable(table)) {
                                        $('.dataTables_processing', table.closest('.dataTables_wrapper')).show();
                                        setTimeout(function() {
                                            table.dataTable();
                                            table.api().ajax.reload();
                                            $('.dataTables_processing', table.closest('.dataTables_wrapper')).hide();
                                            setTimeout(function() {
                                                $('.btn-dismiss').prop("disabled", false);
                                                App.hideModal('#modal-simple-create, #modal-region-create, #modal-province-create, #modal-tribe-create');
                                                setTimeout(() => {
                                                    $inputs.prop("disabled", false);
                                                }, 500);
                                            }, 300);
                                        }, 100);
                                    }

                                } else if (redirectUrl && redirectUrl != undefined && redirectUrl != 'undefined') {

                                    if (redirectUrl.indexOf('{id}') != -1)
                                        redirectUrl = redirectUrl.replace('{id}', resp.id);

                                    console.log('redirectUrl', redirectUrl);

                                    setTimeout(() => {
                                        window.location.href = (redirectUrl || pathArray[1] || '');
                                    }, 300);

                                } else {
                                    $inputs.prop("disabled", false);
                                }
                            }
                        },
                        error: function(jqXhr) {
                            console.log('ajax request error')

                            if (Loading !== undefined)
                                Loading.hide();

                            var errors = jqXhr.responseJSON;
                            if (errors['errors'] !== undefined) {
                                App.showFormErrors(errors, $(form));
                            } else if (errors['message'] !== undefined) {
                                $inputs.prop("disabled", false);
                                App.alert(errors['message']);
                                // noty({
                                //     text: errors['message'],
                                //     type: 'error',
                                //     layout: 'bottom',
                                //     animation: {
                                //         open: 'animated fadeInDown',
                                //         close: 'animated fadeOutUp',
                                //         speed: 250
                                //     }
                                // });
                            }

                            $inputs.prop("disabled", false);

                            //Labotanic.resetSubmitButton($(form).find('[type="submit"]'));
                        }
                    });

                },

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>