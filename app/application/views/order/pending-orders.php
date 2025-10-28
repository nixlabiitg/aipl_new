<div class="page-content bottom-content">
    <div class="container">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <form action="<?=base_url('report/pending_orders')?>" method="POST">
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="">Form</label>
                        <input type="date" id="from" name="from" class="form-control" value="<?=$from?>" required>
                    </div>
                    <div class="col-6">
                        <label for="">To</label>
                        <input type="date" id="to" name="to" class="form-control" value="<?=$to?>" required>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success w-100 mt-2">Display</button>
                    </div>
                    <input hidden type="text" id="incomeid" name="incomeid" value="<?=$incomeid?>">
                    <input hidden type="text" id="pagename" name="pagename" value="<?=$page_name?>">
            </form>
        </div>
        <div class="row">
            <div class="table-responsive">
                <div class="table-wrap">
                    <table class="table table-striped table-bordered table-hover table-checkable" id="example">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                                                                           
                            $id = "0";
                            foreach ($order as $product) {
                        ?>
                            <input hidden id="delid<?php echo $product['order_id']?>" value="<?= $product['delid']  ?>">
                            <span hidden id="add<?php echo $product['order_id']?>">
                                <p class="mb-0">Address 1 : <?= $product['address1'] ?></p>
                                <p class="mb-0">House No : <?= $product['house_no']  ?></p>
                                <p class="mb-0">Road Name : <?= $product['road_name']  ?></p>
                                <p class="mb-0">PIN : <?= $product['pin'] ?>
                                <p class="mb-0"> Contact No : <?= $product['contact_no']  ?>
                            </span>
                            <tr>
                                <td class="text-center">
                                    <?php echo ++$id ?>
                                </td>
                                <td class="text-center"><img
                                        src="<?php echo base_url('../admin/uploads/products/'.$product['product_image_one'])?>"
                                        alt="" class="rounded images" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter"
                                        data-imageone="<?php echo base_url('admin/uploads/products/'.$product['product_image_one'])?>"
                                        data-imagetwo="<?php echo base_url('admin/uploads/products/'.$product['product_image_two'])?>"
                                        data-imagethree="<?php echo base_url('admin/uploads/products/'.$product['product_image_three'])?>"
                                        data-imagefour="<?php echo base_url('admin/uploads/products/'.$product['product_image_four'])?>"
                                        data-imagefive="<?php echo base_url('admin/uploads/products/'.$product['product_image_five'])?>"
                                        data-imagesix="<?php echo base_url('admin/uploads/products/'.$product['product_image_six'])?>"
                                        style="height:40px; width:40px; cursor:pointer;border-radius:10px;">
                                </td>
                                <td class="text-center"><?= $product['qty'] ?></td>
                                <td class="text-center">&#8377;<?= number_format($product['rate'],2)  ?></td>
                                <td class="text-center">&#8377;<?= number_format($product['rate']*$product['qty'],2)  ?>
                                </td>
                                <td>
                                    <span
                                        class="badge badge-<?=($product['ostatus']==0?"warning":($product['ostatus']==1?"info":($product['ostatus']==2?"success":"danger"))) ?>"
                                        style="border-radius:20px;"><?=($product['ostatus']==0?"Shipping in progress":($product['ostatus']==1?"Shipped":($product['ostatus']==2?"Delivered":"Canceled"))) ?></span>
                                </td>

                                <td nowrap style="text-align:center;">
                                    <a id="<?php echo $product['order_id']."/".$product['dt']."/".$product['amount']."/".$product['discount_price']?>"
                                        class="btn btn-primary btn-sm text-white" onclick='despatch(this);'>Order
                                        Details</a>
                                </td>
                                <td class="text-center"><button class="btn btn-info btn-sm"
                                    onclick="showOrderInvoice('<?= $product['order_id'] ?>')">Invoice</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form action="<?php echo base_url('report/customer_order_invoice') ?>" id="order-id-form" method="POST">
                    <input type="hidden" name="orderId" id="orderId" class="form-control">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Order Details</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="close_();">
                    <span aria-hidden="true" onclick="close();">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center align-items-center mb-2">
                        <div class="col-12 mb-1 text-center bg-info text-white rounded p-2">
                            <label for="despatch">Order No :</label>
                            <label id="orderno"></lable>
                        </div>
                        <div class="col-12 text-center bg-success text-white rounded p-2">
                            <label for="despatch">Date :</label>
                            <label id="orderdate"></lable>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive" style="max-height:300px; overflow:auto;">
                            <table class="table table-bordered table-striped display" id="basic-1">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th nowrap>Product Image</th>                                       
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>

                                    </tr>
                                </thead>
                                <tbody id="bd">

                                </tbody>

                            </table>
                            <hr>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Total Amount :</th>
                                <td class="text-right"><span id="amount"></span></td>
                            </tr>
                            <tr>
                                <th>Discount :</th>
                                <td class="text-right"><span id="discount"></span></td>
                            </tr>
                            <tr>
                                <th>Order Amount :</th>
                                <td class="text-right"><span id="net"></span></td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="col-lg-8 text-info" id="franchise">

                </div>
            </div>
            <input type="text" hidden id="delvid" class="form-control">
            <input hidden type="text" id="orederid" class="form-control">
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
despatch = function(x) {
    var p = x.id.split("/");
    var d = {
        "order_id": p[0]
    }
    $("#orderno").html(p[0]);
    $("#orderdate").html(p[1]);

    $("#amount").html("&#8377;" + p[2]);
    $("#discount").html("&#8377;" + p[3]);
    $("#net").html("&#8377;" + (p[2] - p[3]));

    $.ajax({
        url: "<?php echo base_url('report/ordered_product'); ?>",
        type: "POST",
        dataType: "text",
        data: d,
        success: function(data) {
            // do something
            //   alert(data);
            var fid = "";

            var d = JSON.parse(data);
            var tm = "";
            for (i in d) {
                tm += "<tr><td class='text-center'>" + (Number(i) + 1) + "</td>"

                    +
                    '<td nowrap class="text-center">' +
                    '<img src="<?=base_url()?>' + '../admin/uploads/products/' + d[i][
                        'product_image_one'
                    ] +
                    '" alt="" class="rounded images" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"' +
                    'data-imageone = "<?php echo base_url()?>' + 'admin/uploads/products/' + d[i][
                        'product_image_one'
                    ] + '"' +
                    'data-imagetwo = "<?php echo base_url()?>' + 'admin/uploads/products/' + d[i][
                        'product_image_two'
                    ] + '"' +
                    'data-imagethree = "<?php echo base_url()?>' + 'admin/uploads/products/' + d[i][
                        'product_image_three'
                    ] + '"' +
                    'data-imagefour = "<?php echo base_url()?>' + 'admin/uploads/products/' + d[i][
                        'product_image_four'
                    ] + '"' +
                    'data-imagefive = "<?php echo base_url()?>' + 'admin/uploads/products/' + d[i][
                        'product_image_five'
                    ] + '"' +
                    'data-imagesix = "<?php echo base_url()?>' + 'admin/uploads/products/' + d[i][
                        'product_image_six'
                    ] + '"' +
                    'style="height:50px; width:50px; cursor:pointer; border-radius:10px;">' +
                    '</td>' +
                    "<td nowrap>" + d[i]['product_name'] + "</td>" +
                    "<td  nowrap class='text-center'>&#8377; " + d[i]['rate'] + "</td>" +
                    "<td  nowrap class='text-center'>" + d[i]['qty'] + "</td>" +
                    "<td  nowrap class='text-center'>&#8377; " + Number(d[i]['qty']) * Number(d[i]['rate']) +
                    "</td>";
                fid = (d[i]['name'] ? d[i]['name'] + " , " + d[i]['address'] : "");

            }

            $("#franchise").html((fid != "" ? "** Franchise : " + fid : "** Shipping in progress"));

            $("#bd").html(tm);
        },
        error: function(data) {
            // do something
            alert(data);
        }
    });

    $("#productdetails").modal("show");
}
close_ = function() {
    $("#productdetails").modal("toggle");
}

showOrderInvoice = function(x) {
    $('#orderId').val(x)
    $('#order-id-form').submit()
}
</script>