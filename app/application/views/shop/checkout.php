<!-- Page Content -->
<div class="page-content">
    <div class="container bottom-content shop-cart-wrapper">
        <h3>Shopping Coupons</h3>
        <input type="hidden" id="usedCoupon" value="0">
        <div class="mt-3 mb-3">
            <button class="btn w-100 btn-outline-success mb-2">Total Coupons :
                <?= $tcoupon=$customerDetails[0]->no_of_coupon ?></button>
            <button class="btn w-100 btn-outline-danger mb-2">Used Coupons :
                <?= $ucoupon = $customerDetails[0]->coupon_used ?></button>
            <button class="btn w-100 btn-outline-warning mb-2">Available Coupons : <?= $tcoupon - $ucoupon ?></span>
        </div>

        <h6>Shopping Coupons for this order</h6>
        <?php
            $checkTime = $customerDetails[0]->activation_date;
            $currentTime = date('Y-m-d H:i:s');

            $diffInSeconds = strtotime($currentTime) - strtotime($checkTime);
            $diffInHours = floor($diffInSeconds / 3600);

            if($diffInHours < 24 AND $customerDetails[0]->fasttrack_status == 0){
        ?>
        <div class="text-center">
            <h6 class="bg-info badge">Fastrack Purchase</h6>
        </div>
        <?php }else{ ?>
        <?php for($i = 0; $i < $dcoupon; $i++){ ?>
        <div class="container mb-3 rounded" style="border:1px solid #ccc;">
            <div class="row align-items-center">
                <div class="col-8 text-center">
                    Coupon Amount : &#8377;<?= $customerDetails[0]->shopping_coupon_amt ?>/-
                </div>
                <div class="col-4">
                    <button onclick="addCoupon(<?= $i ?>, <?= $customerDetails[0]->shopping_coupon_amt ?>)"
                        id="add<?= $i ?>" class="btn btn-success px-4">Add</button>
                    <button style="display:none;"
                        onclick="removeCoupon(<?= $i ?>, <?= $customerDetails[0]->shopping_coupon_amt ?>)"
                        id="remove<?= $i ?>" class="btn btn-danger px-4">Remove</button>
                </div>
            </div>
        </div>
        <?php }} ?>
        <span id="usedCoupon"></span>
    </div>

    <div class="footer fixed ">
        <div class="container">
            <form id="placeorder" action="<?php echo base_url('products/placeOrder') ?>" method="post">
                <div class="view-title mb-2">
                    <?php 
                    $id=0;
                    foreach($cart as $cart){
                        $productId = $cart->product_id;
                        $productDetails = $this->Crud->ciRead("product_master", "`product_id` = '$productId'");

                        $qty = $cart->qty;
                        $price = $productDetails[0]->price * $qty;
                        $totalPrice += $price;
                ?>
                    <input type="hidden" name="finalProductId[]" value="<?= $productDetails[0]->product_code ?>">
                    <input type="hidden" name="finalQty[]" value="<?= $cart->qty ?>">
                    <input type="hidden" name="finalPrice[]" value="<?= $productDetails[0]->price ?>">
                    <input type="hidden" name="finalGst[]" value="<?= $productDetails[0]->gst ?>">
                    <?php
                    }
                ?>

                    <ul>
                        <li>
                            <span class="text-soft">Subtotal(&#8377;)</span>
                            <span class="text-soft" id="totalPrice"><?= $totalPrice ?></span>
                        </li>
                        <li>
                            <span class="text-soft">Discount(&#8377;)</span>
                            <span class="text-soft" id="dist">0</span>
                        </li>
                        <li>
                            <h5>Total(&#8377;)</h5>
                            <h5 id="tprice"><?= $totalPrice ?></h5>
                        </li>
                    </ul>
                </div>
                <div class="footer-btn d-flex align-items-center">
                    <button type="button" onclick="placeOrder()" class="btn btn-primary flex-1">PLACE ORDER</button>
                    <input type="hidden" name="finalCouponUsed" id="finalCouponUsed">
                    <input type="hidden" name="finalTotalAmount" id="finalTotalAmount">
                    <input type="hidden" name="finalDistPrice" id="finalDistPrice">
                    <input type="hidden" name="cartItems" value="<?= $cartItem ?>">
                    <input type="hidden" name="finalDistAmt" id="finalDistAmt">
                </div>
        </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
    function addCoupon(x, y) {
        var totalAmount = $('#tprice').html();
        var discount = $('#dist').html();
        $("#add" + x).hide();
        $("#remove" + x).show();
        var disMinusAmt = parseInt(totalAmount) - parseInt(y);
        var disAmt = parseInt(discount) + parseInt(y);
        $('#tprice').html(disMinusAmt);
        $('#dist').html(disAmt);

        $("#usedCoupon").val()
        var couponUsed = $("#usedCoupon").val()
        $("#usedCoupon").val(parseInt(couponUsed) + 1)

        var coupon = $('#usedCoupon').html()
    }
    </script>

    <script>
    function removeCoupon(x, y) {
        var totalAmount = $('#tprice').html();
        var discount = $('#dist').html();
        $("#add" + x).show();
        $("#remove" + x).hide();
        var disPlusAmt = parseInt(totalAmount) + parseInt(y);
        var disAmt = parseInt(discount) - parseInt(y);

        $("#usedCoupon").val()
        var couponUsed = $("#usedCoupon").val()
        $("#usedCoupon").val(parseInt(couponUsed) - 1)

        $('#tprice').html(disPlusAmt)
        $('#dist').html(disAmt);
    }
    </script>

    <script>
    function placeOrder() {
        $("#finalCouponUsed").val($("#usedCoupon").val());
        $("#finalTotalAmount").val($("#totalPrice").html());
        $("#finalDistPrice").val($("#dist").html());
        $("#finalDistAmt").val($("#tprice").html());
        // $("#finalPaymentType").val($("input[name='paymentType']:checked").val());

        $("#placeorder").submit();
    }
    </script>