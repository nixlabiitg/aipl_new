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
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group d-flex align-items-center">
                                <label for="from" class="mr-3 font-bold">From</label>
                                <input type="date" value="<?= $FROM ? $FROM : '' ?>" class="form-control" id="from" name="from" required>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group d-flex align-items-center">
                                <label for="to" class="mr-3 font-bold">To</label>
                                <input type="date" class="form-control" value="<?= $TO ? $TO : '' ?>" id="to" name="to" required>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Bank A/C Holder Name</th>
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                <th>A/C No</th>
                                <th>IFS Code</th>
                                <th>PAN No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($LIST as $data){
                                $amount = intval($data->request_amount) - (intval($data->tds)+intval($data->admin_charge));    
                            ?>
                            <tr>
                                <td class="text-center"><?= ++$id ?></td>
                                <td class="text-uppercase"><?= $data->name ?></td>
                                <td><?= $data->mobile ?></td>
                                <td class="text-right">&#8377;<?= number_format($amount,2) ?></td>
                                <td class="text-uppercase"><?= $data->payee_name ?></td>
                                <td><?= $data->bank_name ?></td>
                                <td><?= $data->branch_name ?></td>
                                <td><?= $data->ac_no ?></td>
                                <td><?= $data->ifsc_code ?></td>
                                <td><?= $data->pan_no ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>