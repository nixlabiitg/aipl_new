
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
                            <tr>
                                <th>#</th>                               
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th class="text-right">Total Member Benefit</th>
                                <th>MRL Achieve On</th>
                                <th>Collection</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id = 0;
                                foreach($HOLDERS as $ar){
                                    $total+=$ar['nominee_benefit'];
                            ?>
                            <tr>
                                <td><?= ++$id; ?></td>                                
                                <td><?= $ar['customer_id']; ?></td>
                                <td><?= $ar['name']; ?></td>
                                <td class="text-right">&#8377;<?= number_format($ar['nominee_benefit'],2); ?></td>
                                <td class="text-center"><?= date('d-m-Y', strtotime($ar['mrl_achieve_on'])); ?></td>
                                <td>
                                    <button id="<?= $ar['customer_id']; ?>" onclick="viewCollection(this.id)" class="btn btn-info">View Collections</button>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total :</th>
                                <th class="text-right">&#8377;<?= number_format($total,2) ?></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentList" tabindex="-1" aria-labelledby="paymentListLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentListLabel">Collection List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 500px; overflow-y: scroll;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td class="text-center">Sl No.</td>
                        <td class="text-right">Amount</td>
                        <td class="text-center">Added On</td>
                    </tr>
                </thead>
                <tbody id="list-row">
                    
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    viewCollection = function(x){
        $.ajax({
            url : '<?php echo site_url('report/collection_list') ?>',
            method : 'POST',
            data : {
                customerId : x
            },
            success:function(data){
                $('#list-row').html(data)
                $('#paymentList').modal('show')
            }
        })
        
    }
</script>