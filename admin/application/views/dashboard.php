<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
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

    <!-- end:: Content Head -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="col-xl-12 mb-3 m-0 p-0">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <h5 class="text-success">Total Customer</h5>
                            <hr>
                            <h2 class="text-warning"><?=($pencust+$apcust)?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <h5 class="text-success">Total Packages</h5>
                            <hr>
                            <h2 class="text-warning"><?=count($package)?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('customer/pendingCustomer'); ?>">
                                <h5 class="text-success">Pending Customer</h5>
                            </a>

                            <hr>
                            <h2 class="text-warning"><?=$pencust?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <h5 class="text-success">Total Franchise</h5>
                            <hr>
                            <h2 class="text-warning"><?=($fpending+$fapprove+$freject)?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('franchise/pendingFranchise'); ?>">
                                <h5 class="text-success">Franchise Request <p class="text-white">adada</p>
                                </h5>
                            </a>
                            <hr>
                            <h2 class="text-warning"><?=$fpending?></h2>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('customer/activationwallet'); ?>">
                                <h5 class="text-success">Activation Wallet Request</h5>
                            </a>
                            <hr>
                            <h2 class="text-warning"><?=$awallet?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('customer/pending_request'); ?>">
                                <h5 class="text-success">Customer Payout Request</h5>
                            </a>
                            <hr>
                            <h2 class="text-warning"><?=$payout?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('customer/upgraderequest'); ?>">
                                <h5 class="text-success">Customer Upgrade Request</h5>
                            </a>
                            <hr>
                            <h2 class="text-warning"><?=$ugrequest?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('report/pending_orders'); ?>">
                                <h5 class="text-success">Pending Orders<p class="text-white">adada</p>
                                </h5>
                            </a>
                            <hr>
                            <h2 class="text-warning"><?=$porder?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('product/manageServices/pending'); ?>">
                                <h5 class="text-success">Service Request<p class="text-white">adada</p>
                                </h5>
                            </a>
                            <hr>
                            <h2 class="text-warning"><?=$pservice?></h2>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('report/kyc_request_by_customer'); ?>">
                                <h5 class="text-success">Customer KYC Request<p class="text-white">adada</p>
                                </h5>
                            </a>


                            <hr>
                            <h2 class="text-warning"><?=$ckyc?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-3">
                    <div class="card border-info p-3" style="border-radius:10px;">
                        <div class="text-center">
                            <a href="<?= base_url('report/kyc_request_by_francise'); ?>">
                                <h5 class="text-success">Franchise KYC Request<p class="text-white">adada</p>
                                </h5>
                            </a>


                            <hr>
                            <h2 class="text-warning"><?=$fkyc?></h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-12 mt-3 mb-4">
            <h5>Activation List</h5>
            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col-lg-3 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="">From</label>
                            <input type="date" name="from" value="<?= $from == '' ? date('Y-m-d') : $from ?>" id="from"
                                class="form-control ml-2" required>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="">To</label>
                            <input type="date" name="to" id="to" value="<?= $to == '' ? date('Y-m-d') : $to ?>" class="form-control ml-2"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-2">
                        <button type="submit" name="activationList" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Customer ID</td>
                            <td>Sponsor</td>
                            <td>Package</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($TODAY_ACTIVATION)){ $_id = 0; foreach($TODAY_ACTIVATION as $data){ ?>
                        <tr>
                            <td><?= ++$_id ?></td>
                            <td><?= $data->name ?></td>
                            <td><?= $data->customer_id ?></td>
                            <td><?= $data->sponsor_id ?></td>
                            <td><?= $data->package_name ?></td>
                        </tr>
                        <?php }}else{ ?>
                        <tr>
                            <td colspan="5" class="text-center">NO DATA FOUND</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-12 mt-3 mb-4">
            <h5>PP & SPP Rank Holders List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Customer ID</td>
                            <td>Sponsor</td>
                            <th class="text-center">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($PP_RANK)){ $_id = 0; foreach($PP_RANK as $data){ ?>
                        <tr>
                            <td><?= ++$_id ?></td>
                            <td><?= $data->name ?></td>
                            <td><?= $data->customer_id ?></td>
                            <td><?= $data->sponsor_id ?></td>
                            <td class="text-center"><?= $data->promotion_id == 1 ? 'PP' : 'SPP' ?></td>
                        </tr>
                        <?php }}else{ ?>
                        <tr>
                            <td colspan="5" class="text-center">NO DATA FOUND</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-success text-light">
                                    <th>Users</th>
                                    <th class="text-center">Count</th>
                                    <th class="text-right">Business</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td class="text-center"><?=$pencust?></td>
                                    <td class="text-right">&#8377;<?=number_format($pamt ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger">Reject</span></td>
                                    <td class="text-center"><?=$rejcust?></td>
                                    <td class="text-right">&#8377;<?=number_format($ramt ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td class="text-center"><?=$apcust?></td>
                                    <td class="text-right">&#8377;<?=number_format($aamt ?? 0,2)?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total = </th>
                                    <th class="text-center"><?=($pencust+$apcust)?></th>
                                    <th class="text-right">&#8377;<?=number_format(($pamt+$aamt) ?? 0,2)?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-warning text-light">
                                    <th>Franchise</th>
                                    <th class="text-center">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-warning">Pending Request</span></td>
                                    <td class="text-center"><?=$fpending?></td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger">Reject</span></td>
                                    <td class="text-center"><?=$freject?></td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td class="text-center"><?=$fapprove?></td>
                                </tr>
                            </tbody>
                            </tfoot>
                            <tr>
                                <th>Total =</th>
                                <th class="text-center"><?=$fpending+$fapprove+$freject?></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 table-responsive" style="height:385px;">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-danger text-light">
                                    <th class="text-center">ID</th>
                                    <th>Package Details</th>
                                    <th class="text-center">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl=0;
                                $total=0;
                                foreach($package as $pk)
                                { $total+=$pk['cnt']?>
                                <tr>
                                    <td class="text-center"><?=++$sl?></td>
                                    <td>
                                        <h5><b><?=$pk['package_name']?></b></h5>

                                    </td>
                                    <td class="text-center"><?=$pk['cnt']?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">Total = </th>
                                    <th class="text-center"><?=$total?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <form hidden action="<?=base_url('dashboard/club_members')?>" method="POST" id="clubview">
                    <input type="text" id="club_id" name="club_id">
                </form>

                <form hidden action="<?=base_url('dashboard/director_club_members')?>" method="POST" id="dclubview">
                    <input type="text" id="dclub_id" name="dclub_id">
                </form>

                <form hidden action="<?=base_url('dashboard/recog_members')?>" method="POST" id="rclubview">
                    <input type="text" id="rclub_id" name="rclub_id">
                    <input type="text" id="rclub_name" name="rclub_name">
                </form>

                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th>Club Achieve Bonus</th>
                                    <th class="text-center">Count</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Green Club</td>
                                    <td class="text-center"><?=$green?></td>
                                    <td class="text-center"><a onclick="club_member(1)"><i class="fa fa-list"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Red Club</td>
                                    <td class="text-center"><?=$red?></td>
                                    <td class="text-center"><a onclick="club_member(2)"><i class="fa fa-list"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Yellow Club</td>
                                    <td class="text-center"><?=$yellow?></td>
                                    <td class="text-center"><a onclick="club_member(3)"><i class="fa fa-list"></i></a>
                                    </td>
                                </tr>
                                <tr class="bg-warning text-light">
                                    <th>Director Club Bonus</th>
                                    <th class="text-center">Count</th>
                                    <th class="text-center">View</th>
                                </tr>
                                <tr>
                                    <td>ASSISTANT DIRECTOR</td>
                                    <td class="text-center"><?=$adirector?></td>
                                    <td class="text-center"><a onclick="derector_member(4);"><i
                                                class="fa fa-list"></i></a></td>
                                </tr>
                                <tr>
                                    <td>DIRECTOR</td>
                                    <td class="text-center"><?=$director?></td>
                                    <td class="text-center"><a onclick="derector_member(5);"><i
                                                class="fa fa-list"></i></a></td>
                                </tr>
                                <tr>
                                    <td>SR DIRECTOR</td>
                                    <td class="text-center"><?=$sdirector?></td>
                                    <td class="text-center"><a onclick="derector_member(6);"><i
                                                class="fa fa-list"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-light">
                                    <th class="text-center" colspan="5">RECOGNITIONS</th>
                                </tr>

                                <tr>
                                    <th>#</th>
                                    <th>RECOGNITIONS</th>
                                    <th class="text-center">Member</th>
                                    <th>Facilities</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $i=0;
                            $cnt=0;
                            foreach($recognition as $rc)
                                { 
                                    $cnt+=$rc['cnt'];?>
                                <tr>
                                    <td><?=++$i?></td>
                                    <td><?=$rc['club_name']?></td>
                                    <td class="text-center"><?=$rc['cnt']?></td>
                                    <td class="text-left"><?=$rc['facilities']?></td>
                                    <td class="text-center"><a id="<?=$rc['reward_club_id']."/".$rc['club_name']?>"
                                            onclick="recog_member(this);"><i class="fa fa-list"></i></a></td>

                                </tr>
                                <?php } ?>
                            </tbody>
                            </tfoot>
                            <tr>
                                <th></th>

                                <th class="text-right">Total = </th>
                                <th class="text-center"><?=$cnt?></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>


            </div>
        </div>



        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-light">
                                    <th class="text-center" colspan="3">Incomes</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Income</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=0;
                                $tincome=0;
                                foreach($income as $in)
                                {
                                    $tincome+=$in['income'];
                                ?>
                                <tr>
                                    <td class="text-center"><?=++$i?></td>
                                    <td><?=$in['income_name']?></td>
                                    <td class="text-right">&#8377;<?=number_format($in['income'] ?? 0,2)?></td>
                                </tr>

                                <?php } ?>

                            </tbody>
                            <tfooter>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Total Income</th>
                                    <th class="text-right">&#8377;<?=number_format($tincome ?? 0,2)?></th>
                                </tr>

                            </tfooter>



                        </table>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-sm border-0 table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th colspan="2" class="bg-success text-light">Wallet</th>
                                </tr>
                                <tr>
                                    <td>ACTIVATION WALLET</td>
                                    <td class="text-right">&#8377;<?=number_format($wallet[0]['awallet'] ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <td>DIGITAL WALLET</td>
                                    <td class="text-right">&#8377;<?=number_format($wallet[0]['dwallet'] ?? 0,2)?></td>
                                </tr>
                                <!-- <tr>
                                    <td>MAGIC_SHOPPING_POINT</td>
                                    <td class="text-center">&#8377;79,601.00</td>
                                </tr> -->
                                <tr>
                                    <td>MAIN WALLET</td>
                                    <td class="text-right">&#8377;<?=number_format($wallet[0]['mwallet'] ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <td>POINT WALLET</td>
                                    <td class="text-right">&#8377;<?=number_format($wallet[0]['pwallet'] ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="bg-warning text-light">Payouts</th>
                                </tr>
                                <tr>
                                    <td>Franchise</td>
                                    <td class="text-right">&#8377;<?=number_format($fpayout ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td class="text-right">&#8377;<?=number_format($cpayout ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="bg-danger text-light">Payout Request</th>
                                </tr>
                                <tr>
                                    <td>Approved</td>
                                    <td class="text-right">&#8377;<?=number_format($papprove ?? 0,2)?></td>
                                </tr>
                                <tr>
                                    <td>Pending</td>
                                    <td class="text-right">&#8377;<?=number_format($prequest ?? 0,2)?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
club_member = function(x) {
    $("#club_id").val(x);
    $("#clubview").submit();
}

derector_member = function(x) {
    $("#dclub_id").val(x);
    $("#dclubview").submit();
}

recog_member = function(x) {
    var p = x.id.split("/");
    $("#rclub_id").val(p[0]);
    $("#rclub_name").val(p[1]);
    $("#rclubview").submit();
}
</script>