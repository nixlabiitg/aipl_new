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
    <?php foreach($product as $pr) {
        $catid=$pr['category_id'];
        $countryorigin=$pr['country_of_origin'];
        $gst=$pr['gst'];
    ?>
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" id="ai" action="<?php echo base_url('product/updateProductBasic') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h3>Add Product</h3>
                <hr>
                <div class="row">
                    <input hidden readonly name="productid" value="<?=$pr['product_id']  ?>">
                    <input hidden readonly name="pcode" value="<?=$pr['product_code']  ?>">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="subcategory_0" id="subcategory_0" class="form-control" required onchange="sub_category(this);">
                                <option value="" selected disabled>Select category</option>
                                <?php 
                                    function u_category($catid)
                                    {
                                        $c=& get_instance();
                                        $cat="";
                                        $sql="SELECT * FROM `category_master` WHERE `category_id`='".$catid."'";
                                        $query=$c->db->query($sql);
                                        $result=$query->result_array();
                                        foreach($result as $rs)
                                        {
                                            if ($rs['under_category_id']!=1){
                                            $cat=u_category($rs['under_category_id'])."/".$rs['category_id'];
                                            } 
                                            else  $cat=$rs['category_id'];
                                        }
                                        return $cat;
                                    }
                                $category_id=u_category($catid);
                                foreach ($category as $cat) { ?>
                                <option value="<?= $cat['category_id'] ?>">
                                    <?= $cat['category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php for($i=1;$i<50;$i++) {?>
                        <div style="display:none;" class="col-lg-4" id="subcategoryDiv_<?=$i?>">
                            <div class="form-group">
                                <label for="subcategory">Sub-category <?=$i?></label>
                                <select name="subcategory_<?=$i?>" id="subcategory_<?=$i?>" class="form-control"  onchange="sub_category(this);">                                        
                                    <option value="" selected disabled>---Select---</option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <input readonly hidden id='category' name='category' />



                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" value="<?=$pr['product_name']; ?>" class="form-control" placeholder="Enter name" name="product" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>HSN Code</label>
                            <input type="number" class="form-control"  value="<?=$pr['HSN_code']; ?>" placeholder="NSN Code" name="hsn" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <select name="brand" id="brand" class="form-control" required >
                                <option value="" selected disabled>Select brand</option>
                                <?php foreach ($brand as $cat) { ?>
                                <option <?php echo($pr['brand_id']==$cat['brand_id']?"selected":"") ?> value="<?= $cat['brand_id'] ?>">
                                    <?=  $cat['brand_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" id="unit" class="form-control" required >
                                <option value="" selected disabled>Select unit</option>
                                <?php foreach ($unit as $cat) { ?>
                                <option <?php echo($pr['unit']==$cat['id']?"selected":"") ?> value="<?= $cat['id'] ?>">
                                    <?=  $cat['unit'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>MRP</label>
                            <input type="number" value="<?=$pr['mrp'];?>" class="form-control" placeholder="MRP" name="mrp" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="number"  value="<?=$pr['price'];?>" class="form-control" placeholder="Price" name="sPrice" required>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <label for="productImage">Product Image (<small>Max. image 6</small>)</label>
                        <input type="file" id="productImage" name="productImage[]" class="form-control" accept="image/*"
                            multiple="multiple">
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>GST(%)</label>
                            <select name="gst" id="" class="form-control" required>
                                <option <?= $pr['gst'] == '0' ? 'selected' : '' ?> value="0">0%</option>
                                <option <?= $pr['gst'] == '3' ? 'selected' : '' ?> value="3">3%</option>
                                <option <?= $pr['gst'] == '5' ? 'selected' : '' ?> value="5">5%</option>
                                <option <?= $pr['gst'] == '12' ? 'selected' : '' ?> value="12">12%</option>
                                <option <?= $pr['gst'] == '18' ? 'selected' : '' ?> value="18">18%</option>
                                <option <?= $pr['gst'] == '28' ? 'selected' : '' ?> value="28">28%</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea name="description" id="description" class="form-control"><?=$pr['product_description'];?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Manufacturer Details</label>
                            <textarea class="form-control" id="manufacturer" name="manufacturer" rows="6"
                                placeholder="Manufacturer Details" required><?=$pr['manufacturer']?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Packer Details</label>
                            <textarea class="form-control" id="packer" name="packer" rows="6"
                                placeholder="Packer Details" required><?=$pr['packer_details']?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Importer Details</label>
                            <textarea class="form-control" id="importer" name="importer" rows="6"
                                placeholder="Importer Details" required><?=$pr['importer_details']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" name="addproduct" onclick=edit_product(); class="btn btn-primary">Edit
                                Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <?php } ?>
</div>

<!--end::Portlet-->
</div>
<script>
   new FroalaEditor('#description');
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
 $(document).ready(function() {      
   $("#gst").val(<?=$gst?>);
   $("#country").val('<?=$countryorigin?>');
    var c="<?=$category_id;?>";
  
   var ct=c.split("/");
   $("#subcategory_0").val(ct[0])
  
  for(i=1;i<ct.length;i++)
    {
        sub_category_view(i,ct[i-1],ct[i]);
     
        
    }
    });
     
    
      function edit_product()
      {        
          var k=49;
          do
          {
                k--;          
          } while (!$('#subcategory_'+k).val()) ;
            $("#category").val($('#subcategory_'+k).val());
            $("#ai").submit();
      }
</script>    

<script type="text/javascript">  
   
sub_category_view = function(p,x,y)        
        {
                     
                var categoryID = x;
          
            if(categoryID){
                $.ajax({
                    type: 'POST',
                    data: 'categoryID='+categoryID,
                    url: '<?php echo site_url('product/getsubcategory1'); ?>',
            
                        success: function(response) {
                       //     alert(response);
                  if(response!=0)
                  {
                    $('#subcategory_'+p).html(response);
                    $("#subcategoryDiv_"+p).show();
                    $("#subcategory_"+p).val(y);  
                  } else {
                        for(i=p;i<50;i++)
                        {
                            $('#subcategory_'+i).html("");
                                           
                            $("#subcategoryDiv_"+i).hide();
                        }
                       
                  }
                  
                }
            });
            }else {
                for(i=p;i<50;i++)
                        {
                            $('#subcategory_'+i).html("");
                                           
                            $("#subcategoryDiv_"+i).hide();
                        }
                       
                  }
        }     




        sub_category = function(x)        
        {
      
                var p=Number(x.id.split("_")[1])+1;                 
                var categoryID = $(x).val();
         
            if(categoryID){
                $.ajax({
                    type: 'POST',
                    data: 'categoryID='+categoryID,
                    url: '<?php echo site_url('product/getsubcategory1'); ?>',
            
                        success: function(response) {
                       //     alert(response);
                  if(response!=0)
                  {
                    $('#subcategory_'+p).html(response);
                    $("#subcategoryDiv_"+p).show();
                  } else {
                        for(i=p;i<50;i++)
                        {
                            $('#subcategory_'+i).html("");
                                           
                            $("#subcategoryDiv_"+i).hide();
                        }
                       
                  }
                  
                }
            });
            }else {
                for(i=p;i<50;i++)
                        {
                            $('#subcategory_'+i).html("");
                                           
                            $("#subcategoryDiv_"+i).hide();
                        }
                       
                  }
        }     
</script>