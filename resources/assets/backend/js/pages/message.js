var Message = function () {

    var moduleUrl = appUrl + '/admin/messages';
    var messageId;

    var initDatatable = function () {
        datatable = $('#table-message').DataTable({
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
                { data: 'subject' },
                {
                    data: 'created_at',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                { data: 'sender_name', sClass: 'text-center' },
                { data: 'sender_email', sClass: 'text-center' },
                {
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var baseUrl = moduleUrl + '/' + data;
                        var attrName = ' data-name="' + row.subject + '"';
                        var attrActionUrl = ' data-action-url="' + baseUrl + '"';
            
                        var btnView = `<a href="${baseUrl}" class="btn btn-icon tooltips" data-title="ดูข้อมูล"><i class="fa fa-search"></i></a>`;
                        var btnDel = `<a href="javascript:;" ${attrName} ${attrActionUrl} class="btn btn-icon btn-delete tooltips" data-title="ลบ"><i class="fa fa-trash"></i></a>`;
            
                        var actions = btnView + btnDel;
                        return actions;
                    }
                },
            ],
            columnDefs: [].concat($.fn.dataTable.defaults.columnDefs),
        }).on('draw', function () {
            app_plugins.switch_button();
            $('.tooltips').tooltip();
        });

        datatable.on('row-reorder', function (e, diff, edit) {

            var arr = [];
            for (var i = 0, ien = diff.length; i < ien; i++) {
                var rowData = datatable.row(diff[i].node).data();
                arr.push({
                    id: rowData.id,
                    position: diff[i].newPosition
                });
            }

            if (arr.length) {
                Loading.show();

                $.ajax({
                    url: `${moduleUrl}/sequence`,
                    type: 'POST',
                    data: JSON.stringify(arr),
                    dataType: 'json',
                    success: function (resp) {
                        App.showSuccess(resp);
                        datatable.draw();
                        Loading.hide();
                    },
                    error: function (resp) {
                        Loading.hide();
                    }
                });
            }

        });
    };

    /**
     * Form Section
     */

    var initFeaturedImage = function () {
        dropzone = true;
        var featuredImage = $(".featured");

        featuredImage.dropzone({
            url: `${moduleUrl}/upload-featured`,
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
                    formData.append("id", messageId);
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
        $('#form-message').on('submit', function (e) {
            e.preventDefault();
            if (e.isTrigger) return false; // prevent submit twice

            form = this;

            // $('<input />').attr('type', 'hidden').attr('name', "content_id").attr('value', messageApp.message.link_content.content_id).appendTo($(form));
            // $('<input />').attr('type', 'hidden').attr('name', "content_type_id").attr('value', messageApp.message.link_content.content_type_id).appendTo($(form));

            var checkboxes = $(this).find("input[type=checkbox]");
            $.each(checkboxes, function (key, val) {
                $('<input />').attr('type', 'hidden').attr('name', $(val).attr('name')).attr('value', $(this).is(':checked')).appendTo($(form));
            });

            if ($(form).valid()) {
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
                        messageId = resp.data.id;
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
            if ($('#table-message').length) {
                initDatatable();
            }

            if ($('#form-message').length) {
                initFeaturedImage();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Message.init();
});
