<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Packages</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Packages</a></li>
                    </ol>
                </div>
            </div>
            <!-- Col end-->
        </div>
        <!-- Row end-->
    </div>
    <!-- Container end-->
</div>
<!-- Banner area end-->

<section class="main-container no-padding" id="main-container">
    <div class="ts-services " id="ts-services">
        <div class="container">
            <div class="row ts-service-row-box">
                <?php
                foreach($package as $package){
            ?>
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="ts-service-box shadow border-0" style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                        <div class="ts-service-content">
                            <h3 class="service-title mb-5"><?= $package['package_name'] ?></h3>
                            <table class="table table-bordered">
                                <tr class="text-left">
                                    <th>Package Amount</th>
                                    <td class="text-center">&#8377;<?= $package['package_amount'] ?></td>
                                </tr>
                                <tr class="text-left">
                                    <th>Digital Wallet</th>
                                    <td class="text-center">&#8377;<?= $package['digital_wallet_value'] ?></td>
                                </tr>
                                <tr class="text-left">
                                    <th>Shipping Coupon Amount</th>
                                    <td class="text-center">&#8377;<?= $package['shopping_coupon_value'] ?></td>
                                </tr>
                                <tr class="text-left">
                                    <th>No of Coupons</th>
                                    <td class="text-center"><?= $package['no_of_coupon'] ?></td>
                                </tr>
                                <tr class="text-left">
                                    <th>Magic Shopping Point</th>
                                    <td class="text-center"><?= $package['magic_shopping_points'] ?></td>
                                </tr>
                                <tr class="text-left">
                                    <th>Gift Product</th>
                                    <td class="text-center">&#8377;<?= $package['gift_product_amount'] ?></td>
                                </tr>
                                <tr class="text-left">
                                    <th>Direct IPP Sponsor Amount</th>
                                    <td class="text-center">&#8377;<?= $package['direct_ipp_amount'] ?></td>
                                </tr>
                            </table>
                            <div class="text-center ">
                                <a href="<?php echo base_url('registration') ?>" class="btn btn-primary">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>