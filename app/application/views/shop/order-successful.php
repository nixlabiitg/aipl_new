
<!DOCTYPE html>
<html lang="en">
<head>
    
	<!-- Base url -->
	<base href="../">
	
    <!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	
	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('../') ?>assets/app/images/favicon.png">
    
    <!-- Title -->
	<title><?= PROJECT_NAME ?></title>
	
    
	<!-- Global CSS -->
	<link href="<?php echo base_url('../') ?>assets/app/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('../') ?>assets/app/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
</head>   
<body data-theme-color="color-green">
<div class="page-wraper">
    
    <!-- Preloader -->
    <div id="preloader">
		<div class="loader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
    <!-- Preloader end-->
    
    <!-- Page Content -->
	<div class="page-content">
		<!-- MAKE PAYMENT -->
		<div class="payment-confirm-wrapper">
			<div class="payment-box">
				<i class="fa-solid fa-check mb-4"></i>
				<h5 class="text-white">Order Successful!</h5>
				<a href="<?php echo base_url('report/pending_orders') ?>" class="delivery-btn mx-auto">Delivery Status
					<span class="next ms-auto">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.25005 20.25C8.05823 20.25 7.86623 20.1767 7.7198 20.0303C7.42673 19.7372 7.42673 19.2626 7.7198 18.9698L14.6895 12L7.7198 5.03025C7.42673 4.73719 7.42673 4.26263 7.7198 3.96975C8.01286 3.67688 8.48742 3.67669 8.7803 3.96975L16.2803 11.4698C16.5734 11.7628 16.5734 12.2374 16.2803 12.5303L8.7803 20.0303C8.63386 20.1767 8.44186 20.25 8.25005 20.25Z" fill="#fff"/>
						</svg>
					</span>
				</a>
			</div>
		</div>
		<!-- MAKE PAYMENT -->
	</div>
    <!-- Page Content End-->
</div>
<!--**********************************
    Scripts
***********************************-->
<script src="<?php echo base_url('../') ?>assets/app/js/jquery.js"></script>
<script src="<?php echo base_url('../') ?>assets/app/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('../') ?>assets/app/js/settings.js"></script>
<script src="<?php echo base_url('../') ?>assets/app/js/custom.js"></script>
</body>
</html>