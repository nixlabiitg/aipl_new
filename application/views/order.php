<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Checkout</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Checkout</a></li>
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
                <div class="col-lg-6 mb-2">
                    <h3>Shopping Coupons</h3>
                    <input type="hidden" id="usedCoupon" value="0">
                    <p><span style="border:1px solid #ccc; border-radius:10px; padding : 5px 10px; color : green;">Total Coupons : <?= $tcoupon=$customerDetails[0]->no_of_coupon ?></span> <span style="border:1px solid #ccc; border-radius:10px; padding : 5px 10px; color : red;">Used Coupons : <?= $ucoupon = $customerDetails[0]->coupon_used ?></span> <span style="border:1px solid #ccc; border-radius:10px; padding : 5px 10px; color : orange;">Available Coupons : <?= $tcoupon - $ucoupon ?></span></p>
                    

                    <?php
                    $checkTime = $customerDetails[0]->activation_date;
					$currentTime = date('Y-m-d H:i:s');

					$diffInSeconds = strtotime($currentTime) - strtotime($checkTime);
					$diffInHours = floor($diffInSeconds / 3600);

					if($diffInHours < 24 && $customerDetails[0]->fasttrack_status == 0){
                    ?>
                        <h6>Fastrack Purchase</h6>
                    <?php }else{ ?>
                    <?php for($i = 0; $i < $dcoupon; $i++){ ?>
                    <div class="row align-items-center ml-2 mb-2">
                        <div class="col-5 p-1 text-center" style="border:1px dotted #ccc; border-radius : 5px;">
                            Coupon Amount : &#8377;<?= $customerDetails[0]->shopping_coupon_amt ?>/-
                        </div>
                        <div class="col-lg-2">
                            <button onclick="addCoupon(<?= $i ?>, <?= $customerDetails[0]->shopping_coupon_amt ?>)" id="add<?= $i ?>" class="btn btn-success px-4">Add</button>
                            <button style="display:none;" onclick="removeCoupon(<?= $i ?>, <?= $customerDetails[0]->shopping_coupon_amt ?>)" id="remove<?= $i ?>" class="btn btn-danger px-4">Remove</button>
                        </div>
                    </div>
                    <?php }} ?>
                    <span id="usedCoupon"></span>
                </div>
                
                <div class="col-lg-6 mb-2">
                    <form id="placeorder" action="<?php echo base_url('placeOrder') ?>" method="post">
                        <h4>Products</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id=0; foreach($cart as $cart){
                                    $productId = $cart->product_id;
                                    $productDetails = $this->Crud->ciRead("product_master", "`product_id` = '$productId'");

                                    $qty = $cart->qty;
                                    $price = $productDetails[0]->price * $qty;
                                    $totalPrice += $price;
                                ?>
                                <tr>
                                    <td class="text-center"><?= ++$id; ?></td>
                                    <td><?= $productDetails[0]->product_name ?></td>
                                    <td class="text-center"><?= $qty ?></td>
                                    <td class="text-right"><?= number_format($price, 2) ?></td>
                                    <input type="hidden" name="finalProductId[]" value="<?= $productDetails[0]->product_code ?>">
                                    <input type="hidden" name="finalPerformanceBonusStatus[]" value="<?= $productDetails[0]->monthly_performance_bonus ?>">
                                    <input type="hidden" name="finalShoppingIncomeStatus[]" value="<?= $productDetails[0]->team_shopping_income ?>">
                                    <input type="hidden" name="finalQty[]" value="<?= $cart->qty ?>">
                                    <input type="hidden" name="finalPrice[]" value="<?= $productDetails[0]->price ?>">
                                    <input type="hidden" name="finalGst[]" value="<?= $productDetails[0]->gst ?>">
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right font-weight-bold" colspan="3">Total : </td>
                                    <td class="text-right font-weight-bold">&#8377;<span id="totalPrice"><?= $totalPrice ?></span>.00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right font-weight-bold" colspan="3">Discount : </td>
                                    <td class="text-right font-weight-bold">&#8377;<span id="dist">0</span>.00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right font-weight-bold" colspan="3">Net Amount : </td>
                                    <td class="text-right font-weight-bold">&#8377;<span id="tprice"><?= $totalPrice ?></span>.00
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- <div class="col-lg-12">
                            <b>Payment Type :</b>&nbsp;&nbsp;
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio1"
                                    value="Cash" checked>
                                <label class="form-check-label" for="inlineRadio1">Cash</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2"
                                    value="UPI">
                                <label class="form-check-label" for="inlineRadio2">UPI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2"
                                    value="Cheque">
                                <label class="form-check-label" for="inlineRadio2">Cheque</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2"
                                    value="RTGS/NEFT">
                                <label class="form-check-label" for="inlineRadio2">RTGS/NEFT</label>
                            </div>
                        </div> -->
                        <div class="col-lg-12">
                            <hr>
                            <div class="text-right">
                                <button onclick="placeOrder()" class="btn btn-info btn-sm px-3 py-2">Place Order</button>
                            </div>
                        </div>
                        <input type="hidden" name="finalCouponUsed" id="finalCouponUsed">
                        <input type="hidden" name="finalTotalAmount" id="finalTotalAmount">
                        <input type="hidden" name="finalDistPrice" id="finalDistPrice">
                        <input type="hidden" name="cartItems" value="<?= $cartItem ?>">
                        <input type="hidden" name="finalDistAmt" id="finalDistAmt">
                    <!-- <input type="text" name="finalPaymentType" id="finalPaymentType"> -->
                    </form>
                </div>
            </div>
            
    </div>
</section>

<link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
    type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
    type="text/javascript"></script>

<script>
    function addCoupon(x, y){
        var totalAmount = $('#tprice').html();
        var discount = $('#dist').html();
        $("#add"+x).hide();
        $("#remove"+x).show();
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
    function removeCoupon(x, y){
        var totalAmount = $('#tprice').html();
        var discount = $('#dist').html();
        $("#add"+x).show();
        $("#remove"+x).hide();
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
    function placeOrder(){
        $("#finalCouponUsed").val($("#usedCoupon").val());
        $("#finalTotalAmount").val($("#totalPrice").html());
        $("#finalDistPrice").val($("#dist").html());
        $("#finalDistAmt").val($("#tprice").html());
        // $("#finalPaymentType").val($("input[name='paymentType']:checked").val());

        $("#placeorder").submit();
    }
</script>