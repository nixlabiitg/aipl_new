<div class="page-content bottom-content">
    <div class="container">
        <div class="col-sm mt-4">
            <?php
            $id = 0;
            foreach ($request as $wl) {
                $sl = ++$id;                            
            ?>
            <div class="card payment-service">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title sub-title">Request Amt : &#8377;<?= $wl['request_amount'] ?></h5>
                    <div class="active-style"></div>
                </div>
                <div class="card-body">
                    <ul class="card-list">
                        <li>
                            <div class="accordion style-2" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading1">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse<?= $sl ?>"
                                            aria-expanded="false" aria-controls="collapse<?= $sl ?>">
                                            <i class="fa-solid fa-calendar icon-bx me-2"></i>
                                            Request Date :
                                            <?= date('d M Y, h:i A', strtotime($wl['date'])) ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $sl ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading1" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <table class="table table-bordered table-striped">
                                                <?php if($status==1) { ?>
                                                <tr>
                                                    <th>Approved Date</th>
                                                    <td>: <?= date('d M Y, h:i A', strtotime($wl['apdate']))?></td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>TDS Amount</th>
                                                    <td>: &#8377;<?= $wl['tds'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Admin Charge</th>
                                                    <td>: &#8377;<?= $wl['admin_charge'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Net Amount</th>
                                                    <td>:
                                                        &#8377;<?= $wl['request_amount']- $wl['tds']- $wl['admin_charge'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks</th>
                                                    <td>: <?=$wl['remarks']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Slip</th>
                                                    <td>: <button class="btn"
                                                            onclick="displaySlip('<?= $wl['id'] ?>')"><i
                                                                class="fa fa-file-pdf text-danger"></i></button></td>
                                                </tr>
                                            </table>
                                            <form action="<?php echo base_url('customer/payment_slip') ?>"
                                                id="slip-form" method="POST">
                                                <input type="hidden" id="payoutid" name="payoutid">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- REJECT Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <input hidden type="text" id="cid">
            <div class="modal-header ">
                <label>Reject Reason</label>
            </div>
            <div class="col-lg-12">
                <textarea rows="5" class="form-control" id="reason"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="reject_submit();">Submit</button>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
reject = function(x) {
    $("#cid").val(x.id)
    $("#reject").modal("show");
}


reject_submit = function() {
    var d = {
        "id": $("#cid").val(),
        "reason": $("#reason").val()
    }
    $.ajax({
        url: "<?=base_url("customer/rejectwallet")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            alert("Rejected Successfully");
            window.location.reload();
        },
        error: function(data) {
            alert(data);
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

displaySlip = function(x){
        $('#payoutid').val(x)
        $('#slip-form').submit()
    }
</script>