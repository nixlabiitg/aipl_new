<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
      <!-- begin:: Content Head -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">PACKAGE</h3>
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
    
        <!-- <h5>PACKAGE</h5>
        <hr> -->
     
        <?php $this->load->view('messages'); ?>
        <div class="row">
           
              <div class="col-lg-12 mt-3">
                <label for="">Package Name</label>
                <input type="text" class="form-control"  id="packagename">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Package Amount (&#8377;)</label>
                <input type="number" class="form-control"  id="p_amount">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Digital Wallet (&#8377;)</label>
                <input type="number" class="form-control"  id="dwallet">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Shopping Coupon Amount (&#8377;)</label>
                <input type="number" class="form-control"  id="quopon">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">No of coupons (nos)</label>
                <input type="number" class="form-control"  id="noquopon">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Magic Shopping Point</label>
                <input type="number" class="form-control"  id="magicpoint">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Gift Product (&#8377;)</label>
                <input type="number" class="form-control"  id="giftamt">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Direct IPP Sponsor Amount (&#8377;)</label>
                <input type="number" class="form-control"  id="sponsoramt">

              </div>

              <div class="col-lg-3 mt-3">
                <label for="">Registration Point</label>
                <input type="number" class="form-control"  id="regpoint">

              </div>
              <div class="col-lg-3 mt-3">
                <label for="">Refer Point</label>
                <input type="number" class="form-control"  id="refpoint">

              </div>

            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="autopool" >
                        <label class="form-check-label" for="flexCheckChecked">
                            Allow in Autopool
                        </label>
                    </div>
                </div>
                

            </div>
               
       <div class="row">
        <div class="col-lg-12 text-right">
            <button class="btn btn-success mt-4" onclick="add_package();">Save & Continue</button>
        </div>
       </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="row px-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Field Name</label>
                                <input type="text" name="" placeholder="Field name" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
   add_package=function()
    {
       if($("#packagename").val()=="" || $("#p_amount").val()=="") return;
        var d={
            "p_name":$("#packagename").val(),
            "p_amount":$("#p_amount").val(),
            "d_wallet":$("#dwallet").val(),
            "quopon":$("#quopon").val(),
            "noquopon":$("#noquopon").val(),
            "magicpoint":$("#magicpoint").val(),
            "giftamt":$("#giftamt").val(),
            "sponsoramt":$("#sponsoramt").val(),
            "regpoint":$("#regpoint").val(),
            "refpoint":$("#refpoint").val(),
            "autopoolallow":($("#autopool").is(':checked')?1:0)

        }
        $.ajax({
            url:"<?=base_url("customer/addPackage")?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
                // alert(data);
                alert("Project Added Successfully")
                window.location.reload();
            },
            error:function(data)
            {

            }

        })
    }
</script>