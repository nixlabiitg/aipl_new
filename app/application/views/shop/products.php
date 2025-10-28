<style>
.lightning-border {
    font-size: 10px;
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
<!-- Page Content -->
<div class="page-content">
    <div class="content-inner pt-0">
        <div class="container bottom-content">
            <!-- Search -->
            <div>
                <div class="mb-3 input-group input-radius">
                    <span class="input-group-text">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z"
                                fill="#7D8FAB" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Search products" class="form-control main-in ps-0 bs-0">
                </div>
            </div>

            <!-- Dashboard Area -->
            <div class="dashboard-area">
                <!-- Recomended Start -->
                <div class="title-bar">
                    <span class="title mb-0 font-18">Our Products</span>
                </div>
                <div class="row g-3">
                    <?php $id = 0; foreach($prd as $products){
                        $sl = ++$id;
                        $productId = $products['product_id'];
                        $product_stock_sql = $this->db->query("SELECT (SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) - SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) AS total_stock FROM `stock_master` WHERE `product_id` = '$productId'");
                        $result = $product_stock_sql->result();
                        $stock = $result[0]->total_stock;
                        $arrival_status = $products['new_arrival'];
                    ?>
                    <div class="col-6">
                        <div class="card-item style-1">
                            <?php if($stock == 0 && $arrival_status != 1){ ?>
                            <span class="text-danger border border-danger p-1 rounded" style="font-size: 10px;">OUT OF
                                STOCK</span>
                            <?php } ?>

                            <?php if($arrival_status == 1){ ?>
                            <span class="lightning-border">New Arrival</span>
                            <?php } ?>

                            <div class="dz-media">
                                <?php if($products['product_image_one'] != ''){ ?>
                                <img src="<?php echo base_url('../admin/uploads/products/'.$products['product_image_one']) ?>"
                                    alt="image" style="height: 200px; width: 100%;">
                                <?php }else{ ?>
                                <img src="<?php echo base_url('../admin/uploads/products/no-image.png') ?>" alt="image">
                                <?php } ?>
                                <!-- <div class="label">5% OFF</div> -->
                            </div>
                            <div class="dz-content">
                                <h6 class="title mb-3"><a id="<?=$products['product_id']?>" href="#"
                                        onclick='product_details(this);'><?= $products["product_name"] ?></a></h6>
                                <div class="dz-meta">
                                    <ul>
                                        <li class="price text-accent"><span
                                                class="text-secondary"><del><?=($products['mrp']>$products['price']?'&#8377;'.$products['mrp']:"")?></del></span>&nbsp;
                                            &#8377;<?=$products['price']?>
                                        </li>
                                        <!-- <li class="review">
                                            <span class="text-soft font-10">(243)</span>
                                            <i class="fa fa-star"></i>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="mt-2">
                                    <?php if(!$this->session->userdata('aiplAppId')){ ?>
                                    <a class="btn btn-primary add-btn light"
                                        href="<?php echo base_url('/authentication/login') ?>">Add to cart</a>
                                    <?php }else{
                                        if($stock == 0){   
                                    ?>
                                        <button class="btn btn-primary add-btn light" disabled><i
                                                class="icon icon-cart"></i>
                                            Add to
                                            Cart</button>
                                    <?php } else { ?>
                                    <div class="text-center">
                                        <span class="text-info" style="font-size : 12px;" id="cartMsg<?= $sl ?>"></span>
                                    </div>
                                    <button
                                        id="<?= $this->session->userdata('aiplAppId').'/'.$products['product_id'] ?>"
                                        onclick="addToCart(this, <?= $sl ?>)" class="btn btn-primary add-btn light">Add
                                        to cart</button>
                                    <?php }} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- Recomended Start -->
            </div>
        </div>
    </div>

</div>
<!-- Page Content End-->

<form hidden action="<?php echo base_url('Products/shop_details') ?>" method="post" id="pdetails">
    <input type="text" value="" id="pid" name="pid">
</form>

<link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
    type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
    type="text/javascript"></script>

<script>
function product_details(x) {
    var p = x.id;
    $("#pid").val(p);
    $("#pdetails").submit();
}
</script>

<script>
function addToCart(x, y) {
    var cart = x.id.split("/");
    var details = {
        "customerid": cart[0],
        "productid": cart[1],
        "qty": 1
    };
    $.ajax({
        type: "POST",
        url: '<?php echo base_url('products/addToCart') ?>',
        data: details,
        success: function(response) {
            if (response == 0) {
                alert("Something went wrong. Try again.")
            } else if (response == 1) {
                $("#cartMsg" + y).html("Added to cart.");
            }
        }
    })
}
</script>