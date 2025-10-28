
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
                                <th>Franchise Name</th>
                                <th>Package Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <?php if($status==0) { ?>
                                    <th>Registration Date</th>
                                <th>Action</th>
                                <?php } else if($status==1) {?>
                                    <th>Approve Date</th>
                                    <th>Action</th>
                                <?php } else if($status==2) {?>
                                    <th>Blocked Date</th>
                                    
                                    <th>Action</th>
                               <?php } else {?>
                                    <th>Reject Date</th>
                                    <th>Reject Reason</th>

                                <?php }?>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            foreach ($cust as $c) {
                                $packageId = $c['package_id'];
                                $packageName = $this->Crud->ciRead("franchise_package_master", "`id` = '$packageId'");
                            ?>
                            <tr>
                                <td><?= ++$id; ?></td>
                                <td nowrap>                                   
                                    <?= $c['name'] ?>
                                </td>
                                <td><?= $packageName[0]->package_name ?></td>
                                <td><?= $c['address']?></td>
                                <td><?= $c['mobile']?></td>
                                <td><?= $c['email']?></td>
                                <?php if($status==0) { ?>
                                    <td><?= $c['cdate']?></td>
                                    <td><a class="btn btn-success text-white w-100" id="<?=$c['franchise_id']."/".$c['mobile'] ?>" onclick="approve(this);">Approve</a><br>
                                    <a class="btn btn-danger text-white mt-2 w-100" id="<?=$c['franchise_id']."/".$c['mobile']."/3" ?>" onclick="relject_block(this,3);">Reject</a></td>
                     
                                <?php } else if($status==1) {?>
                                    <td><?= $c['adate']?></td>
                                    <td><a class="btn btn-danger text-white mt-2 w-100" id="<?=$c['franchise_id']."/".$c['mobile']."/2" ?>" onclick="block_unblock(this,2);">Block</a></td>
                                <?php } else if($status==2) {?>
                                    <td><?= $c['adate']?></td>
                                 
                                    <td><a class="btn btn-success text-white mt-2 w-100" id="<?=$c['franchise_id']."/".$c['mobile'] ?>" onclick="block_unblock(this,1);">Unblock</a></td>
                    

                               <?php } else {?>
                                <td><?= $c['adate']?></td>
                                <td><?= $c['reject_reason']?></td>                               
                                
                                <?php }?>
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
</div>
<!-- REJECT Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <label id='r' >Reject Reason</label>              
            </div>
            <div class="col-lg-12">
                  <textarea rows="5" class="form-control" id="rejectreason"></textarea>
            </div>
       <input type="text" hidden id="fid">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="reject_frnach();">Submit</button>
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

relject_block=function(x,s)
{
    if(s==3) $("#r").html("Reject Reason");
    else $("#r").html("Blocked Reason");
    $("#fid").val(x.id);
    $("#reject").modal("show");
}

approve=function(x)
{
    
    if(!confirm("Sure to approve ?")) return;    
    var p=x.id.split("/");
    var d={
        "fid":p[0],
        "phone":p[1]
    }
    $.ajax({
           
            url: '<?php echo base_url('franchise/approve_francise') ?>',
            type: 'POST',
            dataType:"TEXT",
            data: d,
            success: function(data) {
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }

        });
}


reject_frnach=function(x)
{
    if($("#rejectreason").val()=="") { alert("Please enter reason."); return; }
    
    
    var p=$("#fid").val().split("/");
    if(!confirm("Sure to "+(p[2]==2?"block?":"reject?"))) return;
  
    var d={
        "fid":p[0],
        "phone":p[1],
        "status":p[2],
        "reason":$("#rejectreason").val()
    }
    $.ajax({
           
            url: '<?php echo base_url('franchise/reject_block_francise') ?>',
            type: 'POST',
            dataType:"TEXT",
            data: d,
            success: function(data) {

                // alert(data);
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }

        });
}


block_unblock=function(x,s)
{
   
    if(!confirm("Sure to "+(s==2?"block?":"unblock?"))) return;
    var p=x.id.split("/");
    var d={
        "fid":p[0],
        "phone":p[1],
        "status":s,
        "reason":''
    }
    $.ajax({
           
            url: '<?php echo base_url('franchise/reject_block_francise') ?>',
            type: 'POST',
            dataType:"TEXT",
            data: d,
            success: function(data) {

                // alert(data);
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }

        });
}
</script>