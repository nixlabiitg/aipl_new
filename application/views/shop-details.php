<style>
.lightning-border {
    font-size: 15px;
    padding: 0px 10px;
    border: 2px solid green;
    /* Bootstrap info color */
    border-radius: 5px;
    color: green;
    position: relative;
    display: inline-block;
    animation: lightning 1.2s infinite;
}

/* Flickering lightning effect */
@keyframes lightning {
    0% {
        box-shadow: 0 0 2px green, 0 0 5px green;
    }

    20% {
        box-shadow: 0 0 6px green, 0 0 12px green;
    }

    40% {
        box-shadow: 0 0 2px green, 0 0 5px green;
    }

    60% {
        box-shadow: 0 0 10px green, 0 0 20px green;
    }

    80% {
        box-shadow: 0 0 3px green, 0 0 7px green;
    }

    100% {
        box-shadow: 0 0 8px green, 0 0 15px green;
    }
}
</style>

<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Shop Details</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Shop Details</a></li>
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

<section class="single-project" id="single-project">
    <div class="container">
        <?php foreach($pro as $pro){?>
        <div class="row">
            <div class="col-lg-7">
                <div class="carousel slide " id="main-slide" data-ride="carousel">
                    <!-- Indicators-->
                    <ol class="carousel-indicators visible-lg visible-md">
                        <li class="active" data-target="#main-slide" data-slide-to="0"></li>
                        <li data-target="#main-slide" data-slide-to="1"></li>
                        <li data-target="#main-slide" data-slide-to="2"></li>
                    </ol>
                    <!-- Indicators end-->
                    <!-- Carousel inner-->
                    <div class="carousel-inner">
                        <div class="carousel-item active"
                            style="background-image:url(<?php echo base_url('admin/uploads/products/'.$pro['product_image_one']) ?>);">
                        </div>
                        <!-- Carousel item 1 end-->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('admin/uploads/products/'.$pro['product_image_two']) ?>);">
                        </div>
                        <!-- Carousel item 2 end-->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('admin/uploads/products/'.$pro['product_image_three']) ?>);">
                        </div>
                        <!-- Carousel item 3 end-->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('admin/uploads/products/'.$pro['product_image_four']) ?>);">
                        </div>
                        <!-- Carousel item 4 end -->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('admin/uploads/products/'.$pro['product_image_five']) ?>);">
                        </div>
                        <!-- Carousel item 5 end -->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('admin/uploads/products/'.$pro['product_image_six']) ?>);">
                        </div>
                        <!-- Carousel item 6 end -->
                    </div>
                    <!-- Carousel inner end-->
                    <!-- Controllers-->
                    <a class="left carousel-control carousel-control-prev" href="#main-slide" data-slide="prev"><span><i
                                class="fa fa-angle-left"></i></span></a>
                    <a class="right carousel-control carousel-control-next" href="#main-slide" data-slide="next">
                        <span><i class="fa fa-angle-right"></i></span></a>
                </div>
                <!-- Carousel end-->
            </div>
            <!-- col end -->
            <div class="col-lg-5 project-right-side">
                <div class="single-project-content">
                    <?php if($STOCK[0]->total_stock == 0 && $pro['new_arrival'] != 1){ ?>
                    <span class="text-danger border border-danger p-1 rounded" style="font-size: 12px;">OUT OF
                        STOCK</span>
                    <?php } ?>
                    <?php if($pro['new_arrival'] == 1){ ?>
                    <span class="lightning-border mb-3">New
                        Arrival</span>
                    <?php } ?>
                    <h2 class="text-capitalize"><?php echo $pro['product_name'] ?></h2>
                    <h4>&#8377;<?=$pro['price']?> <span
                            class="text-secondary h6"><del><?=($pro['mrp']>$pro['price']?'&#8377;'.$pro['mrp']:"")?></del></span>
                    </h4>
                    <p><b>HSN Code : </b> <?php echo $pro['HSN_code'] ?></p>
                </div>
                <div class="my-4">
                    <div class="quantity">
                        <a href="#" class="quantity__minus"><span>-</span></a>
                        <input name="quantity" id="quantity" type="text" class="quantity__input" value="1" readonly>
                        <a href="#" class="quantity__plus"><span>+</span></a>
                    </div>
                </div>
                <?php if(!$this->session->userdata('aiplUserId')) { ?>
                <a href="<?php echo base_url('authentication/login') ?>" class="btn-block btn btn-outline-success"><i
                        class="icon icon-cart"></i> Add to Cart</a>
                <?php }else{ ?>
                <button id="<?= $this->session->userdata('aiplUserId').'/'.$pro['product_id'] ?>"
                    onclick="addToCart(this)" class="btn-block btn btn-outline-success" <?= $STOCK[0]->total_stock == 0 ? 'disabled' : '' ?>><i class="icon icon-cart"></i>
                    Add to Cart</button>
                <?php } ?>

            </div>
            <!-- col end -->
        </div>
        <!-- row end -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="featured-tab">
                    <ul class="nav nav-tabs">
                        <li>
                            <a class="animated active fadeIn px-5" href="#tab_a" data-toggle="tab">
                                <span>Description</span>
                            </a>
                        </li>
                        <li>
                            <a class="animated fadeIn px-5" href="#tab_b" data-toggle="tab">
                                <span>Manufacturer</span>
                            </a>
                        </li>
                        <li>
                            <a class="animated fadeIn px-5" href="#tab_c" data-toggle="tab">
                                <span>Packer Details</span>
                            </a>
                        </li>
                        <li>
                            <a class="animated fadeIn px-5" href="#tab_d" data-toggle="tab">
                                <span>Importer Details</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active animated fadeInRight" id="tab_a">
                            <div class="tab-wrapper">

                                <div class="ts-service-box">
                                    <div class="ts-service-box-content">
                                        <?php echo $pro['product_description'] ?>
                                    </div>
                                </div><!-- Service 1 end -->

                            </div><!-- Tab wrapper end -->
                        </div><!-- Tab pane 1 end -->

                        <div class="tab-pane animated fadeInRight" id="tab_b">
                            <div class="ts-service-box">
                                <div class="ts-service-box-content">
                                    <p><?php echo $pro['manufacturer'] ?></p>
                                </div>
                            </div><!-- Service 1 end -->
                        </div><!-- Tab pane 2 end -->

                        <div class="tab-pane animated fadeInLeft" id="tab_c">
                            <p><?php echo $pro['packer_details'] ?></p>
                        </div>

                        <div class="tab-pane animated fadeInLeft" id="tab_d">
                            <p><?php echo $pro['importer_details'] ?></p>
                        </div>
                    </div><!-- tab content -->
                </div><!-- Featured tab end -->
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- main container end -->
</section>
<link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
    type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
    type="text/javascript"></script>
<script>
$(document).ready(function() {
    const minus = $('.quantity__minus');
    const plus = $('.quantity__plus');
    const input = $('.quantity__input');
    minus.click(function(e) {
        e.preventDefault();
        var value = input.val();
        if (value > 1) {
            value--;
        }
        input.val(value);
    });

    plus.click(function(e) {
        e.preventDefault();
        var value = input.val();
        value++;
        input.val(value);
    })
});
</script>

<script>
function addToCart(x) {
    var cart = x.id.split("/");
    var details = {
        "customerid": cart[0],
        "productid": cart[1],
        "qty": $("#quantity").val()
    };
    $.ajax({
        type: "POST",
        url: '<?php echo base_url('welcome/addToCart') ?>',
        data: details,
        success: function(response) {
            if (response == 0) {
                Swal.fire(
                    'Ooops. Something went wrong.',
                    'Try Again.',
                    'question'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            } else if (response == 1) {
                Swal.fire(
                    'Success',
                    'Item added to Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            }
        }
    })
}
</script>