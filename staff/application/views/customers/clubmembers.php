
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
                                <th>Package</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            foreach ($club as $c) { ?>
                            <tr>
                                <td><?= ++$id; ?></td>
                                <td><?=$c['customer_id']?>                                 
                                </td>
                                <td nowrap>
                                    <?php if ($c['profile'] == "") { ?>
                                    <img src="<?php echo base_url('../') ?>uploads/dummy/dummy.png" alt="" class="shadow"
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
                                <td><?= $c['package_name']?></td>
                                
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
    <input type="text" name="customerid" id="customerid" >
    <input type="text" name="custname" id="custname">
</form>
<form id="gen1" hidden action="<?=base_url('customer/autopool1geanology')?>" method="POST">
    <input type="text" name="customerid1" id="customerid1" >
    <input type="text" name="custname1" id="custname1">
</form>
<form id="gen2" hidden action="<?=base_url('customer/autopool2geanology')?>" method="POST">
    <input type="text" name="customerid2" id="customerid2" >
    <input type="text" name="custname2" id="custname2">
</form>
<!-- REJECT Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
