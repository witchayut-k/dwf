var Banner = function () {

    var moduleUrl = appUrl + '/admin/banners';
    var bannerId;

    var initDatatable = function () {
        datatable = $('#table-banner').DataTable({
            rowReorder: {
                update: false
            },
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
                    data: 'id',
                    sClass: "dragable",
                    render: function (data, type, row) {
                        return '';
                    }
                },
                {
                    data: 'DT_RowIndex', sClass: 'text-center'
                },
                { data: 'title' },
                {
                    data: 'featured_image',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return `<img src="${data}" style="width: 118px; height: 60px;" />`;
                    }
                },
                {
                    data: 'created_at',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'view_count',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return data;
                    }
                },
                {
                    data: 'click_count',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return data;
                    }
                },
                {
                    data: 'published', sClass: 'text-center',
                    render: function (data, type, row) {
                        const checked = data ? 'checked' : '';
                        return `<label class="switch"><input type="checkbox" name="status" data-module-url="${moduleUrl}" data-id="${row.id}" ${checked} /></label>`;
                    }
                },
                {
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var actions = App.renderTableActionsWithPreview(moduleUrl, row.id, row.title);
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
                    formData.append("id", bannerId);
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

        var $form = $('#form-banner');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSubmit: function (arr, $form, options) {
                $inputs.prop("disabled", true);
            },
            success: function (resp) {
                if (submitMethod == 'PUT') {
                    App.showSuccess(resp);
                    setTimeout(function () {
                        $inputs.prop("disabled", false);
                        // if (redirectUrl)
                        //     window.location.href = redirectUrl;
                    }, 500);
                } else {

                    App.showSuccess(resp);

                    var pathArray = location.pathname.split('/');

                    if (redirectUrl) {

                        if (redirectUrl.indexOf('{id}') != -1)
                            redirectUrl = redirectUrl.replace('{id}', resp.id);

                        setTimeout(() => {
                            window.location.href = (redirectUrl || pathArray[1] || '');
                        }, 500);

                    }
                }
            },
            error: function (err) {
                $inputs.prop("disabled", false);
            }
        });
    };


    return {
        init: function () {
            if ($('#table-banner').length) {
                initDatatable();
            }

            if ($('#form-banner').length) {
                dropzone = true;
                // initFeaturedImage();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Banner.init();
});
