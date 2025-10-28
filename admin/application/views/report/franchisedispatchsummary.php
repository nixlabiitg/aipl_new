
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
        <form action="<?=base_url('report/franchise_dispatch_summary')?>" method="POST">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="">Franchise</label>
                <select name="fname" id="fname" class="form-control">
                    <option  value="">select</option>
                    <?php foreach($frn as $fr)
                    {?>
                    <option <?=($fr['franchise_id']==$fname?"selected":"")?> value="<?=$fr['franchise_id']?>"><?=$fr['name']?></option>
                <?php }?>
                    
                </select>
            </div>

            <div class="col-lg-3">
                <label for="">Form</label>
                <input type="date" id="from" name="from" class="form-control" value="<?=$dtf?>" required>
            </div>
            <div class="col-lg-3">
                <label for="">To</label>
                <input type="date" id="to" name="to" class="form-control" value="<?=$dtt?>" required>
            </div>

            <div class="col-lg-4 mt-4">
                <button type="submit" class="btn btn-success mt-2">Display</button>
            </div>
            <input hidden type="text" id="incomeid" name="incomeid"  value="<?=$incomeid?>">
            
            <input hidden type="text" id="pagename" name="pagename"  value="<?=$page_name?>">
            </form>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>                               
                                <th>Date</th>
                                <th>Product Name</th>
                                <th class="text-right">Quantity</th>
                                <th></th>
                                <th></th>
                                <th></th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = 0;
                          
                            foreach($income as $ar)
                             {?>
                            <tr>
                                <td><?= ++$id; ?></td>                                
                                <td><?=$ar['dt']?></td>
                                <td><?=$ar['product_name']?></td>
                              
                                <td class="text-right"><?=$ar['qty']?></td>
                                <td></td>
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