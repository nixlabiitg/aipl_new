<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-2">
                <h6>Magic Shopping Points Available &#8377; <?=$mspoint?></h6>
                <input type="text" hidden id="mpoint" value="<?=$mspoint?>">
                <!-- <input type="hidden" id="usedCoupon" value="0">
                    <p class="mt-4"><span style="border:1px solid #ccc; border-radius:10px; padding : 5px 10px; color : green;">Total Coupons : <?= $tcoupon=$customerDetails[0]->no_of_coupon ?></span> <span style="border:1px solid #ccc; border-radius:10px; padding : 5px 10px; color : red;">Used Coupons : <?= $ucoupon = $customerDetails[0]->coupon_used ?></span> <span style="border:1px solid #ccc; border-radius:10px; padding : 5px 10px; color : orange;">Available Coupons : <?= $tcoupon - $ucoupon ?></span></p>
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
                    <?php } ?>
                    <span id="usedCoupon"></span> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-2">
                <!-- <h4>Products</h4> -->
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id=0; foreach($product as $p){
                                   
                                   
                                     $price = $p['price'];
                                  
                                     $rewarddiscount=round($price*50/100,2);
                                     $discount=round($rewarddiscount*20/100,2);
                                     if($mspoint<$discount) $discount=$mspoint;
                                ?>
                        <input type="hidden" name="productid" id="productid" value="<?= $p['product_code'] ?>">
                        <input type="hidden" name="rate" id="rate" value="<?= $p['price'] ?>">

                        <tr>
                            <td class="text-center"><?= ++$id; ?></td>
                            <td><?= $p['product_name'] ?></td>
                            <td class="text-center">
                                <div class="quantity">
                                    <!-- <span class="quantity__minus" style="cursor : pointer;"
                                        id="<?= $p['product_code'].'~'.$p['price']."~".$mspoint ?>"   onclick="minus_cart_(this)"><span>-</span></span> -->
                                    <input name="quantity" type="text" id="qty<?= $p['product_code'] ?>"
                                        class="quantity__input" value="1" readonly style="border:0">
                                    <!-- <span class="quantity__plus" style="cursor : pointer;"
                                            id="<?= $p['product_code'].'~'.$p['price']."~".$mspoint ?>" onclick="plus_cart_(this)"><span>+</span></span> -->
                                </div>
                            </td>
                            <td class="text-right" id="amt<?= $p['product_code'] ?>"><?= $p['price'] ?></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-right font-weight-bolder" colspan="3"><b>Total :</b> </td>
                            <td class="text-right font-weight-bold">&#8377;<span id="totalPrice"><?= $price ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-weight-bold" colspan="3">Reward Discount : </td>
                            <td class="text-right font-weight-bold">&#8377;<span id="rdist"><?=$rewarddiscount?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-weight-bold" colspan="3">Shopping Points Applied : </td>
                            <td class="text-right font-weight-bold">&#8377;<span id="dist"><?=$discount?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-weight-bold" colspan="3">Net Amount : </td>
                            <td class="text-right font-weight-bold">&#8377;<span
                                    id="tprice"><?= $price-$discount-$rewarddiscount ?></span>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="col-lg-12">
                    <hr>
                    <div style="text-align:right">
                        <button onclick="placeOrder()" class="btn btn-info btn-sm px-3 py-2">Place Order</button>
                    </div>
                </div>
                <!-- <form id="placeorder" action="<?php echo base_url('report/placeOrder') ?>" method="post"> -->
                <input type="hidden" name="pid" id="pid">
                <input type="hidden" name="pqty" id="pqty">
                <input type="hidden" name="pamount" id="pamount">

                <input type="hidden" name="gross" id="gross">
                <input type="hidden" name="rewarddiscount" id="rewarddiscount">
                <input type="hidden" name="spointdiscount" id="spointdiscount">
                <input type="hidden" name="orderamount" id="orderamount">
                <!-- <input type="text" name="finalPaymentType" id="finalPaymentType"> -->
                <!-- </form> -->
            </div>
        </div>

    </div>
    </section>

    <link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css"
        rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
        type="text/javascript"></script>

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
        var pid = $("#productid").val();

        var d = {
            "sid": <?=$sid?>,
            "pid": pid,
            "pqty": $("#qty" + pid).val(),
            "pamount": $("#amt" + pid).html(),
            "prate": $("#rate").val(),
            "gross": $("#totalPrice").html(),
            "rewarddiscount": $("#rdist").html(),
            "spointdiscount": $("#dist").html(),
            "orderamount": $("#tprice").html()
        }
        $.ajax({
            url: "<?=base_url('report/placeOrder')?>",
            type: "POST",
            dataType: "TEXT",
            data: d,
            success: function(data) {
                // alert(data);
                alert("Order Placed Successfully.");
                window.open("<?=base_url('report/rewards')?>", '_self');

            },
            error: function(data) {
                alert(data);
            }
        })

    }
    </script>
    <script>
    function minus_cart_(x) {
        var p = x.id.split("~");
        var value = $("#qty" + p[0]).val();
        if (value > 1) {
            value--;
        }
        $("#qty" + p[0]).val(value);
        var amt = value * p[1]
        $("#amt" + p[0]).html(amt.toFixed(2));
        $("#totalPrice").html(amt.toFixed(2));
        var discount = amt * 20 / 100;
        var mspoint = p[2];
        var rdiscount = amt * 50 / 100;
        $("#rdist").html(rdiscount.toFixed(2));
        if (mspoint < discount) discount = mspoint;
        $("#dist").html(discount.toFixed(2));
        var tamount = amt - discount - rdiscount;
        $("#tprice").html(tamount.toFixed(2));
    }
    </script>

    <script>
    function plus_cart_(x) {

        var p = x.id.split("~");

        var value = $("#qty" + p[0]).val();
        value++;
        $("#qty" + p[0]).val(value);
        var amt = value * p[1]
        $("#amt" + p[0]).html(amt.toFixed(2));
        $("#totalPrice").html(amt.toFixed(2));
        var discount = amt * 20 / 100;
        var mspoint = p[2];
        var rdiscount = amt * 50 / 100;
        $("#rdist").html(rdiscount.toFixed(2));
        if (mspoint < discount) discount = mspoint;
        $("#dist").html(discount.toFixed(2));
        var tamount = amt - discount - rdiscount;
        $("#tprice").html(tamount.toFixed(2));

    }
    </script>
    <style>
    /* Increment button css */
    .quantity {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .quantity__minus,
    .quantity__plus {
        display: block;
        /* width: 42px;
  height: 43px; */
        margin: 0;
        background: #dee0ee;
        text-decoration: none;
        text-align: center;
        line-height: 23px;
    }

    .quantity__minus:hover,
    .quantity__plus:hover {
        background: #575b71;
        color: #fff;
    }

    .quantity__minus {
        border-radius: 3px 0 0 3px;
        font-size: 25px;
        padding: 5px 15px;
    }

    .quantity__plus {
        border-radius: 0 3px 3px 0;
        font-size: 25px;
        padding: 5px 15px;
    }

    .quantity__input {
        width: 42px;
        height: 33px;
        margin: 0;
        padding: 0;
        text-align: center;
        border-top: 2px solid #dee0ee;
        border-bottom: 2px solid #dee0ee;
        border-left: 1px solid #dee0ee;
        border-right: 2px solid #dee0ee;
        background: #fff;
        color: #8184a1;
    }

    .quantity__minus:link,
    .quantity__plus:link {
        color: #8184a1;
    }

    .quantity__minus:visited,
    .quantity__plus:visited {
        color: #fff;
    }
    </style>