<script src="https://www.google.com/recaptcha/api.js?render=6LcBg9grAAAAAHVIDcmaKhbKi_1Qg7HVS5YB_e0c
"></script>
<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Customer Registration</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Customer Registration</a></li>
                    </ol>
                </div>
            </div>
            <!-- Col end-->
        </div>
        <!-- Row end-->
    </div>
    <!-- Container end-->
</div>
<!-- Banner area end-->

<section class="main-container no-padding" id="main-container">
    <div class="about-pattern">
        <div class="container p-2">
            <?php $this->load->view('messages'); ?>
            <div class="offset-md-1 col-lg-10">
                <div class="border p-4 rounded border-0"
                    style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                    <form action="<?php echo base_url('welcome/createAccount') ?>" method="post" id="signup-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">User ID</label>
                                    <input type="text" name="userid" id="userid" placeholder="User ID"
                                        class="form-control border-dark" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Sponsor ID</label>
                                    <input type="text" name="sponsor" onchange="findSponsor(this.value)" id="sponsor"
                                        placeholder="Enter Sponsor ID" class="form-control border-dark" required>
                                    <small><span class="text-danger" id="msg"></span></small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Sponsor Name</label>
                                    <input type="text" name="sponsor_name" id="sponsor_name" placeholder="Sponsor Name"
                                        class="form-control border-dark readonly" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Choose Package</label>
                                    <select name="package" style="height: 50px; border: 1px solid #000;" id="package"
                                        class="form-control" required>
                                        <option value="" selected disabled>Select an option</option>
                                        <?php foreach($PACKAGES as $data){ ?>
                                        <option value="<?= $data->package_id ?>"><?= $data->package_name ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="show_package_products" style="cursor:pointer; color: teal;"><small>Show
                                            Package Products <i class="fa fa-share"></i></small></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter your name"
                                        class="form-control border-dark" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Enter your email"
                                        class="form-control border-dark" onchange="findEmail(this.value)">
                                    <small><span id="emailid" class="text-info"></span></small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" pattern="[0-9]{10}" minlength="10" maxlength="10"
                                        id="phone" placeholder="Enter your phone no" class="form-control border-dark"
                                        onchange="findNumber(this.value)" required>
                                    <small><span id="phoneno" class="text-info"></span></small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nominee Name</label>
                                    <input type="text" name="nominee" placeholder="Enter nominee name"
                                        class="form-control border-dark" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Relationship</label>
                                    <input type="text" name="relationship" placeholder="Enter relationship with nominee"
                                        class="form-control border-dark" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nominee Bank A/C No</label>
                                    <input type="text" name="bankno" placeholder="Enter account no"
                                        class="form-control border-dark">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nominee Bank IFSC Code</label>
                                    <input type="text" name="nominee_ifsc" placeholder="Enter IFSC"
                                        class="form-control border-dark">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nominee DOB</label>
                                    <input type="date" name="dobdate" placeholder="Enter dob"
                                        value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>"
                                        class="form-control border-dark">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Full Address</label>
                                    <textarea name="address" placeholder="Enter your address"
                                        class="form-control border-dark"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="password" placeholder="New Password"
                                        class="form-control border-dark" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        placeholder="Confirm Password" class="form-control border-dark"
                                        onchange="checkPassword(this.value)" required>
                                    <small><span id="pass" class="text-danger"></span></small>
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="viewPassword()" type="checkbox"
                                            value="" id="viewpass">
                                        <label class="form-check-label" for="viewpass">
                                            View Password
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Add the CAPTCHA section -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div id="captcha"></div>
                                    <input type="number" id="userAnswer" name="userAnswer" placeholder="Your answer"
                                        class="form-control border-dark" required>
                                    <span id="matching_msg" class="text-danger" style="font-size:14px;"></span>
                                    <input type="hidden" id="captchaAnswer" name="captchaAnswer">

                                    <input type="hidden" name="g_recaptcha_response" id="g-recaptcha-response">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-5">
                                <div class="text-center mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="agree" required>
                                        <label class="form-check-label" for="agree">
                                            I Agree to the <a href="<?php echo base_url('terms_and_condition') ?>"
                                                target="_blank">Terms & Conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" name="create_account" id="create_account"
                                        class="btn btn-secondary">Create Account</button><br />
                                    Already have an account? <a href="<?php echo base_url('/authentication/login') ?>"
                                        target="_blank">Login here</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Container 1 end-->
    </div>
    <!-- About pattern End-->
</section>

<!-- Products -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Package Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-right">Price</th>
                    </tr>
                </thead>
                <tbody id="plist">

                </tbody>
            </table>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$('#create_account').prop("disabled", true)
$('#show_package_products').hide();
$(window).on("load", function() {
    $.ajax({
        type: "post",
        url: '<?php echo base_url('welcome/useridGenerate') ?>',
        success: function(data) {
            $("#userid").val(data);
        }
    })
});
</script>
<script>
function findSponsor(x) {
    $.ajax({
        type: "post",
        url: '<?php echo base_url('welcome/findSponsor') ?>',
        data: {
            sponsorid: x
        },
        success: function(data) {
            if (data == 0) {
                $("#msg").html("Sponsor ID: " + x + " not found.");
                $("#sponsor_name").val("");
                $("#sponsor").val("");
            } else {
                $("#sponsor_name").val(data);
                $("#msg").html("")
            }

        }
    })
}
</script>

<script>
function viewPassword() {
    let passwordNew = document.getElementById("password");
    let passwordConfirm = document.getElementById("confirm_password");
    let checkbox = document.getElementById("viewpass");

    if (checkbox.checked) {
        passwordNew.type = "text";
        passwordConfirm.type = "text";
    } else {
        passwordNew.type = "password";
        passwordConfirm.type = "password";
    }
}
</script>

<script>
function checkPassword(x) {
    let passwordNew = $("#password").val();
    let passwordConfirm = $("#confirm_password").val();

    if (passwordNew == passwordConfirm) {
        $('#create_account').prop("disabled", false);
        $("#pass").html("");
    } else {
        $("#pass").html("Password didn't match.");
        $('#create_account').prop("disabled", true)
    }
}
</script>

<script>
function findNumber(x) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url('welcome/find_phoneno') ?>',
        data: {
            phone: x
        },
        success: function(data) {
            if (data == 1) {
                $('#phoneno').html("Phone no " + x + " already exist.");
                $('#phone').val("");
            } else {
                $('#phoneno').html("");
            }
        }
    })
}
</script>

