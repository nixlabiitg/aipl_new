<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>
        <form action="<?=base_url('report/filterincome')?>" method="POST">
            <div class="row mb-4">
                <div class="col-6">
                    <label for="">Form</label>
                    <input type="date" id="from" name="from" class="form-control" value="<?=$from?>" required>
                </div>
                <div class="col-6">
                    <label for="">To</label>
                    <input type="date" id="to" name="to" class="form-control" value="<?=$to?>" required>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-success w-100 mt-2">Display</button>
                </div>
                <input hidden type="text" id="incomeid" name="incomeid" value="<?=$incomeid?>">

                <input hidden type="text" id="pagename" name="pagename" value="<?=$page_name?>">
        </form>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="table-responsive">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Package</th>
                            <th>Income</th>
                            <th>Credit Date</th>
                            <th>Remarks</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0;
                          
                            foreach($income as $ar)
                             {?>
                        <tr>
                            <td><?= ++$id; ?></td>
                            <td><?=$ar['customer_id']?></td>
                            <td><?=$ar['name']?></td>
                            <td><?=$ar['package_name']?></td>
                            <td class="text-right">&#8377;<?=$ar['credit']?></td>
                            <td><?=$ar['dt']?></td>
                            <td><?=$ar['remarks']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- profile Modal -->
<div class="modal fade" id="profileImage" tabindex="-1" role="dialog" aria-labelledby="profileImageTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('staff/uploadProfileImage') ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="profile" id="" class="form-control">
                        <input type="hidden" id="staffid" name="staffid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Staff Modal -->
<div class="modal fade" id="editStaff" tabindex="-1" role="dialog" aria-labelledby="editStaffTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Staff Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="kt-form" method="post" action="<?php echo site_url('staff/editStaff/'); ?>"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="name"
                                        id="name" required>
                                    <input type="hidden" id="userid" name="userid">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select name="designation" id="designation" class="form-control">
                                        <option value="TC">Telecaller</option>
                                        <option value="ME">Marketing Executive</option>
                                        <option value="OE">Office Executive</option>
                                        <option value="TE">Technician</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="text" pattern="[0-9]{10}" maxlength="10" minlength="10"
                                        class="form-control" id="phone" placeholder="Enter phone no" name="phone"
                                        id="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" placeholder="Enter email id" id="email"
                                        name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="editStaff" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).on('click', '.edit', function(e) {
    $('#name').val($(this).data('name'));
    $('#userid').val($(this).data('id'));
    $('#phone').val($(this).data('phone'));
    $('#email').val($(this).data('email'));
    $('#designation').val($(this).data('designation'));
})
</script>

<script>
$(document).on('click', '.profileimage', function(e) {
    $('#staffid').val($(this).data('id'));
})
</script>