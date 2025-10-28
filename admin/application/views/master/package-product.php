<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$status==1?"ACTIVE ":"BLOCKED "?>PACKAGE</h3>
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
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <?php $this->load->view('messages'); ?>

        <div class="row">
            <div class="col-lg-12 mb-3">
                <h5>Package Name : <?= $PACKAGE_DETAILS[0]->package_name ?> | Package Price :
                    &#8377;<?= number_format($PACKAGE_DETAILS[0]->package_amount,2) ?> </h5>

                <form action="<?php echo base_url('package/package_product') ?>" method="POST">
                    <div class="row mt-4">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="" selected disabled>Select an option</option>
                                    <?php foreach($PRODUCTS as $product){ ?>
                                    <option value="<?= $product->product_id ?>">
                                        <?= $product->product_name .' (&#8377;'.$product->price.')' ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" value="<?= $PACKAGE_DETAILS[0]->package_id ?>" name="package_id"
                                    id="package_id">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <button type="submit" id="package_product" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="col-sm">
                    <div class="table-wrap">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id=0; foreach($PACKAGE_PRODUCTS as $data){ ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><?= $data->product_name ?></td>
                                    <td><?= '&#8377;'.number_format($data->price,2) ?></td>
                                    <td><button id="<?= $data->id ?>" onclick="removeProduct(this.id)"
                                            class="btn btn-danger">Delete</button></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
function removeProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('package/remove_product') ?>",
            data: {
                id: id
            },
            success: function(data) {
                if(data == 1){
                    location.reload();
                }else{
                    alert("Something went wrong. Please try again.");
                }
                
            }
        });
    }
}
</script>