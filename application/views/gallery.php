<?php $id = $_GET['id']; ?>
<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Gallery</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Gallery</a></li>
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

<section id="main-container" class="main-container">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-title">
                    <?php
                        $category = $this->Crud->ciRead("galler_category", "`id` = '$id'");
                        echo $category[0]->gallery_category.' Images';
                    ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <?php
                $gallery = $this->Crud->ciRead("gallery", "`gallery_category` = '$id'");
                foreach($gallery as $key){
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="gallery-img">
                    <a class="gallery-popup" href="<?php echo base_url('admin/uploads/gallery/'.$key->file_name) ?>">
                        <img class="img-fluid" src="<?php echo base_url('admin/uploads/gallery/'.$key->file_name) ?>" alt="" style="height:200px;">
                        <span class="gallery-icon"><i class="fa fa-search"></i></span>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>