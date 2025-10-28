<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Company Documents</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Company Documents</a></li>
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

<section class="ts-services solid-bg" id="ts-services">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-title"><span>See our</span>Company Documents</h2>
            </div>
        </div>
        <!-- Title row end-->
        <div class="row ts-service-row-box">
            <?php
                //Count local files 
                $directory ="assets/images/documents";
                $count = 0;

                $iterator = new DirectoryIterator($directory);
                foreach ($iterator as $file) {
                    if ($file->isFile()) {
            ?>
            <div class="col-lg-6 mb-3">
                <h3><?= str_replace( array('_' , '-', '.png' ), ' ', $file) ?></h3>
                <img src="<?php echo base_url('assets/images/documents/'.$file) ?>" style="width:100%;" alt="">
            </div>
            <?php }} ?>
        </div>
    </div>
</section>