<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">ADD TO WALLET</h3>
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
        <!--begin::Form-->
        <!-- <form class="kt-form" method="post" action="<?php echo site_url('staff/addNewStaff/'); ?>" enctype="multipart/form-data"> -->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Amount</label>
                            <input  type="number" class="form-control" id="amount" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Mode of Payment</label>
                            <select  type="text" class="form-control" id="mop">                                     
                              
                                     <option selected value="Cash">Cash</option>
                                     <option value="UPI">UPI</option>
                               
                            </select> 
                        </div>
                    </div>

                   
                
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="kt-form__actions mt-4">
                                 <button name="" class="btn btn-primary w-25 mt-2" onclick="addtowallet()">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
           
</div>


</div>


<!--end::Portlet-->

<div class="kt-portlet__main">
            <h5 class="kt-subheader__title">ADD TO WALLET REQUEST</h5>
            <!-- <span class="kt-subheader__separator kt-subheader__separator--v"></span> -->
</div>
<div class="kt-portlet">
            <div class="col-sm mt-4">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Amount</th>
                                <th>Mode Of Payment</th>
                                <th class="text-center">Request Date</th>                                
                                <th class="text-center">Status</th>
                               <th>Remarks</th>
                               <th></th>
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
                                    <td class="text-center">&#8377;<?= $wl['amount'] ?></td>  
                                    <td ><?= $wl['mode_of_payment'] ?></td>                                   
                                    <td class="text-center"><?= $wl['rqdate'] ?></td>                                   
                                    <td class="text-center"><?= ($wl['status']==0?'<span class="badge badge-warning w-100">Pending</span>':($wl['status']==1?'<span class="badge badge-success w-100">Approved</span>':'<span class="badge badge-danger w-100">Rejected</span>')) ?></td>
                                    <td><?= ($wl['status']==1?"Approved on ".$wl['apdate']:($wl['status']==2?"Rejected on ".$wl['apdate']."<p>".$wl['reject_reason']:'')) ?></td>
                                    <td></td>
                                    <td></td>
                                   
                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form id='pd' action="<?php echo base_url('product/product_details'); ?>" method="post">
                        <input hidden id="pcode" name="pcode" type="text">
                        <input hidden id="pname" name="pname" type="text">
                    </form>
                </div>
            </div>
        </div>
    </div>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
   
   
    addtowallet=function()
    {

        
        if($("#amount")=="") { alert("Please enter valid amount.") ; return; }

        if(!confirm("Are you sure to continue?")) return ;
 
       
        var d={
            "amount":$("#amount").val(),
            "mop":$("#mop").val()
        }
        $.ajax({
            url:"<?=base_url("Customer/addtowalletrequest")?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
            //    alert(data);
              alert("Request Sent Successfully")
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }

        })
    }



</script>