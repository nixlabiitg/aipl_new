<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Terms and Condition</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Terms and Condition</a></li>
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

    <div class="about-pattern">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 about-desc">
                    <h2 class="column-title">Terms and Conditions</h2>
                    <p><?= file_get_contents(FCPATH . "admin/content/terms-and-conditions.txt") ?></p>
                </div>
            </div>
            <!-- Main row end-->
        </div>
        <!-- Container 1 end-->
    </div>
    <!-- About pattern End-->
</section>