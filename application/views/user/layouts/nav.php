<!-- end:: Aside -->
<?php 
	$userId=$this->session->userdata('aiplUserId');
    $c=&get_instance();
    $sql="SELECT count(id)  as cnt FROM `scratch_card_master` where TIMESTAMPDIFF(MINUTE,`create_date`,CURRENT_TIMESTAMP()) <30 and  `is_used`=0";
    $query=$this->db->query($sql);
    $gift=$query->result_array()[0]['cnt'];

?>
<style>
    .blink {
  animation: blinker 1s step-start infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed bg-dark">

    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="#" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text text-light">Welcome to <?= PROJECT_NAME; ?></span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user" >
        <div class="kt-header__topbar-user">
                   <a href="<?= base_url('report/rewards'); ?>"> <span class="kt-header__topbar-welcome kt-hidden-mobile text-light"><i class="fa fa-gift" aria-hidden="true" style="font-size:20pt;color:yellow;"></i><p class="blink text-warning"><?=$gift?></small></p></span></a>
              </div>   
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
           
            
            <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile text-light">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile text-light"><?= $username = $this->session->userdata('aiplUserName') ?></span>
                    <img class="kt-hidden" alt="Pic" src="<?php echo base_url(); ?>assets/media/users/300_25.jpg" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?= substr($username, 0, 1) ?></span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url('../'); ?>portal_assets/media/misc/bg-1.jpg)">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="<?php echo base_url(); ?>assets/media/users/300_25.jpg" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?= substr($username, 0, 1) ?></span>
                    </div>
                    <div class="kt-user-card__name">
                        <?= $this->session->userdata('aiplUserName') ?>
                    </div>
                    <!-- <div class="kt-user-card__badge">
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                    </div> -->
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <div class="kt-notification__custom">
                        <a href="<?php echo base_url('/'); ?>" class="btn mr-3 btn-label-brand btn-sm btn-bold">View Profile</a>
                        <a href="<?php echo base_url('dashboard/logout/'); ?>" class="btn btn-danger btn-sm btn-bold">Sign Out</a>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

