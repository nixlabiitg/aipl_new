

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
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>MRP</th>
                                <th>Selling Price</th>
                                <th>HSN Code</th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <!-- <th>GST(%)</th> -->
                                <th>Images</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Action</th>
                                <th>Scratch Card</th>
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

                                $unit = $product->unit;
                                $findunit = $this->Crud->ciRead("unit", "`id` = '$unit'")[0]->unit;

                                $brand = $product->brand_id;
                                $findname = $this->Crud->ciRead("brand_master", "`brand_id` = '$brand'")[0]->brand_name;
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><?= $product->product_name ?></td>
                                    <td><?= $category ?></td>
                                    <td>&#8377;<?= $product->mrp ?></td>
                                    <td>&#8377;<?= $product->price ?></td>
                                    <td><?= $product->HSN_code ?></td>
                                    <td><?= $findname ?></td>
                                    <td><?= $findunit ?></td>
                                    <!-- <td class="text-center"><?= $product->gst ?>%</td> -->
                                    <td class="text-center" nowrap>
                                        <button class="btn btn-info btn-sm" onclick="viewImageModal(<?= $product->product_id ?>)">View</button>
                                    </td>
                                    <td class="text-center">
                                        <button id="<?= $product->product_id ?>" class="btn btn-warning btn-sm" onclick=product_details(this);>View</button>
                                    </td>
                                    <td nowrap>
                                        <button class="btn btn-info btn-sm" id="<?php echo $product->product_code?>/<?php echo $product->product_name?>/<?php echo $product->category_id?>/<?php echo $product->product_id?>" onclick=product_edit(this);>Edit</button>
                                    </td>
                                    <td nowrap>
                                        <?php if($product->status == 1){ ?>
                                            <button onclick="changeStatus(<?= $product->product_id ?>,0)" class="btn btn-danger btn-sm">Block</button>
                                        <?php }else{ ?>
                                            <button onclick="changeStatus(<?= $product->product_id ?>,1)" class="btn btn-success btn-sm">Unblock</button>
                                        <?php } ?>
                                    </td>
                                    <td nowrap>
                                        <?php if($product->used_in_scratch == 1){ ?>
                                            <button onclick="set_remove_scratch_card(<?= $product->product_id ?>,0)" class="btn btn-warning btn-sm">Remove From Scratch Card</button>
                                        <?php }else{ ?>
                                            <button onclick="set_remove_scratch_card(<?= $product->product_id ?>,1)" class="btn btn-primary btn-sm">Set For Scratch Card</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form id='pd' action="<?php echo base_url('product/product_details'); ?>" method="post">
                        <input hidden id="pcode" name="pcode" type="text">
                    </form>

                    <form id='editpd' action="<?php echo base_url('product/product_edit'); ?>" method="post">
                        <input hidden id="editpid" name="editpid" type="text" >     
                        <input hidden id="editpcode" name="editpcode" type="text" >     
                        <input hidden id="editpname" name="editpname" type="text" >     
                        <input hidden id="editcatid" name="editcatid" type="text" > 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="images">
            
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

        $("#pd").submit();
    }
</script>

<script>
    product_edit = function(x) {
        var p = x.id.split("/");
        $("#editpcode").val(p[0]);
        $("#editpname").val(p[1]);   
        $("#editcatid").val(p[2]);  
        $("#editpid").val(p[3]);  
        $("#editpd").submit(); 
    }
</script>

<script>
    function viewImageModal(x){
        $.ajax({
            type : 'post',
            url : '<?php echo base_url('product/viewImages') ?>',
            data : {
                id : x
            },

            success:function(data){
                $("#imageModal").modal('show');
                $("#images").html(data);
            }
        })
    }
</script>

<script>

set_remove_scratch_card=function(pid,status)
{
    
    $.ajax({
            type : 'post',
            url : '<?php echo base_url('product/setscratch') ?>',
            data : {
                "pid" : pid,
                "status" : status
            },

            success:function(data){
                // alert(data);
                if(data == 1){
                    if(status==1) alert("Added to scratch card.");
                    else  alert("Removed from scratch card.")
                    
                    location.reload();
                }else{
                    alert("Something went wrong.")
                    location.reload();
                }
            }
        })
}

    function changeStatus(x,y){
        $.ajax({
            type : 'post',
            url : '<?php echo base_url('product/changeProductStatus') ?>',
            data : {
                id : x,
                status : y
            },

            success:function(data){
                if(data == 1){
                    alert("Status changed.")
                    location.reload();
                }else{
                    alert("Something went wrong.")
                    location.reload();
                }
            }
        })
    }
</script>