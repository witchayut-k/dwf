var Event = function () {

    var moduleUrl = appUrl + '/admin/events';
    var eventId;
    var searchData = {};
    var begin, end;
    var eventSources = [{ events: [], }];

    var initCalendar = function () {

        $('.calendar').fullCalendar({
            locale: 'th',
            monthNames: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
            monthNamesShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
            dayNames: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
            dayNamesShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
            dayNamesMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
            eventSources: eventSources,
            displayEventTime: false,
            header: {
                left: 'title prev,next',
                center: '',
                right: ''
            },
            viewRender: function (view, element) {
                bindEvents();
            },
            eventClick: function (calEvent, event) {
                window.location.href = `${moduleUrl}/${calEvent.id}/edit`;
            },
            dayClick: function (date, jsEvent, view) {
            },
            dayRender: function (date, cell) {
                var today = new Date();
                var end = new Date();
                end.setDate(today.getDate() - 1);
                // if (date < end)
                // cell.css("background-color", "#fcfcfc");
            },
            eventRender: function (event, element) {
                // element.find('.fc-title').html(element.find('.fc-title').text());
                // element.find('.fc-list-item-title').html(element.find('.fc-list-item-title').text());
            }
        });
    };

    var bindEvents = function () {
        begin = moment($('.calendar').fullCalendar('getView').start).format('DD/MM/YYYY');
        end = moment($('.calendar').fullCalendar('getView').end).format('DD/MM/YYYY');

        eventSources = [];

        $.ajax({
            type: 'GET',
            async: false,
            url: `${moduleUrl}/calendar?begin=${begin}&end=${end}`,
            success: function (resp) {
                eventSources = resp;
            },
            error: function (jqXhr) {
            }
        });

        $('.calendar').fullCalendar('removeEvents');
        $('.calendar').fullCalendar('renderEvents', eventSources, true);
    };

    var initDatatable = function () {
        datatable = $('#table-event').DataTable({
            bPaginate: false,
            bSort: false,
            ajax: {
                url: moduleUrl,
                data: function (d) {
                    searchData.begin = begin;
                    searchData.end = end;
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
                    data: 'begin_date',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY') + ' - ' + moment(row.end_date).format('DD/MM/YYYY');
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

    return {
        init: function () {
            if ($('#table-event').length) {
                initCalendar();
                initDatatable();
            }

            if ($('#form-event').length) {
                // handleSubmit();
            }
        }
    }
}();

$(function () {
    Event.init();
});
