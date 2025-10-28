<style>
.quantity {
  display: flex;
  align-items: center;
  padding: 0;
}
.quantity__minus,
.quantity__plus {
    display: block;
    width: 22px;
    height: 23px;
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
    font-size: 20px;
    padding: 0px 5px;
}

.quantity__plus {
    border-radius: 0 3px 3px 0;
    font-size: 20px;
    padding: 0px 5px;
}

.quantity__input {
    width: 22px;
    height: 23px;
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
<!-- Page Content -->
<div class="page-content">
    <div class="container bottom-content shop-cart-wrapper">
        <div class="item-list style-2">
            <ul>
                <?php $id = 0; foreach($cart as $cart){
                    $pdid = $cart->product_id;
                    $sql="SELECT * FROM product_master where product_id='$pdid'";
                    $query = $this->db->query($sql);
                    $product = $query->result_array();

                    $price = $cart->qty * $product[0]['price'];
                    $totalPrice += $price;
                ?>
                <li>
                    <div class="item-content">
                        <div class="item-media media media-60">
                            <img src="<?php echo base_url('../admin/uploads/products/'.$product[0]['product_image_one']) ?>" alt="product_image">
                        </div>
                        <div class="item-inner">
                            <div class="item-title-row">
                                <h5 class="item-title sub-title"><a href="#"><?= $product[0]['product_name'] ?></a></h5>
                            </div>
                            <div class="item-footer">
                                <div class="d-flex align-items-center">
                                    <h6 class="me-3">&#8377;<?= number_format($product[0]['price'], 2) ?></h6>
                                </div>
                                <div class="d-flex align-items-center">
                                <span onclick="removeFromCart(<?= $cart->cart_id ?>)"
                                        style="cursor:pointer;color : red;"><i class="fa fa-trash"></i></span>&nbsp;&nbsp;&nbsp;
                                    <div class="quantity">
                                        <span class="quantity__minus" style="cursor : pointer;"
                                            onclick="minus_cart_(<?= $cart->cart_id ?>)"><span>-</span></span>
                                        <input name="quantity" type="text" id="qty<?= $cart->cart_id ?>"
                                            class="quantity__input" value="<?= $cart->qty ?>" readonly>
                                        <span class="quantity__plus" style="cursor : pointer;"
                                            onclick="plus_cart_(<?= $cart->cart_id ?>)"><span>+</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>

                <form id="amtForm" action="<?php echo base_url('products/checkout') ?>" method="post">
                    <input hidden type="text" id="amt" name="totalAmt">
            </form>
            </ul>
        </div>
        <div style="text-align:right">
            <?php if($cartItems > 0){ ?>
                <button class="btn btn-outline-warning p-2" style="cursor:pointer; color:red;" onclick="removeAll()">Clear all</button>
            <?php } ?>
        </div>
    </div>

    <div class="footer fixed ">
        <div class="container">
            <div class="view-title mb-2">
                <ul>
                    <li>
                        <h5>Total</h5>
                        <h5>&#8377;<?= number_format($totalPrice, 2) ?></h5>
                    </li>
                </ul>
            </div>
            <div class="footer-btn d-flex align-items-center">
                <?php if($cartItems > 0){ ?>
                    <button type="button" onclick="checkout(<?= $totalPrice ?>)" class="btn btn-primary flex-1">CHECKOUT</button>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
    function minus_cart_(x) {
        var value = $("#qty" + x).val();
        if (value > 1) {
            value--;
            decrease_qty(x);
        }
        $("#qty" + x).val(value);
    }
    </script>
    <script>
    function decrease_qty(x) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('products/decreaseCartQty') ?>',

            data: {
                id: x
            },

            success: function(response) {
                location.reload();
            }
        })
    }
    </script>
    <script>
    function plus_cart_(x) {
        var value = $("#qty" + x).val();
        value++;
        $("#qty" + x).val(value);
        increase_qty(x);
    }
    </script>
    <script>
    function increase_qty(x) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('products/increaseCartQty') ?>',

            data: {
                id: x
            },

            success: function(response) {
                location.reload();
            }
        })
    }
    </script>

    <script>
    function removeFromCart(x) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('products/removeFromCart') ?>',
            data: {
                id: x
            },

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

    <script>
    function removeAll() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('products/removeAll') ?>',

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

    <script>
    function checkout(x) {
        $("#amt").val(x);
        $("#amtForm").submit();
    }
    </script>