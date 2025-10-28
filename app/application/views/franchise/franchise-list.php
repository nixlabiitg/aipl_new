<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="col-12">
                    <?php $id = 0; foreach($franchises as $data){
                        $sl = ++$id;    
                    ?>
                    <div class="card payment-service">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title sub-title">Franchise ID : <?= $data->franchise_id ?></h5>
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
                                                    <?= $data->name ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $sl ?>" class="accordion-collapse collapse"
                                                aria-labelledby="heading<?= $sl ?>"
                                                data-bs-parent="#accordionExample<?= $sl ?>" style="">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered table-striped">
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>: <?= $data->name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>: <?= $data->address ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact No</th>
                                                            <td>: <?= $data->mobile ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>: <?= $data->email ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Added On</th>
                                                            <td>:
                                                                <?= date('d-m-Y', strtotime($data->app_reject_date)) ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td>: <?php if($data->status == 0){ ?>
                                                                <span class="badge badge-warning">Pending</span>
                                                                <?php }else if($data->status == 1){ ?>
                                                                <span class="badge badge-success">Approved</span>
                                                                <?php }else if($data->status == 2){ ?>
                                                                <span class="badge badge-danger">Blocked</span>
                                                                <?php }else{ ?>
                                                                <span class="badge badge-danger">Rejected</span>
                                                                <?php } ?>
                                                            </td>
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
    </div>
</div>