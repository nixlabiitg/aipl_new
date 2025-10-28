<div class="card-body login-card-body">

    <div class="row align-items-center" style="margin-top: 1em;">
        <div class="offset-md-3 col-lg-6">
            <div class="card p-4 shadow border-0">

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
                <form action="<?php echo site_url('settings/changePassword'); ?>" method="post">
                    <div class="form-group">
                        <label for="">Current Password</label>
                        <input type="password" required name="password" class="form-control"
                            value="<?php echo set_value('password'); ?>" placeholder="Current Password">
                    </div>
                    <label for="">New Password</label>
                    <div class="form-group">
                        <input type="password" required id="password" name="new_password" class="form-control"
                            value="<?php echo set_value('new_password'); ?>" placeholder="New Password">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewPassword"
                                onclick="viewPassword1()">
                            <label class="form-check-label" for="viewPassword">
                                <small>View Password</small>
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="change" class="btn btn-primary btn-block">Change password</button>
            </div>
        </div>
    </div>
</div>
</form>
</div>

<script>
function viewPassword1() {
    let passwordInput = document.getElementById("password");
    let checkbox = document.getElementById("viewPassword");

    if (checkbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
</script>