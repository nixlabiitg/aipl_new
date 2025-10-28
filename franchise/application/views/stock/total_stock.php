<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
     <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?= $page_name ?></h3>
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
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
            <div class="kt-portlet__body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Total Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($TotalStocks)): ?>
                                <?php $i=1; foreach($TotalStocks as $stock): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $stock['product_name']; ?></td>
                                        <td><?= $stock['total_stock']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No stock found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
            </div>
        <!--end::Form-->
    </div>
</div>

<!--end::Portlet-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

