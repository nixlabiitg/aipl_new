<?php 
function customerTree($customerId, $level = 1)
{
    $c = &get_instance();
    $data = [];

    $sql = "SELECT * FROM `customer_master` WHERE `sponsor_id`='" . $customerId . "'";
    $query = $c->db->query($sql);
    $result = $query->result_array();

    if ($c->db->affected_rows() > 0) {
        foreach ($result as $rs) {
            $package_id = $rs['package_id'];
            $sponsorid = $rs['sponsor_id'];

            $sponsor_details = $c->Crud->ciRead("customer_master", "`customer_id` = '$sponsorid'");
            $sname = $sponsor_details[0]->name ?? '--';

            $sql = "SELECT * FROM `package_master` WHERE `package_id`='" . $package_id . "'";
            $query = $c->db->query($sql);
            $package_details = $query->result_array();
            $package_name = !empty($package_details) ? $package_details[0]['package_name'] : '--';



            $data[] = [
                'customer_id' => $rs['customer_id'],
                'name' => $rs['name'],
                'address' => $rs['address'],
                'mobile' => $rs['mobile'],
                'email' => $rs['email'],
                'sponsor_id' => $sname,
                'sponsor_id' => $rs['sponsor_id'],
                'package_name' => $package_name,
                'status' => ($rs['status'] == 1 || $rs['status'] == 4) ? 'Active' : 'Inactive',
                'activation_date' => $rs['activation_date'] ? date('d F Y', strtotime($rs['activation_date'])) : '--',
                'level' => $level
            ];

            $data = array_merge($data, customerTree($rs['customer_id'], $level + 1));
        }
    }

    return $data;
}

// Fetch tree data
$customerData = [];
foreach ($tree as $t) {
    $customerData = array_merge($customerData, customerTree($t['customer_id']));
}
?>

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
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <form action="" method="post" class="mb-3">
                    <div class="row">
                        <div class="col-2">
                            <input type="text" value="<?= $CUSTID ? $CUSTID : '' ?>" placeholder="Enter Customer ID" name="customerid" class="form-control"
                                required>
                        </div>

                        <div class="col-2">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sponsor</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Package</th>
                                <th>Status</th>
                                <th>Approved On</th>
                                <th>Registration Date</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; ?>
                            <?php foreach ($customerData as $t) {
                                $sponsorid = $t['sponsor_id'];
                                $sponsor_details = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsorid'");
                            ?>
                            <tr>
                                <td class="text-center"><?= ++$id; ?></td>
                                <td><?= $t['customer_id'] ?></td>
                                <td><?= $t['name'] ?></td>
                                <td nowrap>
                                    <?= $sponsor_details[0]->name ?><br/>
                                    <?= $sponsorid ?>
                                </td>
                                <td><?= $t['address'] ?></td>
                                <td><?= $t['mobile'] ?></td>
                                <td><?= $t['email'] ?></td>
                                <td><?= $t['package_name'] ?></td>
                                <td><?= $t['status'] ?></td>
                                <td><?= $t['activation_date'] ?></td>
                                <td><?= $t['registration_date'] ?></td>
                                <td class="text-center"><?= $t['level'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>