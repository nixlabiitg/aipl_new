<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="table-responsive">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>HSN Code</th>
                                <th>Quantity</th>

                                <th></th>
                                <th></th>
                                <th></th>
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
                            foreach ($stock as $product) {
                                $category = underCategory($product['category_id']);
                            ?>
                            <tr>
                                <td class="text-center"><?= ++$id ?></td>
                                <td><?= $product['product_name'] ?></td>
                                <td><?= $category ?></td>
                                <td><?= $product['HSN_code'] ?></td>
                                <td>20 <?= $product['unit'] ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
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