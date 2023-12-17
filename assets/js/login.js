$(document).ready(function () {
    $("#login_form").on("submit", function (event) {
        event.preventDefault();

        var data = {
            username: $("#username").val(),
            password: $("#password").val()
        }

        $.ajax({
            type: "POST",
            url: agriserve.Ajax,
            data: {
                action: "userLogin",
                username: data.username,
                password: agriserve.Utils.hash(data.password)
            },
            success: function (res) {
                if (res === "true") {
                    notyf.success("Logged in successfully!")
                    setInterval(function (){
                        window.location.href = 'index.php'
                    }, 5000)
                } else {
                    notyf.error(res);
                }
            }
        });
    });
});
