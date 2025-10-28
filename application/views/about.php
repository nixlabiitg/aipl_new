<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">About Us</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">About Us</a></li>
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
                <div class="col-lg-6 about-desc">
                    <div
                        style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                        <h2 class="column-title"><span>We are</span>ACEAWS INDIA PVT. LTD.</h2>
                        <p><?= file_get_contents(FCPATH . "admin/content/about.txt") ?></p>
                    </div>
                </div>
                <!-- Col end-->
                <div class="col-lg-6 text-md-center mrt-40">
                    <img class="img-fluid" src="<?php echo base_url('') ?>admin/content/about.jpg" alt="">
                </div>
                <!-- Col end-->
            </div>
            <!-- Main row end-->
        </div>
        <!-- Container 1 end-->
    </div>
    <!-- About pattern End-->
</section>