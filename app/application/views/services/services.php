<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <?php foreach($services as $services){ ?>
            <div class="col-12">
                <div class="card p-2">
                    <div class="swiper-btn-center-lr">
                        <div class="swiper tag-group recomand-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="card add-banner"
                                        style="background-image: url(<?php echo base_url('../uploads/service/'.$services['image_1']) ?>);">
                                    </div>
                                </div>
                                <?php if($services['image_2'] != ''){ ?>
                                <!-- Carousel item 1 end-->
                                <div class="swiper-slide">
                                    <div class="card add-banner"
                                        style="background-image: url(<?php echo base_url('../uploads/service/'.$services['image_2']) ?>);">
                                    </div>
                                </div>
                                <?php }else if($services['image_3'] != ''){ ?>
                                <!-- Carousel item 2 end-->
                                <div class="swiper-slide">
                                    <div class="card add-banner"
                                        style="background-image: url(<?php echo base_url('../uploads/service/'.$services['image_3']) ?>);">
                                    </div>
                                </div>
                                <?php }else if($services['image_4'] != ''){ ?>
                                <!-- Carousel item 3 end-->
                                <div class="swiper-slide">
                                    <div class="card add-banner"
                                        style="background-image: url(<?php echo base_url('../uploads/service/'.$services['image_4']) ?>);">
                                    </div>
                                </div>
                                <?php }else if($services['image_5'] != ''){ ?>
                                <!-- Carousel item 4 end -->
                                <div class="swiper-slide">
                                    <div class="card add-banner"
                                        style="background-image: url(<?php echo base_url('../uploads/service/'.$services['image_5']) ?>);">
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="dz-inner">
                        <div class="text-center">
                            <h3><?= $services['organization_name'] ?></h3>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Experience</th>
                                <td>: <?= $services['experience'] ?> years</td>
                            </tr>
                            <tr>
                                <th>Expertise</th>
                                <td>: <?= $services['expertise'] ?></td>
                            </tr>
                            <tr>
                                <th>Service Areas</th>
                                <td>: <?= $services['available_in'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><u>Description:</u><br /> <?= $services['service_description'] ?></td>
                            </tr>
                            <?php if($this->session->userdata('aiplAppId')) { ?>
                            <tr>
                                <th>Contact No</th>
                                <td>: <?= $services['phone'] ?> &nbsp;<a href="tel:<?= $services['phone'] ?>" class="text-info"><i class="fa fa-phone"></i> &nbsp;Call</a></td>
                            </tr>
                            <tr>
                                <td colspan="2"><u>Website :</u><br/> <?= $services['website'] ?> <a href="https://<?= $services['website'] ?>"
                                        target="_blank"><i class="fa fa-external-link text-secondary"></i></a></td>
                            </tr>
                            <tr>
                                <td colspan="2"><u>Mail Id :</u><br/> <?= $services['mail_id'] ?> <a href="mailto:<?= $services['mail_id'] ?>"
                                        target="_blank"><i class="fa fa-external-link text-secondary"></i></a></td>
                            </tr>
                            <tr>
                                <?php
                                                $countryId = $services['country'];
                                                $findCountry = $this->Crud->ciRead("countries", "`iso2` = '$countryId'")[0]->name;

                                                $stateId = $services['state'];
                                                $findState = $this->Crud->ciRead("states", "`id` = '$stateId'")[0]->name;

                                                $cityId = $services['city'];
                                                $findcity = $this->Crud->ciRead("cities", "`id` = '$cityId'")[0]->name;
                                            ?>
                                <td colspan="2"><u>Service Provider Location :</u> <br /> <span
                                        class="text-capitalize"><?= $services['address'] ?></span>, <b>City :</b>
                                    <?= $findcity ?>, <b>State :</b> <?= $findState ?>, <b>Country :</b>
                                    <?= $findCountry ?>, <b>PIN Code :</b> <?= $services['pin'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><u>Service Description :</u> <br /><?= $services['service_description'] ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>

<!-- Thumbs -->
<div class="modal fade" tabindex="-1" id="servicesModal" aria-labelledby="servicesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Call Service Provider</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <?php
                        $userid = $this->session->userdata("aiplAppId");
                        $phone_number = '7002779799';
                        $masked_number = substr_replace($phone_number, '*******', 2, 7);
                        if($userid == ''){
                    ?>
                    <span class="text-info"><small>Registered user can view phone no</small></span><br />
                    <h1><?= $masked_number ?></h1>
                    <?php } else{ ?>
                    <a href="tel:+917002779799" class="mb-2 me-2 btn btn-icon btn-phone"><i class="fa fa-phone"></i></a>
                    <span class="h1"><?= $phone_number ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>