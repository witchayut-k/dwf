var Menu = function () {

    var moduleUrl = appUrl + '/admin/menus';

    var menuApp = new Vue({
        el: '.menu-app',
        data: {
            menus: [],
            position: 'top_menu',
        },
        methods: {

        }
    });


    var initDatatable = function () {
        datatable = $('#table-menu').DataTable({
            rowReorder: {
                update: false
            },
            bSort: false,
            bPaginate: false,
            ajax: {
                url: moduleUrl,
                data: function (d) {
                    if (!searchData.menu_position)
                        searchData.menu_position = 'top_menu'
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
                { data: 'title_th' },
                { data: 'menu_type', sClass: 'text-center' },
                {
                    data: 'menu_content', sClass: 'text-center',
                    render: function (data, type, row) {
                        if (data.indexOf('http') > -1)
                            return `<div style="width: 150px; word-wrap: break-word;"><a href="${data}" target="_blank">${data}</a></div>`;

                        return `<div style="width: 150px; word-wrap: break-word;">${data}</div>`;
                    }
                },
                {
                    data: 'parent_menu',
                    render: function (data, type, row) {
                        var convert = function (convert) {
                            return $("<p />", { html: convert }).text();
                        };

                        return convert(data);
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
                        var actions = App.renderTableActions(moduleUrl, row.id, row.title_th);
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

    var handleFilter = function () {
        $('[name="menu_position"]').on('change', function () {
            searchData.menu_position = $(this).val();
            datatable.draw();

            initMainMenu();
        });

        $('[name="main_menu_id"]').on('change', function () {
            searchData.main_menu_id = $(this).val();
            datatable.draw();
        });
    }

    var initMainMenu = function () {
        var position = $('[name="menu_position"]').val();
        $.ajax({
            url: `${appUrl}/api/backend/main-menus?position=${position}`,
            type: 'get',
            success: function (resp) {
                menuApp.menus = resp;

                setTimeout(() => {
                    $('[name="main_menu_id"]').selectpicker('val', '');
                    $('[name="main_menu_id"]').selectpicker('refresh');
                }, 100);
            },
            error: function () {
                alert('Error occured, please contact administrator');
            }
        });
    };

    var handleMenuType = function () {
        $('[name="menu_type_id"]').on('change', function () {
            const type = $('[name="menu_type_id"]:checked').val();
            if (type == 1) {
                $('.group-content').hide();
                $('.group-content-type').hide();
                $('.group-url').hide();
                $('.group-internal-link').hide();
            } else if (type == 2) {
                $('.group-content').show();
                $('.group-content-type').hide();
                $('.group-url').hide();
                $('.group-internal-link').hide();
            } else if (type == 3) {
                $('.group-content').hide();
                $('.group-content-type').show();
                $('.group-url').hide();
                $('.group-internal-link').hide();
            } else if (type == 4) {
                $('.group-content').hide();
                $('.group-content-type').hide();
                $('.group-url').show();
                $('.group-internal-link').hide();
            } else if (type == 5) {
                $('.group-content').hide();
                $('.group-content-type').hide();
                $('.group-url').hide();
                $('.group-internal-link').show();
            }
        });
    };

    var handleSubmit = function () {
        var $form = $('#form-menu');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                var contentId = null;
                if ($('[name="menu_type_id"]:checked').val() == 2)
                    contentId = $('[name="content_picker"]').val();
                else if ($('[name="menu_type_id"]:checked').val() == 3)
                    contentId = $('[name="content_type_picker"]').val();
                else if ($('[name="menu_type_id"]:checked').val() == 5)
                    $('[name="url"]').val($('[name="internal_link"]').val());

                $('<input />').attr('type', 'hidden').attr('name', 'content_id').attr('value', contentId).appendTo($form);
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
            if ($('#table-menu').length) {
                initDatatable();
                initMainMenu();
                handleFilter();
            }

            if (('#form-menu').length) {
                customSubmit = true;
                handleSubmit();
                handleMenuType();

                $('[name="menu_type_id"]').trigger('change');

                $('#parent-menu').hierarchySelect({
                    width: 'auto',
                    onChange: function (value) {
                        // console.log(value)
                        // $('[name="parent_id"]').val(value);
                    }
                });
            }

        }
    }
}();

$(function () {
    Menu.init();
});
