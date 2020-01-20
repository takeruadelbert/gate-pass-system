$(document).ready(function () {
    
})

function loginAjax(username, password, e) {
    buttonSpin(e);
    $.ajax({
        type: "POST",
        url: BASE_URL + "accounts/login_member/",
        data: {username: username, password: password},
        dataType: "json",
        success: function (data) {
            if (data.status == 201) {
                window.location.reload();
            } else if (data.status == 402) {

            }
        },
        error: function () {

        },
        done: function () {
            buttonUnspin(e);
        }
    });
}