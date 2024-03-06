$(document).ready(function () {
    $('#login').click(function () {
        var username = $('#username').val();
        var password = $('#password').val();
        if (username == '' || password == '') {
            Swal.fire({
                title: "Warning",
                text: "Please fill all fields!",
                icon: "info",
                confirmButtonText: 'Retry'
            })
        } else {
            $.ajax({
                url: 'src/api/login.php',
                method: 'POST',
                dataType: 'json',
                cache: false,
                data: { username: username, password: password },
                success: function (data) {
                    if (data == 'Success') {
                        Swal.fire({
                            title: "Success",
                            text: "Logged in Successfully",
                            icon: "success",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then(function () {
                            // window.location.href = 'src/views/home.php';
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Incorrect Username or Password",
                            icon: "error",
                            confirmButtonText: 'Retry'
                        }).then(function () {
                            $('#username,#password').val('')
                        })
                    }
                }
            })
        }
    });

})