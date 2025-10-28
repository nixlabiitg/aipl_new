<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <?php $this->load->view('messages'); ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <!--begin::Form-->
        <form class="kt-form" id="addproduct" action="<?php echo base_url('tiesup/add_download') ?>" method="post"
            autocomplete="off" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                <h3>Downloads</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Download Type</label>
                            <select name="download_type" id="download_type" class="form-control" required>
                                <option value="joining_form">Joining Form</option>
                                <option value="price_list">Product Price List</option>
                                <option value="training_list">Training List</option>
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

                <div class="col-lg-12">
                    <div class="table-wrap">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th class="text-left">Download Type</th>
                                    <th>File</th>
                                    <th>Added On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 0; foreach($DOWNLOADS as $data){ ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td>
                                        <?php if($data->download_type == 'joining_form'){ ?>
                                            Joining Form
                                        <?php }else if($data->download_type == 'price_list'){ ?>
                                            Product Price List
                                        <?php }else if($data->download_type == 'training_list'){ ?>
                                            Training List
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><a href="<?= base_url('../uploads/tiesup/'.$data->download_file) ?>" target="_blank"><u>file</u></a></td>
                                    <td class="text-center"><?= date('d M Y', strtotime($data->added_on)) ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>