$.extend(true, $.fn.dataTable.defaults, {
    language: {
        search: "_INPUT_",
        searchPlaceholder: 'ค้นหา..',
        emptyTable: 'ไม่มีข้อมูล',
        info: "ข้อมูลลำดับที่ _START_ ถึง _END_ จาก _TOTAL_ รายการ",
        infoEmpty: "ไม่มีข้อมูล",
        lengthMenu: "_MENU_ รายการ",
        oPaginate: {
            sFirst: '<i class="fa fa-angle-double-left"></i>',
            sPrevious: '<i class="fa fa-angle-left"></i>',
            sNext: '<i class="fa fa-angle-right"></i>',
            sLast: '<i class="fa fa-angle-double-right"></i>'
        },
        processing: '<i class="fa fa-cog fa-spin fa-fw tx-gray-400"></i> <span class="tx-16 tx-gray-400">Loading...</span> ',
    },
    dom: '<tr><"table-control"pi>',
    // "dom": '<"table-info"i>rt<"table-control"lp>',
    // "sDom"          : '<"search-box"r>lftip', // FOR MOVE SEARCH BOX TO LEFT SIDE
    responsive: false,
    bStateSave: true,
    bLengthChange: false,
    bPaginate: true,
    bInfo: true,
    bSort: false,
    bFilter: true,
    serverSide: true,
    processing: true,
    ordering: true,
    pagingType: 'full_numbers',
    pageLength: 10,
    autoWidth: false,
    lengthMenu: [
        [10, 25, 50],
        [10, 25, 50]
    ],
})

$.extend($.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper",
    "sFilterInput": "form-control input-inline",
    "sLengthSelect": "form-control input-inline"
});

$.extend(true, $.fn.dataTable.defaults, {
    columnDefs: [
        { targets: '_all', orderSequence: ["desc", "asc"] }
    ],
    initComplete: function (settings, json) {
        var previous = App.getParam('previous');
        var $table = $('#' + settings.sTableId);
        var $row = $table.find('tbody > tr[id="' + previous + '"]');
        $row.addClass('hovered');

    },
    fnCreatedRow: function (nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData.id);
    }
});

$.fn.dataTable.ext.errMode = 'throw';

// $('body').on('click', '.btn-view', function () {
//     Loading.show();
//     $('#pdfFrame').attr('src', moduleUrl + '/' + $(this).data('id'));
//     setTimeout(() => {
//         $('#modal-preview').modal('show');
//         setTimeout(() => {
//             Loading.hide();
//         }, 300);
//     }, 500);
// });