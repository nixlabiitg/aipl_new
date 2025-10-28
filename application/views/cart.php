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
<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Cart</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Cart</a></li>
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
            <div class="col-lg-12">
                <?php $this->load->view('messages') ?>
                <h3>Cart Items</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Products</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($cart as $cart){
                                 $pdid = $cart->product_id;
                                 $sql="SELECT * FROM product_master where product_id='$pdid'";
                                 $query = $this->db->query($sql);
                                 $product = $query->result_array();

                                 $price = $cart->qty * $product[0]['price'];
                                 $totalPrice += $price;
                            ?>
                            <tr class="text-center">
                                <td><?= ++$id ?></td>
                                <td class="text-left">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <img src="<?php echo base_url('admin/uploads/products/'.$product[0]['product_image_one']) ?>"
                                                alt="" style="height:40px; width: 60px; border-radius: 5px;">
                                        </div>
                                        <div class="col-9">
                                            <p class="text-capitalize"><b><?= $product[0]['product_name'] ?></b></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity">
                                        <span class="quantity__minus" style="cursor : pointer;"
                                            onclick="minus_cart_(<?= $cart->cart_id ?>)"><span>-</span></span>
                                        <input name="quantity" type="text" id="qty<?= $cart->cart_id ?>"
                                            class="quantity__input" value="<?= $cart->qty ?>" readonly>
                                        <span class="quantity__plus" style="cursor : pointer;"
                                            onclick="plus_cart_(<?= $cart->cart_id ?>)"><span>+</span></span>
                                    </div>
                                </td>
                                <td class="text-right">&#8377;<?= number_format($product[0]['price'],2) ?></td>
                                <td class="text-right">&#8377;<span><?= number_format($price,2) ?></span></td>
                                <td>
                                    <span onclick="removeFromCart(<?= $cart->cart_id ?>)"
                                        style="cursor:pointer;color : red;"><i class="fa fa-trash"></i></span>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total = </th>
                                <th class="text-right">&#8377;<?= number_format($totalPrice, 2) ?></th>
                                <th class="text-center"><span style="cursor:pointer; color:red;"
                                        onclick="removeAll()">Clear all</span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-lg-12">
                <?php if($cartItems > 0){ ?>
                <div class="text-right">
                    <button type="button" onclick="checkout(<?= $totalPrice ?>)" class="btn btn-info px-5">Checkout</button>
                </div>
                <?php } ?>
            </div>
            <!-- col end-->
            <form id="amtForm" action="<?php echo base_url('checkout') ?>" method="post">
                    <input hidden type="text" id="amt" name="totalAmt">
            </form>
        </div>
        <!-- Row end-->
    </div>
</section>

<link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
    type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
    type="text/javascript"></script>

<script>
    function minus_cart_(x) {
        var value = $("#qty"+x).val();
        if (value > 1) {
            value--;
            decrease_qty(x);
        }
        $("#qty"+x).val(value);
    }
</script>
<script>
    function decrease_qty(x){
        $.ajax({
            type: 'POST',
            url: '<?= base_url('decreaseCartQty') ?>',

            data : {
                id : x
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
    function increase_qty(x){
        $.ajax({
            type: 'POST',
            url: '<?= base_url('increaseCartQty') ?>',

            data : {
                id : x
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
        url: '<?= base_url('removeFromCart') ?>',
        data: {
            id: x
        },

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
                    'Item removed from Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            }
        }
    })
}
</script>

<script>
function removeAll() {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('removeAll') ?>',

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
                    'Items removed from Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            }
        }
    })
}
</script>

<script>
    function checkout(x){
        $("#amt").val(x);
        $("#amtForm").submit();
    }
</script>