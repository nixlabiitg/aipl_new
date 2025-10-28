<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">TRANSFER TO OTHER CUSTOMER</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
         <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-daterange" id="" data-toggle="kt-tooltip" title=""
                    data-placement="left">
                    <span class="kt-subheader__btn-daterange-title text-danger"
                        id="kt_dashboard_daterangepicker_title">Wallet : </span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date text-success"
                        id="kt_dashboard_daterangepicker_date ">&#8377;<?=$wallet;?></span>
                    <i class="fa fa-wallet text-danger"></i>
                </a>
            </div>
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
                <div class="row  text-centere">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Customer Id</label>
                            <input type="text" class="form-control" id="cust_id">
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                           <a class="btn btn-primary text-white mt-4" onclick="find();"><i class="fa fa-search"></i>Find</a>
                            
                        </div>
                    </div>
                    
                    <hr>
                </div>
               
              
                <div class="row">

                <div class="col-md-4">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input readonly type="text" class="form-control" id="name">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input readonly type="text" class="form-control" id="mobile">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                    </div>
</div>
<div class="row">
<div class="col-md-8">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea readonly class="form-control"  id="address" ></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sponsor Id</label>
                            <input readonly type="text" id="sponsorId" class="form-control" id="sponsor_id">
                        </div>
                    </div>
</div>
<div class="row">
                   
                    <div hidden class="col-md-4">
                        <div class="form-group">
                            <label>Sponsor Name</label>
                            <input readonly type="text" class="form-control" id="cid">
                        </div>
                    </div>
                </div>

                <div class="row  text-centere">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Amount (&#8377;)</label>
                            <input type="text" class="form-control" id="amount" placeholder="Enter amount">
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="form-group">
                        <button type="submit" name="addstaff" class="btn btn-primary mt-3" onclick="transfer()">Transfer</button>
                    
                        </div>
                    </div>
                    
                    <hr>
                </div>      
               
        <!-- </form> -->

        <!--end::Form-->
    </div>
</div>

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function checkPass(x) {
        var repass = $("#password").val();
        if (x.value != repass) {
            $("#msg").html("Password didn't match. Try again.");
            $("#retypepass").val('');
        }
    }

   
    transfer=function()
    {   
       
        if($("#amount").val=="") { alert("Please enter valid amount.") ; return; }
        if(!confirm("Are you sure to transfer amount now?")) return ;

        if($("#cid").val()=="") { alert("Customer Not found.") ;return;}
        var d={
            "cid":$("#cid").val(),
            "amount":$("#amount").val()
        }
        $.ajax({
            url:"<?=base_url("Customer/transferamount")?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
             
               if(data=='d')  alert("Don't have sufficient balance in activation wallet.");
                else alert("Amount Transfered Successfully")
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }

        })
    }


    find=function()
    {
               
        var d={
            "cid":$("#cust_id").val()
        }

        $.ajax({
            url:"<?=base_url("Customer/findtotransfer")?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
                //   alert(data);
                var d1=JSON.parse(data);
        
                for(i=0;i<d1.length;i++)
                {                  
                    $("#name").val(d1[i]['name']);                    
                    $("#address").val(d1[i]['address']);
                    $("#mobile").val(d1[i]['mobile']);
                    $("#email").val(d1[i]['email']);
                    $("#sponsorId").val(d1[i]['sponsor_id']);
                    $("#cid").val(d1[i]['customer_id']);                     
                }
                
                
            },
            error:function(data)
            {
alert(data);
            }

        })
    }

</script>