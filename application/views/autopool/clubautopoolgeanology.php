<div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><?=$page_name?></h3>
          
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-daterange" id="" data-toggle="kt-tooltip" title=""
                    data-placement="left">
                    <span class="kt-subheader__btn-daterange-title"
                        id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date"
                        id="kt_dashboard_daterangepicker_date"><?php echo date('d M Y') ?></span>
                    <i class="flaticon2-calendar-1"></i>
                </a>
            </div>
        </div>
    </div>
<div class="body genealogy-body genealogy-scroll">
    <div class="genealogy-tree">
        <ul class="active">
            <?php 
            function customerTree($customerId, $s, &$visited = [])
            {
                $c = &get_instance();

                // Stop recursion if already processed this customer
                if (in_array($customerId, $visited)) {
                    return '';
                }
                $visited[] = $customerId;

                $uc = '<ul '.($s == 1 ? 'class="Active"' : '').'>';

                $sql = "SELECT 
                    c1.profile_pic as c1pic, c2.profile_pic as c2pic, c3.profile_pic as c3pic, c4.profile_pic as c4pic, c5.profile_pic as c5pic,
                    c1.customer_id as u1id, c1.name as u1name, c1.status as u1status,
                    c2.customer_id as u2id, c2.name as u2name, c2.status as u2status,
                    c3.customer_id as u3id, c3.name as u3name, c3.status as u3status,
                    c4.customer_id as u4id, c4.name as u4name, c4.status as u4status,
                    c5.customer_id as u5id, c5.name as u5name, c5.status as u5status
                FROM ((((customer_master c1 
                    LEFT JOIN club_autopool a ON c1.customer_id = a.uid_1)
                    LEFT JOIN customer_master c2 ON c2.customer_id = a.uid_2)
                    LEFT JOIN customer_master c3 ON c3.customer_id = a.uid_3)
                    LEFT JOIN customer_master c4 ON c4.customer_id = a.uid_4)
                    LEFT JOIN customer_master c5 ON c5.customer_id = a.uid_5
                WHERE a.member_id = '".$customerId."'";

                $query = $c->db->query($sql);
                $result = $query->result_array();

                // If no children → stop here
                if (empty($result)) return '';

                foreach ($result as $rs) {
                    for ($i = 1; $i <= 5; $i++) {
                        $uid = $rs["u{$i}id"];
                        $uname = $rs["u{$i}name"];
                        $ustatus = $rs["u{$i}status"];
                        $upic = $rs["c{$i}pic"];

                        if (!empty($uid) && !in_array($uid, $visited)) {
                            $badgeColor = ($ustatus == 1 ? "success" : ($ustatus == 0 ? "warning" : ($ustatus == 2 ? "info" : "danger")));
                            $badgeText  = ($ustatus == 1 ? "Active" : ($ustatus == 0 ? "Pending" : ($ustatus == 2 ? "Block" : "Reject")));

                            $uc .= '<li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="'.base_url("uploads/profile/".($upic==1?$uid:"images").".png").'" alt="Member" style="border-radius:50%">
                                        </div>
                                        <div class="member-details text-center">'
                                            .$uname.'<br>'
                                            .$uid.'<br>'
                                            .'<span class="badge badge-'.$badgeColor.'">'.$badgeText.'</span>'
                                        .'</div>
                                    </div>
                                </a>';

                            // Call recursively only if this user not processed yet
                            $uc .= customerTree($uid, 0, $visited);
                            $uc .= '</li>';
                        }
                    }
                }

                return $uc.'</ul>';
            }

            // 🔹 ROOT LEVEL USERS
            foreach ($tree as $t) {
            ?>                
                <li>
                    <a href="javascript:void(0);">
                        <div class="member-view-box">
                            <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                <img src="<?= base_url('uploads/profile/'.($t['profile_pic']==1?$t['customer_id']:'images').'.png') ?>" alt="Member" style="border-radius:50%">
                            </div>
                            <div class="member-details text-center">
                                <?= $t['name'] ?><br>
                                <?= $t['customer_id'] ?><br>
                                <span class="badge badge-<?= ($t['status']==0 ? "danger" : "success") ?>">
                                    <?= ($t['status']==0 ? "Pending" : "Active") ?>
                                </span>
                            </div>
                        </div>
                    </a>
                    <?php 
                        // Initialize visited array for each root user
                        $visited = [];
                        echo customerTree($cid, 1, $visited);
                    ?>                       
                </li>
            <?php } ?>
        </ul>
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
.genealogy-body{
    white-space: nowrap;
    overflow-y: hidden;
    padding: 50px;
    min-height: 500px;
    padding-top: 10px;
    text-align: center;
}
.genealogy-tree{
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
    float: left; text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
}
.genealogy-tree li::before, .genealogy-tree li::after{
    content: '';
    position: absolute; 
  top: 0; 
  right: 50%;
    border-top: 2px solid #ccc;
    width: 50%; 
  height: 18px;
}
.genealogy-tree li::after{
    right: auto; left: 50%;
    border-left: 2px solid #ccc;
}
.genealogy-tree li:only-child::after, .genealogy-tree li:only-child::before {
    display: none;
}
.genealogy-tree li:only-child{ 
    padding-top: 0;
}
.genealogy-tree li:first-child::before, .genealogy-tree li:last-child::after{
    border: 0 none;
}
.genealogy-tree li:last-child::before{
    border-right: 2px solid #ccc;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}
.genealogy-tree li:first-child::after{
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}
.genealogy-tree ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 2px solid #ccc;
    width: 0; height: 20px;
}
.genealogy-tree li a{
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
.genealogy-tree li a:hover+ul ul::before{
    border-color:  #fbba00;
}

/*--------------memeber-card-design----------*/
.member-view-box{
    padding:0px 20px;
    text-align: center;
    border-radius: 4px;
    position: relative;
}
.member-image{
    width: 60px;
    position: relative;
}
.member-image img{
    width: 60px;
    height: 60px;
    border-radius: 6px;
  background-color :#000;
  z-index: 1;
}

    </style>
    <script>
        $(function () {
    $('.genealogy-tree ul').hide();
    $('.genealogy-tree>ul').show();
    $('.genealogy-tree ul.active').show();
    $('.genealogy-tree li').on('click', function (e) {
        var children = $(this).find('> ul');
        if (children.is(":visible")) children.hide('fast').removeClass('active');
        else children.show('fast').addClass('active');
        e.stopPropagation();
    });
});

    </script>