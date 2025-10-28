<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-checkable" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th nowrap>Organization Name</th>
                                <th nowrap>Category</th>
                                <th nowrap>Available In</th>
                                <th nowrap>Country</th>
                                <th nowrap>State</th>
                                <th nowrap>City</th>
                                <th nowrap>Pin</th>
                                <th nowrap>Phone</th>
                                <th nowrap>Whatsapp</th>
                                <th nowrap>Mail Id</th>
                                <th nowrap>Website</th>
                                <th nowrap>Experience</th>
                                <th nowrap>Expertise</th>
                                <th nowrap>Service Description</th>
                                <th nowrap>Service Images</th>
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
                                    <button class="btn btn-info"
                                        onclick="viewImageModal(<?= $product->id ?>)">View</button>
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
<div class="modal fade" id="serviceImages" tabindex="-1" role="dialog" aria-labelledby="serviceImagesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceImagesLabel">Service Image</h5>
            </div>
            <div class="modal-body">
                <div class="row" id="images">

                </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
function viewImageModal(x) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url('products/viewImages') ?>',
        data: {
            id: x
        },

        success: function(data) {
            $("#serviceImages").modal('show');
            $("#images").html(data);
        }
    })
}
</script>