<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Income Statement</h3>
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

    <!-- end:: Content Head -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid " id="kt_content">



        <div class="col-lg-12">
            <form action="<?=base_url('report/income_statement')?>" method="POST">
                <div class="row">

                    <div class="col-lg-3">
                        <label for="">Customer Id</label>
                        <input type="text" name="cid" id="cid" class="form-control" value="<?=$cid?>">

                    </div>

                    <div class="col-lg-3">
                        <label for="">Form</label>
                        <input type="date" id="from" name="from" class="form-control" value="<?=$dtf?>" required>
                    </div>
                    <div class="col-lg-3">
                        <label for="">To</label>
                        <input type="date" id="to" name="to" class="form-control" value="<?=$dtt?>" required>
                    </div>

                    <div class="col-lg-3 mt-4">
                        <button type="submit" class="btn btn-success mt-2">Display</button>
                    </div>
                    <input hidden type="text" id="incomeid" name="incomeid" value="<?=$incomeid?>">

                    <input hidden type="text" id="pagename" name="pagename" value="<?=$page_name?>">
            </form>
        </div>
        <?php 
            $df=explode("-",$dtf);
            $dtfrom=$df[2]."/".$df[1]."/".$df[0];
            $dt=explode("-",$dtt);
            $dtto=$dt[2]."/".$dt[1]."/".$dt[0];
            ?>
            <div class="row" >
                
                <!-- <div class="col-lg-11 mb-3" > -->
                <div class="card col-lg-11 mb-3 border-1" id="acd">
                     <div class="row  mt-3 mb-3">
                    
                   
                        <img class="ml-5" src="<?=base_url('../portal_assets/images/logo.png')?>" alt="" style="width:100px;height:100px;">
                   
                    <div style="width:80%;text-align:center;margin-left:-40px;">
                        <h3>ACEAWS INDIA PVT. LTD.</h3><h5>Income Statement</h5><h6 style="text-decoration:underline"> <?=$dtfrom?> - <?=$dtto?> </h6 ><h4 class="text-uppercase"><?=$club?></h4>
   
                    </div>
                    

                </div>
                <div class="card shadow-sm border-1 table-responsive">


                    <table class="table table-striped">
                        <thead>

                            <!-- <tr >
                                    <th class="text-center" colspan="3"><img src="<?=base_url('../portal_assets/images/logo.png')?>" alt="" style="width:100px;height:100px;"><h3>ACEAWS INDIA PVT. LTD.</h3><h5>Income Statement</h5><h6 style="text-decoration:underline"> <?=$dtfrom?> - <?=$dtto?> </h6 ><h4 class="text-uppercase"><?=$club?></h4></th>
                                </tr> -->
                            <tr <?=($cname?"":"hidden")?>>

                                <th colspan="2"><?=($cname?"Name : ".$cname:"")?></th>
                                <th class="text-right"><?=($cname?"Customer Id : ".$custid:"")?></th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Income</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                                foreach($income as $in)
                                {
                                    $total+=$in['income'];
                                ?>
                            <tr>
                                <td class="text-center"><?=++$i?></td>
                                <td><?=$in['income_name']?></td>
                                <td class="text-right">&#8377;<?=number_format($in['income'],2)?></td>
                            </tr>

                            <?php } ?>
                            <tr>
                                <td class="text-center"></td>
                                <td>Total</td>
                                <td class="text-right">&#8377;<?=number_format($total,2)?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-11 text-right">
                <button class="btn btn-primary" onclick="printDiv();"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
function printDiv() {
    var printContents = $("#acd").html();
    var bgclr = document.body.style.backgroundColor;
    document.body.style.backgroundColor = "white";

    document.body.innerHTML = printContents;
    window.print();
    window.location.reload();

}
</script>