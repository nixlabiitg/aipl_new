<style>
body {
    background-color: transparent;
    font-family: 'verdana';
}

.id-card-holder {
    width: 225px;
    padding: 4px;
    margin: 0 auto;
    background-color: #1f1f1f;
    border-radius: 5px;
    position: relative;
}

.id-card-holder:after {
    content: '';
    width: 7px;
    display: block;
    background-color: #0a0a0a;
    height: 100px;
    position: absolute;
    top: 105px;
    border-radius: 0 5px 5px 0;
}

.id-card-holder:before {
    content: '';
    width: 7px;
    display: block;
    background-color: #0a0a0a;
    height: 100px;
    position: absolute;
    top: 105px;
    left: 222px;
    border-radius: 5px 0 0 5px;
}

.id-card {

    background-color: #fff;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 1.5px 0px #b9b9b9;
}

.id-card img {
    margin: 0 auto;
}

.header img {
    width: 100px;
    margin-top: 15px;
    width: 60px;
}

.photo img {
    width: 80px;
    margin-top: 15px;
    border-radius: 10px;
}

h2 {
    font-size: 16px;
    margin: 5px 0;
}

h4 {
    font-size: 12px;
}

h3 {
    font-size: 12px;
    margin: 2.5px 0;
    font-weight: 300;
}

.qr-code img {
    width: 50px;
}

p {
    font-size: 5px;
    margin: 2px;
}

.id-card-hook {
    background-color: black;
    width: 70px;
    margin: 0 auto;
    height: 15px;
    border-radius: 5px 5px 0 0;
}

.id-card-hook:after {
    content: '';
    background-color: white;
    width: 47px;
    height: 6px;
    display: block;
    margin: 0px auto;
    position: relative;
    top: 6px;
    border-radius: 4px;
}

.id-card-tag-strip {
    width: 45px;
    height: 40px;
    background-color: #d9300f;
    margin: 0 auto;
    border-radius: 5px;
    position: relative;
    top: 9px;
    z-index: 1;
    border: 1px solid #a11a00;
}

.id-card-tag-strip:after {
    content: '';
    display: block;
    width: 100%;
    height: 1px;
    background-color: #a11a00;
    position: relative;
    top: 10px;
}

.id-card-tag {
    width: 0;
    height: 0;
    border-left: 100px solid transparent;
    border-right: 100px solid transparent;
    border-top: 100px solid #d9300f;
    margin: -10px auto -30px auto;

}

.id-card-tag:after {
    content: '';
    display: block;
    width: 0;
    height: 0;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    border-top: 100px solid white;
    margin: -10px auto -30px auto;
    position: relative;
    top: -130px;
    left: -50px;
}
</style>
<div class="card-body login-card-body">

    <div class="row" style="margin-top: 1em;">
        <div class="col-lg-6 mb-5">
            <div class="profile-image text-center">
                <?php $userid = $this->session->userdata("aiplUserId"); ?>
                <img src="<?php echo base_url('uploads/profile/'.$userid.'.png') ?>" style="width:150px; height: 150px;" class="rounded" alt="/">
                <br />
                <a href="javascript:void(0);" class="btn btn-info mt-2 mb-4" data-toggle="modal"
                    data-target="#editProfile">Change profile
                    photo</a>
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

        <div class="col-lg-6 mb-5">
            <div class="id-card-tag"></div>
            <div class="id-card-tag-strip"></div>
            <div class="id-card-hook"></div>
            <div class="id-card-holder">
                <div class="id-card">
                    <div class="header">
                        <img src="<?php echo base_url(''); ?>portal_assets/images/logo.png">
                    </div>
                    <div class="photo">
                        <img src="<?php echo base_url('uploads/profile/'.$userid.'.png') ?>" />
                    </div>
                    <h2><b><?= $profile[0]->name ?></b></h2>
                    <h4>Call : <?= $profile[0]->mobile ?></h4>
                    <div class="qr-code">

                    </div>
                    <h3><b>IPP ID</b></h3>
                    <h3><?= $profile[0]->customer_id ?></h3>
                    <hr>
                    <p><strong>ACEAWS INDIA PVT. LTD.</strong></p>
                    <p>House No: 144, Rajghar Road, Bhangaghar,
                    <p>
                    <p>Kamrup(M), Assam, Guwahati - <strong>781005</strong></p>
                    <p>Ph: 8638828553</p>

                </div>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-info btn-sm" id="printButton">Print ID</button>
            </div>
        </div>

        <div class="col-lg-6">
            <div hidden style="width:250px;" id="print-id">
                <div style="text-align:center; margin:auto;">
                    <div>
                        <img src="<?php echo base_url(''); ?>portal_assets/images/logo.png" style="width:80px;">
                    </div>
                    <div style="margin-top:10px;">
                        <img src="<?php echo base_url('uploads/profile/'.$userid.'.png') ?>" style="width:80px; border-radius:10px;" />
                    </div>
                    <h2 style="font-size:18px;"><b><?= $profile[0]->name ?></b></h2>
                    <h4 style="font-size:12px; margin-top:-10px;">Call : <?= $profile[0]->mobile ?></h4>
                    <h3><b>IPP ID</b></h3>
                    <h3 style="margin-top:-10px;"><?= $profile[0]->customer_id ?></h3>
                    <hr>
                    <p><strong>ACEAWS INDIA PVT. LTD.</strong></p>
                    <p style="margin-top:-10px;">House No: 144, Rajghar Road, Bhangaghar,</p>
                    <p style="margin-top:-10px;">Kamrup(M), Assam, Guwahati - <strong>781005</strong></p>
                    <p style="margin-top:-10px;">Ph: 8638828553</p>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Update Profile</h5>
            </div>
            <form action="<?php echo base_url('Settings/changeProfile') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="file" name="profile" id="profile" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#printButton').click(function() {
        var myDiv = $('#print-id').html();
        var printWindow = window.open('', '', 'height=500,width=800');
        printWindow.document.write('<html><head><title>Print Div</title>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(myDiv);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
});
</script>