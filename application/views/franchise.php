<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Franchise/ACDC</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Franchise/ACDC</a></li>
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

<section class="projects" id="projects">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-title"><span></span>Our Franchises/ACDC</h2>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12">
                <div
                    style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Franchise/ACDC Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id=0; foreach($FRANCHISE as $data){ ?>
                                <tr>
                                    <td class="text-center"><?= ++$id ?></td>
                                    <td><b><?= $data->name ?></b></td>
                                    <td><?= $data->address ?></td>
                                    <td><i class="fa fa-envelope"></i> <a href="mailto:<?= $data->email ?>"
                                            target="_blank" class="text-success"><?= $data->email ?></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- row 1 end-->
    </div>
    <!-- Container end-->
</section>
<!-- Projects end-->