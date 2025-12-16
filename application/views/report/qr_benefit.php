<div class="col-lg-12">

<div class="text-center mb-4">
    <img src="<?=base_url('portal_assets/images/logo.png')?>" width="100">
    <h3>ACEAWS INDIA PVT. LTD.</h3>
    <h5>QR Benefit Statement</h5>
    <hr>
</div>

<table class="table table-bordered table-striped">
<thead class="bg-success text-light">
<tr>
    <th>#</th>
    <th>Date</th>
    <th>Description</th>
    <th class="text-right">Amount</th>
</tr>
</thead>
<tbody>
<?php $i=1; $total=0; foreach($list as $row): $total+=$row['credit']; ?>
<tr>
    <td><?=$i++?></td>
    <td><?=date('d-m-Y', strtotime($row['vc_date']))?></td>
    <td><?=$row['remarks']?></td>
    <td class="text-right">₹<?=number_format($row['credit'],2)?></td>
</tr>
<?php endforeach; ?>
<tr class="font-weight-bold">
    <td colspan="3">Total</td>
    <td class="text-right">₹<?=number_format($total,2)?></td>
</tr>
</tbody>
</table>

<?=$pagination?>

</div>
