var ContentType = function () {

    var moduleUrl = appUrl + '/admin/content-types';

    var initDatatable = function () {
        datatable = $('#table-content-type').DataTable({
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
                { data: 'name' },
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
                        var baseUrl = moduleUrl + '/' + data;
                        var attrName = ' data-name="' + row.name + '"';
                        var attrActionUrl = ' data-action-url="' + baseUrl + '"';
            
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


    return {
        init: function () {
            if ($('#table-content-type').length) {
                initDatatable();
            }
        }
    }
}();

$(function () {
    ContentType.init();
});
