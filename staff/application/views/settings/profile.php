<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Profile
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <?php $this->load->view('messages'); ?>
            <form action="<?php echo base_url('settings/updateProfile') ?>" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Customer ID</label>
                            <input type="text" placeholder="Customer ID" value="<?= $PROFILE[0]->customer_id ?>"
                                name="id" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" placeholder="Name" value="<?= $PROFILE[0]->user_name ?>" name="name"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" placeholder="Email" value="<?= $PROFILE[0]->user_email ?>" name="email"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" placeholder="Phone" value="<?= $PROFILE[0]->user_phone ?>"
                                pattern="[0-9]{10}" minlength="10" maxlength="10" name="phone" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-right">
                            <button class="btn btn-info btn-sm">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>