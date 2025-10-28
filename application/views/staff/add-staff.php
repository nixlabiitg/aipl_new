<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <!-- <form class="kt-form" method="post" action="<?php echo site_url('staff/addNewStaff/'); ?>" enctype="multipart/form-data"> -->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Designation</label>
                            <select name="designation" id="" class="form-control">
                                <option value="TC">DEG1</option>
                                <option value="ME">DEG1</option>
                                <option value="OE">DEG1</option>
                                <option value="TE">DEG1</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" pattern="[0-9]{10}" maxlength="10" minlength="10" class="form-control" id="" placeholder="Enter phone no" name="phone" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="email" class="form-control" placeholder="Enter email id" id="" name="email" required>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Meeting Target</label>
                            <input type="number" class="form-control" placeholder="Enter meeting target" name="meeting">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Calling Target</label>
                            <input type="number" class="form-control" placeholder="Enter calling target" name="calling">
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Re-type Password</label>
                            <input type="password" class="form-control" onchange="checkPass(this)" id="retypepass" placeholder="Re-type Password" required>
                            <span class="text-danger" id="msg"></span>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addstaff" class="btn btn-primary">Add Staff</button>
                        </div>
                    </div>
                </div>
        <!-- </form> -->

        <!--end::Form-->
    </div>
</div>

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function checkPass(x) {
        var repass = $("#password").val();
        if (x.value != repass) {
            $("#msg").html("Password didn't match. Try again.");
            $("#retypepass").val('');
        }
    }
</script>