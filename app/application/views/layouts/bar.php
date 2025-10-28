<?php 

$c = &get_instance();
$userId=$c->session->userdata('aiplAppId');
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

<!-- Sidebar -->
<div class="dark-overlay"></div>
<?php $userid = $this->session->userdata("aiplAppId"); ?>
<div class="sidebar">
    <?php if($userid != ''){
        $img =  file_exists('../uploads/profile/'.$userid.'.png');
    ?>
        <div class="author-box">
            <div class="dz-media">
                <?php if($img == ''){ ?>
                    <img src="<?php echo base_url('../uploads/profile/images2.png') ?>" alt="author-image">
                <?php }else{ ?>
                    <img src="<?php echo base_url('../uploads/profile/'.$userid.'.png') ?>" alt="author-image" style="height:100%; width:100%;">
                <?php } ?>
            </div>
            <div class="dz-info">
                <h5 class="name"><?= $this->session->userdata('aiplAppName') ?></h5>
                <span><?= $this->session->userdata('aiplAppId') ?></span>
            </div>
        </div>
    <?php }else{ ?>
        <div class="author-box">
            <div class="dz-media">
                <img src="<?php echo base_url('../uploads/profile/images2.png') ?>" alt="author-image">
            </div>
            <div class="dz-info">
                <h5 class="name">Guest User</h5>
                <a href="<?php echo base_url('authentication/login') ?>" class="text-white"><u>Sign in</u></a>
            </div>
        </div>
    <?php } ?>
    <?php if($userid != ''){ ?>
    <ul class="nav navbar-nav">
        <li class="nav-label">Main Menu</li>
        <li>
            <a class="nav-link" href="<?php echo base_url('/') ?>">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z" />
                    </svg>
                </span>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('report/rewards') ?>">
                <span class="dz-icon">
                    <svg height="512pt" viewBox="0 -22 512 511" width="512pt" xmlns="http://www.w3.org/2000/svg">
                        <path d="m356.472656 131.734375h-200.945312l100.472656 334.898437zm0 0"></path>
                        <path d="m217.363281 429.191406-89.238281-297.457031h-128.125zm0 0"></path>
                        <path d="m352.863281 105.488281-52.480469-104.976562h-88.765624l-52.492188 104.976562zm0 0">
                        </path>
                        <path d="m383.863281 131.734375-89.226562 297.457031 217.363281-297.457031zm0 0"></path>
                        <path
                            d="m129.78125 105.488281 52.496094-104.988281h-96.875c-4.132813 0-8.023438 1.945312-10.5 5.25l-74.8046878 99.730469zm0 0">
                        </path>
                        <path
                            d="m382.222656 105.488281h129.683594l-74.804688-99.730469c-2.480468-3.304687-6.375-5.246093-10.507812-5.25h-96.863281zm0 0">
                        </path>
                    </svg>
                </span>
                <?php if($gift > 0){ ?>
                <span>Reward &nbsp;<span class="text-dark blink-hard bg-warning px-2 rounded"><?= $gift ?></span></span>
                <?php } else { ?>
                <span>Reward</span>
                <?php } ?>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('dashboard/notifications') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g></g>
                        <g>
                            <path
                                d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,18.5c-0.83,0-1.5-0.67-1.5-1.5h3 C13.5,17.83,12.83,18.5,12,18.5z M16,16H8c-0.55,0-1-0.45-1-1v0c0-0.55,0.45-1,1-1l0-3c0-1.86,1.28-3.41,3-3.86V6.5 c0-0.55,0.45-1,1-1s1,0.45,1,1v0.64c1.72,0.45,3,2,3,3.86l0,3c0.55,0,1,0.45,1,1v0C17,15.55,16.55,16,16,16z">
                            </path>
                        </g>
                    </svg>
                </span>
                <?php if($NOTIFICATIONS_COUNT > 0){ ?>
                <span>Notification &nbsp;<span class="text-dark blink-hard bg-warning px-2 rounded"><?= $NOTIFICATIONS_COUNT ?></span></span>
                <?php }else{ ?>
                <span>Notification</span>
                <?php } ?>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/customer_list') ?>">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z" />
                    </svg>
                </span>
                <span>Customers</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="<?php echo base_url('franchise/franchise') ?>">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z" />
                    </svg>
                </span>
                <span>Franchise</span>
            </a>
        </li>


        <li>
            <a class="nav-link" href="<?php echo base_url('report/kyc_request_by_customer') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M14.59 2.59c-.38-.38-.89-.59-1.42-.59H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8.83c0-.53-.21-1.04-.59-1.41l-4.82-4.83zM15 18H9c-.55 0-1-.45-1-1s.45-1 1-1h6c.55 0 1 .45 1 1s-.45 1-1 1zm0-4H9c-.55 0-1-.45-1-1s.45-1 1-1h6c.55 0 1 .45 1 1s-.45 1-1 1zm-2-6V3.5L18.5 9H14c-.55 0-1-.45-1-1z">
                        </path>
                    </svg>
                </span>
                <span>KYC</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/wallet_list') ?>">
                <span class="dz-icon">
                    <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
                        xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path
                                d="m256 512c-68.38 0-132.668-26.628-181.02-74.98s-74.98-112.64-74.98-181.02 26.629-132.667 74.98-181.02 112.64-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.64 74.98 181.02-26.629 132.667-74.98 181.02-112.64 74.98-181.02 74.98zm0-480c-123.514 0-224 100.486-224 224s100.486 224 224 224 224-100.486 224-224-100.486-224-224-224z">
                            </path>
                            <path
                                d="m256 240c-22.056 0-40-17.944-40-40s17.944-40 40-40 40 17.944 40 40c0 8.836 7.163 16 16 16s16-7.164 16-16c0-34.201-23.978-62.888-56-70.186v-17.814c0-8.836-7.163-16-16-16s-16 7.164-16 16v17.814c-32.022 7.298-56 35.985-56 70.186 0 39.701 32.299 72 72 72 22.056 0 40 17.944 40 40s-17.944 40-40 40-40-17.944-40-40c0-8.836-7.163-16-16-16s-16 7.164-16 16c0 34.201 23.978 62.888 56 70.186v17.814c0 8.836 7.163 16 16 16s16-7.164 16-16v-17.814c32.022-7.298 56-35.985 56-70.186 0-39.701-32.299-72-72-72z">
                            </path>
                        </g>
                    </svg>
                </span>
                <span>Activate Wallet</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/payout_list') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M20,2H8C6.9,2,6,2.9,6,4v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V4C22,2.9,21.1,2,20,2z M11.76,13.28L9.69,11.2 c-0.38-0.39-0.38-1.01,0-1.4l0,0c0.39-0.39,1.02-0.39,1.41,0l1.36,1.37l4.42-4.46c0.39-0.39,1.02-0.39,1.41,0l0,0 c0.38,0.39,0.38,1.01,0,1.4l-5.13,5.17C12.79,13.68,12.15,13.68,11.76,13.28z M3,6L3,6C2.45,6,2,6.45,2,7v13c0,1.1,0.9,2,2,2h13 c0.55,0,1-0.45,1-1v0c0-0.55-0.45-1-1-1H5c-0.55,0-1-0.45-1-1V7C4,6.45,3.55,6,3,6z">
                        </path>
                    </svg>
                </span>
                <span>Payout</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/transfer_list') ?>">
                <span class="dz-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4"
                            d="M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2558 2.67555 18.9206 3.50777 18.9206H10.0833C10.9155 18.9206 11.5911 18.2558 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z"
                            fill="#130F26"></path>
                        <path opacity="0.4"
                            d="M22 6.37856C22 5.56203 21.3244 4.89832 20.4933 4.89832H13.9178C13.0856 4.89832 12.41 5.56203 12.41 6.37856C12.41 7.19618 13.0856 7.85989 13.9178 7.85989H20.4933C21.3244 7.85989 22 7.19618 22 6.37856Z"
                            fill="#130F26"></path>
                        <path
                            d="M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z"
                            fill="inherit"></path>
                        <path
                            d="M22.0001 17.3992C22.0001 19.2648 20.4612 20.7778 18.5612 20.7778C16.6623 20.7778 15.1223 19.2648 15.1223 17.3992C15.1223 15.5325 16.6623 14.0196 18.5612 14.0196C20.4612 14.0196 22.0001 15.5325 22.0001 17.3992Z"
                            fill="inherit"></path>
                    </svg>
                </span>
                <span>Transfer History</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/manualActivation') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M17 7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h10c2.76 0 5-2.24 5-5s-2.24-5-5-5zM7 15c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z">
                        </path>
                    </svg>
                </span>
                <span>Manual Activation</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/upgradation') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <g>
                                    <path
                                        d="M23,8c0,1.1-0.9,2-2,2c-0.18,0-0.35-0.02-0.51-0.07l-3.56,3.55C16.98,13.64,17,13.82,17,14c0,1.1-0.9,2-2,2s-2-0.9-2-2 c0-0.18,0.02-0.36,0.07-0.52l-2.55-2.55C10.36,10.98,10.18,11,10,11s-0.36-0.02-0.52-0.07l-4.55,4.56C4.98,15.65,5,15.82,5,16 c0,1.1-0.9,2-2,2s-2-0.9-2-2s0.9-2,2-2c0.18,0,0.35,0.02,0.51,0.07l4.56-4.55C8.02,9.36,8,9.18,8,9c0-1.1,0.9-2,2-2s2,0.9,2,2 c0,0.18-0.02,0.36-0.07,0.52l2.55,2.55C14.64,12.02,14.82,12,15,12s0.36,0.02,0.52,0.07l3.55-3.56C19.02,8.35,19,8.18,19,8 c0-1.1,0.9-2,2-2S23,6.9,23,8z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <span>Upgrade</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/active_package') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M20.45,6.55L20.45,6.55c-0.38-0.38-1.01-0.38-1.39,0L16.89,8.7c-0.39,0.38-0.39,1.01,0,1.39l0.01,0.01 c0.39,0.39,1.01,0.39,1.4,0c0.62-0.63,1.52-1.54,2.15-2.17C20.83,7.55,20.83,6.93,20.45,6.55z">
                                </path>
                                <path
                                    d="M12.02,3h-0.03C11.44,3,11,3.44,11,3.98v3.03C11,7.56,11.44,8,11.98,8h0.03C12.56,8,13,7.56,13,7.02V3.98 C13,3.44,12.56,3,12.02,3z">
                                </path>
                                <path
                                    d="M7.1,10.11l0.01-0.01c0.38-0.38,0.38-1.01,0-1.39L4.96,6.54c-0.38-0.39-1.01-0.39-1.39,0L3.55,6.55 c-0.39,0.39-0.39,1.01,0,1.39c0.63,0.62,1.53,1.54,2.15,2.17C6.09,10.49,6.72,10.49,7.1,10.11z">
                                </path>
                                <path
                                    d="M12,15c-1.24,0-2.31-0.75-2.76-1.83C8.92,12.43,8.14,12,7.34,12L4,12c-1.1,0-2,0.9-2,2l0,5c0,1.1,0.9,2,2,2h16 c1.1,0,2-0.9,2-2v-5c0-1.1-0.9-2-2-2l-3.34,0c-0.8,0-1.58,0.43-1.9,1.17C14.31,14.25,13.24,15,12,15">
                                </path>
                            </g>
                        </g>
                    </svg>
                </span>
                <span>Packages</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('products/products') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M19 3H5c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 6h-3.14c-.47 0-.84.33-.97.78C14.53 11.04 13.35 12 12 12s-2.53-.96-2.89-2.22c-.13-.45-.5-.78-.97-.78H5V6c0-.55.45-1 1-1h12c.55 0 1 .45 1 1v3zm-3.13 7H20c.55 0 1 .45 1 1v2c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2v-2c0-.55.45-1 1-1h4.13c.47 0 .85.34.98.8.35 1.27 1.51 2.2 2.89 2.2s2.54-.93 2.89-2.2c.13-.46.51-.8.98-.8z">
                        </path>
                    </svg>
                </span>
                <span>Products</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('report/pending_orders') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM4 9h10.5v3.5H4V9zm0 5.5h10.5V18H5c-.55 0-1-.45-1-1v-2.5zM19 18h-2.5V9H20v8c0 .55-.45 1-1 1z">
                        </path>
                    </svg>
                </span>
                <span>My Orders</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('report/coupon') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M22 8.54V6c0-1.1-.9-2-2-2H4c-1.1 0-1.99.89-1.99 2v2.54c0 .69.33 1.37.94 1.69C3.58 10.58 4 11.24 4 12s-.43 1.43-1.06 1.76c-.6.33-.94 1.01-.94 1.7V18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-2.54c0-.69-.34-1.37-.94-1.7-.63-.34-1.06-1-1.06-1.76s.43-1.42 1.06-1.76c.6-.33.94-1.01.94-1.7zm-9 8.96h-2v-2h2v2zm0-4.5h-2v-2h2v2zm0-4.5h-2v-2h2v2z">
                        </path>
                    </svg>
                </span>
                <span>Coupons</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('customer/genealogy_list') ?>">
                <span class="dz-icon">
                    <svg height="18" viewBox="0 -8 464 464" width="18" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m360 144h-120v-40c0-4.417969-3.582031-8-8-8s-8 3.582031-8 8v40h-120c-4.417969 0-8 3.582031-8 8v48c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-40h240v40c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-48c0-4.417969-3.582031-8-8-8zm0 0"
                            fill="#f7cc38"></path>
                        <path
                            d="m424 320h-56v-40c0-4.417969-3.582031-8-8-8s-8 3.582031-8 8v40h-56c-4.417969 0-8 3.582031-8 8v48c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-40h112v40c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-48c0-4.417969-3.582031-8-8-8zm0 0"
                            fill="#f7cc38"></path>
                        <path
                            d="m168 320h-56v-40c0-4.417969-3.582031-8-8-8s-8 3.582031-8 8v40h-56c-4.417969 0-8 3.582031-8 8v48c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-40h112v40c0 4.417969 3.582031 8 8 8s8-3.582031 8-8v-48c0-4.417969-3.582031-8-8-8zm0 0"
                            fill="#f7cc38"></path>
                        <path d="m56 192h96v96h-96zm0 0" fill="#60a2d7"></path>
                        <path d="m176 0h112v112h-112zm0 0" fill="#5f7bad"></path>
                        <path d="m408 288h-96v-96h96zm0 0" fill="#60a2d7"></path>
                        <g fill="#92aeba">
                            <path d="m0 368h80v80h-80zm0 0"></path>
                            <path d="m128 368h80v80h-80zm0 0"></path>
                            <path d="m256 368h80v80h-80zm0 0"></path>
                            <path d="m384 368h80v80h-80zm0 0"></path>
                        </g>
                    </svg>
                </span>
                <span>Genealogy</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('report/report_list') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM8 19h12c.55 0 1-.45 1-1s-.45-1-1-1H8c-.55 0-1 .45-1 1s.45 1 1 1zm0-6h12c.55 0 1-.45 1-1s-.45-1-1-1H8c-.55 0-1 .45-1 1s.45 1 1 1zM7 6c0 .55.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1H8c-.55 0-1 .45-1 1z">
                        </path>
                    </svg>
                </span>
                <span>Reports</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="<?php echo base_url('products/services_list') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M6,13c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S8.2,13,6,13z M12,3C9.8,3,8,4.8,8,7s1.8,4,4,4s4-1.8,4-4S14.2,3,12,3z M18,13 c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S20.2,13,18,13z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </span>
                <span>Service Management</span>
            </a>
        </li>
        <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">
            <a href="<?php echo base_url('dashboard/welcomeLetter') ?>" class="nav-link">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z">
                        </path>
                    </svg>
                </span>
                <span>Welcome Letter</span>
            </a>
        </li>
        <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">
            <a href="<?php echo base_url('dashboard/visiting_card') ?>" class="nav-link">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z">
                        </path>
                    </svg>
                </span>
                <span>Visiting Card</span>
            </a>
        </li>
        <li class="nav-label">Settings</li>
        <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">
            <a href="<?php echo base_url('settings/password') ?>" class="nav-link">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon" fill="inherit">
                        <g stroke="none" stroke-width="1" fill="inherit" fill-rule="evenodd">
                            <path
                                d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z"
                                fill="inherit" fill-rule="nonzero" opacity="1"
                                transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) ">
                            </path>
                        </g>
                    </svg>
                </span>
                <span>Change Password</span>
            </a>
        </li>
        <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">
            <a href="<?php echo base_url('settings/profile') ?>" class="nav-link">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z">
                        </path>
                    </svg>
                </span>
                <span>Profile</span>
            </a>
        </li>
        <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">
            <a href="<?php echo base_url('dashboard/logout') ?>" class="nav-link">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <g clip-path="url(#A)">
                            <path
                                d="M23.561 6.622L19.5 10.683c-.293.293-.677.439-1.061.439s-.768-.146-1.061-.439a1.5 1.5 0 0 1 0-2.121l1.5-1.5H3.153a1.5 1.5 0 1 1 0-3h15.726l-1.5-1.5a1.5 1.5 0 0 1 0-2.121 1.5 1.5 0 0 1 2.121 0l4.061 4.061a1.5 1.5 0 0 1 0 2.121zm-3.533 10.317H5.122l1.5-1.5a1.5 1.5 0 0 0-2.121-2.121L.44 17.378a1.5 1.5 0 0 0 0 2.121l4.061 4.061c.293.293.677.439 1.061.439s.768-.146 1.061-.439a1.5 1.5 0 0 0 0-2.121l-1.5-1.5h14.906a1.5 1.5 0 1 0 0-3z"
                                fill="#7d8fab"></path>
                        </g>
                        <defs>
                            <clipPath id="A">
                                <path fill="#fff" d="M0 0h24v24H0z"></path>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
                <span>Logout</span>
            </a>
        </li>
    </ul>
    <?php } else{ ?>
    <ul class="nav navbar-nav">
        <li class="nav-label">Main Menu</li>

        <li>
            <a class="nav-link" href="<?php echo base_url('/') ?>">
                <span class="dz-icon">
                    <svg xmlns="www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path
                            d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z" />
                    </svg>
                </span>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="<?php echo base_url('dashboard/active_package') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M20.45,6.55L20.45,6.55c-0.38-0.38-1.01-0.38-1.39,0L16.89,8.7c-0.39,0.38-0.39,1.01,0,1.39l0.01,0.01 c0.39,0.39,1.01,0.39,1.4,0c0.62-0.63,1.52-1.54,2.15-2.17C20.83,7.55,20.83,6.93,20.45,6.55z">
                                </path>
                                <path
                                    d="M12.02,3h-0.03C11.44,3,11,3.44,11,3.98v3.03C11,7.56,11.44,8,11.98,8h0.03C12.56,8,13,7.56,13,7.02V3.98 C13,3.44,12.56,3,12.02,3z">
                                </path>
                                <path
                                    d="M7.1,10.11l0.01-0.01c0.38-0.38,0.38-1.01,0-1.39L4.96,6.54c-0.38-0.39-1.01-0.39-1.39,0L3.55,6.55 c-0.39,0.39-0.39,1.01,0,1.39c0.63,0.62,1.53,1.54,2.15,2.17C6.09,10.49,6.72,10.49,7.1,10.11z">
                                </path>
                                <path
                                    d="M12,15c-1.24,0-2.31-0.75-2.76-1.83C8.92,12.43,8.14,12,7.34,12L4,12c-1.1,0-2,0.9-2,2l0,5c0,1.1,0.9,2,2,2h16 c1.1,0,2-0.9,2-2v-5c0-1.1-0.9-2-2-2l-3.34,0c-0.8,0-1.58,0.43-1.9,1.17C14.31,14.25,13.24,15,12,15">
                                </path>
                            </g>
                        </g>
                    </svg>
                </span>
                <span>Packages</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="<?php echo base_url('products/products') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path
                            d="M19 3H5c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 6h-3.14c-.47 0-.84.33-.97.78C14.53 11.04 13.35 12 12 12s-2.53-.96-2.89-2.22c-.13-.45-.5-.78-.97-.78H5V6c0-.55.45-1 1-1h12c.55 0 1 .45 1 1v3zm-3.13 7H20c.55 0 1 .45 1 1v2c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2v-2c0-.55.45-1 1-1h4.13c.47 0 .85.34.98.8.35 1.27 1.51 2.2 2.89 2.2s2.54-.93 2.89-2.2c.13-.46.51-.8.98-.8z">
                        </path>
                    </svg>
                </span>
                <span>Products</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="<?php echo base_url('services/all_services') ?>">
                <span class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                        viewBox="0 0 24 24" width="24px" fill="#000000">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M6,13c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S8.2,13,6,13z M12,3C9.8,3,8,4.8,8,7s1.8,4,4,4s4-1.8,4-4S14.2,3,12,3z M18,13 c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S20.2,13,18,13z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </span>
                <span>Services</span>
            </a>
        </li>
    </ul>
    <?php } ?>
    <div class="sidebar-bottom">
        <h6 class="name"><?= PROJECT_NAME ?></h6>
        <span class="ver-info">App Version 1.0</span>
    </div>
</div>
<!-- Sidebar End -->