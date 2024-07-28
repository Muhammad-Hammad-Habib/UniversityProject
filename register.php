<?php include('config/config.php'); ?>

<?php
if (!isset($_SESSION['user'])) {
    include('layout/header.php');
?>

    <style>
        #header {
            display: none !important;
        }

        .php-email-form {
            box-shadow: none !important;
        }

        #hero {
            height: 600px !important;
        }

        #footer {
            display: none !important;
        }

        form input {
            border-radius: 20px !important;
        }

        form button {
            border-radius: 20px !important;
        }
    </style>

    <section id="hero" class="d-flex align-items-center">
        <div style="z-index: 1; width: 100%" class="text-center">
            <section class="contact " data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
                <div class="container">
                    <div class="row">
                        <div class="col-10 col-sm-8 col-lg-5 mx-auto">
                            <form id="register_form" role="form" class="php-email-form">
                                <h3 class="text-center text-white mb-4">Register Here</h3>
                                <div class="my-3">
                                    <div class="error-message text-center"></div>
                                    <div class="sent-message text-center"></div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" autocomplete="off" />
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="last_name"  class="form-control" placeholder="Last Name" autocomplete="off" />
                                </div>
                                <div class="form-group mt-3">
                                    <input type="email" name="email" class="form-control email" placeholder="Email" autocomplete="off" />
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" />
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off" />
                                </div>
                                <div class="form-group mt-3 OTP" style="display: none;">
                                    <input type="text" name="otp" class="form-control OTP_num" placeholder="Enter OTP" autocomplete="off" />
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" id="submit" hidden>Please Register</button>
                                    <button type="button" id="verify_email">Verify Email</button>
                                    <p class="text-center mt-4">Already a member? Please<a href="login.php"> Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <?php include('layout/footer.php'); ?>

    <script>
        $(document).ready(function() {
            var check_num = 0;

            $('.error-message').removeClass('d-block');
            $('.sent-message').removeClass('d-block');

            // ========== Verify Email ==========
            $('#verify_email').click(function() {
                if ($('.email').val() != '') {
                    $.ajax({
                        url: "/ums/config/verify_email.php",
                        type: "POST",
                        data: {
                            id: $('.email').val()
                        },
                        success: function(response) {
                            if (response == 'Email Already Exists') {
                                $('.sent-message').removeClass('d-block');
                                $('.error-message').addClass('d-block').html(response);
                                setTimeout(() => {
                                    $('.error-message').html('').removeClass('d-block');
                                }, 3000);
                            } else {
                                $.ajax({
                                    url: "/ums/config/mail.php",
                                    type: "POST",
                                    data: {
                                        id: $('.email').val()
                                    },
                                    success: function(response) {
                                        $('.OTP').css('display', 'block')
                                        check_num = response.toString();

                                        $('.error-message').removeClass('d-block');
                                        $('.sent-message').addClass('d-block').html("You Will Receive OTP, Wait For a Minute");
                                        setTimeout(() => {
                                            $('.sent-message').html("").removeClass('d-block');
                                            // location.reload();
                                        }, 3000);

                                    }
                                });
                            }
                            console.log(response)
                        }
                    });
                }
            });

            // ========== Verify OTP ==========
            $(".OTP_num").change(function() {

                if ($(".OTP_num").val() == check_num) {
                    //   $("#submit").removeAttr('hidden');
                    // $(".OTP").attr('hidden');  
                    $('#submit').removeAttr('hidden')
                    $('#verify_email').css("display", "none")
                    $('.error-message').removeClass('d-block');
                        $('.sent-message').addClass('d-block').html("OTP VERIfIED");
                        setTimeout(() => {
                            $('.sent-message').html("").removeClass('d-block');
                        }, 3000);
                }
            });



            // ========== Register Form ==========
            $('#register_form').submit(function(e) {
                e.preventDefault();
                $.post("./config/code.php", $('#register_form').serialize(), response => {
                    if (response === 'success') {
                        $('.error-message').removeClass('d-block');
                        $('.sent-message').addClass('d-block').html("Register Successfull. Please Login");
                        setTimeout(() => {
                            $('.sent-message').html("").removeClass('d-block');
                            location.reload();
                        }, 3000);
                        $('#register_form')[0].reset();
                    } else {
                        $('.sent-message').removeClass('d-block');
                        $('.error-message').addClass('d-block').html(response);
                        setTimeout(() => {
                            $('.error-message').html('').removeClass('d-block');
                        }, 3000);
                    }
                });
            });
        });
    </script>

<?php
} else {
    header('Location: index.php');
}
?>