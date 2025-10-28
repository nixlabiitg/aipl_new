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

.blink-soft {
    animation: blinker 1.5s linear infinite;
}
</style>
<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v">

            </span>

        </div>

        <h3 class="text-right mt-4 text-<?=($club? ($club[0]['club_id']==1?"success":($club[0]['club_id']==2?"danger":($club[0]['club_id']==3?"warning":"info"))):"")?>"
            style="font-weight:bold">
            <?=($club?$club[0]['club_name']:"")?>

        </h3>

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

    <!-- end:: Content Head -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="col-lg-12 mb-2">
            <h5>Registration Date : <span
                    class="text-info"><?= date('d-m-Y', strtotime($profile[0]->registration_date)) ?></span>, Activation
                Date: <span
                    class="text-success"><?= $profile[0]->activation_date == '' ? '--' : date('d-m-Y', strtotime($profile[0]->activation_date)) ?></span>
                    <?php if($profile[0]->promotion_id < 0){?>
                    , Rank : <?php if($profile[0]->promotion_id == 1 ? 'PP' : 'SPP') ?>
                <?php } ?>
            </h5>
        </div>
        <div class="col-lg-12 my-3">
            <div class="card p-3">
                <h5 class="text-info blink-soft">Notifications</h5>
                <hr>
                <h4>
                    <marquee behavior="" direction="">
                        <?php
                        $i=0;
                        foreach ($NOTIFICATIONS as $notification) {
                    ?>
                        <span><?= ++$i.')' ?> <?=$notification['notification'] ?> </span>
                        <?php } ?>
                    </marquee>
                </h4>
                <?php if($SELF_PURCHASE < 1000){ ?>
                <h2 class="mt-3 text-center text-danger">Your account does not meet the minimum monthly purchase
                    requirement of ₹1000. Please complete a purchase to proceed with the payout request.</h2>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-12 my-3">
            <div class="card p-3">
                <h5 class="text-info">Webinar Links</h5>
                <hr>
                <ul>
                    <?php foreach($WEBINAR as $data){ ?>
                    <li><b>Date :</b> <?= date('d M Y', strtotime($data->webinar_date)) ?> | <b>Time :</b>
                        <?= date('d M Y', strtotime($data->webinar_time)) ?> | <b>Link :</b> <a
                            href="<?= $data->webinar_link ?>"><?= $data->webinar_link ?></a> | <b>Note :</b>
                        <?= $data->note ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="id-card-holder mb-5">
                    <div class="id-card">
                        <div class="header">
                            <img src="<?php echo base_url(''); ?>portal_assets/images/logo.png">
                        </div>
                        <div class="photo">
                            <img src="<?php echo base_url('uploads/profile/'.$profile[0]->customer_id.'.png') ?>" />
                        </div>
                        <h2><b><?= $profile[0]->name ?></b></h2>
                        <div class="qr-code">

                        </div>
                        <h3><?= $profile[0]->customer_id ?></h3>
                        <hr>
                        <p><strong>ACEAWS INDIA PVT. LTD.</strong></p>
                        <p>House No: 144, Rajghar Road, Bhangaghar
                        <p>
                        <p>Kamrup(M), Assam, Guwahati - <strong>781005</strong></p>
                        <p>Ph: 8638828553</p>
                        <h4 class="mt-2"><b>HELP CARD</b></h4>
                    </div>
                </div>

                <?php if($profile[0]->health_card_front != ''){ ?>
                <div class="mt-3 text-center">
                    <div class="dropdown show">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Download Health Card
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="<?php echo base_url('./admin/uploads/healthcard/'.$profile[0]->health_card_front) ?>" class="dropdown-item text-dark" download>Health Card Front</a>
                            <a href="<?php echo base_url('./admin/uploads/healthcard/'.$profile[0]->health_card_back) ?>" class="dropdown-item text-dark"
                                download>Health Card Back</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="col-lg-8 mb-3 m-0 p-0">
                <div class="card p-3 mb-3 border-0 shadow">
                    <h4 class="mb-4">Recharge &amp; Bill Payment</h4>
                    <div class="row">
                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/phn.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Mobile/Landline</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/dth.webp" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>DTH</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/elc.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Electricity</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/inc.webp" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Insurance</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/water.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Water</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/gas.jpg" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Gas-Pipe Line</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/muc.jpg" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Municipal Taxes & Services</b>
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/cyl.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>LPG Gas</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/data.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Broadband/Data card</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/cable.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Cable</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/emi.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>EMI</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/fast.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Fastag</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/loan.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Loan Repayments</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/deposit.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Recurring Deposits</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/credit.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Credit Card</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/mutual.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Mutual Fund</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/house.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Housing Society</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/edu.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Education & Fees</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/hos.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Hospital & Pathology</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/club.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Club & Associations</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/rent.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Rental</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/metro.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Metro Recharge</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/ott.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Digital/OTT</b></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card p-3 mb-3 border-0 shadow">
                    <h4 class="mb-4">Shopping</h4>
                    <div class="row">
                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/amazon.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Amazon Shopping</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/shopclues.webp" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Shopclues</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/Tata-Cliq-logo.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Tata Cliq</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/Ajio.webp" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Ajio</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/myntra.webp" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Myntra</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/snapdeal.png" alt=""
                                        style="height:50px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>Snapdeal</b></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-2 col-4 mb-3">
                            <a href="">
                                <div class="card text-center border-0">
                                    <img src="<?php echo base_url('') ?>portal_assets/icons/fc-logo.png" alt=""
                                        style="height:30px; object-fit:contain;">
                                    <p class="text-dark mt-2" style="font-size:10px;"><b>First Cry</b></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <div class="card border-warning p-3">
                            <div class="text-center">
                                <h4>Total Income</h4>
                                <hr>
                                <h2>&#8377; <?=round($TOTAL_INCOME[0]->total_income,2)?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-warning p-3">
                            <div class="text-center">
                                <h4>Main Wallet</h4>
                                <hr>
                                <h2>&#8377; <?=round($main_wallet,2)?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-danger p-3">
                            <div class="text-center">
                                <h4>Digital Wallet</h4>
                                <hr>
                                <h2>&#8377; <?=round($digital_wallet,2)?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-info p-3">
                            <div class="text-center">
                                <h4>Point Wallet</h4>
                                <hr>
                                <h2><?=$point_wallet?><small> pts</small></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-success p-3">
                            <div class="text-center">
                                <h4>Activation Wallet</h4>
                                <hr>
                                <h2>&#8377; <?=round($activation_wallet,2)?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="card border-success p-3">
                            <div class="text-center">
                                <h4>Direct Bonus Point</h4>
                                <hr>
                                <h2>&#8377; <?=round($direct_bonus_point,2)?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-success p-3">
                            <div class="text-center">
                                <h4>Magic Shoping Point</h4>
                                <hr>
                                <h2>&#8377; <?=round($mspoint,2)?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-success p-3">
                            <div class="text-center">
                                <h4>Sales Point <small>(
                                        <?php if($promotion_id == 1){?>
                                        Promotion Partner
                                        <?php }else if($promotion_id == 2){ ?>
                                        Senior Promotion Partner
                                        <?php }else if($promotion_id == 3){ ?>
                                        Branch Manager
                                        <?php }else{ ?>
                                        --
                                        <?php } ?>
                                        )</small></h4>
                                <hr>
                                <?php if($promotion_id < 2){ ?>
                                <h2><?=$PP?></h2>
                                <?php }else if($promotion_id > 1    ){ ?>
                                <h2><?=$SPP?></h2>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card p-3 mb-3 border-0 shadow">
                <h4 class="mb-4">Payouts</h4>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-3">
                                    <input type="month" name="payout_month" value="<?= $MONTH ? $MONTH : date('Y-m') ?>" class="form-control" id="" required>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-info" name="filter_payouts">Filter</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-striped- table-bordered table-hover table-checkable"
                                        id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th nowrap>Request Date</th>
                                                <th nowrap>Request Amount</th>
                                                <th nowrap>TDS Amount</th>
                                                <th nowrap>Admin Charge</th>
                                                <th nowrap>Net Amount</th>
                                                <th nowrap>Approved Date</th>
                                                <th nowrap>Approved Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($PAYOUTS)){
                                                $id = 0;
                                                foreach($PAYOUTS as $data)  {
                                            ?>
                                            <tr>
                                                <td><?= ++$id ?></td>
                                                <td><?= date('d-m-Y', strtotime($data->date)) ?></td>
                                                <td class="text-right">&#8377;<?= number_format($data->request_amount,2) ?></td>
                                                <td class="text-right">&#8377;<?= number_format($data->tds,2) ?></td>
                                                <td class="text-right">&#8377;<?= number_format($data->admin_charge,2) ?></td>
                                                <td class="text-right">&#8377;<?= number_format($data->request_amount - ($data->tds + $data->admin_charge),2) ?></td>
                                                <td><?= date('d-m-Y', strtotime($data->approve_date)) ?></td>
                                                <td><?= date('h:i A', strtotime($data->approve_date)) ?></td>
                                            </tr>
                                            <?php }}else { ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">NO PAYOUTS FOUND</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="card p-3">
                <h3>Your Referral Link</h3>
                <div class="row">
                    <div class="col-10">
                        <input type="text" id="myInput"
                            value="<?php echo site_url('referral_registration?uuid=' . $this->session->userdata('aiplUserId')); ?>"
                            class="form-control">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-info" onclick="myFunction()">Copy Link</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="row">

                <div class="col-lg-12 mb-3">
                    <div class="card shadow-sm border-0 table-responsive" style="height:125px;">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-danger text-light">
                                    <th class="text-center">ID</th>
                                    <th>Package Details</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($customer as $c) {?>
                                <tr>
                                    <td class="text-center"><?=++$i?></td>
                                    <td>
                                        <h5><b><?=$c['package_name']?></b></h5>
                                    </td>
                                    <td class="text-center">&#8377; <?=$c['package_amount']?>/-</td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-light">
                                    <th class="text-LEFT" colspan="2">CLUB & RECOGNITIONS</th>
                                </tr>


                            </thead>
                            <tbody>
                                <?php 
                           
                           foreach($dclub as $rc)
                           { ?>

                                <tr>

                                    <td><?=$rc['club_name']?></td>
                                    <td class="text-left"><?=$rc['facilities']?></td>

                                </tr>
                                <?php }
                            foreach($recognition as $rc)
                                { 
                                   ?>
                                <tr>

                                    <td><?=$rc['club_name']?></td>
                                    <td class="text-left"><?=$rc['facilities']?></td>

                                </tr>
                                <?php }  ?>
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>


        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-success text-light">
                                    <th class="text-LEFT" colspan="3">Incomes</th>
                                </tr>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Income</th>
                                    <th CLASS="TEXT-RIGHT">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=0;
                                foreach($income as $in)
                                {

                                ?>
                                <tr>
                                    <td class="text-center"><?=++$i?></td>
                                    <td><?=$in['income_name']?></td>
                                    <td class="text-right">&#8377;<?=number_format($in['income'],2)?></td>
                                </tr>

                                <?php } ?>

                                </tfoot>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- alert -->
<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body p-4 px-5">
                <div class="main-content text-center">
                    <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><span class="icon-close2"></span></span>
                    </a>
                    <div class="warp-icon mb-4">
                        <span class="icon-lock2"></span>
                    </div>
                    <i class="fa fa-warning mb-1" style="font-size:15pt;"></i><br>
                    <label for="">Warning</label>
                    <p class="mb-4">Your activation is pending or rejected. Please activate it.</p>

                    <div class="d-flex">
                        <div class="mx-auto">
                            <a href="<?=base_url('Customer/selfActivation')?>" class="btn btn-primary">Activate Now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
    $(document).ready(function() {

        // <?php if($status==0 || $status==3) { ?>
        // $("#alert").modal("show");
        // <?php } ?>
    });
    </script>

    <script>
    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
    </script>