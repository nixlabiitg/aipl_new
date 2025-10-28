<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
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
        <form class="kt-form" id="addproduct" action="<?php echo base_url('product/addProductBasic') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h3>Add Product</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="subcategory_0" id="subcategory_0" class="form-control"
                                onchange="sub_category(this);" required>
                                <option value="" selected disabled>Select a category</option>
                                <?php foreach ($CATEGORY as $category) { ?>
                                <option value="<?= $category->category_id; ?>"><?= $category->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php for ($i = 1; $i < 50; $i++) { ?>
                    <div style="display: none;" class="col-md-4" id="subcategoryDiv_<?= $i ?>" required>
                        <div class="form-group">
                            <label>Subcategory <?= $i ?></label>
                            <select name="subcategory_<?= $i ?>" id="subcategory_<?= $i ?>" class="form-control"
                                onchange="sub_category(this);">
                                <option value="" selected disabled>Select a subcategory</option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <input readonly hidden id='category' name='category' />



                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="product" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>HSN Code</label>
                            <input type="number" class="form-control" placeholder="NSN Code" name="hsn" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <select name="brand" id="" class="form-control" required>
                                <option value="" selected disabled>Select an option</option>
                                <?php foreach($BRAND as $brand){ ?>
                                <option value="<?= $brand->brand_id ?>"><?= $brand->brand_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" id="" class="form-control" required>
                                <option value="" selected disabled>Select an option</option>
                                <?php foreach($UNIT as $unit){ ?>
                                <option value="<?= $unit->id ?>"><?= $unit->unit ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>MRP</label>
                            <input type="number" class="form-control" placeholder="MRP" name="mrp" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="number" class="form-control" placeholder="Price" name="sPrice" required>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <label for="productImage">Product Image (<small>Max. image 6</small>)</label>
                        <input type="file" id="productImage" name="productImage[]" class="form-control" accept="image/*"
                            multiple="multiple" required>
                    </div>

                    <div class="col-md-4" hidden>
                        <div class="form-group">
                            <label>GST(%)</label>
                            <select name="gst" id="" class="form-control" required>
                                <option value="0">0%</option>
                                <option value="3">3%</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18" selected>18%</option>
                                <option value="28">28%</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Manufacturer Details</label>
                            <textarea class="form-control" id="manufacturer" name="manufacturer" rows="6"
                                placeholder="Manufacturer Details" required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Packer Details</label>
                            <textarea class="form-control" id="packer" name="packer" rows="6"
                                placeholder="Packer Details" required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Importer Details</label>
                            <textarea class="form-control" id="importer" name="importer" rows="6"
                                placeholder="Importer Details" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addproduct" onclick="add_product()" class="btn btn-primary">Add
                                Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>

<!--end::Portlet-->
</div>
<script>
   new FroalaEditor('#description');
</script>
<script type="text/javascript">
sub_category = function(x) {

    var p = Number(x.id.split("_")[1]) + 1;
    var categoryID = $(x).val();

    if (categoryID) {
        $.ajax({
            type: 'POST',
            data: 'categoryID=' + categoryID,
            url: '<?php echo site_url('product/getsubcategory'); ?>',

            success: function(response) {
                if (response != 0) {
                    $('#subcategory_' + p).html(response);
                    $("#subcategoryDiv_" + p).show();
                } else {
                    for (i = p; i < 50; i++) {
                        $('#subcategory_' + i).html("");

                        $("#subcategoryDiv_" + i).hide();
                    }

                }

            }
        });
    } else {
        for (i = p; i < 50; i++) {
            $('#subcategory_' + i).html("");

            $("#subcategoryDiv_" + i).hide();
        }

    }
}
</script>

<script>
function add_product() {
    var k = 49;
    do {
        k--;
    } while (!$('#subcategory_' + k).val());
    $("#category").val($('#subcategory_' + k).val());
    $("#addproduct").submit();
}
</script>