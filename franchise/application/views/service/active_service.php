

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$page_name?></h3>
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
     
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Category</th>
                                <th>SAC Code</th>
                                <th>GST(%)</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 0;
                            function underCategory($categoryid)
                            {
                                $c = &get_instance();
                                $cat = "";
                                $sql = "SELECT * FROM `category_master` WHERE `category_id`='" . $categoryid . "'";
                                $query = $c->db->query($sql);
                                $result = $query->result_array();
                                foreach ($result as $rs) {
                                    if ($rs['under_category_id'] != 1) {
                                        $cat = underCategory($rs['under_category_id']) . "/" . $rs['category_name'];
                                    } else  $cat = $rs['category_name'];
                                }
                                return $cat;
                            }
                            foreach ($PRODUCT as $product) {
                                $category = underCategory($product->category_id);
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><?= $product->service_name ?></td>
                                    <td><?= $category ?></td>
                                    <td><?= $product->sac_code ?></td>
                                   
                                    <td class="text-center"><?= $product->gst ?>%</td>
                                    <td><?= $product->service_description ?></td>
                                    <td>
                                        <button id="<?= $product->id ?>/<?= $product->service_name ?>" class="btn btn-warning btn-sm" onclick=>Add</button>
                                    </td>
                                    <td nowrap>
                                        <button class="btn btn-info btn-sm">Edit</button>
                                    </td>
                                    <td nowrap>
                                        <button class="btn btn-danger btn-sm">Block</button>
                                        <button class="btn btn-success btn-sm">Unblock</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form id='pd' action="<?php echo base_url('product/product_details'); ?>" method="post">
                        <input hidden id="pcode" name="pcode" type="text">
                        <input hidden id="pname" name="pname" type="text">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    product_details = function(x) {
        var p = x.id.split("/");
        $("#pcode").val(p[0]);
        $("#pname").val(p[1]);

        $("#pd").submit();
    }
</script>