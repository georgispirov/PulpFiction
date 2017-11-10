$(document).ready(function () {
    $('#create-user-form').submit(function () {
        var form = $('#create-user-form');
        $.ajax({
            url: "/users/register",
            type: "POST",
            dataType: "json",
            data: { create_user: $(this).serialize() },
            success: function (data) {
                alert(data);
                form[0].reset();
            }
        });
    });
});