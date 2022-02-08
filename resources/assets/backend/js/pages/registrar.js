var Registrar = function () {

    var moduleUrl = appUrl + '/admin/registrars';
    var registrarId = $('[name="id"]').val();

    var registrarApp = new Vue({
        el: '.registrar-app',
        data: {
            fields: [{ name: '' }],
            maxFields: 10
        },
        methods: {
            addField: function () {
                if (this.fields.length < this.maxFields) {
                    this.fields.push({
                        name: ''
                    })
                }

            },
            removeField: function (index) {
                this.fields.splice(index, 1);
            }
        }
    });

    var initDatatable = function () {
        datatable = $('#table-registrar').DataTable({
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
                {
                    data: 'featured_image',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return `<img src="${data}" style="width: 118px; height: 60px;" />`;
                    }
                },
                {
                    data: 'begin_date',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY') + ' - ' + moment(row.end_date).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'registered_count',
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
    };

    /**
     * Form Section
     */

    const initForm = () => {
        if (!registrarId) return;
        $.ajax({
            url: `${moduleUrl}/${registrarId}/fields`,
            type: 'GET',
            success: function (resp) {
                registrarApp.fields = resp.length ? resp : [{ name: '' }];
            },
            error: function () {
                // alert('Error occured, please contact administrator');
            }
        });
    }

    const handleSubmit = function () {

        var $form = $('#form-registrar');

        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                $('<input />').attr('type', 'hidden').attr('name', 'fields').attr('value', JSON.stringify(registrarApp.fields)).appendTo($form);
                $('<input />').attr('type', 'hidden').attr('name', 'published').attr('value', $('[name="published"]').is(':checked')).appendTo($form);
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
            }
        });
    };


    return {
        init: function () {
            if ($('#table-registrar').length) {
                initDatatable();
            }

            if ($('#form-registrar').length) {
                customSubmit = true;
                initForm();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Registrar.init();
});
