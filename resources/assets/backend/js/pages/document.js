var Document = function () {

    var moduleUrl = appUrl + '/admin/documents';

    var initDatatable = function () {
        datatable = $('#table-document').DataTable({
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
                { data: 'title' },
                { data: 'type_name' },
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
                    data: 'download_count',
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
                        var actions = App.renderTableActions(moduleUrl, row.id, row.title);
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

    /**
     * Form Section
     */
     var handleSubmit = function () {

        var $form = $('#form-document');

        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                $('<input />').attr('type', 'hidden').attr('name', 'published').attr('value', $('[name="published"]').is(':checked')).appendTo($form);
            },
            beforeSubmit: function (arr, $form, options) {
                // $inputs.prop("disabled", true);
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
            }
        });
    };

    return {
        init: function () {
            if ($('#table-document').length) {
                initDatatable();
            }

            if ($('#form-document').length) {
                dropzone = true;
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Document.init();
});
