<div class="card-body login-card-body">

    <div class="row" style="margin-top: 1em;">
        <div class="col-3">
        </div>
        <div class="col-6">

            <?php
            if ($this->session->flashdata('danger')) {
                echo '<div class="alert alert-danger fade show" role="alert">
                            <div class="alert-text">' . $this->session->flashdata('danger') . '</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</i></span>
                                </button>
                            </div>
                        </div>';
            }
            ?>
            <?php
            if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success fade show" role="alert">
                            <div class="alert-text">' . $this->session->flashdata('success') . '</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</i></span>
                                </button>
                            </div>
                        </div>';
            }
            ?>
            <form action="<?php echo site_url('settings/changeInfo'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-12">
                     <label>Address:</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" style="height:100px;" value="<?= $CONTACT_INFO[0]->address; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label>Location:</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?= $CONTACT_INFO[0]->location; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label>Pin:</label>
                    <input type="text" class="form-control" id="pin" name="pin" placeholder="Pin" value="<?= $CONTACT_INFO[0]->pin; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label>State:</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?= $CONTACT_INFO[0]->state; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label>Website:</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="<?= $CONTACT_INFO[0]->website; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $CONTACT_INFO[0]->email; ?>" placeholder="Email">
                </div>
                <div class="form-group col-md-12">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" pattern="[6789]{1}[0-9]{9}" id="number" name="phone" placeholder="Phone no." minlength="10" maxlength="10" value="<?= $CONTACT_INFO[0]->contact; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label>Whatsapp Number:</label>
                    <input type="text" class="form-control" pattern="[6789]{1}[0-9]{9}" id="number" name="whatsapp" placeholder="Whatsapp no." minlength="10" maxlength="10" value="<?= $CONTACT_INFO[0]->whatsapp; ?>">
                </div>
                <div class="input-group my-3">
                    <label>Upload Logo:</label>
                    <!-- <input type="file" class="form-control" id="sliderImage" aria-describedby="sliderImage" name="sliderImage" required> -->
                    <input type="file" name="uimg" class="form-control" id="uimg">
                    <input type="hidden" name="uimg" class="form-control" id="uimg" value="<?= $CONTACT_INFO[0]->logo; ?>">
                    <!-- <br /><img src="" id="showImage" alt="" height="100" width="150">  -->
                </div>
                <button type="submit" name="change" class="btn btn-primary btn-block">Change Info</button>
                <!-- /.col -->
        </div>
    </div>
</div>
</form>
</div>