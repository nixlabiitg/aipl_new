<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        
               <div class="kt-portlet__body">
<div class="row mb-3">
    <div class="col-lg-12 text-right">
   
    <?=(count($kyc)>0?($kyc[0]['status']==0?"<span class='badge badge-warning text-white'> <i class='fa fa-info-circle' aria-hidden='true' ></i>  KYC Not approved</span>":($kyc[0]['status']==1?"<span class='badge badge-success text-white'> <i class='fa fa-info-circle' aria-hidden='true' ></i>  KYC approved</span>":"<span class='badge badge-danger'> <i class='fa fa-info-circle' aria-hidden='true' ></i>  KYC Rejected</span>")):"")?>

    </div>
</div>
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bank Name</label>
                            <input  type="text" id="bank" class="form-control" placeholder="Enter Bank Name" value="<?= ($kyc?$kyc[0]['bank_name']:"") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Branch Name</label>
                            <input  type="text" id="branch" class="form-control" placeholder="Enter Branch Name" value="<?= ($kyc?$kyc[0]['branch_name']:"") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>A/c No</label>
                            <input  type="text" id="acno" class="form-control" placeholder="Enter A/c Name" value="<?= ($kyc?$kyc[0]['ac_no']:"") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>IFSC Code</label>
                            <input  type="text" id="ifsc" class="form-control" placeholder="Enter IFSC Name" value="<?= ($kyc?$kyc[0]['ifsc_code']:"") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>PAN No</label>
                            <input  type="text" id="pan" class="form-control" placeholder="Enter PAN Name" value="<?= ($kyc?$kyc[0]['pan_no']:"") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Aadhar No</label>
                            <input  type="text" id="aadhar" class="form-control" placeholder="Enter Aadhar Name" value="<?= ($kyc?$kyc[0]['aadhar_no']:"") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Payee Name</label>
                            <input  type="text" id="payee" class="form-control" placeholder="Enter Payee Name" value="<?= ($kyc?$kyc[0]['payee_name']:"") ?>">
                        </div>
                    </div>
                   
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nominee Name</label>
                        <input type="text" name="nominee" id="nominee" value="<?= $customer_master[0]->nominee ?>" placeholder="Enter nominee name"
                            class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Relationship</label>
                        <input type="text" name="relationship" id="relationship" value="<?= $customer_master[0]->relationship ?>" placeholder="Enter relationship with nominee"
                            class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nominee Bank A/C No</label>
                        <input type="text" name="bankno" id="bankno" value="<?= $customer_master[0]->nominee_bank_no ?>" placeholder="Enter account no"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nominee Bank IFSC Code</label>
                        <input type="text" name="nominee_ifsc" id="nominee_ifsc" value="<?= $customer_master[0]->nominee_bank_ifsc ?>" placeholder="Enter IFSC"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nominee DOB</label>
                        <input type="date" name="dobdate" id="dobdate" placeholder="Enter dob" value="<?= $customer_master[0]->nominee_dob ?>"
                            max="<?= date('Y-m-d') ?>" class="form-control">
                    </div>
                </div>
                    
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button hidden type="reset" class="btn btn-warning text-light">Reset</button>
                            <button  id="savekyc" onclick="save_kyc()" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
   

        <!--end::Form-->
    </div>
</div>

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    save_kyc = function(x) {
        if($("#bank").val()=="" || $("#branch").val()=="" || $("#acno").val()=="" || $("#ifsc").val()=="" || $("#pan").val()=="" || $("#aadhar").val()=="" || $("#payee").val()=="")
        {
            alert("Incomplete Entry. Please fill up the mandatory fields."); return;
        }

     var d={
            "bank":$("#bank").val(),
            "branch":$("#branch").val(),
            "acno":$("#acno").val(),
            "ifsc":$("#ifsc").val(),
            "pan":$("#pan").val(),
            "aadhar":$("#aadhar").val(),
            "payee":$("#payee").val(),
            "nominee": $('#nominee').val(),
            "nominee_relation": $('#relationship').val(),
            "nominee_bankno": $('#bankno').val(),
            "nominee_bank_ifsc": $('#nominee_ifsc').val(),
            "nominee_dob": $('#dobdate').val(),
            }

    
            $.ajax({
                type: 'POST',
                data: d,
                url: '<?php echo site_url('customer/kyc_update'); ?>',

                success: function(data) {
                    // alert(data);
                        alert("KYC request sent successfully.");
                        window.location.reload();
                     },
                error:function(data)
                {
                    alert(data);
                }     
            });
        
    }
</script>

