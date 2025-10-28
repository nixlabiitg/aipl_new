<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$page_name?></h3>

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
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <?php if($page_name=="Customer KYC Approved" || $page_name=="Customer KYC Rejected") {?>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <?php } else { ?>
                                <th>Franchise Id</th>
                                <th>Franchise Name</th>

                                <?php }?>
                                <th>A/c No</th>
                                <th>IFSC Code</th>
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                <th>Payee Name</th>
                                <th>PAN No</th>
                                <th>Aadhar No</th>
                                <th>Nominee</th>
                                <th>Relationship</th>
                                <th>Nominee Bank A/C No</th>
                                <th>Nominee Bank IFSC</th>
                                <th>Nominee DOB</th>
                                <?php if($page_name=="Customer KYC Approved"  || $page_name=="Franchise KYC Approved") {?>
                                <th>Approve On</th>
                                <?php } else { ?>
                                <th>Rejected On</th>
                                <?php }?>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $id=0;
                            foreach($kyc as $k) {
                                if($page_name=="Customer KYC Request") {
                                    $cid = $k['customer_id'];
                                    $nominee_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$cid'");
                                    } else {
                                        $cid = $k['franchise_id'];
                                        $nominee_details = $this->Crud->ciRead("franchise_master", "`franchise_id` = '$cid'");
                                    }
                                $id++ ?>
                            <tr>
                                <td><?=$id?></td>
                                <?php if($page_name=="Customer KYC Approved" || $page_name=="Customer KYC Rejected" ) {?>
                                <td><?=$k['customer_id']?></td>
                                <td><?=$k['name']?></td>

                                <?php } else { ?>
                                <td><?=$k['franchise_id']?></td>
                                <td><?=$k['name']?></td>
                                <?php }?>

                                <td><?=$k['ac_no']?></td>
                                <td><?=$k['ifsc_code']?></td>
                                <td><?=$k['bank_name']?></td>
                                <td><?=$k['branch_name']?></td>
                                <td><?=$k['payee_name']?></td>
                                <td><?=$k['pan_no']?></td>
                                <td><?=$k['aadhar_no']?></td>
                                <td><?= $nominee_details[0]->nominee ?></td>
                                <td><?= $nominee_details[0]->relationship ?></td>
                                <td><?= $nominee_details[0]->nominee_bank_no ?></td>
                                <td><?= $nominee_details[0]->nominee_bank_ifsc ?></td>
                                <td><?= $nominee_details[0]->nominee_dob ? date('d m Y', strtotime($nominee_details[0]->nominee_dob)) : '' ?></td>
                                <td><?=$k['adate']?></td>
                                <td><button
                                        id="<?= $k['customer_id'].'/'.$k['ac_no'].'/'.$k['ifsc_code'].'/'.$k['bank_name'].'/'.$k['branch_name'].'/'.$k['payee_name'].'/'.$k['pan_no'].'/'.$k['aadhar_no'] ?>"
                                        onclick="updateKyc(this)" class="btn btn-info">Update KYC</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- REJECT Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <label>Reject Reason</label>
            </div>
            <div class="col-lg-12">
                <textarea rows="5" class="form-control"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>
    </div>
</div>

<!-- Update KYC Modal -->
<div class="modal fade" id="updateKycModal" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3>Update KYC</h3>
            </div>
            <form action="<?php echo base_url('customer/update_kyc') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Bank Name</label>
                                <input type="text" placeholder="Enter bank name" name="bankname" id="bankname" class="form-control" required>
                                <input type="hidden" id="customerid" name="customerid">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Branch Name</label>
                                <input type="text" placeholder="Enter branch name" name="branchname" id="branchname" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">A/C No</label>
                                <input type="text" placeholder="Enter account no" name="acno" id="acno" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">IFSC Code</label>
                                <input type="text" placeholder="Enter IFSC" name="ifsc" id="ifsc" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">PAN No</label>
                                <input type="text" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" minlength="10" maxlength="10" placeholder="Enter pan no" name="panno" id="panno" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Aadhar No</label>
                                <input type="text" pattern="[2-9][0-9]{3}[0-9]{4}[0-9]{4}" placeholder="Enter aadhar no" title="1234 1234 1234" name="aadharno" id="aadharno" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Payee Name</label>
                                <input type="text" placeholder="Enter bank name" name="payee" id="payee" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).on('click', '.edit', function(e) {
    $('#name').val($(this).data('name'));
    $('#userid').val($(this).data('id'));
    $('#phone').val($(this).data('phone'));
    $('#email').val($(this).data('email'));
    $('#designation').val($(this).data('designation'));
})
</script>

<script>
$(document).on('click', '.profileimage', function(e) {
    $('#staffid').val($(this).data('id'));
})

reject_modal = function() {
    $("#reject").modal("show");
}


function approve_reject(x, s) {
    if (!confirm("Sure to " + (s == 1 ? "approve?" : "reject?"))) return;
    var d = {
        "id": x.id,
        "status": s

    }

    $.ajax({
        url: "<?=base_url("report/approve_reject")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            alert(data);
            if (s == 1) alert("KYC Approved Successfully");
            else if (s == 2) alert("KYC Rejected Successfully");
            window.location.reload();
        },
        error: function(data) {

        }

    })

}


updateKyc = function(x) {
    let dt = x.id.split('/');
   
    $('#customerid').val(dt[0]);
    $('#acno').val(dt[1]);
    $('#ifsc').val(dt[2]);
    $('#bankname').val(dt[3]);
    $('#branchname').val(dt[4]);
    $('#payee').val(dt[5]);
    $('#panno').val(dt[6]);
    $('#aadharno').val(dt[7]);
    $('#updateKycModal').modal('show')
}
</script>