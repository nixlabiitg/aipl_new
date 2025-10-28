<div class="page-content bottom-content">
    <div class="container">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Customer Id</label>
                        <input readonly type="text" class="form-control" id="cust_id"
                            value="<?=$self[0]['customer_id']?>">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Current Package</label>
                        <input readonly type="text" class="form-control" id="cust_id"
                            value="<?=$self[0]['package_name']?>">
                    </div>
                </div>

                <div class="col-md-4 mb-3 text-right">
                    <div class="form-group">
                        <?=($self[0]['upgrade_package_request']!=0?"<span class='badge badge-warning text-white'> <i class='fa fa-info-circle' aria-hidden='true' ></i>  Upgrade Request Sent</span>":"")?>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input readonly type="text" class="form-control" id="name" value="<?=$self[0]['name']?>">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input readonly type="text" class="form-control" id="mobile" value="<?=$self[0]['mobile']?>">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input readonly type="text" class="form-control" id="email" value="<?=$self[0]['email']?>">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea readonly class="form-control" id="address"><?=$self[0]['address']?></textarea>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Sponsor Id</label>
                        <input readonly type="text" id="sponsorId" class="form-control" id="sponsor_id"
                            value="<?=$self[0]['sponsor_id']?>">
                    </div>
                </div>

                <div hidden class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Sponsor Name</label>
                        <input readonly type="text" class="form-control" id="cid" value="<?=$self[0]['customer_id']?>">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Upgrade to</label>
                        <select type="text" class="form-control" id="package">
                            <option value="">Choose Package</option>
                            <?php foreach($package as $pk)
                                {
                                    $d=$pk['main_wallet']."/".$pk['digital_wallet_value']."/".$pk['shopping_coupon_value']."/".$pk['no_of_coupon']."/".$pk['magic_shopping_points']."/".$pk['gift_product_amount']."/".$pk['direct_ipp_amount']."/".$pk['project_development_benefit']."/".$pk['registration_point']."/".$pk['reffer_point']; ?>
                            <option <?=($pk['package_amount']<=$self[0]['package_amount']?"disabled":"") ?>
                                value="<?=$pk['package_id']."!".$d ?>"><?=$pk['package_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Mode of Payment</label>
                        <select type="text" class="form-control" id="mop">
                            <option selected value="Cash">Cash</option>
                            <option value="UPI">UPI</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" name="addstaff" class="btn btn-primary w-100"
                                onclick="Upgrade()">Upgrade</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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


    Upgrade = function() {

        var d1 = $("#package").val().split("!");
        if (d1[0] == "") {
            alert("Please Choose Package.");
            return;
        }

        if (!confirm("Are you sure to upgrade now?")) return;

        if ($("#cid").val() == "") {
            alert("Customer Not found.");
            return;
        }
        var d = {
            "cid": $("#cid").val(),
            "packageId": d1[0],
            "wallet": d1[1],
            "mop": $("#mop").val()
        }
        $.ajax({
            url: "<?=base_url("Customer/upgrade")?>",
            type: "POST",
            dataType: "TEXT",
            data: d,
            success: function(data) {
                //    alert(data);
                alert("Upgrade Request Sent Successfully.");
                window.location.reload();
            },
            error: function(data) {
                alert(data);
            }

        })
    }


    find = function() {

        var d = {
            "cid": $("#cust_id").val()
        }

        $.ajax({
            url: "<?=base_url("Customer/find")?>",
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
                }


            },
            error: function(data) {
                alert(data);
            }

        })
    }
    </script>