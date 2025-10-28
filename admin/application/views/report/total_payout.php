
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
   <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>

    <!-- Date Range Filter Form -->
    <form action="<?= base_url('report/total_payout') ?>" method="POST">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="from">From</label>
                <input type="date" id="from" name="from" class="form-control">
            </div>
            <div class="col-lg-3">
                <label for="to">To</label>
                <input type="date" id="to" name="to" class="form-control">
            </div>
            <div class="col-lg-4 mt-4">
                <button type="submit" class="btn btn-success mt-2">Display</button>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="row">
        <div class="col-sm-12">
            <div class="table-wrap">
                <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>                               
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Package</th>
                            <th>Debit</th>
                            <th>Credit Date</th>
                            <th>Remarks</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $id = 0; ?>
                    <?php foreach($income as $ar) { ?>
                    <tr>
                        <td><?= ++$id; ?></td>                                
                        <td><?= $ar['customer_id'] ?></td>
                        <td><?= $ar['name'] ?></td>
                        <td><?= $ar['package_name'] ?></td>
                        <td class="text-right">&#8377;<?= number_format((float)$ar['debit'], 2) ?></td>
                        <td><?= $ar['dt'] ?></td>
                        <td><?= $ar['remarks'] ?></td>
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

<!-- JS: jQuery + Bootstrap 4 + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


