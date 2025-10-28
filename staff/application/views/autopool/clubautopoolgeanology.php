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
                  function customerTree($customerId,$s)
                  {
                      $c = &get_instance();
                      $uc =  '<ul '.($s==1?'class="Active"':'').'>';
                      $sql="SELECT c1.profile_pic as c1pic,c2.profile_pic as c2pic,c3.profile_pic as c3pic,c4.profile_pic as c4pic,c5.profile_pic as c5pic,c1.customer_id as u1id,c1.name as u1name,c1.status as u1status,c2.customer_id as u2id,c2.name as u2name,c2.status as u2status,c3.customer_id as u3id,c3.name as u3name,c3.status as u3status,c4.customer_id as u4id,c4.name as u4name,c4.status as u4status,c5.customer_id as u5id,c5.name as u5name,c5.status as u5status FROM ((((customer_master c1 LEFT JOIN club_autopool a on c1.customer_id=a.uid_1) left join customer_master c2 on c2.customer_id=a.uid_2) left join customer_master c3 on c3.customer_id=a.uid_3) left join customer_master c4 on c4.customer_id=a.uid_4) left join customer_master c5 on c5.customer_id=a.uid_5 where `member_id`='".$customerId."'";
                      $query = $c->db->query($sql);
                      $result = $query->result_array();
                      if($c->db->affected_rows()>0)
                      {
                          foreach ($result as $rs) {     
                            // 1st 
                            if($rs['u1id'] != null)
                            {
                                $uc.='<li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box" >
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="'.base_url("../uploads/profile/".($rs['c1pic']==1?$rs['u1id']:"images").".png") .'" alt="Member" style="border-radius:50%" >
                                           
                                        </div>
                                        <div class="member-details text-center" >'.
                                           $rs['u1name'].'<br>'.
                                           $rs['u1id'].'<br>'.
                                           '<span class="badge badge-'.($rs['u1status']==1?"success":($rs['u1status']==0?"warning":($rs['u1status']==2?"info":"danger"))).'">'.($rs['u1status']==1?"Active":($rs['u1status']==0?"Pending":($rs['u1status']==2?"Block":"Reject"))).'</span>'.

                                        '</div>
                                    </div>
                            </a>';                                             
                            $uc.= customerTree($rs['u1id'],0).'</li>';  }

                            // 2nd
                            if($rs['u2id'] != null)
                             {
                            $uc.='<li>
                            <a href="javascript:void(0);">
                                <div class="member-view-box" >
                                    <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                        <img src="'.base_url("../uploads/profile/".($rs['c2pic']==1?$rs['u2id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                                       
                                    </div>
                                    <div class="member-details text-center" >'.
                                       $rs['u2name'].'<br>'.
                                       $rs['u2id'].'<br>'.
                                       '<span class="badge badge-'.($rs['u2status']==1?"success":($rs['u2status']==0?"warning":($rs['u2status']==2?"info":"danger"))).'">'.($rs['u2status']==1?"Active":($rs['u2status']==0?"Pending":($rs['u2status']==2?"Block":"Reject"))).'</span>'.

                                    '</div>
                                </div>
                        </a>';                                             
                        $uc.= customerTree($rs['u2id'],0).'</li>';  }
           
                        // 3rd
                         if($rs['u3id'] != null)
                         {
                         $uc.='<li>
                         <a href="javascript:void(0);">
                             <div class="member-view-box" >
                                 <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                     <img src="'.base_url("../uploads/profile/".($rs['c3pic']==1?$rs['u3id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                                    
                                 </div>
                                 <div class="member-details text-center" >'.
                                    $rs['u3name'].'<br>'.
                                    $rs['u3id'].'<br>'.
                                    '<span class="badge badge-'.($rs['u3status']==1?"success":($rs['u3status']==0?"warning":($rs['u3status']==2?"info":"danger"))).'">'.($rs['u3status']==1?"Active":($rs['u3status']==0?"Pending":($rs['u3status']==2?"Block":"Reject"))).'</span>'.

                                 '</div>
                             </div>
                     </a>';                                             
                     $uc.= customerTree($rs['u3id'],0).'</li>';  }

                      // 4th
                      if($rs['u4id'] != null)
                      {
                      $uc.='<li>
                      <a href="javascript:void(0);">
                          <div class="member-view-box" >
                              <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                  <img src="'.base_url("../uploads/profile/".($rs['c4pic']==1?$rs['u4id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                                 
                              </div>
                              <div class="member-details text-center" >'.
                                 $rs['u4name'].'<br>'.
                                 $rs['u4id'].'<br>'.
                                 '<span class="badge badge-'.($rs['u4status']==1?"success":($rs['u4status']==0?"warning":($rs['u4status']==2?"info":"danger"))).'">'.($rs['u4status']==1?"Active":($rs['u4status']==0?"Pending":($rs['u4status']==2?"Block":"Reject"))).'</span>'.

                              '</div>
                          </div>
                  </a>';                                             
                  $uc.= customerTree($rs['u4id'],0).'</li>';  }
                   // 5th
                   if($rs['u5id'] != null)
                   {
                   $uc.='<li>
                   <a href="javascript:void(0);">
                       <div class="member-view-box" >
                           <div class="member-image" style="margin-left:auto;margin-right:auto;">
                               <img src="'.base_url("../uploads/profile/".($rs['c5pic']==1?$rs['u5id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                              
                           </div>
                           <div class="member-details text-center" >'.
                              $rs['u5name'].'<br>'.
                              $rs['u5id'].'<br>'.
                              '<span class="badge badge-'.($rs['u5status']==1?"success":($rs['u5status']==0?"warning":($rs['u5status']==2?"info":"danger"))).'">'.($rs['u5status']==1?"Active":($rs['u5status']==0?"Pending":($rs['u5status']==2?"Block":"Reject"))).'</span>'.

                           '</div>
                       </div>
               </a>';                                             
               $uc.= customerTree($rs['u5id'],0).'</li>';  }

                            
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
                    ?>                
                        <li>
                        <a href="javascript:void(0);">
                            <div class="member-view-box" >
                                <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                    <img src="<?=base_url('../uploads/profile/'.($t['profile_pic']==1?$t['customer_id']:'images').'.png') ?>" alt="Member" style="border-radius:50%" >
                                  
                                </div>
                                <div class="member-details text-center" >
                                    <?=$t['name']?><br>
                                    <?=$t['customer_id']?><br>
                                    <span class="badge badge-<?=($t['status']==0?"danger":"success")?>"><?=($t['status']==0?"Pending":"Active")?></span>

                                    </div>
                            </div>
                       </a>
                       <?=customerTree($cid,1)?>                       
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