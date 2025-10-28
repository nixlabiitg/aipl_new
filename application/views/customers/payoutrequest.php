<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$page_name;?></h3>
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


    <div class="kt-portlet col-lg-6" style="margin-left:auto;margin-right:Auto;margin-top:50px;;">
        <div class="col-sm mt-4">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="">Wallet Value &#8377;</label>
                    <input id="wallet" type="text" class="form-control" value="<?=round($wallet,2)?>" readonly>

                </div>
                <div class="col-lg-6 mb-3">
                    <label for="">Request Amount &#8377;</label>
                    <input type="number" class="form-control" min=0 id="amount" onkeyup="tax_calculation(this);">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="">TDS (5%)</label>
                    <input id="tds" type="text" class="form-control" value="" readonly>

                </div>
                <div class="col-lg-6 mb-3">
                    <label for="">Admin Charge (10%)</label>
                    <input type="text" class="form-control" min=0 id="admincharge" readonly>

                </div>
                <div class="col-lg-6 mb-3">
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
                    <button class="btn btn-primary" <?= $is_kyc_approved == 0 ? 'disabled' : '' ?> onclick="send_request();">Send Request</button>
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

    $('#req-btn').prop('disabled', true)

    var d = {
        "amount": $("#amount").val(),
        "tds": $("#tds").val(),
        "admincharge": $("#admincharge").val(),
        "remarks": $("#remarks").val()
    }
    $.ajax({
        url: "<?=base_url("Customer/send_request")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            // alert(data);
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