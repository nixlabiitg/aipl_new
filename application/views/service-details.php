<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Service Details</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Service Details</a></li>
                    </ol>
                </div>
            </div>
            <!-- Col end-->
        </div>
        <!-- Row end-->
    </div>
    <!-- Container end-->
</div>
<!-- Banner area end-->

<section class="single-project" id="single-project">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="carousel slide " id="main-slide" data-ride="carousel">
                    <!-- Indicators-->
                    <ol class="carousel-indicators visible-lg visible-md">
                        <li class="active" data-target="#main-slide" data-slide-to="0"></li>
                        <li data-target="#main-slide" data-slide-to="1"></li>
                        <li data-target="#main-slide" data-slide-to="2"></li>
                    </ol>
                    <!-- Indicators end-->
                    <!-- Carousel inner-->
                    <div class="carousel-inner">
                        <div class="carousel-item active"
                            style="background-image:url(<?php echo base_url('uploads/service/'.$services[0]['image_1']) ?>);">
                        </div>
                        <?php if($services[0]['image_2'] != ''){ ?>
                        <!-- Carousel item 1 end-->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('uploads/service/'.$services[0]['image_2']) ?>);">
                        </div>
                        <?php }else if($services[0]['image_3'] != ''){ ?>
                        <!-- Carousel item 2 end-->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('uploads/service/'.$services[0]['image_3']) ?>);">
                        </div>
                        <?php }else if($services[0]['image_4'] != ''){ ?>
                        <!-- Carousel item 3 end-->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('uploads/service/'.$services[0]['image_4']) ?>);">
                        </div>
                        <?php }else if($services[0]['image_5'] != ''){ ?>
                        <!-- Carousel item 4 end -->
                        <div class="carousel-item"
                            style="background-image:url(<?php echo base_url('uploads/service/'.$services[0]['image_5']) ?>);">
                        </div>
                        <?php } ?>
                        <!-- Carousel item 5 end -->
                    </div>
                    <!-- Carousel inner end-->
                    <!-- Controllers-->
                    <a class="left carousel-control carousel-control-prev" href="#main-slide" data-slide="prev"><span><i
                                class="fa fa-angle-left"></i></span></a>
                    <a class="right carousel-control carousel-control-next" href="#main-slide" data-slide="next">
                        <span><i class="fa fa-angle-right"></i></span></a>
                </div>
                <!-- Carousel end-->
            </div>
            <!-- col end -->
            <div class="col-lg-5 mt-2">
                <div class="single-project-content">
                    <h2 class="text-capitalize"><?= $services[0]['organization_name'] ?></h2>
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Experience </b></td>
                                <td>: <?= $services[0]['experience'] ?> years</td>
                            </tr>
                            <tr>
                                <td><b>Expertise </b></td>
                                <td>: <?= $services[0]['expertise'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Service Areas </b></td>
                                <td>: <?= $services[0]['available_in'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if($this->session->userdata('aiplUserId')) { ?>
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Website </b></td>
                                    <td>: <?= $services[0]['website'] ?> <a href="https://<?= $services[0]['website'] ?>" target="_blank"><i class="fa fa-external-link text-secondary"></i></a></td>
                                </tr>
                                <tr>
                                    <td><b>Mail Id </b></td>
                                    <td>: <?= $services[0]['mail_id'] ?> <a href="mailto:<?= $services[0]['mail_id'] ?>" target="_blank"><i class="fa fa-external-link text-secondary"></i></a></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b><u>Service Provider Location :</u></b></td>
                                </tr>
                                <tr>
                                    <?php
                                        $countryId = $services[0]['country'];
                                        $findCountry = $this->Crud->ciRead("countries", "`iso2` = '$countryId'")[0]->name;

                                        $stateId = $services[0]['state'];
                                        $findState = $this->Crud->ciRead("states", "`id` = '$stateId'")[0]->name;

                                        $cityId = $services[0]['city'];
                                        $findcity = $this->Crud->ciRead("cities", "`id` = '$cityId'")[0]->name;
                                    ?>
                                    <td colspan="2"><span class="text-capitalize"><?= $services[0]['address'] ?></span>, <b>City :</b> <?= $findcity ?>, <b>State :</b> <?= $findState ?>, <b>Country :</b> <?= $findCountry ?>, <b>PIN Code :</b> <?= $services[0]['pin'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b><u>Service Description :</u></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?= $services[0]['service_description'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
                <?php if(!$this->session->userdata('aiplUserId')) { ?>
                <a href="<?php echo base_url('authentication/login') ?>" class="btn-block btn btn-outline-success p-2"><i class="icon icon-phone"></i> Call Now</a>
                <?php }else{ ?>
                <button id="<?= $services[0]['phone']."/".$services[0]['whatsapp']."/".$services[0]['service_code']."/".$services[0]['user_id'] ?>" onclick="showNumber(this)" class="btn-block btn btn-outline-success p-2"><i class="icon icon-phone"></i> Call Now</button>
                <?php } ?>

            </div>
            <!-- col end -->
        </div>
    </div>
    <!-- main container end -->
</section>

<!-- Modal -->
<div class="modal fade" id="phoneDisplay" tabindex="-1" role="dialog" aria-labelledby="phoneDisplayLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="phoneDisplayLabel">Service Partner Contact No</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h1 style="background-color : green; padding : 10px; color: #fff; border-radius : 10px;"><i class="fa fa-phone"></i> <span id="partnerPhn"></span></h1>
                    <h1 style="background-color : orange; padding : 10px; color: #fff; border-radius : 10px;"><i class="fa fa-whatsapp"></i> <span id="partnerWhatsapp"></span></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function showNumber(x){
        var details = x.id.split("/");
        var phn = details[0];
        var whatsapp = details[1];

        var d = {
            "service_code" : details[2],
            "service_partner" : details[3]
        }

        $.ajax({
            type : 'post',
            url : "<?php echo base_url('service_query') ?>",

            data : d,

            success:function(data){
                // alert(data);
            }
        })

        $('#partnerPhn').html(phn);
        $('#partnerWhatsapp').html(whatsapp);
        $('#phoneDisplay').modal('show');
    }
</script>