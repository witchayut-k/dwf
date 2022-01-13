var Profile = function () {

    var moduleUrl = appUrl + '/admin/profile';
    var userId;

  
    var handleSubmit = function () {
        var $form = $('#form-profile');
        var submitMethod = $form.find('[name="_method"]').val() || 'POST';
        var redirectUrl = $form.attr('redirect-url');
        var $inputs = $form.find("input, select, button, textarea");

        $form.ajaxForm({
            beforeSerialize: function ($form, options) {
                // $('<input />').attr('type', 'hidden').attr('name', 'content_type_id').attr('value', searchData.content_type_id).appendTo($form);
                // $('<input />').attr('type', 'hidden').attr('name', 'content_type_id').attr('value', searchData.parent_type_id).appendTo($form);
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

            if ($('#form-profile').length) {
                customSubmit = true;
                // initAvatarImage();
                handleSubmit();
            }
        }
    }
}();

$(function () {
    Profile.init();
});
