
var Calendar = function () {

    var moduleUrl = 'events';
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
                left: 'prev,next title',
                center: '',
                right: ''
            },
            viewRender: function (view, element) {
                bindEvents();
            },
            eventClick: function (calEvent, event) {
                var id = calEvent.id;
                $.ajax({
                    url: `${moduleUrl}/${id}`,
                    type: 'get',
                    success: function (resp) {
                        $targetEl = $('#calendarEventModal');
                        $targetEl.find('.content').html(resp);
                        $targetEl.modal();
                    },
                    error: function () {
                        alert('Error occured, please contact administrator');
                    }
                });
                // $('#calendarEventModal').modal();
                // window.location.href = `${moduleUrl}//edit`;
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
            url: `${moduleUrl}?begin=${begin}&end=${end}`,
            success: function (resp) {
                eventSources = resp;
            },
            error: function (jqXhr) {
            }
        });

        $('.calendar').fullCalendar('removeEvents');
        $('.calendar').fullCalendar('renderEvents', eventSources, true);
    };

    return {
        init: function () {
            initCalendar();
        }
    }

}();

$(document).ready(function () {
    Calendar.init();
});