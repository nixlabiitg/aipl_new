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


    <div class="kt-portlet">
        <div class="col-sm mt-4">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Franchise Id</th>
                            <th>Franchise Name</th>
                            <th>Contact No</th>
                            <th class="text-center">Wallet Value</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id = 0;                           
                            foreach ($franchise as $wl) {                                
                            ?>
                        <tr>
                            <td class="text-center"><?= ++$id ?></td>
                            <td><?= $wl['franchise_id'] ?></td>
                            <td><?= $wl['name'] ?></td>
                            <td><?= $wl['mobile'] ?></td>
                            <td class="text-right">&#8377;<?= $wl['wallet'] ?></td>
                            <td><a id="<?=$wl['franchise_id']."/".$wl['name']."/".$wl['wallet']?>"
                                    class="btn btn-primary text-white" onclick="payout(this);">Payout</a></td>
                            <td></td>
                            <td></td>


                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- REJECT Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <input hidden type="text" id="cid">

            <div class="modal-header ">
                <label>Payout</label>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <label>Franchise Name</label>
                        <input class="form-control" id="name" readonly>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <label>Available Amount</label>
                        <input class="form-control" id="amount" readonly>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <label>Withdraw Amount</label>
                        <input class="form-control" placeholder="Amount" id="wamount">
                    </div>
                    <div class="col-lg-4 mt-4">
                        <label>TDS(<span id="tds_percentage"><?= $settings[0]->tds ?></span>%)</label>
                        <input class="form-control" placeholder="Amount" id="tds_charge" readonly>
                    </div>
                    <div class="col-lg-4 mt-4">
                        <label>Admin Charge(<span id="admin_percentage"><?= $settings[0]->admIn_charge ?></span>%)</label>
                        <input class="form-control" placeholder="Amount" id="admin_charge" readonly>
                    </div>
                    <div class="col-lg-4 mt-4">
                        <label>Payable Amount</label>
                        <input class="form-control" placeholder="Amount" id="payable" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">

                        <label>Remarks</label>
                        <textarea rows="4" class="form-control" id="remarks"></textarea>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" id="payout" class="btn btn-primary" onclick="payment();">Payout</button>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
payout = function(x) {
    var p = x.id.split("/");

    $("#cid").val(p[0]);
    $("#name").val(p[1]);
    $("#amount").val(p[2]);

    $("#reject").modal("show");
}

$(document).on('input', '#wamount', function(){
    let amount = Number($("#amount").val());
    let withdraw_amount = Number($(this).val());
    let tds_percentage = Number($('#tds_percentage').html());
    let admin_percentage = Number($('#admin_percentage').html());

    // Calculate tds
    let tds = withdraw_amount * tds_percentage/100;
    $('#tds_charge').val(tds);

    // Calculate admin charge
    let admin_charge = withdraw_amount * admin_percentage/100;
    $('#admin_charge').val(admin_charge);

    let payable = withdraw_amount - (tds + admin_charge);
    $('#payable').val(payable);
})


payment = function() {
    if (!confirm("Sure to pay ?")) return;

    let amount = Number($("#amount").val());
    let withdraw_amount = Number($('#wamount').val());
    let tds = $('#tds_charge').val();
    let admin_charge = $('#admin_charge').val();

    if(withdraw_amount == ''){
        alert('Please enter withdraw amount');
        return;
    }


    if(withdraw_amount > amount){
        alert('Withdraw amount is greater than available amount.')
        return
    }

    var d = {
        "fid": $("#cid").val(),
        "amount": withdraw_amount,
        "tds": tds,
        "admin_charge": admin_charge,
        "remarks": $("#remarks").val()
    }

    $('#payout').prop('disabled', true)

    $.ajax({
        url: "<?=base_url("franchise/payment")?>",
        method: "POST",
        data: d,
        success: function(data) {
            if (data == "d"){
                alert("KYC Not Updated. Inform Franchise to update KYC.")
                $('#payout').prop('disabled', false)
            } 
            else {
                alert("Paid Successfully");
                window.location.reload();
            }

        },
        error: function(data) {
            alert(data);
            $('#payout').prop('disabled', false)
        }

    })
}

approve = function(x) {
    var p = x.id.split("/");
    var d = {
        "id": p[0],
        "cid": p[1],
        "amount": p[2]
    }
    $.ajax({
        url: "<?=base_url("customer/walletapprove")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            alert(data);
            alert("Approved Successfully");
            window.location.reload();
        },
        error: function(data) {
            alert(data);
        }

    })
}
</script>