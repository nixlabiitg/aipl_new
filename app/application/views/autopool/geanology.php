<div class="page-content bottom-content">
    <div class="container">
        <div class="body genealogy-body genealogy-scroll">
            <div class="row mr-5">
                <?php foreach($PACKAGE as $data){ ?>
                <div class="col-lg-4 d-flex mb-2">
                    <div
                        style="padding: 5px 10px; margin-right: 10px; border : 1px solid #ccc; background-color : <?= $data->color_code ?>;">
                    </div>
                    <span style="margin-right: 20px;"><?= $data->package_name ?></span>
                </div>
                <?php } ?>
            </div>
            <div class="genealogy-tree">
                <ul>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="member-view-box">
                                <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                    <img src="<?=base_url('../uploads/profile/'.($profile_pic[0]['profile_pic']==1?$cid:"images").'.png') ?>"
                                        alt="Member" style="border-radius:50%">

                                </div>
                                <?php
                                    $package__id = $profile_pic[0]['package_id'];
                                    $sql="SELECT * FROM `package_master` WHERE `package_id`='".$package__id."'";
                                    $query = $this->db->query($sql);
                                    $package__details = $query->result_array();
                                    $colour_ = $package__details[0]['color_code'];
                                ?>
                                <div class="member-details text-center"
                                    style="background-color:<?= ($colour_ ? $colour_ : 'black')?>; padding: 5px; border-radius: 5px; color:#fff;">
                                    <?=$cname?><br>
                                    <?=$cid?>

                                </div>
                            </div>
                        </a>

                        <ul class="active">
                            <?php 
                  function customerTree($customerId)
                  {
                     $k=0;
                      $c = &get_instance();
                      $uc =  '<ul>';
                      $sql="SELECT * FROM `customer_master` WHERE `sponsor_id`='".$customerId."'";
                      $query = $c->db->query($sql);
                      $result = $query->result_array();

                      $package_id = $result[0]['package_id'];
                        $sql="SELECT * FROM `package_master` WHERE `package_id`='".$package_id."'";
                        $query = $c->db->query($sql);
                        $package_details = $query->result_array();
                        $colour = $package_details[0]['color_code'];

                      if($c->db->affected_rows()>0)
                      {
                          foreach ($result as $rs) {      
                                $uc.='<li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box" >
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="'.base_url("../uploads/profile/".($rs['profile_pic']==1?$rs['customer_id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                                           
                                        </div>
                                        <div class="member-details text-center" style="background-color:'.($colour ? $colour : 'black').'; padding: 5px; border-radius: 5px; color:#fff;">'.
                                           $rs['name'].'<br>'.
                                           $rs['customer_id'].'<br>'.
                                           '<span class="badge badge-'.($rs['status']==1?"success":($rs['status']==0?"warning":($rs['status']==2?"info":"danger"))).'">'.($rs['status']==1?"Active":($rs['status']==0?"Pending":($rs['status']==2?"Block":"Reject"))).'</span>'.

                                        '</div>
                                    </div>
                            </a>';                                             
                            $uc.= customerTree($rs['customer_id']).'</li>';  
                            
                          }
                      }
                      else
                      {
                        return ;
                      }
                      
                     
                      return $uc."</ul>";
                  }
                
                foreach($tree as $t)
                {
                    $package_idd = $t['package_id'];
                    $sql="SELECT * FROM `package_master` WHERE `package_id`='".$package_idd."'";
                    $query = $this->db->query($sql);
                    $package_detailss = $query->result_array();
                    $colourr = $package_detailss[0]['color_code'];
                    ?>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="<?=base_url('../uploads/profile/'.($t['profile_pic']==1?$t['customer_id']:"images").'.png') ?>"
                                                alt="Member" style="border-radius:50%">

                                        </div>
                                        <div class="member-details text-center"
                                            style="background-color:<?= ($colour_ ? $colour_ : 'black')?>; padding: 5px; border-radius: 5px; color:#fff;">
                                            <?=$t['name']?><br>
                                            <?=$t['customer_id']?><br>
                                            <span
                                                class="badge badge-<?=($t['status']==0?"danger":"success")?>"><?=($t['status']==0?"Pending":"Active")?></span>

                                        </div>
                                    </div>
                                </a>
                                <?=customerTree($t['customer_id'])?>
                            </li>
                            <?php } ?>
                        </ul>


                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
/*----------------genealogy-scroll----------*/

.genealogy-scroll::-webkit-scrollbar {
    width: 5px;
    height: 8px;
}

.genealogy-scroll::-webkit-scrollbar-track {
    border-radius: 10px;
    background-color: #e4e4e4;
}

.genealogy-scroll::-webkit-scrollbar-thumb {
    background: #212121;
    border-radius: 10px;
    transition: 0.5s;
}

.genealogy-scroll::-webkit-scrollbar-thumb:hover {
    background: #d5b14c;
    transition: 0.5s;
}


/*----------------genealogy-tree----------*/
.genealogy-body {
    white-space: nowrap;
    overflow-y: hidden;
    padding: 50px;
    min-height: 500px;
    padding-top: 10px;
    text-align: center;
}

.genealogy-tree {
    display: inline-block;
}

.genealogy-tree ul {
    padding-top: 20px;
    position: relative;
    padding-left: 0px;
    display: flex;
    justify-content: center;
}

.genealogy-tree li {
    float: left;
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
}

.genealogy-tree li::before,
.genealogy-tree li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 2px solid #ccc;
    width: 50%;
    height: 18px;
}

.genealogy-tree li::after {
    right: auto;
    left: 50%;
    border-left: 2px solid #ccc;
}

.genealogy-tree li:only-child::after,
.genealogy-tree li:only-child::before {
    display: none;
}

.genealogy-tree li:only-child {
    padding-top: 0;
}

.genealogy-tree li:first-child::before,
.genealogy-tree li:last-child::after {
    border: 0 none;
}

.genealogy-tree li:last-child::before {
    border-right: 2px solid #ccc;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}

.genealogy-tree li:first-child::after {
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}

.genealogy-tree ul ul::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 2px solid #ccc;
    width: 0;
    height: 20px;
}

.genealogy-tree li a {
    text-decoration: none;
    color: #666;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    display: inline-block;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
}

.genealogy-tree li a:hover+ul li::after,
.genealogy-tree li a:hover+ul li::before,
.genealogy-tree li a:hover+ul::before,
.genealogy-tree li a:hover+ul ul::before {
    border-color: #fbba00;
}

/*--------------memeber-card-design----------*/
.member-view-box {
    padding: 0px 20px;
    text-align: center;
    border-radius: 4px;
    position: relative;
}

.member-image {
    width: 60px;
    position: relative;
}

.member-image img {
    width: 60px;
    height: 60px;
    border-radius: 6px;
    background-color: #000;
    z-index: 1;
}
</style>
<script>
$(function() {
    $('.genealogy-tree ul').hide();
    $('.genealogy-tree>ul').show();
    $('.genealogy-tree ul.active').show();
    $('.genealogy-tree li').on('click', function(e) {
        var children = $(this).find('> ul');
        if (children.is(":visible")) children.hide('fast').removeClass('active');
        else children.show('fast').addClass('active');
        e.stopPropagation();
    });
});
</script>