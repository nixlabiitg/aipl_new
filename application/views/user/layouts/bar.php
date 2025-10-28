<?php 

$c = &get_instance();
$userId=$c->session->userdata('aiplUserId');
$sql="SELECT * FROM `autopool_master1` WHERE `member_id`='".$userId."'";

$c->db->query($sql);
$autopool1=$c->db->affected_rows();

$sql="SELECT * FROM `autopool_master2` WHERE `member_id`='".$userId."'";
$c->db->query($sql);
$autopool2=$c->db->affected_rows();

$sql="SELECT * FROM `club_autopool` WHERE `member_id`='".$userId."'";
$c->db->query($sql);
$clubautopool=$c->db->affected_rows();

$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 and (user_type_id=2 or user_type_id=0)  order by id desc";
$query=$c->db->query($sql);
$NOTIFICATIONS_COUNT = $c->db->affected_rows();

$sql="SELECT count(id)  as cnt FROM `scratch_card_master` where TIMESTAMPDIFF(MINUTE,`create_date`,CURRENT_TIMESTAMP()) <30 and  `is_used`=0";
$query=$this->db->query($sql);
$gift=$query->result_array()[0]['cnt'];
?>

<style>
.blink-hard {
    animation: blinker 1.2s step-end infinite;
}

.blink-soft {
    animation: blinker 1.5s linear infinite;
}

