<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
      <!-- begin:: Content Head -->
      <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$status==1?"ACTIVE ":"BLOCKED "?>PACKAGE</h3>
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
                                <th>Package Name</th>
                                <th>Package Amount (₹)</th>
                                <th>Digital Wallet (₹)</th>
                                <th>Shopping Coupon Amount (₹)</th>
                                <th>No of coupons (nos)</th>
                                <th>Magic Shopping Point</th>
                                <th>Gift Product (₹)</th>
                                <th>Direct IPP Sponsor Amount (₹)</th>
                                <th>Registration Point</th>
                                <th>Refer Point</th>
                                <th>Magic IPP for level1</th>
                                <th>Magic IPP for level2</th>
                                <th>Magic IPP for level3</th>
                                <th>Magic IPP for level4</th>
                                <th>Magic IPP for level5</th>
                                <th>Magic IPP for level6</th>
                                <th>Magic IPP for level7</th>
                                <th>Magic IPP for level8</th>
                                <th>Magic IPP for level9</th>
                                <th>Magic IPP for level10</th>
                                <th>Allow in Autopool</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id=0;foreach($package as $pk) { $id++;?>
                                <tr>
                                <td><?=$id ?></td>
                                <td><?=$pk['package_name'] ?></td>
                                <td><?=$pk['package_amount'] ?></td>
                                <td><?=$pk['digital_wallet_value'] ?></td>
                                <td><?=$pk['shopping_coupon_value'] ?></td>
                                <td><?=$pk['no_of_coupon'] ?></td>
                                <td><?=$pk['magic_shopping_points'] ?></td>
                                <td><?=$pk['gift_product_amount'] ?></td>
                                <td><?=$pk['direct_ipp_amount'] ?></td>
                                <td><?=$pk['registration_point'] ?></td>
                                <td><?=$pk['reffer_point'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_1'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_2'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_3'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_4'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_5'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_6'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_7'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_8'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_9'] ?></td>
                                <td><?=$pk['magic_ipp_for_level_10'] ?></td>
                                <td><?=($pk['autopool_allow']==1?"Yes":"No") ?></td>
                                
                            </tr>
                                <?php } ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="row px-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Package Name</label>
                <input type="text" class="form-control"  id="packagename">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Package Amount (&#8377;)</label>
                <input type="number" class="form-control"  id="p_amount">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Digital Wallet (&#8377;)</label>
                <input type="number" class="form-control"  id="dwallet">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Shopping Coupon Amount (&#8377;)</label>
                                <input type="number" class="form-control"  id="quopon">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">No of coupons (nos)</label>
                <input type="number" class="form-control"  id="noquopon">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Magic Shopping Point</label>
                <input type="number" class="form-control"  id="magicpoint">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Gift Product (&#8377;)</label>
                            <input type="number" class="form-control"  id="giftamt">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Direct IPP Sponsor Amount (&#8377;)</label>
                             <input type="number" class="form-control"  id="sponsoramt">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Registration Point</label>
                <input type="number" class="form-control"  id="regpoint">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Refer Point</label>
                             <input type="number" class="form-control"  id="refpoint">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                            <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="autopool" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Allow in Autopool
                    </label>
                    </div>     </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>