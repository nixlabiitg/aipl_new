
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
                    <table id="totalStockTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Franchise</th>
                                <th>Product</th>
                                <th>Total Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($TotalStocks)) { ?>
                                <?php foreach($TotalStocks as $stock) { ?>
                                    <tr>
                                        <td class="text-center"><?= ++$id ?></td>
                                        <td><?= $stock['franchise_name']; ?></td>
                                        <td><?= $stock['product_name']; ?></td>
                                        <td><?= $stock['total_stock']; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="3" class="text-center">No records found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#totalStockTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": true,
        "lengthChange": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>
