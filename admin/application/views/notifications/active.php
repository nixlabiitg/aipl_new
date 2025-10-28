<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
      <!-- begin:: Content Head -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=($status==1?"Active":"Inactive")?> Notification</h3>
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
                                <th>#</th>
                                <th>Title</th>
                                <th>Show until</th>
                            
                                <th>Added on</th>
                                <th>Status</th>
                                <th><?=($status==1?"Action":"")?></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($NOTIFICATIONS as $notification) {
                            ?>
                                <tr>
                                    <td><?=++$i?></td>
                                    <td><?=$notification['notification'] ?></td>
                                    <td><?=$notification['ud'] ?></td>
                                    <td><?=$notification['ad'] ?></td>
                                    <td>
                                    <?php if($status==1) { ?>
                                        <span class="badge badge-success">Active</span></td>
                                        <?php } else {?>
                                            <span class="badge badge-danger">Inactive</span></td>
                                        <?php } ?>
                                    <td>
                                    <?php if($status==1) { ?>
                                        <a href="<?php echo site_url('notifications/disableNotification/' . $notification['id']); ?>" class="btn btn-info btn-xs">Disable</a>
                                
                                    <?php } ?>     
                                     </td>
                                     <td></td>
                                     <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>