<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet p-3">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Service Id</th>
                                <th>Service Provider</th>
                                <th>Customer</th>
                                <th>Query Date</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($services_query as $data){
                                $customerId = $data->user_id;
                                $customerDetails = $this->Crud->ciRead("customer_master", "`customer_id` = '$customerId'");

                                $providerId = $data->service_partner;
                                $providerDetails = $this->Crud->ciRead("customer_master", "`customer_id` = '$providerId'");

                                $serviceId = $data->service_code;
                                $serviceDetails = $this->Crud->ciRead("service_master", "`service_code` = '$serviceId'");

                                $serviceCategory = $serviceDetails[0]->category_id;
                                $sql = "SELECT * FROM `category_master` WHERE `category_id` = '$serviceCategory'";
                                $query = $this->db->query($sql);
                                $category = $query->result_array();

                                $singleServiceId = $serviceDetails[0]->id;

                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td>
                                        Category : <?= $category[0]['category_name']; ?><a href="#" onclick="showDetails(<?= $singleServiceId ?>)"> <i class="fa fa-link"></i></a>
                                    </td>
                                    <td><?= $providerDetails[0]->name ?><br/><small>(<?= $providerId ?>)</small></td>
                                    <td><?= $customerDetails[0]->name ?><br/><small>(<?= $customerId ?>)</small></td>
                                    <td><?= $data->added_date ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form id="singleServiceDetails" action="<?php echo base_url('../welcome/service_details') ?>" method="post" hidden>
                        <input type="text" id="singleserviceid" name="singleserviceid">
                    </form>
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

<script>
function showDetails(x) {
    $("#singleserviceid").val(x);
    $("#singleServiceDetails").submit();
}
</script>