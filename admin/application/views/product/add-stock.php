<style>
    .fr-wrapper{
        height : 300px;
    }
    .fr-second-toolbar #fr-logo{
        display : none;
    }
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" id="addproduct" action="<?php echo base_url('product/addStocks') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h3>Add Stock</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product</label>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="" selected disabled>Select a Product</option>
                                <?php foreach ($PRODUCTS as $product) { ?>
                                <option value="<?= $product->product_id; ?>"><?= $product->product_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label>Add Stock</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-danger" onclick="changeQty(-1)">-</button>
                                <input type="number" name="stock_in" id="stock_in" class="form-control text-center" value="0" min="0">
                                <button type="button" class="btn btn-success" onclick="changeQty(1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addStock" onclick="add_stock()" class="btn btn-primary">Add
                                Stock</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>

    <div class="table-responsive">
    <table id="stocksTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Stock In</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($Stocks as $stock): ?>
            <tr>
                <td><?= $stock['product_name']; ?></td>
                <td><?= $stock['stock_in']; ?></td>
                <td><?= date("d M Y", strtotime($stock['entry_date'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<!--end::Portlet-->
</div>
<script>
function changeQty(val) {
    let qtyInput = document.getElementById("stock_in");
    let current = parseInt(qtyInput.value) || 0;
    let newVal = current + val;
    if(newVal < 0) newVal = 0; // prevent negative stock
    qtyInput.value = newVal;
}
</script>

<script>
function add_stock() {
    // validate product
    let product = document.getElementById("product_id").value;
    let qty = document.getElementById("stock_in").value;

    if (!product) {
        alert("Please select a product.");
        return false; // stop form submit
    }
    if (qty <= 0) {
        alert("Please enter stock greater than 0.");
        return false;
    }

    // submit form
    document.getElementById("addStock").submit();
}
</script>


