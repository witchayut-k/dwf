var Survey = function () {

    var moduleUrl = appUrl + '/admin/surveys';
    var surveyId = $('[name="id"]').val();

    var surveyApp = new Vue({
        el: '.survey-app',
        data: {
            questions: [{ question: '' }],
            maxQuestions: 100,
            choices: [{ name: '' }],
            maxChoices: 5,
        },
        methods: {
            addQuestion: function () {
                if (this.questions.length < this.maxQuestions) {
                    this.questions.push({
                        question: ''
                    })
                }

            },
            removeQuestion: function (index) {
                this.questions.splice(index, 1);
            },
            addChoice: function () {
                if (this.choices.length < this.maxChoices) {
                    this.choices.push({
                        name: ''
                    })
                }

            },
            removeChoice: function (index) {
                this.choices.splice(index, 1);
            }
        }
    });

    var initDatatable = function () {
        datatable = $('#table-survey').DataTable({
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
                    data: 'created_at',
                    sClass: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'view_count',
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
        if (!surveyId) return;
        $.ajax({
            url: `${moduleUrl}/${surveyId}/choices`,
            type: 'GET',
            success: function (resp) {
                surveyApp.choices = resp.length ? resp : [{ name: '' }];
            },
            error: function () {
                // alert('Error occured, please contact administrator');
            }
        });

        $.ajax({
            url: `${moduleUrl}/${surveyId}/questions`,
            type: 'GET',
            success: function (resp) {
                surveyApp.questions = resp.length ? resp : [{ question: '' }];
            },
            error: function () {
                // alert('Error occured, please contact administrator');
            }
        });
    }

    const handleSubmit = function () {

        var $form = $('#form-survey');

        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                $('<input />').attr('type', 'hidden').attr('name', 'questions').attr('value', JSON.stringify(surveyApp.questions)).appendTo($form);
                $('<input />').attr('type', 'hidden').attr('name', 'choices').attr('value', JSON.stringify(surveyApp.choices)).appendTo($form);
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
            error: function (err) {
                $inputs.prop("disabled", false);
            }
        });
    };


    return {
        init: function () {
            if ($('#table-survey').length) {
                initDatatable();
            }

            if ($('#form-survey').length) {
                customSubmit = true;
                initForm();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Survey.init();
});
