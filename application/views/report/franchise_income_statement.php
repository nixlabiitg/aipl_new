<div class="col-lg-12">

    <!-- FILTER -->
    <form method="POST">
        <input type="hidden" name="filter" value="1">

        <div class="row mb-4">

            <div class="col-lg-3">
                <label>From</label>
                <input type="date" name="from" class="form-control" value="<?=$from?>">
            </div>

            <div class="col-lg-3">
                <label>To</label>
                <input type="date" name="to" class="form-control" value="<?=$to?>">
            </div>

            <div class="col-lg-3 mt-4">
                <button class="btn btn-success mt-2">Display</button>
            </div>

            <div class="col-lg-3 mt-4">
                <button type="button" onclick="printDiv()" class="btn btn-primary mt-2">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>

        </div>
    </form>

    <!-- PRINT AREA -->
    <div id="printArea">

        <div class="text-center mb-4">
            <img src="<?=base_url('portal_assets/images/logo.png')?>" width="100"><br>
            <h3>ACEAWS INDIA PVT. LTD.</h3>
            <h5>Franchise Income Statement</h5>
            <h6><?=date("d-m-Y", strtotime($from))?> to <?=date("d-m-Y", strtotime($to))?></h6>
            <hr>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="bg-success text-light">
                    <tr>
                        <th>#</th>
                        <th>Level</th>
                        <th>Franchise ID</th>
                        <th>Member Name</th>
                        <th>Mobile</th>
                        <th>Date</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $i = 1;
                    $total = 0;

                    if(!empty($income_list)):
                        foreach($income_list as $in):
                            $total += $in['credit'];
                    ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$in['level_no'] ?: '-'?></td>
                        <td><?=$in['franchise_id']?></td>
                        <td><?=$in['member_name']?></td>
                        <td><?=$in['member_mobile']?></td>
                        <td><?=date("d-m-Y H:i:s", strtotime($in['vc_date']))?></td>
                        <td class="text-right">₹<?=number_format($in['credit'], 2)?></td>
                    </tr>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="7" class="text-center text-danger">
                            No Income Records Found
                        </td>
                    </tr>
                    <?php endif; ?>

                    <tr class="bg-light font-weight-bold">
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">₹<?=number_format($total, 2)?></td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>

    <div class="mt-3">
        <?=$pagination?>
    </div>

</div>

<script>
function printDiv() {
    var printContents = document.getElementById("printArea").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>
