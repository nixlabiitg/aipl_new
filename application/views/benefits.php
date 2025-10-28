<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Benefits</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Benefits</a></li>
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

<section class="main-container contact-area" id="main-container">
    <div class="ts-form form-boxed" id="ts-form">
        <div class="container">
            <div class="row">
                <?php foreach($BENEFIT as $data){ ?>
                <div class="col-lg-3">
                    <div class="text-center">
                        <a href="<?= 'uploads/tiesup/'.$data->benifit_file ?>" target="_blank">
                            <img src="<?= base_url('portal_assets/media/files/pdf.svg') ?>" class="w-50" alt="">
                        </a>
                        <h5 class="mt-3"><?= $data->category ?> Benefit</h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>