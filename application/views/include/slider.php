<div class="carousel slide" id="main-slide" data-ride="carousel">
    <!-- Indicators-->
    <ol class="carousel-indicators visible-lg visible-md">
        <li class="active" data-target="#main-slide" data-slide-to="0"></li>
        <li data-target="#main-slide" data-slide-to="1"></li>
        <li data-target="#main-slide" data-slide-to="2"></li>
    </ol>
    <!-- Indicators end-->
    <!-- Carousel inner-->
    <div class="carousel-inner">
        <?php
            for($i = 1; $i < 6 ; $i++){
                $filename = $i.'.png';
                $file_path = FCPATH . "assets/images/slider/" . $filename;
                if (file_exists($file_path)) {
        ?>
        <div class="carousel-item <?= $filename == '1.png' ? 'active' : '' ?>"
            style="background-image:url(<?php echo base_url('assets/images/slider/'.$filename) ?>);">
            <div class="container">
                <div class="slider-content text-left">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
            <!-- Container end-->
        </div>
        <?php }} ?>
    </div>
    <!-- Carousel inner end-->
    <!-- Controllers--><a class="left carousel-control carousel-control-prev" href="#main-slide"
        data-slide="prev"><span><i class="fa fa-angle-left"></i></span></a>
    <a class="right carousel-control carousel-control-next" href="#main-slide" data-slide="next"><span><i
                class="fa fa-angle-right"></i></span></a>
</div>
<!-- Carousel end-->