<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" method="post" action="<?php echo site_url('product/updateServiceCategory/'); ?>" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter category name" name="name" value="<?= $CATEGORIES[0]->category_name ?>" required>
                            <input type="hidden" name="categoryid" value="<?= $CATEGORIES[0]->category_id ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Under Category</label>
                            <select name="category" id="" class="form-control" required>
                                <?php foreach ($CATEGORY as $category) {
                                    $underCategory = $CATEGORIES[0]->under_category_id;
                                ?>
                                    <option value="<?= $category->category_id ?>" <?= $category->category_id == $underCategory ? 'selected' : '' ?>><?= $category->category_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="upadteCategory" class="btn btn-primary">Update Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>