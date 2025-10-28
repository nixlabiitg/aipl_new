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
                                <th>Id</th>
                                <th>Name</th>
                                <!-- <th>Rank Achieved</th> -->
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Sponsor Id</th>
                                <th>Registration Package</th>
                                <th>Activation Package</th>
                                <th>Nominee</th>
                                <th>Relationship</th>
                                <th>Nominee Bank A/C No</th>
                                <th>Nominee DOB</th>
                                <?php if($page_name=="Active Customer") { ?>
                                <th>Approved Date</th>
                                <?php }else if($page_name=="Blocked Customer") { ?>
                                <th>Blocked Date</th>
                                <?php } else if($page_name=="Pending Customer") {  ?>
                                <th>Registration Date</th>
                                <?php } else if($page_name=="Upgrade Request") {  ?>
                                <th>Request Date</th>
                                <?php  } else {?>
                                <th>Reject Date</th>
                                <?php } ?>
                                <th>Action</th>
                                <th>Under Franchise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            foreach ($cust as $c) {
                                $registration_package_id = $c['selected_package'];
                                $package_name = '--';
                                if ($registration_package_id != '') {
                                    $get_package = $this->db->query("SELECT * FROM package_master WHERE `package_id` = '$registration_package_id'");
                                    $package_data = $get_package->row_array(); // fetch single row as array
                                    if ($package_data) {
                                        $package_name = $package_data['package_name'];
                                    }
                                }
                                
                            ?>
                            <tr>
                                <td><?= ++$id; ?></td>
                                <td><?=$c['customer_id']?>
                                </td>
                                <td nowrap>
                                    <?php if ($c['profile'] == "") { ?>
                                    <img src="<?php echo base_url('../') ?>uploads/dummy/dummy.png" alt=""
                                        class="shadow" style="height:60px; width:60px; border-radius:50%;">
                                    <?php } else { ?>
                                    <img src="<?php echo base_url('uploads/customer/' . $c['profile']) ?>" alt=""
                                        class="shadow" style="height:60px; width:60px; border-radius:50%;">
                                    <?php } ?>
                                    <?= $c['name'] ?>
                                    <i class="fa fa-edit text-success"
                                        id="<?= $c['id'].'/'.$c['name'].'/'.$c['address'].'/'.$c['mobile'].'/'.$c['email'].'/'.$c['nominee'].'/'.$c['relationship'].'/'.$c['nominee_bank_no'].'/'.$c['nominee_dob'] ?>"
                                        onclick="changeName(this)" style="cursor:pointer;"></i>
                                    <i class="fa fa-eye text-info" style="cursor:pointer;"
                                        onclick="showPassword('<?= $c['customer_id'] ?>')"></i>
                                </td>
                                <!-- <td><?=$c['position']?>                                  -->
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
                                <td><?= date('d F Y', strtotime($c['nominee_dob']))?></td>
                                <td><?= $c['rgdate']?></td>
                                <td>

                                    <?php if($page_name=="Active Customer") { ?>
                                    <a id="<?= $c['customer_id']."/".$c['name']?>"
                                        class="btn btn-primary text-white mt-1" onclick="genealogy(this);">Genealogy</a>
                                    <a id="<?= $c['customer_id']."/".$c['name']?>"
                                        class="btn btn-primary text-white mt-1" onclick="genealogya1(this);">Autopool 1
                                        Genealogy</a>
                                    <a id="<?= $c['customer_id']."/".$c['name']?>"
                                        class="btn btn-primary text-white mt-1" onclick="genealogya2(this);">Autopool 2
                                        Genealogy</a>
                                    <a id="<?= $c['customer_id']."/".$c['name']?>"
                                        class="btn btn-primary text-white mt-1" onclick="clubgenealogy(this);">Club
                                        Autopool Genealogy</a>

                                    <a id="<?= $c['id']?>" class="btn btn-danger text-white mt-1"
                                        onclick="unblock_block(this,2);">Block</a>

                                    <?php } else if($page_name=="Blocked Customer") { ?>
                                    <a id="<?= $c['id']?>" class="btn btn-success text-white w-100 mt-1"
                                        onclick="unblock_block(this,1);">Unblock</a>
                                    <?php } else if($page_name=="Pending Customer") { 
                                if($c['pid']<>0) {?>
                                    <a id="<?= $c['customer_id']."/".$c['autopool_allow']."/".$c['registration_point']."/".$c['sponsor_id']."/".$c['reffer_point']?>"
                                        class="btn btn-primary text-white w-100 mt-1"
                                        onclick="approve(this,1);">Approve</a>
                                    <a id="<?= $c['id']?>" class="btn btn-danger text-white w-100 mt-1"
                                        onclick="reject_modal(this);">Reject</a>
                                </td>
                                <?php } } else if($page_name=="Upgrade Request") {  ?>
                                <a id="<?= $c['customer_id']."/".$c['upgrade_package_request']."/".$c['autopool_allow']."/".$c['sponsor_id']?>"
                                    class="btn btn-primary text-white w-100 mt-1" onclick="upgrade(this);">Approve</a>
                                <a id="<?= $c['customer_id']."/".$c['upgrade_package_request']?>"
                                    class="btn btn-danger text-white w-100 mt-1"
                                    onclick="upgrade_reject_modal(this);">Reject</a></td>

                                <?php }  else {?>
                                <span class="badge badge-danger">Rejected</span>
                                <?php } ?>
                                <td>
                                    <?php if($page_name=="Pending Customer") { ?>
                                    <div style="width: 300px;">
                                        <form action="<?php echo base_url('customer/update_franchise_id') ?>" method="POST">
                                            <label for="">Choose Franchise</label>
                                            <select name="frn_id" id="frn_id" class="form-control" style="width: 200px;" required>
                                                <option value="" selected disabled>Select an option</option>
                                                <?php foreach($FRANCHISE as $data){ ?>
                                                <option <?= $data->franchise_id ==  $c['franchise_id'] ? 'selected' : '' ?> value="<?= $data->franchise_id ?>"><?= $data->name ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" value="<?= $c['customer_id'] ?>" id="cust__id" name="cust__id">

                                            <button type="submit" class="btn btn-info mt-2">Submit</button>
                                        </form>
                                    </div>
                                    <?php }else{ ?>
                                        <?= $c['franchise_id'] ?? '--' ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="gen" hidden action="<?=base_url('customer/geanology')?>" method="POST">
    <input type="text" name="customerid" id="customerid">
    <input type="text" name="custname" id="custname">
</form>
<form id="gen1" hidden action="<?=base_url('customer/autopool1geanology')?>" method="POST">
    <input type="text" name="customerid1" id="customerid1">
    <input type="text" name="custname1" id="custname1">
</form>
<form id="gen2" hidden action="<?=base_url('customer/autopool2geanology')?>" method="POST">
    <input type="text" name="customerid2" id="customerid2">
    <input type="text" name="custname2" id="custname2">
</form>
<form id="genclub" hidden action="<?=base_url('customer/clubautopoolgeanology')?>" method="POST">
    <input type="text" name="customerid2" id="customeridclub">
    <input type="text" name="custname2" id="custnameclub">
</form>
<!-- REJECT Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <label>Reject Reason</label>
            </div>
            <div class="col-lg-12">
                <textarea rows="5" class="form-control" id="rejectreason"></textarea>
            </div>
            <input type="text" hidden id="custid">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="reject_cust();">Submit</button>
            </div>

        </div>
    </div>
</div>

<!-- Upgrade REJECT Modal -->
<div class="modal fade" id="upgradereject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <label>Reject Reason</label>
            </div>
            <div class="col-lg-12">
                <textarea rows="5" class="form-control" id="urejectreason"></textarea>
            </div>
            <input type="text" hidden id="ucustid">
            <input type="text" hidden id="upackageid">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="reject_upgrade_request();">Submit</button>
            </div>

        </div>
    </div>
</div>
<!-- profile Modal -->
<div class="modal fade" id="profileImage" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('staff/uploadProfileImage') ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="profile" id="" class="form-control">
                        <input type="hidden" id="staffid" name="staffid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit name Modal -->
<div class="modal fade" id="nameModal" tabindex="-1" role="dialog" aria-labelledby="nameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameModalLabel">Edit Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('customer/changeName') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="cutomer_name" placeholder="Name"
                                    id="cutomer_name" required>
                                <input type="hidden" id="cutomer_id" name="cutomer_id">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea type="text" class="form-control" rows="1" placeholder="Address"
                                    name="cutomer_address" id="cutomer_address" required></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Contact No</label>
                                <input type="text" class="form-control" placeholder="Contact no" pattern="[0-9]{10}"
                                    minlength="10" maxlength="10" name="cutomer_contact" id="cutomer_contact" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="cutomer_email"
                                    id="cutomer_email" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nominee Name</label>
                                <input type="text" name="nominee" id="nominee" placeholder="Enter nominee name"
                                    class="form-control border-dark">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Relationship</label>
                                <input type="text" name="relationship" id="relationship"
                                    placeholder="Enter relationship with nominee" class="form-control border-dark">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nominee Bank A/C No</label>
                                <input type="text" name="bankno" id="bankno" placeholder="Enter account no"
                                    class="form-control border-dark">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nominee DOB</label>
                                <input type="date" name="dobdate" id="dobdate" placeholder="Enter dob"
                                    value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>"
                                    class="form-control border-dark">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="changeName" class="btn btn-primary">Save changes</button>
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
upgrade_reject_modal = function(x) {
    var p = x.id.split("/");
    $("#ucustid").val(p[0]);
    $("#upackageid").val(p[1]);
    $("#upgradereject").modal("show");

}

reject_modal = function(x) {
    $("#custid").val(x.id);
    $("#reject").modal("show");
}

function upgrade(x) {
    var p = x.id.split("/");


    var d = {
        "cid": p[0],
        "packageId": p[1],
        "autopoolallow": p[2],
        "sponsorid": p[3]
    }
    $.ajax({
        url: "<?=base_url("customer/upgrade")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            alert(data);
            alert("Upgraded Successfully");

            window.location.reload();
        },
        error: function(data) {

        }

    })

}

function unblock_block(x, s) {
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


function approve(x, s) {

    var p = x.id.split("/");
    var d = {
        "cid": p[0],
        "status": s,
        "autopoolallow": p[1],
        "registrationpoint": p[2],
        "sponsorid": p[3],
        "refferpoin": p[4]

    }

    $.ajax({
        url: "<?=base_url("customer/approve")?>",
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

function reject_upgrade_request() {
    if (!confirm("Aru you sure to reject upgrade request ?")) return;
    var d = {
        "cid": $("#ucustid").val(),
        "packageid": $("#upackageid").val(),
        "reason": $("#urejectreason").val()

    }

    $.ajax({
        url: "<?=base_url("customer/rejectupgraderequest")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            // alert(data);
            alert("Upgrade Request Rejected");
            $("#reject").modal("hide");
            window.location.reload();
        },
        error: function(data) {

        }

    })

}
</script>
<script>
genealogy = function(x) {

    var p = x.id.split("/");
    $("#customerid").val(p[0]);
    $("#custname").val(p[1]);
    $("#gen").submit();
}

genealogya1 = function(x) {

    var p = x.id.split("/");
    $("#customerid1").val(p[0]);
    $("#custname1").val(p[1]);
    $("#gen1").submit();
}

genealogya2 = function(x) {

    var p = x.id.split("/");
    $("#customerid2").val(p[0]);
    $("#custname2").val(p[1]);
    $("#gen2").submit();
}

clubgenealogy = function(x) {

    var p = x.id.split("/");
    $("#customeridclub").val(p[0]);
    $("#custnameclub").val(p[1]);
    $("#genclub").submit();
}
</script>

<script>
function showPassword(x) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url('customer/show_password') ?>',
        data: {
            id: x
        },

        success: function(data) {
            alert(data);
        }
    })
}
</script>

<script>
function changeName(x) {
    var data = x.id.split('/');
    var id = data[0];
    var name = data[1];
    var address = data[2];
    var contact = data[3];
    var email = data[4];
    var nominee = data[5];
    var relationship = data[6];
    var nominee_ac = data[7];
    var nominee_dob = data[8];

    $('#nameModal').modal('show');
    $('#cutomer_name').val(name);
    $('#cutomer_id').val(id);
    $('#cutomer_address').val(address);
    $('#cutomer_contact').val(contact);
    $('#cutomer_email').val(email);
    $('#nominee').val(nominee);
    $('#relationship').val(relationship);
    $('#bankno').val(nominee_ac);
    $('#dobdate').val(nominee_dob);
}
</script>