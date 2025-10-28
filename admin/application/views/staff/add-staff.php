<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" method="post" action="<?php echo site_url('staff/addNewStaff/'); ?>" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Designation</label>
                            <select name="designation" id="designation"  class="form-control" required>
                                <option value="Admin Head">Admin Head</option>
                                <option value="Manager">Manager</option>
                                <option value="Office Executive">Office Executive</option>
                                <option value="HR">HR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" pattern="[0-9]{10}" maxlength="10" minlength="10" class="form-control" id="mobile" placeholder="Enter phone no" name="mobile" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="email" class="form-control" placeholder="Enter email id" id="" name="email" required>
                        </div>
                    </div>
                   
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
        </form>

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


    add_staff=function()
    {
     
        var d={
            "name":$("#name").val(),
            "desig":$("#desig").val(),
            "mobile":$("#mobile").val(),
            "email":$("#email").val(),
            "pwd":$("#password").val(),
            "magicpoint":$("#magicpoint").val(),
            "giftamt":$("#giftamt").val(),
            "sponsoramt":$("#sponsoramt").val(),
            "regpoint":$("#regpoint").val(),
            "refpoint":$("#refpoint").val(),
            "level1":$("#level1").val(),
            "level2":$("#level2").val(),
            "level3":$("#level3").val(),
            "level4":$("#level4").val(),
            "level5":$("#level5").val(),
            "level6":$("#level6").val(),
            "level7":$("#level7").val(),
            "level8":$("#level8").val(),
            "level9":$("#level9").val(),
            "level10":$("#level10").val(),
            "inclevel1":$("#inclevel1").val(),
            "inclevel2":$("#inclevel2").val(),
            "inclevel3":$("#inclevel3").val(),
            "inclevel4":$("#inclevel4").val(),
            "inclevel5":$("#inclevel5").val(),
            "inclevel6":$("#inclevel6").val(),
            "inclevel7":$("#inclevel7").val(),
            "inclevel8":$("#inclevel8").val(),
            "inclevel9":$("#inclevel9").val(),
            "inclevel10":$("#inclevel10").val(),

            "f1y":$("#f1y").val(),
            "f2y":$("#f2y").val(),
            "f3y":$("#f3y").val(),
            "f4y":$("#f4y").val(),
            "f5y":$("#f5y").val(),

            "autopoolallow":($("#autopool").is(':checked')?1:0),
            "clubachieve":($("#clubachieve").is(':checked')?1:0),
            "boosterIncome":$("#boosterIncome").val(),
            "directpoint":$("#directpoint").val(),
            "fastrackIncome":$("#fastrackIncome").val(),
            "fastrackDuration":$("#fastrackDuration").val()

        }
        $.ajax({
            url:"<?=base_url("package/addPackage")?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
                //  alert(data);
                alert("Project Added Successfully")
                window.location.reload();
            },
            error:function(data)
            {
alert(data);
            }

        })
    }
</script>