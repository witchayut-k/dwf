var Weblink = function () {

    var moduleUrl = appUrl + '/admin/weblinks';
    var weblinkId;

    var weblinkApp = new Vue({
        el: '.weblink-app',
        data: {
            parentTypes: [],
            types: [],
            parent_type_id: $('[name="parent_type_value"]').val(),
            weblink_type_id: $('[name="weblink_type_value"]').val()
        },
        methods: {
            onParentChange: function (e) {
                const selectedValue = e.target.value;
                searchData.parent_type_id = selectedValue;

                const parent = this.parentTypes.filter(x => x.id == selectedValue)[0];

                if (parent) {
                    this.types = parent.types;
                } else {
                    this.types = [];
                }

                setTimeout(() => {
                    $('[name="weblink_type_id"]').selectpicker('val', '');
                    $('[name="weblink_type_id"]').selectpicker('refresh');

                    if (datatable)
                        datatable.draw();
                }, 100);
            },
            onChange: function (e) {
                const selectedValue = e.target.value;
                searchData.weblink_type_id = selectedValue;

                if (datatable)
                    datatable.draw();
            },
        }

    });

    var initDatatable = function () {
        datatable = $('#table-weblink').DataTable({
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
                        return `<img src="${data}" style="width: 118px; height: auto;" />`;
                    }
                },
                {
                    data: 'parent_type',
                    sClass: 'text-center',
                },
                {
                    data: 'weblink_type',
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

    var initWeblinkTypes = function () {


        $.ajax({
            url: `${appUrl}/api/backend/weblink-types`,
            type: 'get',
            success: function (resp) {
                weblinkApp.parentTypes = resp;
                
                setTimeout(() => {
                    $('[name="parent_type_id"]').selectpicker('refresh');

                    if ($('[name="weblink_type_value"]').val()) {
                        const parent = weblinkApp.parentTypes.filter(x => x.id == weblinkApp.parent_type_id)[0];
                        if (parent)
                            weblinkApp.types = parent.types;

                        setTimeout(() => {
                            $('[name="weblink_type_id"]').selectpicker('val', weblinkApp.weblink_type_id);
                            $('[name="weblink_type_id"]').selectpicker('refresh');
                        }, 100);
                    }

                }, 100);
            },
            error: function () {
                alert('Error occured, please contact administrator');
            }
        });
    };


    /**
     * Form Section
     */


    var handleSubmit = function () {
        var $form = $('#form-weblink');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
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


    return {
        init: function () {
            if ($('#table-weblink').length) {
                initWeblinkTypes();
                initDatatable();
            }

            if ($('#form-weblink').length) {
                customSubmit = true;
                initWeblinkTypes();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Weblink.init();
});
