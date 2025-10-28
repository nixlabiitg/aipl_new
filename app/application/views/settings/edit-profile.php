<!-- Page Content -->
<div class="page-content">
    <div class="container">
        <div class="edit-profile">
            <div class="profile-image">
                <div class="media media-100 rounded-circle">
                    <?php $userid = $this->session->userdata("aiplAppId"); ?>
                    <img src="<?php echo base_url('../uploads/profile/'.$userid.'.png') ?>" alt="/">
                </div>
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editProfile">Change profile photo</a>
            </div>

            <table class="table table-striped table-bordered">
                <?php
                    $sponsor = $profile[0]->sponsor_id;
                    $details = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsor'");
                ?>
                <tbody>
                    <tr>
                        <td>Customer ID</td>
                        <td>: <?= $profile[0]->customer_id ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>: <?= $profile[0]->name ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <?= $profile[0]->email ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>: <?= $profile[0]->mobile ?></td>
                    </tr>
                    <tr>
                        <td>Sponsor</td>
                        <td>: <?= $sponsor .' ['.$details[0]->name.']' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Page Content End-->

<!-- Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileLabel">Update Profile</h5>
      </div>
      <form action="<?php echo base_url('settings/changeProfile') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="file" name="profile" id="profile" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>