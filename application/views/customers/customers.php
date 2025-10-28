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
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            function underCustomer($customerId)
                            {
                                $c = &get_instance();
                                $uc = "";
                                $sql = "SELECT * FROM `customer_master` WHERE `sponsor_id`='".$customerId."'";
                                $query = $c->db->query($sql);
                                $result = $query->result_array();
                                if($c->db->affected_rows()>0)
                                {
                                    foreach ($result as $rs) {                                      
                                            $uc = $rs['customer_id']."/". underCustomer($rs['customer_id']) ;
                                   
                                    }
                                }
                                else
                                {
                                    $uc = $rs['customer_id'];
                                }
                               
                                return $uc;
                            }

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

                            $custid=underCustomer($c['customer_id'])   ;
                            // echo $custid;
                            $criteria="";
                            $cd=explode("/",$custid);
                            for($i=0;$i<count($cd)-1;$i++)
                            {
                                if($i<(count($cd)-2)) $criteria.="customer_id='".$cd[$i]."' or ";
                                 else $criteria.="customer_id='".$cd[$i]."'" ;
                            }
                                // echo $criteria;
                             $criteria=($criteria!=""?"WHERE ".$criteria:" WHERE customer_id=''");   
                           
                            if($c['st']==$status)
                            {
                                ?>
                            <tr>

                                <td><?= ++$id; ?></td>
                                <td><?=$c['customer_id']?>
                                </td>
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
                                <td><?= $c['nominee_dob']?></td>
                                <td><?= $c['rgdate']?></td>
                                <!-- <td>
                                
                                <?php if($page_name=="Active Customer") { ?>
                                    <a id="<?= $c['id']?>" class="btn btn-primary text-white w-100 mt-1" onclick="approve_block(this,2);">Block</a>
                           
                                <?php }else if($page_name=="Blocked Customer") { ?>   
                                    <a id="<?= $c['id']?>" class="btn btn-primary text-white w-100 mt-1" onclick="approve_block(this,1);">Unblock</a>
                               <?php } else if($page_name=="Pending Customer") { 
                                if($c['pid']<>0) {?>      
                               <a id="<?= $c['id']?>" class="btn btn-primary text-white w-100 mt-1" onclick="approve_block(this,1);">Approve</a>
                               <a  id="<?= $c['id']?>" class="btn btn-danger text-white w-100 mt-1" onclick="reject_modal(this);">Reject</a></td>
                             <?php } } else {?>
                                <span class="badge badge-danger">Rejected</span>
                                <?php } ?> -->
                            </tr>
                            <?php } 
                                $sql="SELECT *,c.status as st,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id   ".$criteria;
                           
                                $query=$this->db->query($sql);
                                $res=$query->result_array();
                                foreach($res as $c)
                                {
                                    $registration_package_id = $c['selected_package'];
                                $package_name = '--';
                                if ($registration_package_id != '') {
                                    $get_package = $this->db->query("SELECT * FROM package_master WHERE `package_id` = '$registration_package_id'");
                                    $package_data = $get_package->row_array(); // fetch single row as array
                                    if ($package_data) {
                                        $package_name = $package_data['package_name'];
                                    }
                                }
                                if($c['st']==$status)
                                {
                                ?>
                            <tr>

                                <td><?= ++$id; ?></td>
                                <td><?=$c['customer_id']?>
                                </td>
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
                                <td><?= $c['nominee_dob']?></td>
                                <td><?= $c['rgdate']?></td>
                                <!-- <td>
                                
                                <?php if($page_name=="Active Customer") { ?>
                                    <a id="<?= $c['id']?>" class="btn btn-primary text-white w-100 mt-1" onclick="approve_block(this,2);">Block</a>
                           
                                <?php }else if($page_name=="Blocked Customer") { ?>   
                                    <a id="<?= $c['id']?>" class="btn btn-primary text-white w-100 mt-1" onclick="approve_block(this,1);">Unblock</a>
                               <?php } else if($page_name=="Pending Customer") { 
                                if($c['pid']<>0) {?>      
                               <a id="<?= $c['id']?>" class="btn btn-primary text-white w-100 mt-1" onclick="approve_block(this,1);">Approve</a>
                               <a  id="<?= $c['id']?>" class="btn btn-danger text-white w-100 mt-1" onclick="reject_modal(this);">Reject</a></td>
                             <?php } } else {?>
                                <span class="badge badge-danger">Rejected</span>
                                <?php } ?> -->
                            </tr>

                            <?php }} } ?>
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

<!--Edit Staff Modal -->
<div class="modal fade" id="editStaff" tabindex="-1" role="dialog" aria-labelledby="editStaffTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Staff Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="kt-form" method="post" action="<?php echo site_url('staff/editStaff/'); ?>"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="name"
                                        id="name" required>
                                    <input type="hidden" id="userid" name="userid">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select name="designation" id="designation" class="form-control">
                                        <option value="TC">Telecaller</option>
                                        <option value="ME">Marketing Executive</option>
                                        <option value="OE">Office Executive</option>
                                        <option value="TE">Technician</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="text" pattern="[0-9]{10}" maxlength="10" minlength="10"
                                        class="form-control" id="phone" placeholder="Enter phone no" name="phone"
                                        id="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" placeholder="Enter email id" id="email"
                                        name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="editStaff" class="btn btn-primary">Save changes</button>
                    </div>
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
</script>