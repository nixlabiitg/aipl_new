<div class="container mt-4">

    <h3>Franchise Dashboard</h3>
    <hr>

    <div class="row">

        <div class="col-lg-3">
            <div class="card p-3 shadow-sm">
                <h5>Sponsor Income</h5>
                <h3>₹<?=number_format($SPONSOR_INCOME,2)?></h3>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 shadow-sm">
                <h5>Remuneration</h5>
                <h3>₹<?=number_format($REMUNERATION,2)?></h3>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 shadow-sm">
                <h5>Incentive</h5>
                <h3>₹<?=number_format($INCENTIVE,2)?></h3>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 shadow-sm">
                <h5>QR Benefit</h5>
                <h3>₹<?=number_format($QR_BENEFIT,2)?></h3>
            </div>
        </div>

    </div>

</div>
