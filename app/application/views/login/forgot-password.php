<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Base url -->
    <base href="../">

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('../') ?>assets/app/images/favicon.png">

    <!-- Title -->
    <title></title>

    <!-- Stylesheets -->
    <link href="<?php echo base_url('../') ?>assets/app/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('../') ?>assets/app/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

</head>

<body class="gradiant-bg" data-theme-color="color-green">
    <div class="page-wraper">

        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- Preloader end-->

        <!-- Page Content -->
        <div class="page-content">
            <!-- Banner -->
            <div class="banner-wrapper">
                <div class="circle-1"></div>
                <div class="container inner-wrapper">
                    <img src="<?php echo base_url('../') ?>portal_assets/images/logo.png"
                        style="height:80px; width : 80px;" alt="/">
                    <p class="mb-0 font-20"><?= PROJECT_NAME ?></p>
                </div>
            </div>
            <!-- Banner End -->
            <div class="account-box">
                <div class="container">
                    <div class="account-area" id="forgotPassword">
                        <div>
                            <h2 class="title">Forgot Password</h2>
                            <p class="text-soft">Enter your registered phone no</p>
                            <!-- <form> -->
                            <div class="text-center mb-3">
                                <span id="msg" class="text-warning"></span>
                            </div>
                            <div class="input-group form-item input-select">
                                <span class="input-group-text p-0">
                                    <select class="form-control custom-image-select-2 image-select">
                                        <option
                                            data-thumbnail="<?php echo base_url('../') ?>assets/app/images/flags/svg/india.svg">
                                            +91</option>
                                    </select>
                                </span>
                                <input type="number" name="phone" id="phone" autocomplete="off" required
                                    class="form-control" placeholder="Phone Number">
                            </div>

                            <button class="btn btn-primary btn-block" id="requestOtp" onclick="sendOtp()">SEND
                                OTP</button>
                            <!-- </form> -->
                        </div>
                        <footer class="footer fixed">
                            <div class="container">
                                <a href="<?php echo base_url('authentication/register') ?>" class="btn btn-primary light d-block">CREATE AN
                                    ACCOUNT</a>
                            </div>
                        </footer>
                    </div>

                    <div class="account-area" id="submitOtp">
                        <div>
                            <h2 class="title">Enter Code</h2>
                            <p class="text-soft">OTP send to your registered phone no <span id="msg_phone"></span></p>
                            <p class="text-warning text-center" id="otpmsg"></p>
                            <form action="submit">
                                <div id="otp-form" class="digit-group">
                                    <input class="form-control" type="text" onchange="getOTP()" id="digit-2"
                                        name="digit-2" placeholder="-" data-next="digit-3" data-previous="digit-1" />
                                    <input class="form-control" type="text" onchange="getOTP()" id="digit-3"
                                        name="digit-3" placeholder="-" data-next="digit-4" data-previous="digit-2" />
                                    <input class="form-control" type="text" onchange="getOTP()" id="digit-4"
                                        name="digit-4" placeholder="-" data-next="digit-5" data-previous="digit-3" />
                                    <input class="form-control" type="text" onchange="getOTP()" id="digit-5"
                                        name="digit-5" placeholder="-" data-next="digit-6" data-previous="digit-4" />
                                </div>
                                <input type="hidden" name="otp" id="otp">
                            </form>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="javascript:void(0);" class="text-light text-center d-block">Don’t you recevied
                                    any code?</a>
                                <span style="cursor:pointer;" class="btn-link d-block ms-2 text-underline"
                                    onclick="submitNewOtp()">Resend</span>
                            </div>
                        </div>

                        <footer class="footer fixed">
                            <div class="container">
                                <div class="seprate-box mb-3">
                                    <a href="register.html" class="back-btn">
                                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.40366 8L9.91646 2.58333L7.83313 0.499999L0.333132 8L7.83313 15.5L9.91644 13.4167L4.40366 8Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                    <button id="submitOtp" onclick="submitOtp()"
                                        class="btn btn-primary btn-block">NEXT</a>
                                </div>
                            </div>
                        </footer>
                    </div>

                    <div class="account-area" id="forgotPassConfirm">
                        <div>
                            <h2 class="title">Change Password</h2>
                            <p class="text-warning" id="msg1"></p>
                            <form>
                                <div class="mb-3 input-group input-group-icon">
                                    <div class="input-group-text">
                                        <div class="input-icon">
                                            <svg width="14" height="20" viewBox="0 0 14 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13 6H12V3C12 2.20435 11.6839 1.44129 11.1213 0.87868C10.5587 0.316071 9.79565 0 9 0H5C4.20435 0 3.44129 0.316071 2.87868 0.87868C2.31607 1.44129 2 2.20435 2 3V6H1C0.734784 6 0.48043 6.10536 0.292893 6.29289C0.105357 6.48043 0 6.73478 0 7V15C0 16.3261 0.526784 17.5979 1.46447 18.5355C2.40215 19.4732 3.67392 20 5 20H9C10.3261 20 11.5979 19.4732 12.5355 18.5355C13.4732 17.5979 14 16.3261 14 15V7C14 6.73478 13.8946 6.48043 13.7071 6.29289C13.5196 6.10536 13.2652 6 13 6ZM4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2H9C9.26522 2 9.51957 2.10536 9.70711 2.29289C9.89464 2.48043 10 2.73478 10 3V6H4V3ZM8 13.72V15C8 15.2652 7.89464 15.5196 7.70711 15.7071C7.51957 15.8946 7.26522 16 7 16C6.73478 16 6.48043 15.8946 6.29289 15.7071C6.10536 15.5196 6 15.2652 6 15V13.72C5.69772 13.5455 5.44638 13.2949 5.27095 12.9932C5.09552 12.6914 5.00211 12.349 5 12C5 11.4696 5.21071 10.9609 5.58579 10.5858C5.96086 10.2107 6.46957 10 7 10C7.53043 10 8.03914 10.2107 8.41421 10.5858C8.78929 10.9609 9 11.4696 9 12C8.99789 12.349 8.90448 12.6914 8.72905 12.9932C8.55362 13.2949 8.30228 13.5455 8 13.72Z"
                                                    fill="#7D8FAB" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="password" name="newpassword" id="newpassword"
                                        class="form-control dz-password" placeholder="New Password">
                                    <span class="input-group-text show-pass">
                                        <i class="fa fa-eye-slash text-primary"></i>
                                        <i class="fa fa-eye text-primary"></i>
                                    </span>
                                </div>
                                <div class="mb-3 input-group input-group-icon">
                                    <div class="input-group-text">
                                        <div class="input-icon">
                                            <svg width="14" height="20" viewBox="0 0 14 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13 6H12V3C12 2.20435 11.6839 1.44129 11.1213 0.87868C10.5587 0.316071 9.79565 0 9 0H5C4.20435 0 3.44129 0.316071 2.87868 0.87868C2.31607 1.44129 2 2.20435 2 3V6H1C0.734784 6 0.48043 6.10536 0.292893 6.29289C0.105357 6.48043 0 6.73478 0 7V15C0 16.3261 0.526784 17.5979 1.46447 18.5355C2.40215 19.4732 3.67392 20 5 20H9C10.3261 20 11.5979 19.4732 12.5355 18.5355C13.4732 17.5979 14 16.3261 14 15V7C14 6.73478 13.8946 6.48043 13.7071 6.29289C13.5196 6.10536 13.2652 6 13 6ZM4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2H9C9.26522 2 9.51957 2.10536 9.70711 2.29289C9.89464 2.48043 10 2.73478 10 3V6H4V3ZM8 13.72V15C8 15.2652 7.89464 15.5196 7.70711 15.7071C7.51957 15.8946 7.26522 16 7 16C6.73478 16 6.48043 15.8946 6.29289 15.7071C6.10536 15.5196 6 15.2652 6 15V13.72C5.69772 13.5455 5.44638 13.2949 5.27095 12.9932C5.09552 12.6914 5.00211 12.349 5 12C5 11.4696 5.21071 10.9609 5.58579 10.5858C5.96086 10.2107 6.46957 10 7 10C7.53043 10 8.03914 10.2107 8.41421 10.5858C8.78929 10.9609 9 11.4696 9 12C8.99789 12.349 8.90448 12.6914 8.72905 12.9932C8.55362 13.2949 8.30228 13.5455 8 13.72Z"
                                                    fill="#7D8FAB" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="password" name="confirmpassword" id="confirmpassword"
                                        class="form-control dz-password" placeholder="Confirm Password">
                                    <span class="input-group-text show-pass">
                                        <i class="fa fa-eye-slash text-primary"></i>
                                        <i class="fa fa-eye text-primary"></i>
                                    </span>
                                </div>
                            </form>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="<?php echo base_url('authentication/register') ?>"
                                    class="text-light text-center d-block">Don’t have an account?</a>
                                <a href="<?php echo base_url('authentication/register') ?>"
                                    class="btn-link d-block ms-2 text-underline">SignUp here</a>
                            </div>

                            <footer class="footer fixed">
                                <div class="container">
                                    <button id="submitPassword" onclick="generatePassword()"
                                        class="btn btn-primary btn-block">SUBMIT</button>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content End -->

    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="<?php echo base_url('../') ?>assets/app/js/jquery.js"></script>
    <script src="<?php echo base_url('../') ?>assets/app/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('../') ?>assets/app/vendor/bootstrap-select/dist/js/bootstrap-select.min.js">
    </script>
    <script src="<?php echo base_url('../') ?>assets/app/js/settings.js"></script>
    <script src="<?php echo base_url('../') ?>assets/app/js/custom.js"></script>
    <link href="<?php echo base_url('../'); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css"
        rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('../'); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
        type="text/javascript"></script>
    <script>
    function getOTP() {
        const otp_1 = $('#digit-2').val();
        const otp_2 = $('#digit-3').val();
        const otp_3 = $('#digit-4').val();
        const otp_4 = $('#digit-5').val();

        const combinedOTP = `${otp_1}${otp_2}${otp_3}${otp_4}`
        $("#otp").val(combinedOTP);
    }
    </script>

    <script>
    function submitNewOtp() {
        if ($('#phone').val() == '') {
            $("#msg").html("Enter registered phone no");
            return;
        }

        var phone = $('#phone').val();
        sendOtp()
    }
    </script>
    <script>
    $('#submitOtp').hide();
    $('#forgotPassConfirm').hide();
    $('#forgotPassword').show();

    function sendOtp() {
        if ($('#phone').val() == '') {
            $("#msg").html("Enter registered phone no");
            return;
        }
        $("#msg").html("");

        var phone = $('#phone').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('registration/sendOTP') ?>',
            data: {
                phone: phone
            },
            success: function(data) {
                if (data == 2) {
                    $("#msg").html("Enter registered phone number.");
                    $('#submitOtp').hide();
                    $('#forgotPassConfirm').hide();
                    $('#forgotPassword').show();
                } else {
                    $("#msg_phone").html(phone);
                    $('#submitOtp').show();
                    $('#forgotPassConfirm').hide();
                    $('#forgotPassword').hide();
                }
            }
        });
    }
    </script>
    <script>
    function submitOtp() {
        if ($('#digit-2').val() == '' || $('#digit-3').val() == '' || $('#digit-4').val() == '' || $('#digit-5')
            .val() == '') {
            $('#otpmsg').html('All Fields are required');
            return
        }
        $('#otpmsg').html('');
        var phone = $('#phone').val();
        var otp = $('#otp').val();

        if (phone == '' || otp == '') {
            $("#msg").html("All fields are required");
            return;
        }

        $("#msg").html("");

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url('registration/verifyOTP') ?>',
            data: {
                phone: phone,
                otp: otp
            },
            success: function(response) {
                if (response.result == 'NOT_FOUND') {
                    $('#otpmsg').html('OTP invalid');
                    $('#submitOtp').show();
                    $('#forgotPassConfirm').hide();
                    $('#forgotPassword').hide();
                } else if (response.result == 'FOUND') {
                    $('#submitOtp').hide();
                    $('#forgotPassConfirm').show();
                    $('#forgotPassword').hide();
                }
            }
        });
    }
    </script>

    <script>
    function generatePassword() {
        var newpassword = $('#newpassword').val();
        var phone = $('#phone').val();
        if (newpassword == '' || $('#confirmpassword').val() == '') {
            $('#msg1').html("All fields are required");
            return;
        }

        if (newpassword != $('#confirmpassword').val()) {
            $('#msg1').html("Paasword not match!");
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('registration/changePassword') ?>',
            data: {
                password: newpassword,
                phone: phone
            },
            success: function(response) {
                if (response == 0) {
                    Swal.fire(
                        'OTP Invalid!',
                        'Try Again.',
                        'question'
                    )
                } else if (response == 1) {
                    Swal.fire(
                        'Good Job!',
                        'Your password updated successfully.',
                        'success'
                    ).then((result) => {
                        window.location.href = '<?php echo base_url('/') ?>';
                    });
                }
            }
        });
    }
    </script>
</body>

</html>