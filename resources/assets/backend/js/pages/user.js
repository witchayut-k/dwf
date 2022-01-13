var User = function () {

    var moduleUrl = appUrl + '/admin/users';
    var userId;

    var initDatatable = function () {
        datatable = $('#table-user').DataTable({
            bSort: false,
            ajax: {
                url: moduleUrl,
                data: function (d) {
                    return $.extend(d, searchData);
                },
                method: 'GET'
            },

            columns: [
                {
                    data: 'DT_RowIndex', sClass: 'text-center'
                },
                { data: 'name' },
                {
                    data: 'created_at',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'roles',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return data.length ? data[0].name : '';
                    }
                },
                {
                    data: 'enabled', sClass: 'text-center',
                    render: function (data, type, row) {
                        const checked = data ? 'checked' : '';
                        return `<label class="switch"><input type="checkbox" name="status" data-module-url="${moduleUrl}" data-id="${row.id}" ${checked} /></label>`;
                    }
                },
                {
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var actions = App.renderTableActions(moduleUrl, row.id, row.name);
                        return actions;
                    }
                },
            ],
            columnDefs: [].concat($.fn.dataTable.defaults.columnDefs),
        }).on('draw', function () {
            app_plugins.switch_button();
            $('.tooltips').tooltip();

            if (datatable.data().count() === 1) {
                $('#table-user').find('.btn-delete').attr('disabled', true);
                $('#table-user').find('.btn-delete').prop('disabled', true);
            }
        });

    };

    /**
     * Form Section
     */

    var initAvatarImage = function () {
        dropzone = true;
        var featuredImage = $(".featured");

        featuredImage.dropzone({
            url: `${moduleUrl}/upload-avatar`,
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5048,
            dictRemoveFile: 'Remove',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            previewTemplate: '<div id="template-preview"></div>',
            maxfilesexceeded: function (file) {
                this.removeAllFiles();
                this.addFile(file);
            },
            headers: {
                'X-CSRF-TOKEN': token
            },
            init: function () {
                featuredDropzone = this;

                this.on("thumbnail", function (file, dataURL) {
                    if (file.accepted) {
                        featuredImage.css('background-image', 'url(' + dataURL + ')');
                        featuredImage.addClass('preview');

                        var size = file.size / 1024;
                        featuredImage.siblings('.image-info').text(`${file.name} (${size.toNumber(2)} kb)`).show()
                    }
                });
                this.on('error', function (file, resp) {
                    console.log(resp);
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("id", userId);
                });
                this.on("queuecomplete", function (file) {
                    featuredDropzone.files = [];
                    App.showSuccess(httpResponse);
                    var $inputs = $(form).find("input, select, button, textarea");
                    $inputs.prop("disabled", false);
                    Loading.hide();

                    var method = $('[name="_method"]').val();

                    if (method == 'post') {
                        setTimeout(() => {
                            window.location.href = moduleUrl;
                        }, 300);
                    }
                });
            }
        });
    };

    var handleSubmit = function () {
        $('#form-user').on('submit', function (e) {
            e.preventDefault();
            if (e.isTrigger) return false; // prevent submit twice

            form = this;

            if ($(form).valid()) {

                var checkboxes = $(this).find("input[type=checkbox]");
                $.each(checkboxes, function (key, val) {
                    $('<input />').attr('type', 'hidden').attr('name', $(val).attr('name')).attr('value', $(this).is(':checked')).appendTo($(form));
                });

                var $inputs = $(form).find("input, select, button, textarea");
                var formData = $(form).serializeArray();
                $inputs.prop("disabled", true);
                Loading.show();

                var method = $('[name="_method"]').val();

                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: formData,
                    success: function (resp) {
                        httpResponse = resp;
                        userId = resp.data.id;
                        if (featuredDropzone && featuredDropzone.files.length) {
                            featuredDropzone.processQueue();
                        } else {
                            App.showSuccess(resp);
                            $inputs.prop("disabled", false);
                            Loading.hide();

                            if (method == 'post') {
                                setTimeout(() => {
                                    window.location.href = moduleUrl;
                                }, 300);
                            }

                        }
                    },
                    error: function (jqXhr) {
                        var errors = jqXhr.responseJSON;
                        App.showFormErrors(errors, $(form));
                        App.resetSubmitButton($(form));
                        $inputs.prop("disabled", false);
                        Loading.hide();
                    }
                });
            }
        });
    };


    return {
        init: function () {
            if ($('#table-user').length) {
                initDatatable();
            }

            if ($('#form-user').length) {
                initAvatarImage();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    User.init();
});
