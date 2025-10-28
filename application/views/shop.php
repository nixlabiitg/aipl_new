<style>
.scrollbar {
    height: 500px;
    overflow-y: scroll;
    margin-bottom: 25px;
}

#style-3::-webkit-scrollbar-track {
    background-color: transparent;
}

#style-3::-webkit-scrollbar {
    width: 3px;
    background-color: transparent;
}

#style-3::-webkit-scrollbar-thumb {
    background-color: #ddd;
}

.lightning-border {
  font-size: 10px;
  padding: 0px 10px;
  border: 2px solid green; /* Bootstrap info color */
  border-radius: 5px;
  color: green;
  position: relative;
  display: inline-block;
  animation: lightning 1.2s infinite;
}

/* Flickering lightning effect */
@keyframes lightning {
  0%   { box-shadow: 0 0 2px green, 0 0 5px green; }
  20%  { box-shadow: 0 0 6px green, 0 0 12px green; }
  40%  { box-shadow: 0 0 2px green, 0 0 5px green; }
  60%  { box-shadow: 0 0 10px green, 0 0 20px green; }
  80%  { box-shadow: 0 0 3px green, 0 0 7px green; }
  100% { box-shadow: 0 0 8px green, 0 0 15px green; }
}
</style>
<input hidden id="categoryid" value="<?=$catid?>">
<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Shop</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Shop</a></li>
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
            <div class="col-lg-4">
                <div class="sidebar sidebar-left">
                    <div class="widget widget-search">
                        <div class="input-group" id="search" style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border:none;">
                            <input class="form-control" id="productsearch" onkeyup="product_filter()"
                                placeholder="Search" type="text"><span class="input-group-btn"><i
                                    class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="widget recent-posts" style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border: none;">
                        <h3 class="widget-title">Top Categories</h3>
                        <ul class="unstyled clearfix scrollbar" id="style-3">
                            <?php foreach($category as $category){ ?>
                            <li class="media">
                                <div class="media-body media-middle">
                                    <h4 class="entry-title"><a style="cursor : pointer;" onclick="cat_product(this)"
                                            id="c_<?=$category['category_id']?>"><?= $category['category_name'] ?></a>
                                    </h4>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Recent post end-->
                </div>
                <!-- Sidebar end-->

                <div class="sidebar sidebar-left">
                    <div class="widget recent-posts" style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border: none;">
                        <h3 class="widget-title">New Products</h3>
                        <ul class="unstyled clearfix">
                            <?php foreach($newproduct as $product){ ?>
                            <li class="media">
                                <div class="media-left media-middle">
                                    <?php if($product['product_image'] != ''){ ?>
                                    <img alt="img"
                                        src="<?php echo base_url('admin/uploads/products/'.$product['product_image_one']) ?>">
                                    <?php }else{ ?>
                                    <img alt="img" src="<?php echo base_url('portal_assets/images/logo.png') ?>"
                                        style="width: 100%;">
                                    <?php } ?>
                                </div>
                                <div class="media-body media-middle">
                                    <h4 class="entry-title"><a href="#" class="text-capitalize"
                                            id="<?=$product['product_id']?>"
                                            onclick='product_details(this);'><?= $product['product_name'] ?></a>
                                        <small>&#8377;<?= number_format($product['price'], 2) ?></small>
                                    </h4>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Recent post end-->
                </div>
            </div>
            <!-- Sidebar Col end-->
            <div class="col-lg-8">
                <div class="container">
                    <!-- Title row end-->
                    <div class="row" id="product_h">
                        <?php foreach($prd as $products){
                            $productId = $products['product_id'];
                            $product_stock_sql = $this->db->query("SELECT (SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) - SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) AS total_stock FROM `stock_master` WHERE `product_id` = '$productId'");
                            $result = $product_stock_sql->result();
                            $stock = $result[0]->total_stock;
                            $arrival_status = $products['new_arrival'];  
                        ?>
                        <div class="col-lg-4 col-md-12 mb-3" title="<?= $products["product_name"] ?>">
                            <div class="ts-service-box"

                                style="padding : 5px; border-radius : 5px; background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 10px; border-radius: 10px;">
                                <?php if($stock == 0 && $arrival_status != 1){ ?>
                                    <span class="text-danger border border-danger p-1 rounded" style="font-size: 10px;">OUT OF STOCK</span>
                                <?php } ?>

                                <?php if($arrival_status == 1){ ?>
                                <span class="lightning-border">New Arrival</span>
                                <?php } ?>
                                <div class="ts-service-image-wrapper text-center">
                                    <?php if($product['product_image_one'] != ''){ ?>
                                        <img class="img-fluid"
                                        src="<?php echo base_url('admin/uploads/products/'.$products['product_image_one']) ?>"
                                        style="height:200px;" alt="">
                                    <?php }else{ ?>
                                        <img alt="img" src="<?php echo base_url('portal_assets/images/logo.png') ?>" style="width: 100%;">
                                    <?php } ?>
                                </div>
                                <div class="ts-service-content text-center">
                                    <h3 class="service-title">
                                        <a id="<?=$products['product_id']?>" style="font-size: 12px;" href="#" onclick='product_details(this);'
                                            class="text-dark text-capitalize h6">
                                            <?= character_limiter($products["product_name"],20) ?>
                                        </a>
                                    </h3>
                                    <h5>
                                        <span
                                            class="text-secondary"><del><?=($products['mrp']>$products['price']?'&#8377;'.$products['mrp']:"")?></del></span>&nbsp;
                                        &#8377;<?=$products['price']?>
                                    </h5>
                                    <p>
                                        <?php if(!$this->session->userdata('aiplUserId')){ ?>
                                        <a class="link-more btn btn-secondary"
                                            href="<?php echo base_url('/authentication/login') ?>"><i
                                                class="icon icon-cart"></i> Add to Cart</a>
                                        <?php }else{
                                            if($stock == 0){   
                                        ?>
                                        <button class="link-more btn btn-secondary btn-block" disabled><i
                                                class="icon icon-cart"></i>
                                            Add to
                                            Cart</button>
                                        <?php } else { ?>
                                        <button
                                            id="<?= $this->session->userdata('aiplUserId').'/'.$products['product_id'] ?>"
                                            onclick="addToCart(this)" class="link-more btn btn-secondary btn-block"><i
                                                class="icon icon-cart"></i>
                                            Add to
                                            Cart</button>
                                        <?php }} ?>
                                    </p>
                                </div>
                            </div>
                            <!-- Service1 end-->
                        </div>
                        <?php } ?>
                    </div>
                    <!-- Content 1 row end-->
                </div>

                <!-- 4th post end-->
            </div>
            <!-- Content Col end-->
        </div>
        <!-- Main row end-->
    </div>
    <!-- Container end-->
</section>

<form hidden action="<?php echo base_url('welcome/shop_details') ?>" method="post" id="pdetails">
    <input type="text" value="" id="pid" name="pid">
</form>

<link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
    type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
    type="text/javascript"></script>

<script>
cat_product = function(x) {
    $("#categoryid").val(x.id.split("_")[1]);
    product_filter();
}

product_filter = function(x) {
    var t_ = (x ? x.id : '').split("_");
    var d = {
        "cid": $("#categoryid").val(),
        "search": ($("#productsearch").val())
    }
    $.ajax({
        url: "<?=base_url('filter_shop')?>",
        type: "post",
        dataType: "text",
        data: d,
        success: function(data) {
            // alert(data);
            var data_ = data.split("|");
            var a = JSON.parse(data_[0]);
            var em = '';
            for (i = 0; i < a.length; i++) {

                let stock = parseInt(a[i]['stock']);
                let arrival_status = parseInt(a[i]['arrival_status']);

                em += '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3" title="'+a[i]['product_name']+'">' +
                    '<div class="ts-service-box" style="padding : 5px; border-radius : 5px; background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">';

                    // stock / arrival labels
                    if (stock === 0 && arrival_status != 1) {
                        em += '<span class="text-danger border border-danger p-1 rounded" style="font-size:10px;">OUT OF STOCK</span>';
                    }
                    if (arrival_status === 1) {
                        em += '<span class="lightning-border">New Arrival</span>';
                    }

                    em += '<div class="ts-service-image-wrapper text-center">' +
                    '<img id="' + a[i]['product_id'] +
                    '" onclick="product_details(this);" src="<?=base_url('admin/uploads/products/')?>' +
                    (a[i]['product_image_one'] == "" ? "default.png" : a[i]['product_image_one']) +
                    '" alt="shop_product" style="height:200px;">' +
                    '</div>' +
                    '<div class="ts-service-content text-center">'

                    +
                    '<h3 class="service-title text-capitalize"><a id="' + a[i]['product_id'] +
                    '" onclick="product_details(this);" style="font-size:12px;">' + a[i]['product_name'] + '</a></h3>' +
                    '<h5><span class="text-secondary"><del>' + (a[i]['mrp'] > a[i]['price'] ?
                        '&#8377;' + a[i]['mrp'] : "") + '</del></span>&nbsp; &#8377;' + a[i]['price'] +
                    '</h5> ' +
                    '<div class="hs_shop_prodt_cart_btn">' +
                    '<a  id="' + a[i]['product_id'] +
                    '" href="#" class="link-more btn btn-secondary btn-block" onclick="product_details(this);">View Details</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            }
            $("#product_h").html(em);
        },
        error: function(data) {
            alert(data);
        }


    });
}
</script>

<script>
function product_details(x) {
    var p = x.id;
    $("#pid").val(p);
    $("#pdetails").submit();
}
</script>

<script>
function addToCart(x) {
    var cart = x.id.split("/");
    var details = {
        "customerid": cart[0],
        "productid": cart[1],
        "qty": 1
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
                    // window.location.assign("<?php echo base_url('shop') ?>")
                });
            } else if (response == 1) {
                $("#cart").html(Number($("#cart").html()) + 1);
                Swal.fire(
                    'Success',
                    'Item added to Cart.',
                    'success'
                ).then((result) => {
                    // $("#cart").html(Number($("#cart").html())+1);
                    // window.location.assign("<?php echo base_url('shop') ?>")
                });
            }
        }
    })
}
</script>