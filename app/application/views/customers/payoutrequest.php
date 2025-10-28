<div class="page-content bottom-content">
    <div class="container">
        <div class="col-sm mt-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Wallet Value &#8377;</label>
                    <input id="wallet" type="text" class="form-control" value="<?=round($wallet,2)?>" readonly>

                </div>
                <div class="col-12 mb-3">
                    <label for="">Request Amount &#8377;</label>
                    <input type="number" class="form-control" min=0 id="amount" onkeyup="tax_calculation(this);">

                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">TDS (5%)</label>
                    <input id="tds" type="text" class="form-control" value="" readonly>

                </div>
                <div class="col-12 mb-3">
                    <label for="">Admin Charge (10%)</label>
                    <input type="text" class="form-control" min=0 id="admincharge" readonly>

                </div>
                <div class="col-12 mb-3">
                    <label for="">Net Amount &#8377;</label>
                    <input type="text" class="form-control" min=0 id="net" readonly>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label for="">Remarks</label>
                    <textarea type="text" class="form-control" id="remarks"></textarea>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-3 text-right">
                    <button class="btn btn-primary w-100 req-btn" <?= $is_kyc_approved == 0 ? 'disabled' : '' ?> onclick="send_request();">Send Request</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
tax_calculation = function(x) {

    var amt = Number(x.value);
    var tds = amt * 5 / 100;

    var adc = amt * 10 / 100;
    var net = amt - tds - adc;

    $("#tds").val(tds.toFixed(2));
    $("#admincharge").val(adc.toFixed(2));
    $("#net").val(net.toFixed(2));
}

send_request = function() {
    if (Number($("#amount").val() < 500)) {
        alert("Request amount should be greater than 500");
        return;
    }
    
    if (Number($("#wallet").val() < 500)) {
        alert("Minimum wallet value should be ₹500 to send payout request");
        return;
    }
    if (Number($("#wallet").val() < Number($("#amount").val()))) {
        alert("No sufficient amount in wallet. Please check the amount.");
        return;
    }
    if (Number($("#amount").val() <= 0)) {

        return;
    }

    var d = {
        "amount": $("#amount").val(),
        "tds": $("#tds").val(),
        "admincharge": $("#admincharge").val(),
        "remarks": $("#remarks").val()
    }

    $('#req-btn').prop('disabled', true)

    $.ajax({
        url: "<?=base_url("Customer/send_request")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            if(data == "f"){
                alert("Repurchase amount is below ₹1000 for this month, so you cannot send a payout request.");
                $('#req-btn').prop('disabled', false)
            }else if (data == "d") {
                alert("Already have pending request. Please wait for admin's action.");
                $('#req-btn').prop('disabled', false)
            } else {
                alert("Request Sent Successfully");
                window.location.reload();
            }
        },
        error: function(data) {
            $('#req-btn').prop('disabled', false)
            alert(data);
        }

    })
}
</script>