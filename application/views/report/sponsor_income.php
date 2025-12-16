<div class="col-lg-12">

<form method="POST">
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

<div id="printArea">

<div class="text-center mb-4">
    <img src="<?=base_url('portal_assets/images/logo.png')?>" width="100">
    <h3>ACEAWS INDIA PVT. LTD.</h3>
    <h5>Sponsor Income Statement</h5>
    <h6><?=date("d-m-Y", strtotime($from))?> to <?=date("d-m-Y", strtotime($to))?></h6>
    <hr>
</div>

<table class="table table-bordered table-striped">
<thead class="bg-success text-light">
<tr>
    <th>#</th>
    <th>Member ID</th>
    <th>Name</th>
    <th>Date</th>
    <th class="text-right">Amount</th>
</tr>
</thead>
<tbody>
<?php $i=1; $total=0; foreach($list as $row): $total+=$row['credit']; ?>
<tr>
    <td><?=$i++?></td>
    <td><?=$row['member_id']?></td>
    <td><?=$row['member_name']?></td>
    <td><?=date('d-m-Y', strtotime($row['vc_date']))?></td>
    <td class="text-right">₹<?=number_format($row['credit'],2)?></td>
</tr>
<?php endforeach; ?>
<tr class="font-weight-bold">
    <td colspan="4">Total</td>
    <td class="text-right">₹<?=number_format($total,2)?></td>
</tr>
</tbody>
</table>

</div>

<?=$pagination?>

</div>

<script>
function printDiv(){
    var c=document.getElementById("printArea").innerHTML;
    document.body.innerHTML=c;
    window.print();
    location.reload();
}
</script>
