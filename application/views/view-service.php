<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Services</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Services</a></li>
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

<section class="main-container" id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4 class="list-column-title">All Services</h4>
                <div class="sidebar ">
                    <div class="widget no-padding no-border">
                        <ul class="service-menu">
                            <?php foreach($service as $service){ ?>
                            <li onclick="showServices(<?= $service['category_id'] ?>)"><a href="#"><?= $service['category_name'] ?></a></li>
                            <?php } ?>
                        </ul>
                        <form id="singleService" action="<?php echo base_url('services') ?>" method="post" hidden>
                            <input type="text" id="serviceid" name="serviceid">
                        </form>
                    </div>
                </div>
            </div>
            <!-- Col end -->
            <div class="col-lg-8">
                <?php
                    $categoryId = $services[0]['category_id'];
                    if($categoryId == ''){
                ?>
                    <div id="call-to-action" class="call-to-action-bg service-call-to-action ">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2 class="text-secondary">No Services Found</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                <h3>
                    <?php
                        $sql = "SELECT * FROM `category_master` WHERE `category_id` = '$categoryId'";
                        $query = $this->db->query($sql);
                        $category = $query->result_array();
                        echo $category[0]['category_name'];
                    ?>
                </h3>

                <?php foreach($services as $data){ ?>
                <div id="call-to-action" class="call-to-action-bg service-call-to-action mb-3">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-4">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" style="height:150px; border-radius : 20px 5px;">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" style="height:150px;"
                                                src="<?php echo base_url('uploads/service/'.$data['image_1']) ?>"
                                                alt="First slide">
                                        </div>
                                        <?php if($data['image_2'] != ''){ ?>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="height:150px;"
                                                src="<?php echo base_url('uploads/service/'.$data['image_2']) ?>"
                                                alt="Second slide">
                                        </div>
                                        <?php }else if($data['image_3'] != ''){ ?>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="height:150px;"
                                                src="<?php echo base_url('uploads/service/'.$data['image_3']) ?>"
                                                alt="Third slide">
                                        </div>
                                        <?php }else if($data['image_4'] != ''){ ?>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="height:150px;"
                                                src="<?php echo base_url('uploads/service/'.$data['image_4']) ?>"
                                                alt="Third slide">
                                        </div>
                                        <?php }else if($data['image_5'] != ''){ ?>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="height:150px;"
                                                src="<?php echo base_url('uploads/service/'.$data['image_5']) ?>"
                                                alt="Third slide">
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="call-to-action-title service-call-to-action">
                                    <a href="#" onclick="showDetails(<?= $data['id'] ?>)"><?= $data['organization_name'] ?></a></h3>
                                    <p><b>Experience :</b> <?= $data['experience'] ?> years <br/><b>Expertise : </b><?= $data['expertise'] ?> <br/><b>Service Areas : </b><?= $data['available_in'] ?></p>
                                    <a href="#" onclick="showDetails(<?= $data['id'] ?>)" style="font-size : 16px;"><u>View more</u></a>
                            </div>
                            <div class="col-lg-2 text-right">
                                <?php if($this->session->userdata('aiplUserId') == ''){ ?>
                                    <a class="btn btn-box" href="<?php echo base_url('authentication/login') ?>">Call
                                    Now</a>
                                <?php }else{ ?>
                                    <button id="<?= $data['phone']."/".$data['whatsapp']."/".$data['service_code']."/".$data['user_id'] ?>" onclick="showNumber(this)" class="btn btn-box" href="#">Call Now</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>

                <form id="singleServiceDetails" action="<?php echo base_url('service_details') ?>" method="post" hidden>
                    <input type="text" id="singleserviceid" name="singleserviceid">
                </form>
            </div>
        </div>
    </div>
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
function showServices(x) {
    $("#serviceid").val(x);
    $("#singleService").submit();
}
</script>

<script>
function showDetails(x) {
    $("#singleserviceid").val(x);
    $("#singleServiceDetails").submit();
}
</script>

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