var UserRole = function () {

    var moduleUrl = appUrl + '/admin/user-roles';

    var initDatatable = function () {
        datatable = $('#table-role').DataTable({
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
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var actions = App.renderTableActions(moduleUrl, row.id, row.name);
                        return actions;
                    }
                },
            ],
            columnDefs: [].concat($.fn.dataTable.defaults.columnDefs),
        }).on('draw', function () {
            $('.tooltips').tooltip();
        });

    };

    /**
     * Form Section
     */

     var handleSubmit = function () {

        var $form = $('#form-role');

        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                var permissionValues = $("input:checkbox:checked").map(function(){
                    return $(this).val();
                  }).get();

                $('<input />').attr('type', 'hidden').attr('name', 'permissions').attr('value', JSON.stringify(permissionValues)).appendTo($form);
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
            error: function (jqXhr) {
                var errors = jqXhr.responseJSON;
                App.showFormErrors(errors, $(form));
                App.resetSubmitButton($(form));
                $inputs.prop("disabled", false);
                Loading.hide();
            }
        });
    };

    return {
        init: function () {
            if ($('#table-role').length) {
                initDatatable();
            }

            if ($('#form-role').length) {
                customSubmit = true;
                handleSubmit();
            }
        }
    }
}();

$(function () {
    UserRole.init();
});
