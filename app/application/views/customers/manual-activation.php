<div class="page-content bottom-content">
    <div class="container">
        <div class="text-center mb-3">
            <a class="btn btn-info position-relative shadow-info w-100 my-2 ms-2" style="font-size:20px;">
                Wallet : &#8377;<?=$wallet;?>
            </a>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" placeholder="Customer Id" class="form-control" id="cust_id">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <a class="btn btn-primary text-white" onclick="find();"><i class="fa fa-search"></i>Find</a>

                </div>
            </div>
        </div>

        <div class="divider border-secondary inner-divider transparent mt-3 mb-0"><span>Customer Details</span></div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input readonly type="text" class="form-control" id="name">
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Mobile</label>
                    <input readonly type="text" class="form-control" id="mobile">
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <textarea readonly class="form-control" id="address" rows="1"></textarea>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Sponsor Id</label>
                    <input readonly type="text" id="sponsorId" class="form-control">
                </div>
            </div>

            <div hidden class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Sponsor Name</label>
                    <input readonly type="text" class="form-control" id="cid">
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

            <div class="col-md-4 mb-3">
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
                        <button type="submit" name="addstaff" id="addstaff" class="btn btn-primary w-100"
                            onclick="activate()">Activate</button>
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
        url: "<?=base_url("Customer/activate")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            //    alert(data);
            if (data == 'd') {
                alert("Don't have sufficient balance in activation wallet.");
                $('#addstaff').prop('disabled', false);
            } else alert("Customer Activated Successfully")
            window.location.reload();
        },
        error: function(data) {
            alert(data);
            $('#addstaff').prop('disabled', false);
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
                $('#franchiseId').val(d1[i]['franchise_id'])
                $('#package__Id').val(d1[i]['package_name'])
            }


        },
        error: function(data) {
            alert(data);
        }

    })
}
</script>