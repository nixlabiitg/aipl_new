

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
                                <th>Organization Name</th>
                                <th>Category</th>
                                <th>Available In</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Pin</th>
                                <th>Phone</th>
                                <th>Whatsapp</th>
                                <th>Mail Id</th>
                                <th>Website</th>
                                <th>Experience</th>
                                <th>Expertise</th>
                                <th>Service Description</th>
                                <th>Service Images</th>
                                <th>Active</th>
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
                                    if ($rs['under_category_id'] != 2) {
                                        $cat = underCategory($rs['under_category_id']) . "/" . $rs['category_name'];
                                    } else  $cat = $rs['category_name'];
                                }
                                return $cat;
                            }
                            foreach ($PRODUCT as $product) {
                                $category = underCategory($product->category_id);

                                $countrycode = $product->country;
                                $country = $this->Crud->ciRead("countries", "`iso2` = '$countrycode'")[0]->name;

                                $statecode = $product->state;
                                $state = $this->Crud->ciRead("states", "`id` = '$statecode'")[0]->name;

                                $citycode = $product->city;
                                $city = $this->Crud->ciRead("cities", "`id` = '$citycode'")[0]->name;
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td>
                                        <?= $product->organization_name ?>
                                        <?php if($product->status == 1){ ?>
                                            <p style="font-size:10px; color : orange;"><small>Request Pending</small></p>
                                        <?php }else if($product->status == 2){ ?>
                                            <p style="font-size:10px; color : green;"><small>Request Approved</small></p>
                                        <?php }else if($product->status == 0){ ?>
                                            <p style="font-size:10px; color : red;"><small>Request Rejected</small></p>
                                        <?php } ?>
                                    </td>
                                    <td><?= $category ?></td>
                                    <td>
                                        <?= $product->available_in ?>
                                    </td>
                                    <td><?= $country ?></td>
                                    <td><?= $state ?></td>
                                    <td><?= $city ?></td>
                                    <td><?= $product->pin ?></td>
                                    <td><?= $product->phone ?></td>
                                    <td><?= $product->whatsapp ?></td>
                                    <td><?= $product->mail_id ?></td>
                                    <td><?= $product->website ?></td>
                                    <td><?= $product->experience ?></td>
                                    <td><?= $product->expertise ?></td>
                                    <td><?= $product->service_description ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="viewImageModal(<?= $product->id ?>)">View</button>
                                    </td>
                                    <td>
                                        <?php if($product->status == 1){ ?>
                                            <a onclick="return confirm('Are you sure to proceed?')" href="<?php echo base_url('product/serviceRequest/2/'.$product->id) ?>" class="btn btn-success btn-sm">Approve</a>
                                            <a onclick="return confirm('Are you sure to proceed?')" href="<?php echo base_url('product/serviceRequest/0/'.$product->id) ?>" class="btn btn-danger btn-sm">Reject</a>
                                        <?php }else if($product->status == 2){ ?>
                                            <a onclick="return confirm('Are you sure to proceed?')" href="<?php echo base_url('product/serviceRequest/0/'.$product->id) ?>" class="btn btn-danger btn-sm">Reject</a>
                                        <?php }else{ echo '---';} ?>
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

<!-- Modal -->
<div class="modal fade" id="serviceImages" tabindex="-1" role="dialog" aria-labelledby="serviceImagesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceImagesLabel">Service Image</h5>
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
        $("#pname").val(p[1]);

        $("#pd").submit();
    }
</script>

<script>
    function viewImageModal(x){
        $.ajax({
            type : 'post',
            url : '<?php echo base_url('product/viewServiceImages') ?>',
            data : {
                id : x
            },

            success:function(data){
                $("#serviceImages").modal('show');
                $("#images").html(data);
            }
        })
    }
</script>