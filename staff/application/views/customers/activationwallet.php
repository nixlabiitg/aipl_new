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
                                <th class="text-center">Amount</th>
                                <th>Mode Of Payment</th>
                                
                                <th class="text-center"><?=($status==0?"Request Date":($status==1?"Approved date":"Reject date"))?></th>                                
                                <th class="text-center"><?=($status==0?"Action":($status==2?"Reject Reason":"")) ?></th>
                              
                               <th></th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 0;
                           
                            foreach ($wallet as $wl) {                                
                            ?>
                           
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td ><?= $wl['customer_id'] ?></td>      
                                    <td ><?= $wl['name'] ?></td>        
                                    <td class="text-center">&#8377;<?= $wl['amount'] ?></td>  
                                    <td ><?= $wl['mode_of_payment'] ?></td>                                   
                                    <td class="text-center"><?=($status==0?$wl['rqdate']:$wl['apdate']) ?></td>   
                                    <td class="text-center">
                                    <?php if($status==0) {?>
                                       <a id="<?=$wl['id']."/".$wl['customer_id']."/".$wl['amount']?>" class='btn btn-success m-2 w-50' onclick="approve(this);">Approve</a>
                                       <a id="<?=$wl['id']?>" class='btn btn-danger w-50' onclick="reject(this);">Reject</a>
                                  
                                    <?php } else if($status==2) {
                                     echo $wl['reject_reason'];
                                     } ?>
                                    </td>                             
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
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
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
        url:"<?=base_url("customer/rejectwallet")?>",
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

    approve=function(x)
    {
        var p=x.id.split("/");
        var d={
            "id":p[0],
            "cid":p[1],
            "amount":p[2]
        }
        $.ajax({
        url:"<?=base_url("customer/walletapprove")?>",
        type:"POST",
        dataType:"TEXT",
        data:d,
        success:function(data)
        {
            alert(data);
            alert("Approved Successfully");
            window.location.reload();
        },
        error:function(data)
        {
            alert(data);
        }

        })
    }

</script>