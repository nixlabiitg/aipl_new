<section class="main-container no-padding" id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-2">
                    <marquee behavior="" direction="">
                        <?php foreach($ADS as $data){ ?>
                        <img src="<?= base_url('admin/uploads/ads/'.$data->ads_image) ?>" alt=""
                            style="height : 300px; border-radius : 5px;">
                        <?php } ?>
                    </marquee>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 about-desc">
                <div
                    style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                    <h2 class="column-title"><span>We are</span>ACEAWS INDIA PVT. LTD.</h2>
                    <p><?= substr(file_get_contents(FCPATH . "admin/content/about.txt"),0,650) ?>...</p>
                    <a href="<?php echo base_url('packages') ?>" class="top-right-btn btn btn-primary">Packages</a>
                    <a href="<?php echo base_url('about') ?>" class="top-right-btn btn btn-secondary">About us</a>
                </div>
            </div>
            <!-- Col end-->
            <div class="col-lg-6 text-md-center">
                <img class="img-fluid rounded" src="<?php echo base_url('') ?>admin/content/about.jpg" alt="">
            </div>
            <!-- Col end-->
        </div>
        <!-- Main row end-->
    </div>
    <!-- Container 1 end-->
    </div>
    <!-- About pattern End-->
</section>

<section id="ts-features-light" class="ts-features-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-title">Mission &amp; Vision</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center">
                <div
                    style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                    <div class="ts-feature-box">
                        <div class="ts-feature-info">
                            <img src="<?php echo base_url('') ?>assets/images/icon/why-1.png" alt="">
                            <h3 class="ts-feature-title">Our Mission</h3>
                            <p><?= substr(file_get_contents(FCPATH . "admin/content/mission.txt"),0,200) ?>... <a
                                    href="<?php echo base_url('mission') ?>">view more</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 text-center">
                <div
                    style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                    <div class="ts-feature-box">
                        <div class="ts-feature-info">
                            <img src="<?php echo base_url('') ?>assets/images/icon/why-3.png" alt="">
                            <h3 class="ts-feature-title">Our Vision</h3>
                            <p><?= substr(file_get_contents(FCPATH . "admin/content/vision.txt"),0,200) ?>... <a
                                    href="<?php echo base_url('vision') ?>">view more</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-area" id="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion-title">
                    <h3 class="column-title"><span>Our FAQ</span> Frequently Asked Questions</h3>
                </div>
                <div id="accordion" class="accordion-area">
                    <div
                        style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                        <?php foreach($faqs as $key => $items){?>
                        <div class="card">
                            <div class="card-header p-3 border-0" id="heading<?= $key ?>">
                                <h5 class="mb-0">
                                    <a href="#" class="btn btn-link" data-toggle="collapse"
                                        data-target="#collapse<?= $key ?>" aria-expanded="true"
                                        aria-controls="collapse<?= $key ?>">
                                        <?= $items['question'] ?>
                                    </a>
                                </h5>
                            </div>
                            <div class="collapse <?= $key == 0 ? 'show' : '' ?>" id="collapse<?= $key ?>"
                                aria-labelledby="heading<?= $key ?>" data-parent="#accordion">
                                <div class="card-body border-0">
                                    <p><?= $items['answer'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Accordion end -->
            </div>
            <!-- Col end-->

            <!-- Col end-->
        </div>
        <!-- Content row end-->
    </div>
    <!-- Container end-->
</section>
<!-- Quote area end-->

<section class="clients-area">
    <div class="container">
        <h2 class="text-center mb-5">Our Partners</h2>
        <div class="row">
            <?php foreach($TIESUP as $data){ ?>
            <div class="col-sm-3 text-center">
            <div
            style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                    <img class="rounded" src="<?= base_url('uploads/tiesup/'.$data->ties_image) ?>"
                        style="width: 100px;" alt="">
                    <h5 class="mt-2"><?= $data->company_name ?></h5>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Call to action end -->
<?php
    //Count local files 
    $directory ="assets/images/offer";
    $files = glob($directory . "/*.*");
    $num_files = count($files);
    if($num_files != 0){
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7);">
            <!-- <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">SPECIAL OFFER (<span
                        class="text-warning"><?= $num_files ?> New Offers</span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $iterator = new DirectoryIterator($directory);
                        $id = 0;
                        foreach ($iterator as $file) {
                        if ($file->isFile()) {
                        $count = ++$id;
                    ?>
                        <div class="carousel-item <?= $count == 1 ? 'active' : '' ?>">
                            <img src="<?php echo base_url('assets/images/offer/'.$file) ?>" alt=""
                                class="d-block w-100">
                        </div>
                        <?php
                        }}
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(window).on('load', function() {
    $("#exampleModal").modal('show');
});
</script>