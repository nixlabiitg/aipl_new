<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" placeholder="Enter amount" class="form-control" id="amount">
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label>Mode of Payment</label>
                    <select type="text" class="form-control" id="mop">
                        <option selected value="Cash">Cash</option>
                        <option value="UPI">UPI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="kt-form__actions">
                        <button name="" class="btn btn-primary w-100 mt-2" onclick="addtowallet()">Add to
                            wallet</button>
                    </div>
                </div>
            </div>
        </div>



        <!--end::Portlet-->

        <div class="mt-5">
            <h6 class="">ADD TO WALLET REQUEST</h6>
        </div>
        <div class="col-sm mt-4">
            <?php
                            $id = 0;
                            foreach ($wallet as $wl) {
                                $sl = ++$id;                                 
                            ?>
            <div class="card payment-service">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title sub-title">Request Amount : &#8377;<?= $wl['amount'] ?></h5>
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
                                            Status :
                                            <?= ($wl['status']==0?'<span class="badge badge-warning">Pending</span>':($wl['status']==1?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Rejected</span>')) ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $sl ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading1" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th>Mode of Payment</th>
                                                    <td>: <?= $wl['mode_of_payment'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Request Date</th>
                                                    <td>: <?= date('d M Y', strtotime($wl['rqdate'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks</th>
                                                    <td>:
                                                        <?= ($wl['status']==1?"Approved on ".$wl['apdate']:($wl['status']==2?"Rejected on ".$wl['apdate']."<p>".$wl['reject_reason']:'')) ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <?php } ?>
            <form id='pd' action="<?php echo base_url('product/product_details'); ?>" method="post">
                <input hidden id="pcode" name="pcode" type="text">
                <input hidden id="pname" name="pname" type="text">
            </form>
        </div>
    </div>
</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
addtowallet = function() {


    if ($("#amount") == "") {
        alert("Please enter valid amount.");
        return;
    }

    if (!confirm("Are you sure to continue?")) return;


    var d = {
        "amount": $("#amount").val(),
        "mop": $("#mop").val()
    }
    $.ajax({
        url: "<?=base_url("Customer/addtowalletrequest")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            //    alert(data);
            alert("Request Sent Successfully")
            window.location.reload();
        },
        error: function(data) {
            alert(data);
        }

    })
}
</script>