var Login = function () {
    var moduleUrl = `${appUrl}/admin/auth`;

    return {
        init: function () {
            if ($('#form-login').length) {
            }
        }
    }
}();

$(function () {
    Login.init();
});
