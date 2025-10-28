<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">FAQ's</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">FAQ's</a></li>
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

<section class="main-container" id="main-container">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion-title">
                    <h3 class="column-title"><span>Our FAQ</span> Frequently Asked Questions</h3>
                </div>
                <div id="accordion" class="accordion-area">
                    <?php foreach($faqs['faqs'] as $key => $items){
                        if($items['status'] == 'active'){
                    ?>
                    <div class="card"
                    style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                        <div class="card-header" id="heading<?= $key ?>">
                            <h5 class="mb-0">
                                <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $key ?>"
                                    aria-expanded="true" aria-controls="collapse<?= $key ?>">
                                    <?= $items['question'] ?>
                                </a>
                            </h5>
                        </div>
                        <div class="collapse <?= $key == 0 ? 'show' : '' ?>" id="collapse<?= $key ?>" aria-labelledby="heading<?= $key ?>"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p><?= $items['answer'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <!-- Accordion end -->
            </div>
            <!-- col end-->
        </div>
        <!-- Row end-->
    </div>
</section>