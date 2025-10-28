<!-- Page Content -->
<div class="page-content bottom-content ">
        <div class="container profile-area">
            <div class="profile">	
				<div class="d-flex align-items-center mb-3">
					<div class="media media-70 me-3">
                        <?php $userid = $this->session->userdata("aiplAppId"); ?>
						<img src="<?php echo base_url('../uploads/profile/'.$userid.'.png') ?>" alt="/">
					</div>
					<div class="about-profile">
						<h5 class="sub-title mb-0"><?= $this->session->userdata("aiplAppName") ?></h5>
						<h6 class="sub-title fade-text mb-1 font-w500"><?= $this->session->userdata("aiplAppEmail") ?></h6>
						<h6 class="sub-title fade-text mb-0 font-w500"><?= $this->session->userdata("aiplAppId") ?></h6>
					</div>
					<a href="<?php echo base_url('settings/edit_profile') ?>" class="edit-profile">
						<i class="fa-solid fa-pencil"></i>
					</a>
				</div>
				<!-- <div class="location-box">
					<i class="location fa-solid fa-location-dot"></i>
					<div class="flex-1">
						<h6 class="text-white font-w400 mb-0">324002</h6>
						<h6 class="text-white font-w400 mb-0">UK - 324002</h6>
					</div>
					<a href="javascript:void(0);" class="change-btn">Change</a>
				</div>		 -->
			</div>   
			<div class="profile-content border-0">
				<ul>
					<li>
						<a href="<?php echo base_url('report/my_id_card') ?>">
							<i class="fa-solid fa-user"></i>
							ID Card
							<i class="fa-solid fa-angle-right ms-auto"></i>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url('report/pending_orders') ?>">
							<i class="fa-solid fa-clock"></i>
							My Orders
							<i class="fa-solid fa-angle-right ms-auto"></i>
						</a>
					</li>
					
					<li>
						<a href="<?php echo base_url('dashboard/notifications') ?>">
							<i class="fa-solid fa-bell"></i>
							Notification
							<span class="badge badge-circle align-items-center badge-danger ms-auto">1</span>	
							<i class="fa-solid fa-angle-right ms-2"></i>
						</a>
					</li>
					
					<li class="border-0">
						<a href="<?php echo base_url('dashboard/logout') ?>">
							<i class="fa-solid fa-power-off"></i>
							LogOut
							<i class="fa-solid fa-angle-right ms-auto"></i>
						</a>
					</li>
				</ul>
			</div>
        </div>
    </div>
    <!-- Page Content End-->