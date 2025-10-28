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
                                <th>Direct Point Bonus</th>
                                <th>Special Generation Income for level1</th>
                                <th>Special Generation Income for level2</th>
                                <th>Special Generation Income for level3</th>
                                <th>Special Generation Income for level4</th>
                                <th>Special Generation Income for level5</th>
                                <th>Special Generation Income for level6</th>
                                <th>Special Generation Income for level7</th>
                                <th>Special Generation Income for level8</th>
                                <th>Special Generation Income for level9</th>
                                <th>Special Generation Income for level10</th>
                              
                                <th>Level Upgrade Incentive for level1</th>
                                <th>Level Upgrade Incentive for level2</th>
                                <th>Level Upgrade Incentive for level3</th>
                                <th>Level Upgrade Incentive for level4</th>
                                <th>Level Upgrade Incentive for level5</th>
                                <th>Level Upgrade Incentive for level6</th>
                                <th>Level Upgrade Incentive for level7</th>
                                <th>Level Upgrade Incentive for level8</th>
                                <th>Level Upgrade Incentive for level9</th>
                                <th>Level Upgrade Incentive for level10</th>
                                <th>Booster Income</th>
                                <th>Fastrack Income</th>
                                <th>Fastrack Duration (months)</th>
                                <th>Benefit B 1 Y</th>
                                <th>Benefit B 2 Y</th>
                                <th>Benefit B 3 Y</th>
                                <th>Benefit B 4 Y</th>
                                <th>Benefit B 5 Y</th>

                                <th>Allow in Autopool</th>
                                <th>Club Achieve</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id=0;foreach($package as $pk) { $id++;
                                $edit=$pk['package_id']."~".$pk['package_name']."~".$pk['package_amount']."~".$pk['digital_wallet_value']."~".$pk['shopping_coupon_value'].
                                        "~".$pk['no_of_coupon']."~".$pk['magic_shopping_points']."~".$pk['gift_product_amount']."~".$pk['direct_ipp_amount'].
                                        "~".$pk['registration_point']."~".$pk['reffer_point']."~".$pk['magic_ipp_for_level_2']."~".$pk['magic_ipp_for_level_3_to_10'].
                                        "~".$pk['autopool_allow']."~".$pk['magic_ipp_for_level_1']."~".$pk['magic_ipp_for_level_2']."~".$pk['magic_ipp_for_level_3']."~".$pk['magic_ipp_for_level_4']."~".$pk['magic_ipp_for_level_5']."~".$pk['magic_ipp_for_level_6']."~".$pk['magic_ipp_for_level_7']."~".$pk['magic_ipp_for_level_8']."~".$pk['magic_ipp_for_level_9']."~".$pk['magic_ipp_for_level_10']."~".$pk['club_achieve'].
                                        "~".$pk['level_upgrade_incentive_level_1']."~".$pk['level_upgrade_incentive_level_2']."~".$pk['level_upgrade_incentive_level_3']."~".$pk['level_upgrade_incentive_level_4']."~".$pk['level_upgrade_incentive_level_5']."~".$pk['level_upgrade_incentive_level_6']."~".$pk['level_upgrade_incentive_level_7']."~".$pk['level_upgrade_incentive_level_8']."~".$pk['level_upgrade_incentive_level_9']."~".$pk['level_upgrade_incentive_level_10']."~".$pk['booster_income']."~".$pk['direct_point_bonus']."~".$pk['fasttrack_income']."~".$pk['fasttrack_duration'].
                                        "~".$pk['benefit_b_first_year']."~".$pk['benefit_b_second_year']."~".$pk['benefit_b_third_year']."~".$pk['benefit_b_fourth_year']."~".$pk['benefit_b_fifth_year'];
                                ?>
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
                                <td><?=$pk['direct_point_bonus'] ?></td>

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

                                <td><?=$pk['level_upgrade_incentive_level_1'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_2'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_3'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_4'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_5'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_6'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_7'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_8'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_9'] ?></td>
                                <td><?=$pk['level_upgrade_incentive_level_10'] ?></td>
                                <td><?=$pk['booster_income'] ?></td>
                                <td><?=$pk['fasttrack_income'] ?></td>

                                <td><?=$pk['fastrack_duration'] ?></td>
                                <td><?=$pk['benefit_b_first_year'] ?></td>
                                <td><?=$pk['benefit_b_second_year'] ?></td>
                                <td><?=$pk['benefit_b_third_year'] ?></td>
                                <td><?=$pk['benefit_b_fourth_year'] ?></td>
                                <td><?=$pk['benefit_b_fifth_year'] ?></td>



                                <td><?=($pk['autopool_allow']==1?"Yes":"No") ?></td>
                                <td><?=($pk['club_achieve']==1?"Yes":"No") ?></td>

                                <td><?=($pk['status']==1?"<span class='badge badge-success w-100'>Active</span>":"<span class='badge badge-danger w-100'>Inactive</span>") ?></td>
                                <td>
                                    <?php if($pk["status"]==1) { ?>
                                        <button class="btn btn-sm btn-success w-100 mb-3" id="<?=$edit;?>"
                                        onclick="edit_package(this)" >Edit</button>
                                        <button class="btn btn-sm btn-danger w-100" id="<?=$pk['package_id']?>" onclick="block_unblock(this,2)">Block</button>
                                <?php } else { ?>
                                <button class="btn btn-sm btn-success w-100" id="<?=$pk['package_id']?>" onclick="block_unblock(this,1)" >Unblock</button>
                                <?php } ?>
                                </td>
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
                <h5 class="modal-title" id="editModalLabel">Edit Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
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
                <input type="number" min=0  class="form-control"  id="p_amount">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Digital Wallet (&#8377;)</label>
                <input type="number" min=0  class="form-control"  id="dwallet">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Shopping Coupon Amount (&#8377;)</label>
                                <input type="number" min=0  class="form-control"  id="quopon">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">No of coupons (nos)</label>
                <input type="number" min=0  class="form-control"  id="noquopon">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Magic Shopping Point</label>
                <input type="number" min=0  class="form-control"  id="magicpoint">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Gift Product (&#8377;)</label>
                            <input type="number" min=0  class="form-control"  id="giftamt">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="">Direct IPP Sponsor Amount (&#8377;)</label>
                             <input type="number" min=0  class="form-control"  id="sponsoramt">
                            </div>
                        </div>
                        <div hidden class="col-lg-6">
                            <div class="form-group">
                            <label for="">Registration Point</label>
                <input type="number" min=0  class="form-control"  id="regpoint">
                            </div>
                        </div>
                        <div hidden class="col-lg-6">
                            <div class="form-group">
                            <label for="">Refer Point</label>
                             <input type="number" min=0  class="form-control"  id="refpoint">
                            </div>
                        </div>
                        <div  class="col-lg-6">
                            <div class="form-group">
                            <label for="">Direct Point Bonus</label>
                            <input type="number" min=0  class="form-control"  id="directpoint">
                            </div>
                        </div>
                        <fieldset class="form-group border p-3 mt-3">

<legend class="w-auto px-2 text-left">SPECIAL GENERATION INCOME (Magic IPP)</legend>
<div class="row">
<div class="col-lg-3 mt-2">
        <label for="">Level 1 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level1">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Level 2 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level2">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 3 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level3">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 4 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level4">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 5 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level5">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 6 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level6">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 7 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level7">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 8 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level8">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 9 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level9">

    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Llevel 10 ( &#8377; )</label>
        <input type="number" min=0  class="form-control"  id="level10">
    </div>


</div>

    
</fieldset>

<fieldset class="form-group border p-3 mt-3">

<legend class="w-auto px-2 text-left">LEVEL UPGRADE INCENTIVE</legend>
<div class="row">
         <div class="col-lg-3 mt-2">
            <label for="">Level 1 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel1">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Level 2 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel2">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 3 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel3">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 4 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel4">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 5 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel5">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 6 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel6">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 7 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel7">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 8 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel8">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 9 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel9">

        </div>
        <div class="col-lg-3 mt-2">
            <label for="">Llevel 10 ( &#8377; )</label>
            <input type="number" min=0  class="form-control"  id="inclevel10">
        </div>


    </div>

    
</fieldset> 

                    <div class="col-lg-3 mb-3">                          
                                <label for="">Booster Income ( &#8377; )</label>
                                <input type="number" min=0  class="form-control"  id="boosterIncome">
                    </div>
                    <div class="col-lg-3 mt-2">
                        <label for="">Fast Track Income ( &#8377; )</label>
                        <input type="number" min=0  class="form-control"  id="fastrackIncome">
                    </div>
                    <div class="col-lg-6 mt-2">
                        <label for="">Fastrack Income Duration ( months )</label>
                        <input type="number" min=0 class="form-control w-25"  id="fastrackDuration">
                    </div>
                   
  
                    <fieldset class="form-group border p-3 mt-3">

<legend class="w-auto px-2 text-left">FAST TRACK BENEFIT B</legend>
<div class="row">
<div class="col-lg-2 mt-2">
        <label for="">1 Year ( % )</label>
        <input type="number" class="form-control"  id="f1y">

    </div>
    <div class="col-lg-2 mt-2">
        <label for="">2 Year( % )</label>
        <input type="number" class="form-control"  id="f2y">

    </div>
    <div class="col-lg-2 mt-2">
        <label for="">3 Year ( % )</label>
        <input type="number" class="form-control"  id="f3y">

    </div>
    <div class="col-lg-2 mt-2">
        <label for="">4 Year ( % )</label>
        <input type="number" class="form-control"  id="f4y">

    </div>
    <div class="col-lg-2 mt-2">
        <label for="">5 year ( % )</label>
        <input type="number" class="form-control"  id="f5y">
    </div>
    


</div>

    
</fieldset>   

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="autopool" >
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Allow in Autopool
                                        </label>
                                </div>     
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="clubachieve" >
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Club Achieve
                                        </label>
                                </div>     
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="update_package()" >Save changes</button>
                </div>
           <input type="text" hidden id="packageId">
        </div>
    </div>
</div>

<script>
    function edit_package(x)
    {
        var p=x.id.split("~");
        $("#packageId").val(p[0]);
        $("#packagename").val(p[1]);
        $("#p_amount").val(p[2]);
        $("#dwallet").val(p[3]);
        $("#quopon").val(p[4]);
        $("#noquopon").val(p[5]);
        $("#magicpoint").val(p[6]);
        $("#giftamt").val(p[7]);
        $("#sponsoramt").val(p[8]);
        $("#regpoint").val(p[9]);
        $("#refpoint").val(p[10]);
        $("#magicipp").val(p[11]);
        $("#magicipp3to10").val(p[12]);
        $("#autopool").prop('checked',(p[13]==1?true:false));
        $("#level1").val(p[14]);
        $("#level2").val(p[15]);
        $("#level3").val(p[16]);
        $("#level4").val(p[17]);
        $("#level5").val(p[18]);
        $("#level6").val(p[19]);
        $("#level7").val(p[20]);
        $("#level8").val(p[21]);
        $("#level9").val(p[22]);
        $("#level10").val(p[23]);        
        $("#clubachieve").prop('checked',(p[24]==1?true:false));

        $("#inclevel1").val(p[25]);
        $("#inclevel2").val(p[26]);
        $("#inclevel3").val(p[27]);
        $("#inclevel4").val(p[28]);
        $("#inclevel5").val(p[29]);
        $("#inclevel6").val(p[30]);
        $("#inclevel7").val(p[31]);
        $("#inclevel8").val(p[32]);
        $("#inclevel9").val(p[33]);
        $("#inclevel10").val(p[34]);      
        $("#boosterIncome").val(p[35]);      
        $("#directpoint").val(p[36]);
        $("#fastrackIncome").val(p[37]);
        $("#fastrackDuration").val(p[38]);

        $("#f1y").val(p[39]);
        $("#f2y").val(p[40]);
        $("#f3y").val(p[41]);
        $("#f4y").val(p[42]);
        $("#f5y").val(p[43]);

        $("#editModal").modal("show");      
    }

    update_package=function()
    {
        var d={
        "packageId":$("#packageId").val(),
        "packagename":$("#packagename").val(),
        "dwallet":$("#dwallet").val(),
        "p_amount":$("#p_amount").val(),
        "quopon":$("#quopon").val(),
        "noquopon":$("#noquopon").val(),
        "magicpoint":$("#magicpoint").val(),
        "giftamt":$("#giftamt").val(),
        "sponsoramt":$("#sponsoramt").val(),
        "regpoint":$("#regpoint").val(),
        "refpoint":$("#refpoint").val(),
        "directpoint":$("#directpoint").val(),
        "level1":$("#level1").val(),
        "level2":$("#level2").val(),
        "level3":$("#level3").val(),
        "level4":$("#level4").val(),
        "level5":$("#level5").val(),
        "level6":$("#level6").val(),
        "level7":$("#level7").val(),
        "level8":$("#level8").val(),
        "level9":$("#level9").val(),
        "level10":$("#level10").val(),

        "inclevel1":$("#inclevel1").val(),
        "inclevel2":$("#inclevel2").val(),
        "inclevel3":$("#inclevel3").val(),
        "inclevel4":$("#inclevel4").val(),
        "inclevel5":$("#inclevel5").val(),
        "inclevel6":$("#inclevel6").val(),
        "inclevel7":$("#inclevel7").val(),
        "inclevel8":$("#inclevel8").val(),
        "inclevel9":$("#inclevel9").val(),
        "inclevel10":$("#inclevel10").val(),
        "boosterIncome":$("#boosterIncome").val(),  
        "fastrackIncome":$("#fastrackIncome").val(),   
        "f1y":$("#f1y").val(),
        "f2y":$("#f2y").val(),
        "f3y":$("#f3y").val(),
        "f4y":$("#f4y").val(),
        "f5y":$("#f5y").val(),
   
        "fastrackDuration":$("#fastrackDuration").val(),          
        "autopool":($("#autopool").is(":checked")?1:0),
        "clubachieve":($("#clubachieve").is(":checked")?1:0)
        }
       
        $.ajax({
            url:"<?=base_url('package/edit_package')?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
                
                alert("Package updated successfully.")
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }
        })
    }



    block_unblock=function(x,s)
    {
        var d={
            "packageId":x.id,
            "status":s      
        }
       
        $.ajax({
            url:"<?=base_url('package/block_unblock')?>",
            type:"POST",
            dataType:"TEXT",
            data:d,
            success:function(data)
            {
                
                alert("Package "+(s==2?"blocked":"Unblocked")+" successfully.");
                window.location.reload();
            },
            error:function(data)
            {
                alert(data);
            }
        })
    }
</script>