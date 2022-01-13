var WeblinkType = function () {

    var moduleUrl = appUrl + '/admin/weblink-types';
    var parentTypeId = $('[name="id"]').val();

    var initParentDatatable = function () {
        datatable = $('#table-main-weblink-type').DataTable({
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
                {
                    data: 'example_image',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return `<a href="javascript:;" data-module-url="${moduleUrl}/${row.id}" class="btn-view"><img src="${data}" style="width: 132px; " /></a>`;
                    }
                },
                {
                    data: 'types.length',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return data;
                    }
                },
                {
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var baseUrl = `${moduleUrl}/${data}/table`;
                        var btnEdit = `<a href="${baseUrl}" class="btn btn-icon tooltips btn-edit" data-title="แก้ไข"><i class="fa fa-edit"></i></a>`;
                        var actions = btnEdit;
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

    var initDatatable = function () {
        datatable = $('#table-weblink-type').DataTable({
            rowReorder: {
                update: false
            },
            bSort: false,
            ajax: {
                url: `${moduleUrl}/${parentTypeId}/table`,
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
                    data: 'published', sClass: 'text-center',
                    render: function (data, type, row) {
                        const checked = data ? 'checked' : '';
                        return `<label class="switch"><input type="checkbox" name="status" data-module-url="${moduleUrl}" data-id="${row.id}" ${checked} /></label>`;
                    }
                },
                {
                    data: 'id', sClass: 'text-center',
                    render: function (data, type, row) {
                        var baseUrl = `${moduleUrl}/${parentTypeId}/${data}`;
                        var attrName = ' data-name="' + name + '"';
                        var attrActionUrl = ' data-action-url="' + baseUrl + '"';
            
                        var btnView = `<a href="javascript:;" data-module-url="${baseUrl}" class="btn btn-icon tooltips btn-view" data-title="ดูข้อมูล"><i class="fa fa-search"></i></a>`;
                        var btnEdit = `<a href="${baseUrl}/edit" class="btn btn-icon tooltips btn-edit" data-title="แก้ไข"><i class="fa fa-edit"></i></a>`;
                        var btnDel = `<a href="javascript:;" ${attrName} ${attrActionUrl} class="btn btn-icon btn-delete tooltips" data-title="ลบ"><i class="fa fa-trash"></i></a>`;
            
                        var actions = btnEdit + btnDel;
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
                    url: `${moduleUrl}/${parentTypeId}/sequence`,
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

    var handleSubmit = function () {

        var $form = $('#form-weblink-type');

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
            }
        });
    };

    const handlePreview = () => {
        $('[name="icon"]').on('change', function (e) {
            const [file] = e.target.files
            if (file) {
                // console.log(file)
                $(this).parents('.form-group').find('.preview-image').attr('src', URL.createObjectURL(file));
                $(this).parents('.form-group').find('.preview-image').show();
            }
        })

        $('[name="icon_active"]').on('change', function (e) {
            const [file] = e.target.files
            if (file) {
                // console.log(file)
                $(this).parents('.form-group').find('.preview-image').attr('src', URL.createObjectURL(file));
                $(this).parents('.form-group').find('.preview-image').show();
            }
        })
    }


    return {
        init: function () {
            if ($('#table-main-weblink-type').length) {
                initParentDatatable();
            }

            if ($('#table-weblink-type').length) {
                initDatatable();
            }

            if ($('#form-weblink-type').length) {
                customSubmit = true;
                handleSubmit();
                handlePreview();
            }
        }
    }
}();

$(function () {
    WeblinkType.init();
});
