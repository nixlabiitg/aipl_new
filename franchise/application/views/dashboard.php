<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-daterange" id="" data-toggle="kt-tooltip" title=""
                    data-placement="left">
                    <span class="kt-subheader__btn-daterange-title"
                        id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date"
                        id="kt_dashboard_daterangepicker_date"><?php echo date('d M Y') ?></span>
                    <i class="flaticon2-calendar-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="col-xl-12 mb-3 m-0 p-0">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <h2>Welcome again, <span class="text-uppercase"><?= $this->session->userdata('aiplFranchiseName') ?> [<?= $this->session->userdata('aiplFranchiseId') ?>]</span></h2>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="card border-warning p-3">
                        <div class="text-center">
                            <h4>Wallet</h4>
                            <hr>
                            <h2>&#8377; <?=number_format($wallet,2) ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-danger p-3">
                        <div class="text-center">
                            <h4>Pending Orders</h4>
                            <hr>
                            <h2><?=$pending?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3">
                        <div class="text-center">
                            <h4>Delivered Orders</h4>
                            <hr>
                            <h2><?=$delivered?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-success p-3">
                        <div class="text-center">
                            <h4>Total Income</h4>
                            <hr>
                            <h2>&#8377; <?=number_format($income,2)?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <td>Package Name</td>
                                <td>Registration Amount</td>
                                <td>Digital Wallet Amount</td>
                                <td>Monthly Sales Percentage</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($package as $data){ ?>
                            <tr class="text-center">
                                <td><?= $data->package_name ?></td>
                                <td>&#8377;<?= number_format($data->register_fees,2) ?></td>
                                <td>&#8377;<?= number_format($data->digital_wallet,2) ?></td>
                                <td><?= $data->monthly_sale_percentage ?>%</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr class="bg-success">
                                <th>#</th>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Contact No</th>
                                <th>Order No</th>
                                <th>Despatch Date</th>
                                <th>Bill Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                                                                           
                                      $id = "0";
                                      foreach ($order as $product) {
                                  
                                      ?>
                            <!-- <input hidden id="delid<?php echo $product['order_id']?>" value="<?= $product['delid']  ?>"> -->
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

                                <td><?= $product['customer_id'] ?></td>

                                <td id="cname<?php echo $product['order_id']?>"><?= $product['name']  ?></td>
                                <td id="cno<?php echo $product['order_id']?>"><?= $product['mobile']  ?></td>

                                <td id="refno<?php echo $product['order_id']?>" class="text-center">
                                    <?= $product['order_id']  ?></td>
                                <td id="odate<?php echo $product['order_id']?>"><?= $product['dt']  ?></td>
                                <td id="qty<?php echo $product['order_id']?>" style="text-align:right;">
                                    &#8377;<?= number_format($product['amount']-$product['discount_price'],2)  ?></td>

                                <td style="text-align:center;">
                                    <a id="<?php echo $product['order_id']."/".$product['dt']."/".$product['customer_id']."/".$product['name']."/".$product['amount']."/".$product['discount_price']."/".$product['address']."/". $product['mobile']."/". $product['despatch_through']."/".$product['scratchused']?>"
                                        class="btn btn-success btn-sm text-white" onclick='despatch(this);'>Deliver</a>
                                </td>


                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
            <input type="text" hidden id="scratchused">
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center align-items-center mb-2">
                        <div class="col-lg-6" style="text-align:left;">
                            <label for="despatch">Order No :</label>
                            <label id="orderno"></lable>
                        </div>

                        <div class="col-lg-6" style="text-align:left;">
                            <label for="despatch">Despatch Date :</label>
                            <label id="orderdate"></lable>
                        </div>

                    </div>

                    <div class="row justify-content-center align-items-center mb-2">
                        <div class="col-lg-6" style="text-align:left;">
                            <label for="despatch">Customer ID :</label>
                            <label id="custid"></label>
                        </div>

                        <div class="col-lg-6" style="text-align:left;">
                            <label for="despatch">Customer Name :</label>
                            <label id="custname"></label>
                        </div>
                        <div class="col-lg-12" style="text-align:left;">
                            <label for="despatch">Address :</label>
                            <label id="address"></label>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-wrap" style="max-height:300px;overflow:auto;">
                            <table class="table display" id="basic-1" style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <!-- <th>Batch No</th>                                        -->
                                        <th colspan=2>Product</th>

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
                        <div class="row mr-5">
                            <div class="col-lg-10 text-right">
                                Total Amount :
                            </div>
                            <div class="col-lg-2 text-right" id="amount">
                                &#8377;
                            </div>
                        </div>
                        <div class="row mr-5">
                            <div class="col-lg-10 text-right">
                                Discount :
                            </div>
                            <div class="col-lg-2 text-right" id="discount">
                                &#8377;
                            </div>
                        </div>

                        <div class="row mr-5">
                            <div class="col-lg-10 text-right">
                                Order Amount :
                            </div>
                            <div class="col-lg-2 text-right" id="net">
                                &#8377;
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>




            </div>

            <input type="text" hidden id="fid" class="form-control">
            <input type="text" hidden id="invamt" class="form-control">
            <!-- <div class="row justify-content-center align-items-center mb-3">
                        <div class="col-lg-3" style="text-align:center;">
                                <label for="despatch">Assign to franchise</label>
                        </div>
                        <div class="col-lg-8">
                        <select    id="despatch" class="form-control" >
                            <option selected value="">Select Franchise</option>
                            <?php foreach($franchise as $pr)
                            {?>
                            <option value='<?=$pr["franchise_id"]?>'><?=$pr["name"]." , ".$pr["address"]?></option>
                            <?php } ?>

                          </select>
                        </div>
                            </div> -->


            <!-- <div class="row justify-content-center align-items-center mb-3">
                        <div class="col-lg-3" style="text-align:center;">
                                <label for="despatch">Remarks</label>
                        </div>
                        <div class="col-lg-8">
                          <input  type="text"  id="remarks" class="form-control" >
                        </div>
                  </div>   -->

            <input hidden type="text" id="orederid" class="form-control">

            <div class="row justify-content-center align-items-center mb-3">
                <div class="col-lg-11  text-right">
                    <a class="btn btn-primary btn-sm text-white" onclick="close_();">Close</a>

                    <a class="btn btn-primary btn-sm text-white" onclick=save_despatch(this);>Deliver</a>
                </div>
            </div>
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
    $("#custid").html(p[2]);
    $("#custname").html(p[3]);
    $("#amount").html("&#8377;" + p[4]);
    $("#discount").html("&#8377;" + p[5]);
    $("#net").html("&#8377;" + (p[4] - p[5]));
    $("#invamt").val(p[4] - p[5]);
    $("#address").html(p[6] + " , Contact no : " + p[7]);
    $("#fid").val(p[8]);
    $("#scratchused").val(p[9]);
    $.ajax({
        url: "<?php echo base_url('report/ordered_product'); ?>",
        type: "POST",
        dataType: "text",
        data: d,
        success: function(data) {
            // do something
            //   alert(data);

            var d = JSON.parse(data);
            var tm = "";
            for (i in d) {
                tm += "<tr><td class='text-center'>" + (Number(i) + 1) + "</td>"

                    +
                    '<td class="text-center">' +
                    '<img src="<?=base_url()?>' + '../admin/uploads/products/' + d[i][
                        'product_image_one'
                    ] +
                    '" alt="" class="rounded images" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"' +
                    'data-imageone = "<?php echo base_url()?>' + 'uploads/products/' + d[i][
                        'product_image_one'
                    ] + '"' +
                    'data-imagetwo = "<?php echo base_url()?>' + 'uploads/products/' + d[i][
                        'product_image_two'
                    ] + '"' +
                    'data-imagethree = "<?php echo base_url()?>' + 'uploads/products/' + d[i][
                        'product_image_three'
                    ] + '"' +
                    'data-imagefour = "<?php echo base_url()?>' + 'uploads/products/' + d[i][
                        'product_image_four'
                    ] + '"' +
                    'data-imagefive = "<?php echo base_url()?>' + 'uploads/products/' + d[i][
                        'product_image_five'
                    ] + '"' +
                    'data-imagesix = "<?php echo base_url()?>' + 'uploads/products/' + d[i][
                        'product_image_six'
                    ] + '"' +
                    'style="height:40px; width:40px; cursor:pointer;border-radius:10px;">' +
                    '</td>' +
                    "<td>" + d[i]['product_name'] + "</td>" +
                    "<td class='text-center'>&#8377; " + d[i]['rate'] + "</td>" +
                    "<td class='text-center'>" + d[i]['qty'] + "</td>" +
                    "<td class='text-center'>&#8377; " + Number(d[i]['qty']) * Number(d[i]['rate']) +
                    "</td>";


            }
            //  alert(tm);
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

save_despatch = function(x) {

    if (!confirm("Sure to deliver?")) return;
    if ($("#despatch").val() == "") {
        alert("Please choose franchise.");
        return;
    }
    var d = {
        "orderid": $("#orderno").html(),
        "invamt": $("#invamt").val(),
        "fid": $("#fid").val(),
        "custid": $("#custid").html(),
        "scratchused": $("#scratchused").val(),
    }
    $.ajax({
        url: "<?php echo base_url('report/deliver'); ?>",
        type: "POST",
        dataType: "text",
        data: d,
        success: function(data) {
            // do something
            //   alert(data);
            if (data == 1) {
                alert("Order Delivered Successfully.");
                window.location.reload();
            } else {
                alert("Failed To Despatch.");
            }
        },
        error: function(data) {
            // do something
            alert(data);
        }
    });
}
</script>