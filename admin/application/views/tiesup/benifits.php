<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <div class="kt-portlet__body">
            <h3>Benefits</h3>
            <hr>
            <form class="kt-form" id="addproduct" action="<?php echo base_url('tiesup/add_benefit') ?>" method="post"
                autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Benefit Category <a href="<?php echo base_url('tiesup/benefits_category') ?>"><u>Add
                                        New Category</u></a></label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="" selected disabled>Select an option</option>
                                <?php foreach($CATEGORY as $data){ ?>
                                <option value="<?= $data->id ?>"><?= $data->category ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Download File</label>
                            <input type="file" class="form-control" accept=".pdf" name="file_pdf" required>
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
                                <th class="text-left">Category</th>
                                <th>File</th>
                                <th>Added On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0; foreach($BENEFIT as $data){ ?>
                            <tr>
                                <td class="text-center"><?= ++$id ?></td>
                                <td><?= $data->category ?></td>
                                <td class="text-center"><a href="<?= base_url('../uploads/tiesup/'.$data->benifit_file) ?>" target="_blank">FILE</a></td>
                                <td class="text-center"><?= date('d M Y', strtotime($data->added_on)) ?></td>
                                <td class="text-center">
                                    <button type="button" onclick="removeBenifit('<?= $data->id ?>')" class="btn btn-danger">Remove</button>
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
    removeBenifit = function(x){
        let result = confirm('Are you sure you want to delete this benefit');

        if(result){
            $.ajax({
                url : '<?php echo base_url('tiesup/delete_benefit') ?>',
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