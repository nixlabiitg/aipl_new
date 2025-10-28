<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" method="post" action="<?php echo site_url('product/addNewServiceCategory/'); ?>" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter category name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Under Category</label>
                            <select name="category" id="" class="form-control" required>
                                <option value="" selected disabled>Select an option</option>
                                <?php foreach ($CATEGORY as $category) { ?>
                                    <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addCategory" class="btn btn-primary">Add Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
    <div class="kt-portlet p-3">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Category Name</th>
                                <th>Under Category</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Edit</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            foreach ($CATEGORIES as $category) {
                                $categoryId = $category->under_category_id;
                                $underCategory = '';
                                if ($categoryId == 0) {
                                    $underCategory = 'Main';
                                } else {
                                    $underCategory = $this->Crud->ciRead("category_master", "`category_id` = '$categoryId'")[0]->category_name;
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><?= $category->category_name ?></td>
                                    <td class="text-center"><?= $underCategory ?></td>
                                    <td class="text-center">
                                        <?php if ($category->status == '1') { ?>
                                            <span class="badge badge-success rounded-pill">Active</span>
                                        <?php } else { ?>
                                            <span class="badge badge-warning rounded-pill">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">Admin</td>
                                    <td class="text-center">
                                        <?php
                                        if ($category->under_category_id == 0) {
                                            echo '--';
                                        } else {
                                        ?>
                                            <button class="btn btn-sm btn-info" onclick="editCategory(<?= $category->category_id ?>)">Edit</button>
                                            <form id="editCategory<?= $category->category_id ?>" method="post" action="<?php echo base_url('product/editServiceCategories') ?>">
                                                <input type="hidden" name="categoryid" id="categoryid<?= $category->category_id ?>">
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($category->under_category_id == 0) {
                                            echo '--';
                                        } else {
                                            if ($category->status == '1') { ?>
                                                <a href="<?php echo base_url('product/changeStatus/0/' . $category->category_id) ?>" class="btn btn-sm btn-danger">Block</a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url('product/changeStatus/1/' . $category->category_id) ?>" class="btn btn-sm btn-success">Unblock</a>
                                        <?php }
                                        } ?>
                                    </td>
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

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function editCategory(x) {
        $("#categoryid" + x).val(x);
        $("#editCategory" + x).submit();
    }
</script>