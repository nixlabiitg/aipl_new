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
<!-- Banner -->
<div class="author-notification">
    <div class="container inner-wrapper">
        <div class="dz-info">
            <span class="text-dark d-block">
                <?php
					date_default_timezone_set('Asia/Kolkata');
					$current_time = date('H:i:s');
					if ($current_time >= '00:00:00' && $current_time < '12:00:00') {
						echo "Good morning!";
					} elseif ($current_time >= '12:00:00' && $current_time < '18:00:00') {
						echo "Good afternoon!";
					} else {
							echo "Good evening!";
					}
				?>
            </span>
            <h2 class="name mb-0 title h5">
                <?php $username = $this->session->userdata('aiplAppName'); if( $username == ''){ ?>
                Guest User
                <?php }else{ ?>
                <?= $username ?>
                <?php } ?>
                👋
            </h2>
        </div>
        <?php if( $username == ''){ ?>
        <a href="<?php echo base_url('authentication/register') ?>"
            class="btn btn-outline-success px-3 py-2 btn-pill">Join Now</a>
        <?php } ?>
        <a href="javascript:void(0);" class="menu-toggler">
            <svg class="text-dark" xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px"
                fill="#000000">
                <path
                    d="M13 14v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1zm-9 7h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1zM3 4v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1zm12.95-1.6L11.7 6.64c-.39.39-.39 1.02 0 1.41l4.25 4.25c.39.39 1.02.39 1.41 0l4.25-4.25c.39-.39.39-1.02 0-1.41L17.37 2.4c-.39-.39-1.03-.39-1.42 0z">
                </path>
            </svg>
        </a>
    </div>
</div>
<!-- Banner End -->

