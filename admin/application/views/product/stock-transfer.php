<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
        <form class="kt-form" id="addproduct" action="<?php echo base_url('product/addStockTransfer') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h3>Stock Transfer</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product</label>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="" selected disabled>Select a Product</option>
                                <?php foreach ($AvailableStocks as $stock) { ?>
                                    <?php 
                                        // get product name from PRODUCTS array
                                        $product = array_filter($PRODUCTS, function($p) use ($stock) {
                                            return $p->product_id == $stock['product_id'];
                                        });
                                        $product = reset($product);
                                    ?>
                                    <option value="<?= $stock['product_id']; ?>" 
                                            data-available="<?= $stock['available_stock']; ?>">
                                        <?= $product->product_name; ?> (Available: <?= $stock['available_stock']; ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Franchise</label>
                            <select name="franchise_id" id="franchise_id" class="form-control">
                                <option value="" selected disabled>Select a Franchise</option>
                                <?php foreach ($franchises as $franchise) { ?>
                                <option value="<?= $franchise->user_id; ?>"><?= $franchise->user_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Franchise</label>
                            <select name="franchise_id" id="franchise_id" class="form-control">
                                <option value="" selected disabled>Select a Franchise</option>
                                <?php foreach ($franchises as $franchise) { ?>
                                <option value="<?= $franchise->id; ?>"><?= $franchise->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                     <div class="col-md-4">
                        <div class="form-group">
                            <label>Add Stock</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-danger" onclick="changeQty1(-1)">-</button>
                                <input type="number" name="stock_out" id="stock_out" class="form-control text-center" value="0" min="0">
                                <button type="button" class="btn btn-success" onclick="changeQty1(1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="transferStock" onclick="add_stock_transfer()" class="btn btn-primary">Transfer
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
                    <th>Franchise</th>
                    <th>Product</th>
                    <th>Stock Out</th>
                    <th>Date Added</th>
                    <th>Action</th> <!-- ✅ New column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($Stocks as $stock): ?>
                <tr>
                    <td><?= $stock['name']; ?></td>
                    <td><?= $stock['product_name']; ?></td>
                    <td><?= $stock['stock_out']; ?></td>
                    <td><?= date("d M Y", strtotime($stock['entry_date'])); ?></td>
                    <td>
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#returnModal" 
                            data-stockid="<?= $stock['id']; ?>" 
                            data-stock="<?= $stock['stock_out']; ?>" 
                            data-product="<?= $stock['product_name']; ?>">
                        <i class="fas fa-edit"></i> Return
                    </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="returnForm" method="post" action="<?= base_url('product/returnStock'); ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Return Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Hidden input to hold stock ID -->
                <input type="hidden" name="stock_id" id="modal_stock_id">

                <div class="mb-3">
                    <label for="modal_stock_out">Stock Out</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-danger" onclick="changeQty(-1)">−</button>
                        <input type="number" name="return_qty" id="modal_stock_out" class="form-control text-center" value="1" min="1">
                        <button type="button" class="btn btn-success" onclick="changeQty(1)">+</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Return Stock</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!--end::Portlet-->
</div>
<script>
let maxStock = 0; // available stock of selected product

// When product is selected
document.getElementById("product_id").addEventListener("change", function() {
    let selected = this.options[this.selectedIndex];
    maxStock = parseInt(selected.getAttribute("data-available")) || 0;

    let qtyInput = document.getElementById("stock_out");
    qtyInput.value = 1; // default to 1 instead of 0
    qtyInput.setAttribute("min", 1);
    qtyInput.setAttribute("max", maxStock);
});

// + / - button function
function changeQty1(val) {
    let qtyInput = document.getElementById("stock_out");
    let current = parseInt(qtyInput.value) || 0;
    let newVal = current + val;

    if (newVal < 1) newVal = 1;          // minimum 1
    if (newVal > maxStock) newVal = maxStock; // max available stock

    qtyInput.value = newVal;
}

// Validate manual typing
document.getElementById("stock_out").addEventListener("input", function() {
    let val = parseInt(this.value) || 0;
    if (val > maxStock) this.value = maxStock;
    if (val < 1) this.value = 1; // not allow zero
});

// Final validation before submit
document.getElementById("addproduct").addEventListener("submit", function(e) {
    let qty = parseInt(document.getElementById("stock_out").value) || 0;
    if (qty < 1 || qty > maxStock) {
        alert("Transfer quantity must be between 1 and " + maxStock + ".");
        e.preventDefault();
    }
});
</script>


<script>
function add_stock_transfer() {
    // validate product
    let product = document.getElementById("product_id").value;
    let qty = document.getElementById("stock_in").value;
    let franchise = document.getElementById("franchise_id").value;

    if (!product) {
        alert("Please select a product.");
        return false; // stop form submit
    }
    if (!franchise) {
        alert("Please select a franchise.");
        return false; // stop form submit
    }
    if (qty <= 0) {
        alert("Please enter stock greater than 0.");
        return false;
    }

    // submit form
    document.getElementById("transferStock").submit();
}
</script>

<script>
var maxStock = 0;

var returnModal = document.getElementById('returnModal');
returnModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal

    var stockId = button.getAttribute('data-stockid');
    var stockQty = parseInt(button.getAttribute('data-stock')) || 0;
    var productName = button.getAttribute('data-product');

    // Set hidden input value
    document.getElementById('modal_stock_id').value = stockId;

    // Set stock quantity input
    var input = document.getElementById('modal_stock_out');
    input.value = 1; // default return quantity
    input.setAttribute('max', stockQty); // max cannot exceed stock
    maxStock = stockQty;
});

// + / - button function
function changeQty(amount) {
    var input = document.getElementById('modal_stock_out');
    var current = parseInt(input.value) || 0;
    var min = parseInt(input.min) || 1;
    var max = parseInt(input.max) || maxStock;
    var newValue = current + amount;

    if (newValue < min) newValue = min;
    if (newValue > max) newValue = max;

    input.value = newValue;
}

// Optional: Validate on submit
document.getElementById('returnForm').addEventListener('submit', function(e){
    var qty = parseInt(document.getElementById('modal_stock_out').value) || 0;
    if(qty > maxStock){
        alert("Return quantity cannot exceed current stock (" + maxStock + ").");
        e.preventDefault();
    }
});
</script>




