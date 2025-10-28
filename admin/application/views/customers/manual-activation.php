<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">MANUAL ACTIVATION</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-daterange" id="" data-toggle="kt-tooltip" title=""
                    data-placement="left">
                    <span class="kt-subheader__btn-daterange-title"
                        id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date"
                        id="kt_dashboard_daterangepicker_date"><?php echo date('d M Y') ?></span>
                    <i class="flaticon2-calendar-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <!-- <form class="kt-form" method="post" action="<?php echo site_url('staff/addNewStaff/'); ?>" enctype="multipart/form-data"> -->
        <div class="kt-portlet__body">
            <div class="row  text-centere">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Customer Id</label>
                        <input type="text" class="form-control" id="cust_id">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <a class="btn btn-primary text-white mt-4" onclick="find();"><i
                                class="fa fa-search"></i>Find</a>

                    </div>
                </div>

                <hr>
            </div>


            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input readonly type="text" class="form-control" id="name">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input readonly type="text" class="form-control" id="mobile">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea readonly class="form-control" rows="1" id="address"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sponsor Id</label>
                        <input readonly type="text" id="sponsorId" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Franchise</label>
                        <input readonly type="text" id="franchiseId" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Registration Package</label>
                        <input readonly type="text" class="form-control" id="package__Id">
                    </div>
                </div>

                <div hidden class="col-md-4">
                    <div class="form-group">
                        <label>Sponsor Name</label>
                        <input readonly type="text" class="form-control" id="cid">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Choose Package</label>
                        <select type="text" class="form-control" id="package">
                            <option value="">Choose Package</option>
                            <?php foreach($package as $pk)
                                {
                                    $d=$pk['main_wallet']."/".$pk['digital_wallet_value']."/".$pk['shopping_coupon_value']."/".$pk['no_of_coupon']."/".$pk['magic_shopping_points']."/".$pk['gift_product_amount']."/".$pk['direct_ipp_amount']."/".$pk['project_development_benefit']."/".$pk['registration_point']."/".$pk['reffer_point']; ?>
                            <option
                                value="<?=$pk['package_id']."!".$d."!".$pk['package_amount']."!".$pk['autopool_allow']."!".$pk['registration_point']."!".$pk['reffer_point']."!".$pk['booster_income'] ?>">
                                <?=$pk['package_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <!-- <button type="reset" class="btn btn-warning text-light">Reset</button> -->
                            <button type="submit" name="addstaff" id="addstaff" class="btn btn-primary"
                                onclick="activate()">Activate</button>
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


    activate = function() {

        var d1 = $("#package").val().split("!");
        if (d1[0] == "") {
            alert("Please Choose Package.");
            return;
        }

        if (!confirm("Are you sure to activate now?")) return;

        if ($("#cid").val() == "") {
            alert("Customer Not found.");
            return;
        }

        if ($("#franchiseId").val() == "") {
            alert("Franchise ID Not found.");
            return;
        }

        $('#addstaff').prop('disabled', true);

        var d = {
            "cid": $("#cid").val(),
            "franchiseid": $("#franchiseId").val(),
            "packageId": d1[0],
            "wallet": d1[1],
            "packamount": d1[2],
            "status": 1,
            "autopoolallow": d1[3],
            "registrationpoint": d1[4],
            "sponsorid": $("#sponsorId").val(),
            "refferpoin": d1[5],
            "boosterincome": d1[6]
        }
        $.ajax({
            url: "<?=base_url("customer/activate")?>",
            type: "POST",
            dataType: "TEXT",
            data: d,
            success: function(data) {
                alert("Customer Activated Successfully")
                $('#addstaff').prop('disabled', false);
                window.location.reload();
            },
            error: function(data) {
                $('#addstaff').prop('disabled', false);
            }

        })
    }


    find = function() {
        var d = {
            "cid": $("#cust_id").val()
        }
        $.ajax({
            url: "<?=base_url("customer/find")?>",
            type: "POST",
            dataType: "TEXT",
            data: d,
            success: function(data) {
                //  alert(data);
                var d1 = JSON.parse(data);

                for (i = 0; i < d1.length; i++) {
                    $("#name").val(d1[i]['name']);
                    $("#address").val(d1[i]['address']);
                    $("#mobile").val(d1[i]['mobile']);
                    $("#email").val(d1[i]['email']);
                    $("#sponsorId").val(d1[i]['sponsor_id']);
                    $("#cid").val(d1[i]['customer_id']);
                    $('#franchiseId').val(d1[i]['franchise_id'])
                    $('#package__Id').val(d1[i]['package_name'])
                }


            },
            error: function(data) {

            }

        })
    }
    </script>