<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" method="post" action="<?php echo site_url('product/addNewCategory/'); ?>" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control" placeholder="Enter category name" id="brand" required>
                        </div>
                    </div>
                  
                </div>
                <input type="text" hidden id="brandid">
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button   class="btn btn-primary" onclick="add_brand();">Add Brand</button>
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
                                <th>Brand Name</th>                        
                             
                                <th>Actions</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                            foreach ($brand as $br) {
                               
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><?= $br['brand_name'] ?></td>                                   
                                  
                                    <td class="text-left">
                                        <button id="<?=$br['brand_id']."/".$br['brand_name']?>" class="btn btn-sm btn-info" onclick="edit(this)">Edit</button>
                                    </td>
                                   
                                    <td></td>
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

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    add_brand=function()
    {
        if($("#brand").val()=="") { alert("Please enter brand name"); return;}
        if(!confirm("Sure to "+($("#brandid").val()==""?"add":"update")+" brand")) return;
        
        var d={
            "brand":$("#brand").val(),
            "brandid":$("#brandid").val()
        }
        $.ajax({
            url:"<?=base_url('product/add_brand')?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
               // alert(data);
                if(data=="e") alert("Brand already exist.");
                else if(data=="u") alert("Brand updated successfully");
                else alert("Brand added successfully");
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }
        })
    }

    edit=function(x)
    {
        var p=x.id.split("/");
        $("#brand").val(p[1]);
        $("#brandid").val(p[0]);
    }
    
</script>