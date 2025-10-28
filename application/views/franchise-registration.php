<script src="https://www.google.com/recaptcha/api.js?render=6LcBg9grAAAAAHVIDcmaKhbKi_1Qg7HVS5YB_e0c
"></script>
<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Franchise Registration</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Franchise Registration</a></li>
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
            <div class="col-lg-12">
                <div class="border p-4 rounded">
                    <div class="text-center">
                        <h2>Franchise Request</h2>
                        <hr>
                    </div>
                    <form action="<?php echo base_url('welcome/franchiseQuery') ?>" method="post" id="signup-form">
                        <?php $this->load->view('messages') ?>
                        <h3><u>Referrer Details</u></h3>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Referrer ID</label>
                                    <input type="text" name="refer_id" id="refer_id" placeholder="Referrer ID"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Referrer Name</label>
                                    <input type="text" name="refer_name" id="refer_name" placeholder="Referrer Name"
                                        class="form-control" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <p id="info_notfound"></p>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Don’t have a Referral ID? <span class="text-danger" style="cursor:pointer;" onclick="addDefaultId()"><u>Click here to get one</u></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <h3><u>Personal Details</u></h3>
                        <div class="row">
                            <div class="col-lg-4" style="display: none;">
                                <div class="form-group">
                                    <label for="">User ID</label>
                                    <input type="text" name="userid" id="userid" placeholder="User ID"
                                        class="form-control" readonly required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Choose Package</label>
                                    <select name="package" id="" style="height:50px;" class="form-control" required>
                                        <option value="" selected disabled>Select an option</option>
                                        <?php
                                            $packages = $this->Crud->ciRead("franchise_package_master", "`id` != '0'");
                                            foreach($packages as $data){
                                        ?>
                                        <option value="<?= $data->id ?>"><?= $data->package_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter your name"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" onchange="findEmail(this.value)" id="email"
                                        placeholder="Enter your email" class="form-control">
                                    <small><span id="emailid" class="text-info"></span></small>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" onchange="findNumber(this.value)" name="phone"
                                        pattern="[0-9]{10}" minlength="10" maxlength="10" id="phone"
                                        placeholder="Enter your phone no" class="form-control" required>
                                    <small><span id="phoneno" class="text-info"></span></small>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Full Address</label>
                                    <textarea name="address" placeholder="Enter your address" class="form-control"
                                        required></textarea>
                                </div>
                            </div>
                        </div>

                        <h3><u>KYC Details</u></h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" id="bank" name="bank" class="form-control"
                                        placeholder="Enter Bank Name" value="<?= ($kyc?$kyc[0]['bank_name']:"") ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input type="text" id="branch" name="branch" class="form-control"
                                        placeholder="Enter Branch Name" value="<?= ($kyc?$kyc[0]['branch_name']:"") ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>A/c No</label>
                                    <input type="text" id="acno" name="acno" class="form-control"
                                        placeholder="Enter A/c Name" value="<?= ($kyc?$kyc[0]['ac_no']:"") ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>IFSC Code</label>
                                    <input type="text" id="ifsc" name="ifsc" class="form-control"
                                        placeholder="Enter IFSC Name" value="<?= ($kyc?$kyc[0]['ifsc_code']:"") ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>PAN No</label>
                                    <input type="text" id="pan" name="pan" class="form-control"
                                        placeholder="Enter PAN Name" value="<?= ($kyc?$kyc[0]['pan_no']:"") ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Aadhar No</label>
                                    <input type="text" id="aadhar" name="aadhar" class="form-control"
                                        placeholder="Enter Aadhar Name" value="<?= ($kyc?$kyc[0]['aadhar_no']:"") ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payee Name</label>
                                    <input type="text" id="payee" name="payee" class="form-control"
                                        placeholder="Enter Payee Name" value="<?= ($kyc?$kyc[0]['payee_name']:"") ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nominee Name</label>
                                    <input type="text" name="nominee" placeholder="Enter nominee name"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Relationship</label>
                                    <input type="text" name="relationship" placeholder="Enter relationship with nominee"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Add the CAPTCHA section -->
                        <div class="row mt-5">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div id="captcha"></div>
                                    <input type="number" id="userAnswer" name="userAnswer" placeholder="Your answer"
                                        class="form-control" required>
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
                                    Already have an account? <a href="<?php echo base_url('/franchise') ?>"
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(window).on("load", function() {
    $.ajax({
        type: "post",
        url: '<?php echo base_url('welcome/franchiseidGenerate') ?>',
        success: function(data) {
            $("#userid").val(data);
        }
    })
});
</script>

<script>
function findNumber(x) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url('welcome/franchise_find_phoneno') ?>',
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
        url: '<?php echo base_url('welcome/franchise_find_emailid') ?>',
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

addDefaultId = function(){
    let rid = 'AIPL101';
    $('#refer_id').val(rid)

    $.ajax({
        url : '<?php echo base_url('get_refer_details') ?>',
        method : 'POST',
        data : {
            rid : rid
        },

        success:function(data){
            if(data == 'NOT_FOUND'){
                $('#refer_id').val('')
                $('#refer_name').val('')
                $('#info_notfound').html('Referrer '+rid+' not found').addClass('text-danger');
            }else{
                $('#info_notfound').html('').removeClass('text-danger');
                $('#refer_name').val(data)
            }
        }
    })
}

$(document).on('change', '#refer_id', function(){
    let rid = $(this).val();

    $.ajax({
        url : '<?php echo base_url('get_refer_details') ?>',
        method : 'POST',
        data : {
            rid : rid
        },

        success:function(data){
            if(data == 'NOT_FOUND'){
                $('#refer_id').val('')
                $('#refer_name').val('')
                $('#info_notfound').html('Referrer '+rid+' not found').addClass('text-danger');
            }else{
                $('#info_notfound').html('').removeClass('text-danger');
                $('#refer_name').val(data)
            }
        }
    })
})
</script>