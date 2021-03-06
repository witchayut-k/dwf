var Contact = function () {

    const gmapApiKey = 'AIzaSyBLLjjivZFqH4NHsVwnWYaIv2Xs0mMpKR4';

    var moduleUrl = appUrl + '/admin/contacts';
    var contactId;

    var initDatatable = function () {
        datatable = $('#table-contact').DataTable({
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
                    data: 'address',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return data;
                    }
                },
                {
                    data: 'tel',
                    sClass: 'text-center',
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

    var initMap = false;
    var initGMap = function () {
        var geocoder;
        var map;
        var markers = [];
        var marker;

        var getMap = function () {
            var lat = $('input[name="lat"]').val() || '18.785385';
            var lng = $('input[name="lng"]').val() || '99.02985199999999';
            geocoder = new google.maps.Geocoder();
            var mapCenter = new google.maps.LatLng(lat, lng);
            var mapOptions = {
                center: mapCenter,
                zoom: 16,
                mapTypeId: 'roadmap',
                mapTypeControl: false,
                streetViewControl: false
            };
            /* initial google map by option owner = $mapOption */
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            /* Create the search box */
            var card = document.getElementById('content-input');
            var input = document.getElementById('map-search-input');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

            /* type ahead textbox */
            new google.maps.places.Autocomplete(input);

            /* set marker map */
            /*if($('input[name=lat]').val() != 0 && $('input[name=lng]').val() != 0){

            }*/
            marker = new google.maps.Marker({ position: mapCenter, draggable: true, animation: google.maps.Animation.DROP });
            marker.setMap(map);
            markers.push(marker);

            /* event marker change position (when open first drag on once modal) */
            google.maps.event.addListener(marker, 'dragend', function () {
                codeAddress(marker.getPosition(), null);
            });

            /* event marker change position (when click on modal) */
            google.maps.event.addListener(map, 'click', function (e) {
                codeAddress(e.latLng, null);
            });

        };

        $('#map-search-input').on('keypress', function (e) {
            if (e.keyCode == 13 || e.which == 13) {
                e.preventDefault();
                searchMap(e);
            }
        });

        $('#map-search-input').on('change', function (e) {
            searchMap(e);
        });

        var searchMap = function (e) {
            if ($(e.target).val()) {
                //Loading.show();
                var hideLoading = function () {
                    Loading.hide();
                }
                codeAddress(null, hideLoading);
            } else {
                alert('The name field is required!');
            }
        }

        var codeAddress = function (pos, callback) {
            var address = $('#map-search-input').val();
            /* clear all old marker */
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            geocoder.geocode({
                'address': address,
                componentRestrictions: {
                    country: 'TH'
                }
            },
                function (results, status) {
                    console.log('results', results)
                    console.log('status', status)

                    if (status == 'OK') {
                        if (!results[0].partial_match) {
                            var draggLocation = (pos) ? pos : results[0].geometry.location;
                            var latLocation = (pos) ? pos.lat : results[0].geometry.location.lat;
                            var lngLocation = (pos) ? pos.lng : results[0].geometry.location.lng;
                            marker = new google.maps.Marker({
                                position: draggLocation,
                                draggable: true,
                                animation: google.maps.Animation.DROP
                            });
                            marker.setMap(map);

                            google.maps.event.addListener(marker, 'dragend', function () {
                                codeAddress(marker.getPosition(), null);
                            });

                            /* will tag address input by search box */
                            if (!pos) {
                                $('textarea[name="address"]').val(results[0].formatted_address);

                                // Re-center when submit the address
                                map.setCenter(draggLocation);
                            }

                            $('input[name="lat"]').val(latLocation);
                            $('input[name="lng"]').val(lngLocation);
                            $('input[name="place_id"]').val(results[0].place_id);

                            /* push markers */
                            markers.push(marker);
                        } else {
                            App.error('Address name is "' + address + '"  not found')
                        }

                    } else {
                        // alert('Geocode was not successful for the following reason: ' + status);
                        App.error('Geocode was not successful for the following reason: ' + status)
                    }

                    if (callback) {
                        setTimeout(function () {
                            callback();
                        }, 300);
                    }

                });
        };

        if (initMap) {
            getMap();
        } else {
            $.getScript(`https://maps.googleapis.com/maps/api/js?key=${gmapApiKey}&libraries=places`, function () {
                getMap();
                initMap = true;
            });
        }
    };

    return {
        init: function () {
            if ($('#table-contact').length) {
                initDatatable();
            }

            if ($('#form-contact').length) {
                initGMap();
            }
        }
    }
}();

$(function () {
    Contact.init();
});
