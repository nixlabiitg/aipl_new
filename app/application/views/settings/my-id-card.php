<style>
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
<!-- Page Content -->
<div class="page-content">
    <div class="container">
        <div class="edit-profile">
        <div class="col-lg-6 mb-5">
            <div class="id-card-tag"></div>
            <div class="id-card-tag-strip"></div>
            <div class="id-card-hook"></div>
            <div class="id-card-holder">
                <div class="id-card">
                    <div class="header">
                        <img src="<?php echo base_url('../'); ?>portal_assets/images/logo.png">
                    </div>
                    <div class="photo">
                        <img src="<?php echo base_url('../uploads/profile/'.$profile[0]->customer_id.'.png') ?>" />
                    </div>
                    <h2><b><?= $profile[0]->name ?></b></h2>
                    <h4>Call : <?= $profile[0]->mobile ?></h4>
                    <div class="qr-code">

                    </div>
                    <h3><b>IPP ID</b></h3>
                    <h3><?= $profile[0]->customer_id ?></h3>
                    <hr>
                    <p><strong>ACEAWS INDIA PVT. LTD.</strong></p>
                    <p>House No: 144, Rajghar Road, Bhangaghar<p>
                    <p>Kamrup(M), Assam, Guwahati - <strong>781005</strong></p>
                    <p>Ph: 8638828553</p>

                </div>
            </div>
        </div>
        </div>
    </div>
</div>