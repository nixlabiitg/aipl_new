<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap table-responsive">
                    <table class="table table-striped- table-bordered table-hover table-checkable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                                <th>Qty</th>
                                <th>Warehouse</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            if ($ITEMSCOUNT == 1) {
                                foreach ($ITEMS as $item) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= ++$id ?>
                                            <input type="hidden" id="uproductdetailsid" name="productid" value="<?= $item->id ?>">
                                            <input type="hidden" id="uproductid" name="productid" value="<?= $item->product_id ?>">
                                        </td>
                                        <td><input type="text" value="<?= $pname ?>" readonly class="form-control text-capitalize" required></td>
                                        <td><input type="text" id="upurchase" name="purchase" value="<?= $item->purchase_price ?>" placeholder="Price" class="form-control" required></td>
                                        <td><input type="text" id="usale" name="sale" value="<?= $item->sale_price ?>" placeholder="Price" class="form-control" required></td>
                                        <td><input type="number" id="uqty" name="qty" value="<?= $item->qty ?>" min="0" placeholder="Qty" style="width:80px;" class="form-control" required></td>
                                        <td>
                                            <select name="warehouse" style="width:150px;" id="uwarehouse" class="form-control" disabled required>
                                                <option value="Rajgarh" <?= $item->warehouse == 'Rajgarh' ? 'selected' : '' ?>>Rajgarh</option>
                                                <option value="Chamata" <?= $item->warehouse == 'Chamata' ? 'selected' : '' ?>>Chamata</option>
                                                <option value="BB Home" <?= $item->warehouse == 'BB Home' ? 'selected' : '' ?>>BB Home</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="date" readonly <?php $date = $item->added_on; ?> value="<?= date('d-M-Y', strtotime($item->updated_on)) ?>" class="form-control" required></td>
                                        <td><button onclick="updateProductItem()" class="btn btn-success btn-block btn-sm">Update</button></td>
                                    </tr>
                                <?php }
                            } else { ?>

                                <tr>
                                    <td class="text-center">
                                        <?= ++$id ?>
                                        <input type="hidden" name="productid" id="productid" value="<?= $pcode ?>">
                                    </td>
                                    <td><input type="text" value="<?= $pname ?>" readonly class="form-control text-capitalize" required></td>
                                    <td><input type="text" id="purchase" name="purchase" placeholder="Price" class="form-control" required></td>
                                    <td><input type="text" id="sale" name="sale" placeholder="Price" class="form-control" required></td>
                                    <td><input type="number" id="qty" style="width:80px;" name="qty" min="0" placeholder="Qty" class="form-control" required></td>
                                    <td>
                                        <select name="warehouse" style="width:150px;" id="warehouse" class="form-control" required>
                                            <option value="Rajgarh">Rajgarh</option>
                                            <option value="Chamata" selected>Chamata</option>
                                            <option value="BB Home">BB Home</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="date" readonly value="<?= date('d-M-Y') ?>" class="form-control" required></td>
                                    <td><button onclick="addProductItem()" class="btn btn-block btn-info btn-sm">Add</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <h5>Updated Price Report</h5>
                    <table class="table table-striped- table-bordered table-hover table-checkable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                                <th>Qty</th>
                                <th>Warehouse</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            foreach ($ITEMS_UPDATED_LIFT as $data) { ?>
                                <tr>
                                    <td><?= ++$id ?></td>
                                    <td><?= $pname ?></td>
                                    <td>
                                        <span class="text-success">New : &#8377;<?= number_format($data->purchase_price_new, 2) ?></span><br />
                                        <span class="text-danger">Pre : &#8377;<?= number_format($data->purchase_price, 2) ?></span>
                                    </td>
                                    <td>
                                        <span class="text-success">New : &#8377;<?= number_format($data->sale_price_new, 2) ?></span><br/>
                                        <span class="text-danger">Pre : &#8377;<?= number_format($data->sale_price, 2) ?></span>
                                    </td>
                                    <td>
                                        <?= $data->qty ?>
                                    </td>
                                    <td><?= $data->warehouse ?></td>
                                    <td><?= date('d-M-Y', strtotime($data->added_on)) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function addProductItem() {
        var productId = $("#productid").val();
        var purchase = $("#purchase").val();
        var sale = $("#sale").val();
        var qty = $("#qty").val();
        var warehouse = $("#warehouse").val();

        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: '<?php echo base_url('product/addProductItem') ?>',

            data: {
                productId: productId,
                purchase: purchase,
                sale: sale,
                qty: qty,
                warehouse: warehouse,
            },

            success: function(data) {
                location.reload();
            }
        })
    }
</script>

<script>
    function updateProductItem() {
        var uproductId = $("#uproductid").val();
        var uproductdetailsId = $("#uproductdetailsid").val();
        var upurchase = $("#upurchase").val();
        var usale = $("#usale").val();
        var uqty = $("#uqty").val();
        var uwarehouse = $("#uwarehouse").val();

        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: '<?php echo base_url('product/updateProductItem') ?>',

            data: {
                uproductId: uproductId,
                uproductdetailsId: uproductdetailsId,
                upurchase: upurchase,
                usale: usale,
                uqty: uqty,
                uwarehouse: uwarehouse,
            },

            success: function(data) {
                location.reload();
            }
        })
    }
</script>