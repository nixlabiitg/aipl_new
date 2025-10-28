<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>

        <div class="col-12">
            <div class="card">
                <div class="card-header d-block">
                    <h5 class="card-title">Our Packages</h5>
                </div>
                <div class="card-body">
                    <div class="accordion style-3" id="accordionExample">
                        <?php $id=0; foreach($package as $pk) { $sl = ++$id;?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?= $sl ?>" aria-expanded="false"
                                    aria-controls="collapse<?= $sl ?>">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box me-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.929 1.628C20.8546 1.44247 20.7264 1.28347 20.5608 1.17153C20.3952 1.05959 20.1999 0.999847 20 1H4C3.80012 0.999847 3.60479 1.05959 3.43919 1.17153C3.2736 1.28347 3.14535 1.44247 3.071 1.628L1.071 6.628C1.02414 6.74643 1.00005 6.87264 1 7V22C1 22.2652 1.10536 22.5196 1.29289 22.7071C1.48043 22.8946 1.73478 23 2 23H22C22.2652 23 22.5196 22.8946 22.7071 22.7071C22.8946 22.5196 23 22.2652 23 22V7C23 6.87264 22.9759 6.74643 22.929 6.628L20.929 1.628ZM4.677 3H19.323L20.523 6H3.477L4.677 3ZM3 21V8H21V21H3Z"
                                                    fill="#FFA902"></path>
                                                <path
                                                    d="M10 17H6C5.73478 17 5.48043 17.1054 5.29289 17.2929C5.10536 17.4804 5 17.7348 5 18C5 18.2652 5.10536 18.5196 5.29289 18.7071C5.48043 18.8947 5.73478 19 6 19H10C10.2652 19 10.5196 18.8947 10.7071 18.7071C10.8946 18.5196 11 18.2652 11 18C11 17.7348 10.8946 17.4804 10.7071 17.2929C10.5196 17.1054 10.2652 17 10 17Z"
                                                    fill="#FFA902"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="sub-title"><?= $pk['package_name'] ?></h6>
                                            <ul class="item-status d-flex align-items-center">
                                                <li class="me-2 text-soft">Package Amount (₹) :
                                                    <?= $pk['package_amount'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $sl ?>" class="accordion-collapse collapse" aria-labelledby="heading1"
                                data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body pb-0">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Digital Wallet (₹)</th>
                                                <td><?=$pk['digital_wallet_value'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Shopping Coupon Amount (₹)</th>

                                                <td><?=$pk['shopping_coupon_value'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>No of coupons (nos)</th>
                                                <td><?=$pk['no_of_coupon'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic Shopping Point</th>
                                                <td><?=$pk['magic_shopping_points'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gift Product (₹)</th>
                                                <td><?=$pk['gift_product_amount'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Direct IPP Sponsor Amount (₹)</th>
                                                <td><?=$pk['direct_ipp_amount'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Registration Point</th>
                                                <td><?=$pk['registration_point'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Refer Point</th>
                                                <td><?=$pk['reffer_point'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level1</th>
                                                <td><?=$pk['magic_ipp_for_level_1'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level2</th>
                                                <td><?=$pk['magic_ipp_for_level_2'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level3</th>
                                                <td><?=$pk['magic_ipp_for_level_3'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level4</th>
                                                <td><?=$pk['magic_ipp_for_level_4'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level5</th>
                                                <td><?=$pk['magic_ipp_for_level_5'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level6</th>
                                                <td><?=$pk['magic_ipp_for_level_6'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level7</th>
                                                <td><?=$pk['magic_ipp_for_level_7'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level8</th>
                                                <td><?=$pk['magic_ipp_for_level_8'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level9</th>
                                                <td><?=$pk['magic_ipp_for_level_9'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Magic IPP for level10</th>
                                                <td><?=$pk['magic_ipp_for_level_10'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Allow in Autopool</th>
                                                <td><?=($pk['autopool_allow']==1?"Yes":"No") ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>