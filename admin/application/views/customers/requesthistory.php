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
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Request Date</th>
                            <th>Request Amount</th>
                            <th>TDS Amount</th>
                            <th>Admin Charge</th>
                            <th>Net Amount</th>
                            <?php if($status==1) { ?>
                            <th>Approved Date</th>
                            <th>Pay Slip</th>
                            <?php } ?>
                            <th>Remarks</th>
                            <?php if($status==0) { ?>
                            <th></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id = 0;
                            foreach ($request as $wl) {                                
                            ?>

                        <tr>
                            <td class="text-center"><?= ++$id ?></td>
                            <td><?= $wl['customer_id'] ?></td>
                            <td><?= $wl['name'] ?></td>
                            <td><?= $wl['date'] ?></td>
                            <td class="text-center">&#8377;<?= $wl['request_amount'] ?></td>
                            <td class="text-center">&#8377;<?= $wl['tds'] ?></td>

                            <td class="text-center">&#8377;<?= $wl['admin_charge'] ?></td>

                            <td class="text-center">&#8377;<?= $wl['request_amount']- $wl['tds']- $wl['admin_charge'] ?>
                            </td>


                            <?php if($status==1) { ?>
                            <td><?=$wl['adate']?></td>
                            <td class="text-center"><button class="btn" onclick="displaySlip('<?= $wl['pid'] ?>')"><i
                                        class="fa fa-file-pdf text-danger"></i></button></td>
                            <?php } 
                                    if($status==2) {?>
                            <td class="text-danger"><?=$wl['remarks']?></td>
                            <?php } else {?>
                            <td><?=$wl['remarks']?></td>
                            <?php } ?>
                            <?php if($status==0) { ?>
                            <td>
                                <button
                                    id="<?= $wl['pid']."/".$wl['customer_id']."/".$wl['request_amount']."/".$wl['tds']."/".$wl['admin_charge'] ?>"
                                    class="btn btn-success w-100 text-light app-btn"
                                    onclick="approve(this);">Approve</button>
                                <a id="<?= $wl['pid']."/".$wl['customer_id'] ?>"
                                    class="btn btn-danger mt-2 w-100 text-light rjt-btn" onclick="reject(this);">Reject</a>
                            </td>
                            <?php } ?>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <form action="<?php echo base_url('customer/payment_slip') ?>" id="slip-form" method="POST">
                    <input type="hidden" id="payoutid" name="payoutid">
                </form>
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
   reject=function(x)
   {
    $("#cid").val(x.id)
    $("#reject").modal("show");
   }


    reject_submit=function()
    {       
        var d={
            "id":$("#cid").val(),
            "reason":$("#reason").val()
        }
        $.ajax({
        url:"<?=base_url("customer/payoutreject")?>",
        type:"POST",
        dataType:"TEXT",
        data:d,
        success:function(data)
        {
            alert("Rejected Successfully");
            window.location.reload();
        },
        error:function(data)
        {
            alert(data);
        }

        })
    }

approve = function(x) {
    if (!confirm("Sure to approve ?")) return;
    $('.app-btn').prop('disabled', true)
    var p = x.id.split("/");
    var d = {
        "id": p[0],
        "cid": p[1],
        "amount": p[2],
        "tds": p[3],
        "admincharge": p[4]

    }
    $.ajax({
        url: "<?=base_url("customer/payoutapprove")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            // alert(data);
            alert("Approved Successfully");
           window.location.reload();
        },
        error: function(data) {
            alert(data);
            $('.app-btn').prop('disabled', false)
        }

    })
}

// reject = function(x) {

//     if (!confirm("Sure to reject ?")) return;
//     $('.rjt-btn').prop('disabled', true)
//     var p = x.id.split("/");
//     var d = {
//         "id": p[0],
//         "cid": p[1]


//     }
//     $.ajax({
//         url: "<?=base_url("customer/payoutreject")?>",
//         type: "POST",
//         dataType: "TEXT",
//         data: d,
//         success: function(data) {
//             // alert(data);
//             alert("Rejected Successfully");
//             window.location.reload();
//         },
//         error: function(data) {
//             alert(data);
//             $('.rjt-btn').prop('disabled', false)
//         }

//     })
// }

displaySlip = function(x) {
    $('#payoutid').val(x)
    $('#slip-form').submit()
}
</script>