<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <h5 class="mb-3">Downline Member of <span class="text-danger"><?= $UPLINE ?></span></h5>
                <div class="col-12">
                    <?php
                    $id = 0;

                    foreach ($cust as $c) {
                    $sl = ++$id;
                ?>
                    <div class="card payment-service">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title sub-title">Customer ID : <?=$c['customer_id']?></h5>
                            <div class="active-style"></div>
                        </div>
                        <div class="card-body">
                            <ul class="card-list">
                                <li>
                                    <div class="accordion style-2" id="accordionExample<?= $sl ?>">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?= $sl ?>">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse<?= $sl ?>"
                                                    aria-expanded="false" aria-controls="collapse<?= $sl ?>">
                                                    <i class="fa-solid fa-user icon-bx me-2"></i>
                                                    <?= $c['name'] ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $sl ?>" class="accordion-collapse collapse"
                                                aria-labelledby="heading<?= $sl ?>"
                                                data-bs-parent="#accordionExample<?= $sl ?>" style="">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered table-striped">
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>: <?= $c['address']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact No</th>
                                                            <td>: <?= $c['mobile']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>: <?= $c['email']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sponsor Id</th>
                                                            <td>: <?=$c['sponsor_id']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Package</th>
                                                            <td>: <?= $c['package_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee/Relationship</th>
                                                            <td>: <?= $c['nominee']?>, <?= $c['relationship']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee Bank Account No</th>
                                                            <td>: <?= $c['nominee_bank_no']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee DOB</th>
                                                            <td>: <?= $c['nominee_dob']?></td>
                                                        </tr>
                                                        <?php if($status==1) { ?>
                                                        <tr>
                                                            <th>Approved Date</th>
                                                            <td>: <?= $c['rgdate']?></td>
                                                        </tr>
                                                        <?php } else {?>
                                                        <tr>
                                                            <th>Registration Date</th>
                                                            <td>: <?= date('d M Y, h:i A', strtotime($c['rgdate']))?>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <th>Downline List</th>
                                                            <td>: <button class="btn btn-success" id="<?= $c['customer_id'] ?>" onclick="viewDownline(this.id)">Downline</button></td>
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

                    <form hidden action="" id="downline_form" method="POST">
                        <input type="text" id="cust__id" name="cust__id">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
viewDownline = function(x) {
    let customerid = x;

    $('#cust__id').val(x);
    $('#downline_form').submit();
}
</script>