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
                    <h5 class="mb-3">Downline Member of <span class="text-danger"><?= $UPLINE ?></span></h5>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Sponsor Id</th>
                                <th>Registration Package</th>
                                <th>Package</th>
                                <th>Nominee</th>
                                <th>Nominee Relationship</th>
                                <th>Nominee Bank A/C No</th>
                                <th>Nominee DOB</th>
                                <?php if($status==1) { ?>
                                <th>Approved Date</th>
                                <?php } else {?>
                                <th>Registration Date</th>
                                <?php } ?>
                                <td>Downline List</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 0;
                            foreach ($cust as $c) {
                                $registration_package_id = $c['selected_package'];
                                $package_name = '--';
                                if ($registration_package_id != '') {
                                    $get_package = $this->db->query("SELECT * FROM package_master WHERE `package_id` = '$registration_package_id'");
                                    $package_data = $get_package->row_array();
                                    if ($package_data) {
                                        $package_name = $package_data['package_name'];
                                    }
                                }
                            ?>
                            <tr>
                                <td><?= ++$id; ?></td>
                                <td class="text-info" style="cursor: pointer;" id="<?= $c['customer_id'] ?>" onclick="viewDownline(this.id)"><?=$c['customer_id']?></td>
                                <td nowrap>
                                    <?php if ($c['profile'] == "") { ?>
                                    <img src="<?php echo base_url('') ?>uploads/dummy/dummy.png" alt="" class="shadow"
                                        style="height:60px; width:60px; border-radius:50%;">
                                    <?php } else { ?>
                                    <img src="<?php echo base_url('uploads/customer/' . $c['profile']) ?>" alt=""
                                        class="shadow" style="height:60px; width:60px; border-radius:50%;">
                                    <?php } ?>
                                    <?= $c['name'] ?>
                                </td>
                                <td><?= $c['address']?></td>
                                <td><?= $c['mobile']?></td>
                                <td><?= $c['email']?></td>
                                <td><?=$c['sponsor_id']?></td>
                                <td><?= $package_name ?></td>
                                <td><?= $c['package_name']?></td>
                                <td><?= $c['nominee']?></td>
                                <td><?= $c['relationship']?></td>
                                <td><?= $c['nominee_bank_no']?></td>
                                <td><?= $c['nominee_dob']?></td>
                                <td><?= $c['rgdate']?></td>
                                <td><button class="btn btn-success" id="<?= $c['customer_id'] ?>" onclick="viewDownline(this.id)">Downline</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <form hidden action="" id="downline_form" method="POST">
                        <input type="text" id="cust__id" name="cust__id">
                    </form>
                </div>
            </div>
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

reject_modal = function(x) {
    $("#custid").val(x.id);
    $("#reject").modal("show");
}

function approve_block(x, s) {
    var d = {
        "cid": x.id,
        "status": s

    }

    $.ajax({
        url: "<?=base_url("customer/changestatus")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            // alert(data);
            if (s == 1) alert("Customer Activated Successfully");
            else if (s == 2) alert("Customer Blocked Successfully");
            window.location.reload();
        },
        error: function(data) {

        }

    })

}

function reject_cust() {
    var d = {
        "cid": $("#custid").val(),
        "status": 3,
        "reason": $("#rejectreason").val()

    }

    $.ajax({
        url: "<?=base_url("customer/rejectcust")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            // alert(data);
            alert("Customer rejected Successfully");
            $("#reject").modal("hide");
            window.location.reload();
        },
        error: function(data) {

        }

    })

}

viewDownline = function(x){
    let customerid = x;

    $('#cust__id').val(x);
    $('#downline_form').submit();
}
</script>