<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Our Services</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Our Services</a></li>
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
        <div class="row justify-content-center">
            <?php foreach($service as $service){ ?>
            <div class="col-4 col-md-3 text-center mb-3">
                <span style="cursor : pointer;" onclick="showServices(<?= $service['category_id'] ?>)">
                    <div style="border:1px solid #eee; padding : 10px; border-radius : 10px; background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px; border: none;">
                        <div class="dz-media media-60">
                            <?php
                            $category = $service['category_name'];
                            $words = explode(" ", $category);
                            $acronym = "";

                            foreach ($words as $w) {
                                $acronym .= mb_substr($w, 0, 1);
                            }
                                if($service['avatar'] == ''){
                            ?>
                                <div style="padding:25px; color:teal; font-weight:500; font-size:30px;">
                                    <span class="text-uppercase"><?=  $acronym ?></span>
                                </div>
                            <?php }else{?>
                                <img src="<?php echo base_url('admin/uploads/categories/'.$service['avatar']) ?>"
                                alt="image" style="height:80px; width:80px;">
                            <?php } ?>
                        </div>
                        <span style="font-size : 16px; color : #000;"><?= $service['category_name'] ?></span>
                    </div>
                </span>
            </div>
            <?php } ?>
        </div>
        <form id="singleService" action="<?php echo base_url('services') ?>" method="post" hidden>
            <input type="text" id="serviceid" name="serviceid">
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
function showServices(x) {
    $("#serviceid").val(x);
    $("#singleService").submit();
}
</script>