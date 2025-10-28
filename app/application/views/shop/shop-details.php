<!-- Header End -->
<div class="page-content">
    <?php foreach($pro as $pro){?>
    <div class="content-body bottom-content">
        <div class="swiper-btn-center-lr my-0">
            <div class="swiper demo-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="dz-banner-heading">
                            <div class="overlay-black-light">
                                <img src="<?php echo base_url('../admin/uploads/products/'.$pro['product_image_one']) ?>"
                                    class="bnr-img" alt="bg-image">
                            </div>
                        </div>
                    </div>
                    <?php if($pro['product_image_two'] != ''){ ?>
                    <div class="swiper-slide">
                        <div class="dz-banner-heading">
                            <div class="overlay-black-light">
                                <img src="<?php echo base_url('../admin/uploads/products/'.$pro['product_image_two']) ?>"
                                    class="bnr-img" alt="bg-image">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($pro['product_image_three'] != ''){ ?>
                    <div class="swiper-slide">
                        <div class="dz-banner-heading">
                            <div class="overlay-black-light">
                                <img src="<?php echo base_url('../admin/uploads/products/'.$pro['product_image_three']) ?>"
                                    class="bnr-img" alt="bg-image">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($pro['product_image_four'] != ''){ ?>
                    <div class="swiper-slide">
                        <div class="dz-banner-heading">
                            <div class="overlay-black-light">
                                <img src="<?php echo base_url('../admin/uploads/products/'.$pro['product_image_four']) ?>"
                                    class="bnr-img" alt="bg-image">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($pro['product_image_five'] != ''){ ?>
                    <div class="swiper-slide">
                        <div class="dz-banner-heading">
                            <div class="overlay-black-light">
                                <img src="<?php echo base_url('../admin/uploads/products/'.$pro['product_image_five']) ?>"
                                    class="bnr-img" alt="bg-image">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($pro['product_image_six'] != ''){ ?>
                    <div class="swiper-slide">
                        <div class="dz-banner-heading">
                            <div class="overlay-black-light">
                                <img src="<?php echo base_url('../admin/uploads/products/'.$pro['product_image_six']) ?>"
                                    class="bnr-img" alt="bg-image">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="swiper-btn">
                    <div class="swiper-pagination style-2 flex-1"></div>
                </div>
            </div>
        </div>
        <div class="account-box style-1">
            <div class="container">
                <?php if($STOCK[0]->total_stock == 0 && $pro['new_arrival'] != 1){ ?>
                <span class="text-danger border border-danger p-1 rounded" style="font-size: 12px;">OUT OF
                    STOCK</span>
                <?php } ?>
                <?php if($pro['new_arrival'] == 1){ ?>
                <span class="lightning-border mb-3">New
                    Arrival</span>
                <?php } ?>

                <div class="company-detail mt-3">
                    <div class="detail-content">
                        <div class="flex-1">
                            <h6 class="text-secondary sub-title"><b>HSN Code : </b> <?php echo $pro['HSN_code'] ?></h6>
                            <h4><?php echo $pro['product_name'] ?></h4>
                            <p><?php echo  $pro['product_description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="item-list-2">
                    <div class="price">
                        <span class="text-style text-soft">Price</span>
                        <h3 class="sub-title">&#8377;<?=$pro['price']?>
                            <del><?=($pro['mrp']>$pro['price']?'&#8377;'.$pro['mrp']:"")?></del>
                        </h3>
                    </div>
                    <div class="dz-stepper border-1 rounded-stepper">
                        <input readonly class="stepper" type="text" id="quantity" value="0" name="demo3">
                    </div>
                </div>
                <div class="align-items-center justify-content-between">
                    <p><b>Manufacturer :</b> <?php echo $pro['manufacturer'] ?></p>
                    <p><b>Packer Details :</b> <?php echo $pro['packer_details'] ?></p>
                    <p><b>Importer Details :</b> <?php echo $pro['importer_details'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer fixed">
        <div class="container">
            <?php if(!$this->session->userdata('aiplAppId')) { ?>
            <a href="<?php echo base_url('authentication/login') ?>" class="btn btn-primary text-start w-100">
                <svg class="cart me-4" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.1776 17.8443C16.6362 17.8428 15.3854 19.0912 15.3839 20.6326C15.3824 22.1739 16.6308 23.4247 18.1722 23.4262C19.7136 23.4277 20.9643 22.1794 20.9658 20.638C20.9658 20.6371 20.9658 20.6362 20.9658 20.6353C20.9644 19.0955 19.7173 17.8473 18.1776 17.8443Z"
                        fill="white" />
                    <path
                        d="M23.1278 4.47973C23.061 4.4668 22.9932 4.46023 22.9251 4.46012H5.93181L5.66267 2.65958C5.49499 1.46381 4.47216 0.574129 3.26466 0.573761H1.07655C0.481978 0.573761 0 1.05574 0 1.65031C0 2.24489 0.481978 2.72686 1.07655 2.72686H3.26734C3.40423 2.72586 3.52008 2.82779 3.53648 2.96373L5.19436 14.3267C5.42166 15.7706 6.66363 16.8358 8.12528 16.8405H19.3241C20.7313 16.8423 21.9454 15.8533 22.2281 14.4747L23.9802 5.74121C24.0931 5.15746 23.7115 4.59269 23.1278 4.47973Z"
                        fill="white" />
                    <path
                        d="M11.3404 20.5158C11.2749 19.0196 10.0401 17.8418 8.54244 17.847C7.0023 17.9092 5.80422 19.2082 5.86645 20.7484C5.92617 22.2262 7.1283 23.4008 8.60704 23.4262H8.67432C10.2142 23.3587 11.4079 22.0557 11.3404 20.5158Z"
                        fill="white" />
                </svg>
                ADD TO CART
            </a>
            <?php }else{ ?>
            <button id="<?= $this->session->userdata('aiplAppId').'/'.$pro['product_id'] ?>" onclick="addToCart(this)" <?= $STOCK[0]->total_stock == 0 ? 'disabled' : '' ?>
                class="btn btn-primary text-start w-100">
                <svg class="cart me-4" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.1776 17.8443C16.6362 17.8428 15.3854 19.0912 15.3839 20.6326C15.3824 22.1739 16.6308 23.4247 18.1722 23.4262C19.7136 23.4277 20.9643 22.1794 20.9658 20.638C20.9658 20.6371 20.9658 20.6362 20.9658 20.6353C20.9644 19.0955 19.7173 17.8473 18.1776 17.8443Z"
                        fill="white" />
                    <path
                        d="M23.1278 4.47973C23.061 4.4668 22.9932 4.46023 22.9251 4.46012H5.93181L5.66267 2.65958C5.49499 1.46381 4.47216 0.574129 3.26466 0.573761H1.07655C0.481978 0.573761 0 1.05574 0 1.65031C0 2.24489 0.481978 2.72686 1.07655 2.72686H3.26734C3.40423 2.72586 3.52008 2.82779 3.53648 2.96373L5.19436 14.3267C5.42166 15.7706 6.66363 16.8358 8.12528 16.8405H19.3241C20.7313 16.8423 21.9454 15.8533 22.2281 14.4747L23.9802 5.74121C24.0931 5.15746 23.7115 4.59269 23.1278 4.47973Z"
                        fill="white" />
                    <path
                        d="M11.3404 20.5158C11.2749 19.0196 10.0401 17.8418 8.54244 17.847C7.0023 17.9092 5.80422 19.2082 5.86645 20.7484C5.92617 22.2262 7.1283 23.4008 8.60704 23.4262H8.67432C10.2142 23.3587 11.4079 22.0557 11.3404 20.5158Z"
                        fill="white" />
                </svg>
                ADD TO CART
            </button>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Page Content End -->
<?php } ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function addToCart(x) {

    if ($("#quantity").val() == 0) {
        alert("Your selected item 0");
        return
    }

    var cart = x.id.split("/");
    var details = {
        "customerid": cart[0],
        "productid": cart[1],
        "qty": $("#quantity").val()
    };
    $.ajax({
        type: "POST",
        url: '<?php echo base_url('products/addToCart') ?>',
        data: details,
        success: function(response) {
            if (response == 0) {
                window.location.assign("<?php echo base_url('products/cart') ?>")

            } else if (response == 1) {
                window.location.assign("<?php echo base_url('products/cart') ?>")
            }
        }
    })
}
</script>