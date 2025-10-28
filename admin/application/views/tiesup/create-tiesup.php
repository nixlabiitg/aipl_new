<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" id="addproduct" action="<?php echo base_url('tiesup/add_tiesup') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h3>Create Ties Up</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ties Up Name</label>
                            <input type="text" class="form-control" placeholder="Enter company name" name="name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ties Up Image</label>
                            <input type="file" class="form-control" name="tiesimage" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addproduct" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>