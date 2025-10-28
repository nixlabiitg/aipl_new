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

        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>Added On</th>
                                <th nowrap>Action</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($TIESUP as $data){ ?>
                            <tr class="text-center">
                                <td><?= ++$id ?></td>
                                <td class="text-left">
                                    <img src="<?= base_url('../uploads/tiesup/'.$data->ties_image) ?>" alt="" class="rounded" style="width : 60px;">
                                    <?= $data->company_name ?>
                                </td>
                                <td>
                                    <?php if($data->status == 1){ ?>
                                    <span class="badge badge-info">Live</span>
                                    <?php } else { ?>
                                    <span class="badge badge-danger">Block</span>
                                    <?php } ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($data->added_date)) ?></td>
                                <td nowrap>
                                    <?php if($data->status == 1){ ?>
                                    <button id="<?= $data->id.'~0' ?>" onclick="changeAdsStatus(this)" class="btn btn-danger">Remove
                                        from Live</button>
                                    <?php } else { ?>
                                    <button id="<?= $data->id.'~1' ?>" onclick="changeAdsStatus(this)"
                                        class="btn btn-info">Make Live</button>
                                    <?php } ?>

                                    <button onclick="removeAds(<?= $data->id ?>)"
                                        class="btn btn-warning">Delete</button>
                                </td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function removeAds(x) {
    let result = confirm('Are you sure you want to delete this ads.')

    if (result) {
        $.ajax({
            url: '<?php echo base_url('tiesup/remove_tieup') ?>',
            data: 'id=' + x,
            method: 'POST',

            success: function(data) {
                if (data == 1) {
                    alert('Tiesup removed successfully.')
                    location.reload()
                } else {
                    alert('Something went wrong. Please try again.')
                }
            }
        })
    }
}

function changeAdsStatus(x){
    let result = confirm('Are you sure you want to change this ads status.')

    if (result) {
        let d = x.id.split('~')
        $.ajax({
            url: '<?php echo base_url('tiesup/change_tiesup_status') ?>',
            data: {
                id : d[0],
                status : d[1]
            },
            method: 'POST',

            success: function(data) {
                if (data == 1) {
                    alert('Tiesup status changed successfully.')
                    location.reload()
                } else {
                    alert('Something went wrong. Please try again.')
                }
            }
        })
    }
}
</script>