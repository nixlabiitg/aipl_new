<div class="page-content bottom-content">
    <div class="container">
        <div class="col-sm mt-4">
        <?php
            $id = 0;
            foreach ($wallet as $wl) { 
                $sl = ++$id;                               
            ?>
            <div class="card payment-service">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title sub-title">Customer Id : <?= $wl['customer_id'] ?></h5>
                    <div class="active-style"></div>
                </div>
                <div class="card-body">
                    <ul class="card-list">
                        <li>
                            <div class="accordion style-2" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading1">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse<?= $sl ?>"
                                            aria-expanded="false" aria-controls="collapse<?= $sl ?>">
                                            <i class="fa-solid fa-user icon-bx me-2"></i>
                                            Name :
                                            <?= $wl['name'] ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $sl ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading1" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th>Amount</th>
                                                    <td>: &#8377;<?= $wl['amount'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Transfer Date</th>
                                                    <td>: <?= date('d M Y, h:i A', strtotime($wl['rqdate']))?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>