<!-- Page Content -->
<div class="page-content">
    <div class="content-inner pt-0">
        <div class="container bottom-content">
            <?php if($this->session->userdata('aiplAppId')){ ?>
            <div class="col-lg-12 mb-2">
                <h5>Registration Date : <span
                        class="text-info"><?= date('d-m-Y', strtotime($profile[0]->registration_date)) ?></span>,
                    Activation Date: <span
                        class="text-success"><?= $profile[0]->activation_date == '' ? '--' : date('d-m-Y', strtotime($profile[0]->activation_date)) ?></span>
                    <?php if($profile[0]->promotion_id < 0){?>
                    , Rank : <?php if($profile[0]->promotion_id == 1 ? 'PP' : 'SPP') ?>
                    <?php } ?>
                </h5>
            </div>

            <div class="col-lg-12 my-3">
                <div class="card text-center p-3">
                    <h5 class="text-danger">Notifications</h5>
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
                    <h5 class="text-danger">Webinar Links</h5>
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

            <?php } ?>
            <!-- Dashboard Area -->
            <div class="dashboard-area">
                <!-- Recent -->
                <div class="swiper-btn-center-lr mb-5">
                    <div class="swiper meat-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            for($i = 1; $i < 6 ; $i++){
                            $filename = $i.'.png';
                            $file_path = FCPATH . "../assets/images/slider/" . $filename;
                            if (file_exists($file_path)) {
                        ?>
                            <div class="swiper-slide">
                                <div class="card add-banner2">
                                    <img src="<?php echo base_url('../assets/images/slider/'.$filename) ?>" alt="/">
                                </div>
                            </div>
                            <?php
                            }}
                        ?>
                        </div>
                    </div>
                    <div class="swiper-btn">
                        <div class="meat-swiper-pagination swiper-pagination-bullets style-5"></div>
                    </div>
                </div>
                <?php if($this->session->userdata('aiplAppId')){ ?>
                <div class="col-lg-12">
                    <div class="id-card-holder mb-5">
                        <div class="id-card">
                            <div class="header">
                                <img src="<?php echo base_url('../'); ?>portal_assets/images/logo.png">
                            </div>
                            <div class="photo">
                                <img
                                    src="<?php echo base_url('../uploads/profile/'.$profile[0]->customer_id.'.png') ?>" />
                            </div>
                            <h2><b><?= $profile[0]->name ?></b></h2>
                            <div class="qr-code">

                            </div>
                            <h3><?= $profile[0]->customer_id ?></h3>
                            <hr>
                            <p><strong>ACEAWS INDIA PVT. LTD.</strong></p>
                            <p>House No: 144, Rajghar Road, Bhangaghar,
                            <p>
                            <p>Kamrup(M), Assam, Guwahati - <strong>781005</strong></p>
                            <p>Ph: 8638828553</p>
                            <h4 class="mt-2"><b>HELP CARD</b></h4>
                        </div>
                    </div>
                </div>

                <?php if($profile[0]->health_card_front != ''){ ?>
                <div class="mt-3 d-flex justify-content-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Download Health Card
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('../admin/uploads/healthcard/'.$profile[0]->health_card_front) ?>"
                                class="dropdown-item text-dark" download>Health Card Front</a></li>
                            <li><a href="<?php echo base_url('../admin/uploads/healthcard/'.$profile[0]->health_card_back) ?>"
                                class="dropdown-item text-dark" download>Health Card Back</a></li>
                        </ul>
                    </div>
                </div>
                <?php }} ?>

                <div class="col-lg-12">
                    <div class="card p-3 mb-3 border-0 shadow">
                        <h4 class="mb-4">Payouts</h4>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <form action="" method="POST">
                                    <div class="row mb-4">
                                        <div class="col-3">
                                            <input type="month" name="payout_month"
                                                value="<?= $MONTH ? $MONTH : date('Y-m') ?>" class="form-control" id=""
                                                required>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-info"
                                                name="filter_payouts">Filter</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-wrap table-responsive">
                                            <table
                                                class="table table-striped- table-bordered table-hover table-checkable"
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
                                                        <td class="text-right">
                                                            &#8377;<?= number_format($data->request_amount,2) ?></td>
                                                        <td class="text-right">&#8377;<?= number_format($data->tds,2) ?>
                                                        </td>
                                                        <td class="text-right">
                                                            &#8377;<?= number_format($data->admin_charge,2) ?></td>
                                                        <td class="text-right">
                                                            &#8377;<?= number_format($data->request_amount - ($data->tds + $data->admin_charge),2) ?>
                                                        </td>
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

                <?php
                    //Count local files 
                    $directory ="../assets/images/offer";
                    $files = glob($directory . "/*.*");
                    $num_files = count($files);
                    if($num_files != 0){
                ?>
                <!-- Recent -->
                <div class="row">
                    <?php
                        $iterator = new DirectoryIterator($directory);
                        $id = 0;
                        foreach ($iterator as $file) {
                        if ($file->isFile()) {
                        $count = ++$id;
                    ?>
                    <div class="col-lg-12 mb-3">
                        <img src="<?php echo base_url('../assets/images/offer/'.$file) ?>" alt=""
                            class="d-block rounded w-100">
                    </div>
                    <?php
                        }}
                    ?>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-2">
                            <marquee behavior="" direction="">
                                <?php foreach($ADS as $data){ ?>
                                <img src="<?= base_url('../admin/uploads/ads/'.$data->ads_image) ?>" alt=""
                                    style="height : 300px; border-radius : 5px;">
                                <?php } ?>
                            </marquee>
                        </div>
                    </div>
                </div>

                <div class="row catagore-bx mt-5">
                    <?php foreach($SERVICES as $service){ ?>
                    <div class="col-3 text-center mb-3">
                        <span onclick="showServices(<?= $service->category_id ?>)">
                            <div class="dz-media media-60">
                                <?php if($service->avatar == ''){ ?>
                                <img src="<?php echo base_url('../admin/uploads/categories/no.png') ?>" alt="image">
                                <?php }else{ ?>
                                <img src="<?php echo base_url('../admin/uploads/categories/'.$service->avatar) ?>"
                                    alt="image">
                                <?php } ?>
                            </div>
                            <span style="font-size : 10px;"><?= $service->category_name ?></span>
                        </span>
                    </div>
                    <?php } ?>
                    <form id="singleService" action="<?php echo base_url('services/services') ?>" method="post" hidden>
                        <input type="text" id="serviceid" name="serviceid">
                    </form>
                </div>
            </div>

            <div class="container">
                <h2 class="text-center mb-5">Our Partners</h2>
                <div class="row">
                    <?php foreach($TIESUP as $data){ ?>
                    <div class="col-sm-3 text-center">
                        <h5
                            style="border: 2px solid #FF5733; padding : 10px 20px; border-radius : 10px; color: darkgreen;">
                            <?= $data->company_name ?></h5>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php if($this->session->userdata('aiplAppId')){ ?>
            <div class="col-12 mt-5 mb-5">
                <h3 class="mb-3">User Details</h3>
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="col-xl-12 mb-3 m-0 p-0">
                        <h3 class="text-center mb-4 mt-4 text-<?=($club? ($club[0]['club_id']==1?"success":($club[0]['club_id']==2?"danger":($club[0]['club_id']==3?"warning":"info"))):"")?>"
                            style="font-weight:bold">
                            <?=($club?$club[0]['club_name']:"")?>

                        </h3>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="card bg-info border-warning p-3">
                                    <div class="text-center">
                                        <h6 class="text-white">Main <br />Wallet</h6>
                                        <hr>
                                        <h5 class="text-white">&#8377; <?=round($main_wallet,2)?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="card bg-success border-danger p-3">
                                    <div class="text-center">
                                        <h6 class="text-white">Digital <br />Wallet</h6>
                                        <hr>
                                        <h5 class="text-white">&#8377; <?=round($digital_wallet,2)?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="card bg-warning border-info p-3">
                                    <div class="text-center">
                                        <h6>Point <br />Wallet</h6>
                                        <hr>
                                        <h5><?=$point_wallet?><small> pts</small></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="card bg-primary border-success p-3">
                                    <div class="text-center">
                                        <h6 class="text-white">Activation <br />Wallet</h6>
                                        <hr>
                                        <h5 class="text-white">&#8377; <?=round($activation_wallet,2)?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="card bg-primary border-success p-3">
                                    <div class="text-center">
                                        <h6 class="text-white">Direct Bonus<br /> Point</h6>
                                        <hr>
                                        <h5 class="text-white">&#8377; <?=round($direct_bonus_point,2)?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="card bg-primary border-success p-3">
                                    <div class="text-center">
                                        <h6 class="text-white">Magic Shoping<br />Point</h6>
                                        <hr>
                                        <h5 class="text-white">&#8377; <?=round($mspoint,2)?></h5>
                                    </div>
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
                                            <tr class="bg-danger text-white">
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
                                                    <p><small><?=$c['package_name']?></small></p>
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
                                                <th class="text-white" colspan="2">CLUB & RECOGNITIONS</th>
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
                                                <th class="text-white" colspan="3">Incomes</th>
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
            <?php } ?>
        </div>
    </div>
</div>
<!-- Page Content End-->
<?php if($this->session->userdata('aiplAppId') == ''){ ?>
<div class="modal fade" id="alert" tabindex="-1" aria-labelledby="alertLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 px-5">
                <div class="main-content text-center">
                    <div class="row">

                        <div class="col-12">
                            <div class="warp-icon mb-4">
                                <span class="icon-lock2"></span>
                            </div>
                            <i class="fa fa-warning mb-1" style="font-size:15pt;"></i><br>
                            <h3 class="text-warning">Warning</h3>
                        </div>


                        <div class="col-12">
                            <p class="mb-4">Welcome to our platform! To access all of our services, please create an
                                account or log in if you already have one. By registering, you'll have access to a range
                                of features and benefits, including exclusive content, personalized recommendations, and
                                more. Don't miss out on everything our platform has to offer – <a
                                    href="<?php echo base_url('authentication/register') ?>" class="text-info"><u>sign
                                        up</u></a> today!</p>
                            <div class="text-center">
                                <a href="#" data-bs-dismiss="modal" aria-label="Close">Close</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script type="text/javascript">
window.onload = () => {
    <?php if($status==0 || $status==3) { ?>
    $("#alert").modal("show");
    setTimeout(function() {
        $("#alert").modal("hide");
    }, 10000);
    <?php } ?>
}
</script>


<script>
function showServices(x) {
    $("#serviceid").val(x);
    $("#singleService").submit();
}
</script>