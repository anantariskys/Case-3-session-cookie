<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login Page</title>
</head>

<body>
    <div class="hero min-h-screen" style="background-image: url(https://source.unsplash.com/random/900×700/?hospital);">
        <div class="hero-overlay bg-opacity-30"></div>
        <div class="">
            <div class="min-h-screen  flex flex-col items-center justify-center py-6 px-4">
                <div class="max-w-md w-full  bg-opacity-40 backdrop-blur-xl py-8 px-6 rounded  bg-white">
                    <h1 class="text-4xl font-bold text-center text-[#FA7070]  drop-shadow-2xl "
                        style="filter: drop-shadow(2px 2px 0px #000000);">MediCure</h1>
                    <h2 class="text-center text-3xl ">
                        Log in to your account
                    </h2>
                    <form class="mt-10 space-y-4" id="loginForm">
                        <div>
                            <input name="email" type="email" autocomplete="email"
                                class="w-full text-sm px-4 py-3 rounded outline-none border-2 focus:border-[#FA7070]"
                                placeholder="Email address" />
                            <small class="text-red-500 hidden" id="emailError">Please enter a valid email
                                address.</small>
                        </div>
                        <div>
                            <input name="password" type="password" autocomplete="current-password"
                                class="w-full text-sm px-4 py-3 rounded outline-none border-2 focus:border-[#FA7070]"
                                placeholder="Password" />
                            <small class="text-red-500 hidden" id="passwordError">Password must be at least 8 characters
                                long and contain at least one uppercase letter, one lowercase letter, one number, and
                                one special character.</small>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="rememberMe" name="remember-me" type="checkbox"
                                    class="h-4 w-4 shrink-0 text-[#FA7070] focus:ring-[#FA7070]  rounded" />
                                <label for="rememberMe" class="ml-3 block text-sm">
                                    Remember me
                                </label>
                            </div>

                        </div>
                        <div class="!mt-10">
                            <button type="submit"
                                class="btn text-[#FEFDED] border-0 hover:bg-opacity-80 hover:scale-105 hover:shadow-xl w-full hover:bg-[#FA7070] bg-[#FA7070]">
                                Log in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        function isValidEmail(email) {
            const emailRegex = /\S+@\S+\.\S+/;
            return emailRegex.test(email);
        }


        function isValidPassword(password) {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return passwordRegex.test(password);
        }

        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            const email = $('input[name="email"]').val();
            const password = $('input[name="password"]').val();
            const rememberMe = $('#rememberMe').is(':checked');

            $('#emailError').addClass('hidden');
            $('#passwordError').addClass('hidden');

            if (!isValidEmail(email)) {
                $('#emailError').removeClass('hidden');
                return;
            }

            if (!isValidPassword(password)) {
                $('#passwordError').removeClass('hidden');
                return;
            }

            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: { email: email, password: password, rememberMe: rememberMe },
                success: function (response) {
                    if (response === 'success') {
                        Swal.fire({
                            title: 'Login Successful',
                            text: 'Login berhasil! anda akan redirect ke profile page',
                            icon: 'success',
                            timer: 3000, 
                            timerProgressBar: true, 
                            allowOutsideClick: false, 
                            allowEscapeKey: false, 
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = 'profilPage.php';
                        });


                    } else {
                        showErrorMessage(response);
                    }
                },
                error: function () {
                    showErrorMessage('Terjadi kesalahan saat melakukan login');
                }
            });
        });

        function showErrorMessage(message) {
            Swal.fire({
                title: 'Error',
                text: message,
                icon: 'error',
                customClass: {
                    confirmButton: 'btn text-[#FEFDED] border-0 hover:bg-opacity-80 hover:scale-105 hover:shadow-xl w-full hover:bg-[#FA7070] bg-[#FA7070]'
                },
                buttonsStyling: false
            });
        }


        const email = getCookie('email');
        if (email) {
            $('input[name="email"]').val(decodeURIComponent(email));
            $('#rememberMe').prop('checked', true);
        }
        const password = getCookie('password');
        if (password) {
            $('input[name="password"]').val(decodeURIComponent(password));
            $('#rememberMe').prop('checked', true);
        }


        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) {
                return decodeURIComponent(parts.pop().split(';').shift());
            }
        }


    });
</script>

</html>