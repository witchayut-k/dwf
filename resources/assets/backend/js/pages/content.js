var Content = function () {

    var moduleUrl = appUrl + '/admin/contents';
    var contentId;

    var regionalContentId = $('#regional_content_id').data('id');

    var initDatatable = function () {
        datatable = $('#table-content').DataTable({
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
                    data: 'DT_RowIndex', sClass: 'text-center'
                },
                {
                    data: 'title',
                    render: function (data, type, row) {
                        let content = row.pinned ? data + ' <i class="fa fa-thumb-tack text-danger tooltips" title="เนื้อหาปักหมุด"></i>' : data;
                        if (row.file)
                            content += ` <i class="fa fa-file-pdf-o text-danger tooltips" title="แนบไฟล์ PDF"></i>`;

                        return content;
                    }
                },
                {
                    data: 'featured_image',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return `<img src="${data}" style="width: 118px; height: auto;" />`;
                    }
                },
                {
                    data: 'type_name',
                    sClass: 'text-center',
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

    };

    var handleFilter = function () {
        $('[name="content_type_id"]').on('change', function () {
            searchData.content_type_id = $(this).val();
            datatable.draw();
        });
    }

    /**
     * Form Section
     */

    var handleContentTypeChange = function () {
        console.log('regionalContentId', regionalContentId)
        $('[name="content_type_id"]').on('change', function () {
            if ($(this).val() == regionalContentId) {
                $('.center-container').show();
            } else {
                $('.center-container').hide();
            }
        });
    }


    var handleSubmit = function () {
        var $form = $('#form-content');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                // $('<input />').attr('type', 'hidden').attr('name', 'content_type_id').attr('value', searchData.content_type_id).appendTo($form);
                // $('<input />').attr('type', 'hidden').attr('name', 'content_type_id').attr('value', searchData.parent_type_id).appendTo($form);
            },
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
            error: function (res) {
                $inputs.prop("disabled", false);
                var errors = res.responseJSON;
                if (res.status === 422) {
                    App.showFormErrors(errors, $form);
                }
            }
        });
    };

    var handleFileUpload = function () {
        $('.btn-delete-file').on('click', function () {
            var $form = $('#form-content');
            // $form.append()''
        });
    }

    return {
        init: function () {
            if ($('#table-content').length) {
                handleFilter();
                initDatatable();
            }

            if ($('#form-content').length) {
                customSubmit = true;
                handleFileUpload();
                handleSubmit();
                handleContentTypeChange();
            }
        }
    }
}();

$(function () {
    Content.init();
});
