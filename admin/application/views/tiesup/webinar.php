<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <div class="kt-portlet__body">
            <h3>Webinar</h3>
            <hr>
            <form class="kt-form" id="addproduct" action="<?php echo base_url('tiesup/add_webinar') ?>" method="post"
                autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Webinar Link</label>
                            <input type="text" name="webinar_link" class="form-control" placeholder="Enter link" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Webinar Date</label>
                            <input type="date" class="form-control" name="webinar_date" min="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Webinar Time</label>
                            <input type="time" class="form-control" name="webinar_time" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Webinar Note</label>
                            <textarea name="note" placeholder="Note" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 text-right">
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                            <button type="submit" name="addproduct" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-lg-12">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th class="text-left">Webninar Link</th>
                                <th>Webninar Date</th>
                                <th>Webninar Time</th>
                                <th class="text-left">Webinar Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($WEBINAR as $data){ ?>
                            <tr>
                                <td class="text-center"><?= ++$id ?></td>
                                <td><?= $data->webinar_link ?></td>
                                <td class="text-center"><?= date('d M Y', strtotime($data->webinar_date)) ?></td>
                                <td class="text-center"><?= date('h:i A', strtotime($data->webinar_time)) ?></td>
                                <td><?= $data->note ?></td>
                                <td class="text-center">
                                    <button type="button" onclick="removeWebinar('<?= $data->id ?>')" class="btn btn-danger">Remove</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Form-->
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    removeWebinar = function(x){
        let result = confirm('Are you sure you want to delete this webinar');

        if(result){
            $.ajax({
                url : '<?php echo base_url('tiesup/delete_webinar') ?>',
                method : 'POST',
                data : {
                    id : x
                },

                success:function(data){
                    if(data == 1){
                        location.reload()
                    }else{
                        alert('Something went wrong. Please try again.')
                    }
                }
            })
        }
    }
</script>