@keyframes blinker {
    50% {
        opacity: 0;
    }
}
</style>
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
        data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav">

            <li class="kt-menu__item" aria-haspopup="true"><a href="<?= base_url('/'); ?>" class="kt-menu__link "><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Navigation/Arrow-left.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) "
                                        x="11" y="5" width="2" height="14" rx="1" />
                                    <path
                                        d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) " />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span></span><span class="kt-menu__link-text text-warning">Back to Site</span></a></li>

            <!-- ************************************************************* -->
            <!-- *******************DASHBOARD*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item" aria-haspopup="true"><a href="<?= base_url('dashboard/index'); ?>"
                    class="kt-menu__link "><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <i class="fa fa-home" aria-hidden="true" style="font-size:18pt;"></i>
                        </span></span><span class="kt-menu__link-text text-light">Dashboard</span></a></li>

            <li class="kt-menu__item" aria-haspopup="true"><a href="<?= base_url('report/rewards'); ?>"
                    class="kt-menu__link "><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <i class="fa fa-gift" aria-hidden="true" style="font-size:18pt;"></i>

                        </span></span>
                        <?php if($gift > 0){ ?>
                        <span class="kt-menu__link-text text-light">Reward &nbsp;<span class="text-dark blink-hard bg-warning px-2 rounded"><?= $gift ?></span></span>
                        <?php } else { ?>
                        <span class="kt-menu__link-text text-light">Reward</span>
                        <?php } ?>
                    </a></li>


            <li class="kt-menu__item" aria-haspopup="true"><a href="<?= base_url('dashboard/notifications'); ?>"
                    class="kt-menu__link "><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <i class="fa fa-bell" aria-hidden="true" style="font-size:18pt;"></i>
                        </span></span>
                        <?php if($NOTIFICATIONS_COUNT > 0){ ?>
                            <span class="kt-menu__link-text text-light">Notification &nbsp;<span class="text-dark blink-hard bg-warning px-2 rounded"><?= $NOTIFICATIONS_COUNT ?></span></span>
                        <?php }else{ ?>
                            <span class="kt-menu__link-text text-light">Notification</span>
                        <?php } ?>
                    </a>
            </li>


            <li class="kt-menu__section ">
                <h4 class="kt-menu__section-text text-light">Navigation</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>


            <!-- ************************************************************* -->
            <!-- *******************CUSTOMER MANAGEMENT*********************** -->
            <!-- ************************************************************* -->


            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Customers</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/pendingCustomer'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Pending Customers</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/activeCustomer'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Active Customers</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/downlineCustomer'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Downline Customers</span></a></li>
                        <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('customer/blockedCustomer'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Blocked Customers</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('customer/rejectedCustomer'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Rejected Customers</span></a></li> -->


                    </ul>
                </div>
            </li>
            
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?php echo base_url('Franchise/franchise_list') ?>" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Franchises</span></a>
            </li>


            <!-- ************************************************************* -->
            <!-- *******************KYC MANAGEMENT*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?php echo site_url('report/kyc_request_by_customer'); ?>"
                    class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">KYC</span></a>
                <!-- <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?php echo site_url('Report/kyc_request_by_customer'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Requests</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?php echo site_url('Report/kyc_approved_customer'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Approved</span></a></li>
                    </ul>


                </div> -->
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Activation Wallet</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/addtowallet'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Add to wallet</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/transfertoactivationwallet'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Transfer</span></a></li>
                    </ul>
                </div>



            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Payout</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/payoutrequest'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Request</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/pending_request'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Pending Request</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/approved_request'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Approved Request</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/rejected_request'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Rejected Request</span></a></li>

                    </ul>
                </div>

            </li>
            <!-- transfer history -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Transfer History</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/transferto'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Transfered To</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/transferfrom'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Transfered From</span></a></li>
                    </ul>
                </div>

            </li>
            <!-- ************************************************************* -->
            <!-- *******************Manual Activation*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?php echo base_url('Customer/manualActivation') ?>"
                    class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Manual Activation</span></a>
            </li>
            <?php if($this->session->userdata('packageid')==0){ ?>
            <!-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?php echo base_url('Customer/selfActivation') ?>"
                    class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Self Activation</span></a>
            </li> -->

            <?php } else { ?>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?php echo base_url('Customer/upgradation') ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Upgrade</span></a>
            </li>
            <?php } ?>
            <!-- ************************************************************* -->
            <!-- ******************* PACKAGE MANAGEMENT*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?= base_url('Customer/active_package'); ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Packages</span></a>
                <!-- <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('customer/package'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Add Package</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('customer/active_package'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Active Package</span></a></li>
       <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('customer/block_package'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Blocked Packages</span></a></li>
                    </ul>
                </div> -->
            </li>

            <!-- ************************************************************* -->
            <!-- ******************* PRODUCT MANAGEMENT*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Products</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('product/categories'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Categories</span></a></li> -->
                        <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('product/products'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Add Product</span></a></li> -->
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Product/manageProducts/active'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Active Products</span></a></li>
                        <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('Product/manageProducts/inactive'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Inactive Products</span></a></li> -->
                    </ul>
                </div>
            </li>

            <!-- ************************************************************* -->
            <!-- ******************* STOCK MANAGEMENT*********************** -->
            <!-- ************************************************************* -->



            <!-- ************************************************************* -->
            <!-- ******************* REPURCHASE MANAGEMENT*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?= base_url('report/pending_orders'); ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">My Orders</span></a>

            </li>

            <!-- ************************************************************* -->
            <!-- ******************* COUPONS MANAGEMENT*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?= base_url('report/coupon'); ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Coupons</span></a>

            </li>

            <!-- ************************************************************* -->
            <!-- ******************* AUTOPOOL MANAGEMENT*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Genealogy</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('Customer/geanology'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Genealogy</span></a></li>

                        <?php if($autopool1==1) {?>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/autopool1geanology'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Autopool 1 Genealogy</span></a></li>
                        <?php } if($autopool2==1) {?>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/autopool2geanology'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Autopool 2 Genealogy</span></a></li>

                        <?php } ?>

                        <?php if($clubautopool==1) {?>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('Customer/clubautopoolgeanology'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Club Autopool Genealogy</span></a></li>

                        <?php } ?>
                    </ul>
                </div>
            </li>


            <!-- ************************************************************* -->
            <!-- ******************* GENEALOGY *********************** -->
            <!-- ************************************************************* -->
            <!-- 
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?= base_url('Customer/geanology'); ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Genealogy</span></a>
            </li> -->

            <!-- ************************************************************* -->
            <!-- ******************* REPORT MANAGEMENT *********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Reports</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/income_statement'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Income Statement</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/activationreport'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Activation Report</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/digitalincome'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Digital Wallet Interest</span></a></li>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/direct_ipp_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Direct IPP Sponsor Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/generationincome'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Special Generation Income</span></a></li>
                        <?php if($autopool1==1) {?>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/autopool1_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Autopool 1 Income</span></a></li>
                        <?php } if($autopool2==1) {?>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/autopool2_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Autopool 2 Income</span></a></li>
                        <?php } if($clubautopool==1) {?>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Club_Autopool_Income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Club Autopool Income</span></a></li>
                        <?php } ?>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/club_achieve_bonus'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Club Achieve Bonus</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/level_upgrade_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Level Upgrade Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/member_development_bonus'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Member Development Bonus</span></a></li>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Booster_Income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Booster Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Mentor_Income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Mentor Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Direct_Point_Bonus'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Direct Point Bonus</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/direct_club_bonus'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Director Club Bonus</span></a></li>


                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Rewards_and_Recognitions'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Rewards and Recognitions</span></a></li>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Repurchase_Income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Repurchase Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/Fast_Track_Repurchase'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">First Track Repurchase Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/benefited_b_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">First Track Benefited B Income</span></a></li>


                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/activation_wallet_benefit'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Activation Wallet Benefits</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/direct_purchase_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Direct Repurchase Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/self_purchase_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Self Repurchase Income</span></a></li>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/monthly_purchase_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Monthly Repurchase Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/point_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Point Income</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/cash_back_report'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Cash Back Report</span></a></li>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/repurchase_performance_bonus'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Monthly Repurchase Performance Bonus</span></a></li>

                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('report/direct_team_shopping_income'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Monthly Direct Team Shopping Income</span></a></li>
                    </ul>
                </div>
            </li>


            <!-- ************************************************************* -->
            <!-- ******************* SERVICE MANAGEMENT *********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Service Management</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                class="kt-menu__link"><span class="kt-menu__link-text"></span></span></li>
                        <!-- <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('product/service_categories'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Category</span></a></li> -->
                        <li class="kt-menu__item " aria-haspopup="true"><a href="<?= base_url('product/services'); ?>"
                                class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Add Service</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?= base_url('product/manageServices/active'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Active Services</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?=  base_url('product/manageServices/inactive');  ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Blocked Services</span></a></li>

                    </ul>
                </div>
            </li>

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?= base_url('dashboard/welcomeLetter'); ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Welcome Letter</span></a>

            </li>

            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="<?php echo base_url('dashboard/visiting_card') ?>" class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-icon"><span class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Visiting Card</span></a>

            </li>



            <!-- ************************************************************* -->
            <!-- *******************SETTINGS*********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__section ">
                <h4 class="kt-menu__section-text text-light">Settings</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect opacity="0.200000003" x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Settings</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?php echo base_url('Settings/profile'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Profile</span></a></li>
                        <li class="kt-menu__item " aria-haspopup="true"><a
                                href="<?php echo base_url('Settings/password'); ?>" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Change Password</span></a></li>

                    </ul>
                </div>
            </li>

            <!-- ************************************************************* -->
            <!-- ******************* LOGOUT *********************** -->
            <!-- ************************************************************* -->

            <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('dashboard/logout/'); ?>"
                    class="kt-menu__link "><span class="kt-menu__link-icon"><span
                            class="svg-icon svg-icon-primary svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) "
                                        x="13" y="6" width="2" height="12" rx="1" />
                                    <path
                                        d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
                                </g>
                            </svg>
                        </span></span><span class="kt-menu__link-text text-light">Logout</span></a></li>
            </li>
        </ul>
    </div>
</div>

<!-- end:: Aside Menu -->
</div>