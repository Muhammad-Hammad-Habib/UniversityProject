<?php include('config/config.php'); ?>

<?php
    if (!isset($_SESSION['user'])) {
        include('layout/header.php');
?>

<style>
    .php-email-form{ box-shadow: none !important; }
    #hero { height: 600px !important; }
    #footer { display: none !important; }
</style>

<section id="hero" class="d-flex align-items-center">
    <div style="z-index: 1; width: 100%" class="text-center">
        <section class="contact " data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container">
                <div class="row">
                    <div class="col-10 col-sm-8 col-lg-5 mx-auto">
                        <form id="login_form" role="form" class="php-email-form">
                            <h3 class="text-center text-white mb-4">Login Here</h3>
                            <div class="my-3">
                                <div class="error-message text-center"></div>
                                <div class="sent-message text-center"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="_email" class="form-control" placeholder="Email" autocomplete="off" />
                            </div>
                            <div class="form-group mt-3">
                                <input type="password" name="_password" class="form-control" placeholder="Password" autocomplete="off" />
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit">Login To Continue</button>
                                <p class="text-center mt-4">Not a member? Please<a href="register.php"> Register</a></p>
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

$(document).ready(function () {

    $('.error-message').removeClass('d-block');
    $('.sent-message').removeClass('d-block');

    // ========== Login Form ==========
    $('#login_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#login_form').serialize(), response=> {
            if (response === 'success') {
                $('.sent-message').addClass('d-block').html("You're Successfully Logged In");
                setTimeout(() => {
                    window.open('index.php', '_self');
                }, 2000);
            }
            else{
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
    }else{
        header('Location: index.php');
    }
?>