<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="card-title text-center">Our services</h3>
                <div class="row catagore-bx mt-4">
                    <?php foreach($SERVICES as $service){ ?>
                    <div class="col-3 text-center mb-3">
                        <span onclick="showServices(<?= $service->category_id ?>)">
                            <div class="dz-media media-60">
                                <?php if($service->avatar == ''){ ?>
                                <img src="<?php echo base_url('../admin/uploads/categories/no.png') ?>" alt="image">
                                <?php }else{ ?>
                                <img src="<?php echo base_url('../admin/uploads/categories/'.$service->avatar) ?>"
                                    alt="image">
                                <?php } ?>
                            </div>
                            <span style="font-size : 10px;"><?= $service->category_name ?></span>
                                </span>
                    </div>
                    <?php } ?>
                    <form id="singleService" action="<?php echo base_url('services/services') ?>" method="post" hidden>
                        <input type="text" id="serviceid" name="serviceid">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showServices(x) {
    $("#serviceid").val(x);
    $("#singleService").submit();
}
</script>