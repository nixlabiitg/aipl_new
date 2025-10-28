<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Login history
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Date - Time</th>
                        <th>OS</th>
                        <th>Browser</th>
                        <th>Remote address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id = 0;
                        foreach ($LOGIN_HISTORY as $history) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><?php echo '<b>Date :</b> '. date('d-M-Y', strtotime($history->login_date)) . ' || <b>Time :</b> ' . $history->login_time; ?></td>
                                    <td><?php echo $history->os; ?></td>
                                    <td><?php echo $history->browser; ?></td>
                                    <td><?php echo $history->ip; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>