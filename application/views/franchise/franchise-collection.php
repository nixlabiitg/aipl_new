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
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Amount</th>
                                <th>Added On</th>
                                <th>Package</th>
                                <th>Remarks</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($franchises as $data){ ?>
                            <tr>
                                <td class="text-center"><?= ++$id ?></td>
                                <td>&#8377;<?= number_format($data->credit,2) ?></td>
                                <td><?= date('d M Y', strtotime($data->vc_date)) ?></td>
                                <td><?= $data->package_name ?></td>
                                <td><?= $data->remarks ?></td>
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