var LandingPage = function () {

    var moduleUrl = appUrl + '/admin/landing-pages';
    var landingPageId = $('[name="id"]').val();

    var landingPageApp = new Vue({
        el: '.landing-page-app',
        data: {
            buttons: [{ title: 'เข้าสู่เว็บไซต์', url: appUrl }],
        },
        methods: {
            addButton: function () {
                this.buttons.push({
                    title: '',
                    url: ''
                })

            },
            removeButton: function (index) {
                this.buttons.splice(index, 1);
            }
        }
    });

    var initDatatable = function () {
        datatable = $('#table-landing-page').DataTable({
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
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'end_date',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY');
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
        if (!landingPageId) return;
        $.ajax({
            url: `${moduleUrl}/${landingPageId}/buttons`,
            type: 'GET',
            success: function (resp) {
                landingPageApp.buttons = resp.length ? resp : [{ title: '', url: '' }];
            },
            error: function () {
                // alert('Error occured, please contact administrator');
            }
        });
    }

    var handleSubmit = function () {

        var $form = $('#form-landing-page');

        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                $('<input />').attr('type', 'hidden').attr('name', 'buttons').attr('value', JSON.stringify(landingPageApp.buttons)).appendTo($form);
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
            if ($('#table-landing-page').length) {
                initDatatable();
            }

            if ($('#form-landing-page').length) {
                customSubmit = true;
                initForm();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    LandingPage.init();
});