<script>
function findEmail(x) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url('welcome/find_emailid') ?>',
        data: {
            email: x
        },
        success: function(data) {
            if (data == 1) {
                $('#emailid').html("Email : " + x + " already exist.");
                $('#email').val("");
            } else {
                $('#emailid').html("");
            }
        }
    })
}
</script>

<script>
function generateCaptcha() {
    var num1 = Math.floor(Math.random() * 10);
    var num2 = Math.floor(Math.random() * 10);
    var sum = num1 + num2;

    document.getElementById('captcha').innerHTML = 'Please solve: ' + num1 + ' + ' + num2 + ' = ';
    document.getElementById('captchaAnswer').value = sum;
}

function validateCaptcha() {
    var userAnswer = parseInt(document.getElementById('userAnswer').value);
    var correctAnswer = parseInt(document.getElementById('captchaAnswer').value);

    if (userAnswer === correctAnswer) {
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcBg9grAAAAAHVIDcmaKhbKi_1Qg7HVS5YB_e0c', {
                action: 'submit'
            }).then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
                document.getElementById('signup-form').submit();
            });
        });
    } else {
        document.getElementById('matching_msg').innerHTML = "Incorrect CAPTCHA answer. Please try again.";
        generateCaptcha();
    }
}

// Generate CAPTCHA when the page finishes loading
window.addEventListener('load', function() {
    generateCaptcha();
});

// Handle form submission
document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    validateCaptcha();
});

$(document).on('change', '#package', function() {
    let package_id = $(this).val()
    $('#show_package_products').show()
})

$(document).on('click', '#show_package_products', function () {
    const package_id = $('#package').val();

    if (!package_id) {
        alert('Please select a package.');
        return;
    }

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('get_package_products'); ?>',
        data: { package_id },
        success: function (data) {
            $('#plist').html(data);
            $('#productModal').modal('show')
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Failed to load package products. Try again.');
        }
    });
});

</script>