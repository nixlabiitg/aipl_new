
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
        <form action="<?=base_url('report/transaction_history_franchise')?>" method="POST">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="">Form</label>
                <input type="date" id="from" name="from" class="form-control" value="<?=$from?>" required>
            </div>
            <div class="col-lg-3">
                <label for="">To</label>
                <input type="date" id="to" name="to" class="form-control" value="<?=$to?>" required>
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
                                      <tr class="text-center">  
                                      <th>#</th>  
                                          <th>Franchise Id</th>                                                                          
                                          <th>Franchise Name</th>      
                                          <th>Voucher No</th>                                                                      
                                          <th>Date</th>                                                                          
                                          <th>Debit</th>
                                          <th>Credit</th>
                                          <th>Remarks</th>
                                                                     
                                          
                                        
                                              
                                      
                                      </tr>
                                  </thead>
                                  <tbody >
                                      <?php                                                                           
                                      $id = "0";
                                      foreach ($order as $product) {
                                  
                                      ?>
                                      <input hidden id="delid<?php echo $product['order_id']?>" value="<?= $product['delid']  ?>">
                                      <span hidden id="add<?php echo $product['order_id']?>"><p class="mb-0">Address 1 : <?= $product['address1'] ?></p><p class="mb-0">House No : <?= $product['house_no']  ?></p><p class="mb-0">Road Name : <?= $product['road_name']  ?></p><p class="mb-0">PIN : <?= $product['pin'] ?><p class="mb-0"> Contact No : <?= $product['contact_no']  ?></span>
                                      <tr>
                                          <td class="text-center">
                                              <?php echo ++$id ?>
                                          </td>
                                          <td class="text-center"><?= $product['franchise_id'] ?></td>
                                          <td class="text-center"><?= $product['name'] ?></td>
                                          <td class="text-center"><?= $product['vcid'] ?></td>
                                          <td class="text-center"><?= $product['dt'] ?></td>
                                      
                                          <td  class="text-right"><?= ($product['debit']!=0?"&#8377; ".number_format($product['debit'],2):"")   ?></td>
                                          <td  class="text-right"><?= ($product['credit']!=0?"&#8377; ".number_format($product['credit'],2):"")  ?></td>
                                         
                                          <td><?= $product['remarks']  ?></td>
                                        
                                          
                                         
                                      </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


