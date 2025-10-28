<?php
   $contact = $this->Crud->ciRead("contact_info", "`id` = '1'");
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!--
    Basic Page Needs
    ==================================================
    -->
    <meta charset="utf-8">
    <title><?= PROJECT_NAME ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('') ?>portal_assets/images/logo.png" />
    <!--
    Mobile Specific Metas
    ==================================================
    -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--
    CSS
    ==================================================
    -->
    <!-- Bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/bootstrap.min.css">
    <!-- Animation-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/animate.css">
    <!-- Morris CSS -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/morris.css">
    <!-- FontAwesome-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/font-awesome.min.css">
    <!-- Icon font-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/icon-font.css">
    <!-- Owl Carousel-->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/owl.carousel.min.css">
    <!-- Owl Theme -->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/owl.theme.default.min.css">
    <!-- Colorbox-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/colorbox.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/style.css">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/responsive.css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file.-->
    <!--if lt IE 9
    script(src='<?php echo base_url('') ?>assets/js/html5shiv.js')
    script(src='<?php echo base_url('') ?>assets/js/respond.min.js')
    -->
</head>

<body>
    <div class="body-inner">
        <div class="site-top-2">
            <header class="header nav-down" id="header-2">
                <div class="container">
                    <div class="row">
                        <div class="logo-area clearfix">
                            <div class="logo col-lg-3 col-md-12 text-center">
                                <a href="<?php echo base_url('/') ?>">
                                    <img src="<?php echo base_url('') ?>portal_assets/images/logo.png" alt="" style="height:120px;">
                                </a>
                            </div>
                            <!-- logo end-->
                            <div class="col-lg-9 col-md-12 pull-right">
                                <ul class="top-info unstyled">
                                    <li><span class="info-icon"><i class="icon icon-phone3"></i></span>
                                        <div class="info-wrapper">
                                            <p class="info-title">24/7 Response Time</p>
                                            <p class="info-subtitle" style="font-size : 13px;"><?php echo '+91 '.substr($contact[0]->phone, 0, 3).'-'.substr($contact[0]->phone, 3, 3).'-'.substr($contact[0]->phone, 6, 4); ?></p>
                                        </div>
                                    </li>
                                    <li><span class="info-icon"><i class="icon icon-envelope"></i></span>
                                        <div class="info-wrapper">
                                            <p class="info-title">Send Your Query</p>
                                            <p class="info-subtitle" style="font-size : 13px;"><?= $contact[0]->email ?></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Col End-->
                        </div>
                        <!-- Logo Area End-->
                    </div>
                </div>
                <!-- Container end-->
                <div class="site-nav-inner site-navigation navigation navdown">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation"><span
                                    class="navbar-toggler-icon"><i class="icon icon-menu"></i></span></button>
                            <!-- End of Navbar toggler-->
                            <div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li
                                        class="nav-item dropdown <?= $this->uri->segment(1) == '' ?  'active' : ($this->uri->segment(1) == 'index' ?  'active' : '') ?>">
                                        <a class="nav-link" href="<?php echo base_url('/') ?>">Home</a>
                                    </li>
                                    <!-- li end-->
                                    <li
                                        class="nav-item dropdown <?= $this->uri->segment(1) == 'about' ?  'active' : ($this->uri->segment(1) == 'mission' ? 'active' : ($this->uri->segment(1) == 'vision' ? 'active' : ($this->uri->segment(1) == 'faq' ? 'active' : ($this->uri->segment(1) == 'company_plan' ? 'active' : '')))) ?>">
                                        <a class="nav-link" href="#" data-toggle="dropdown">About<i
                                                class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url('/about') ?>">About Us </a></li>
                                            <li><a href="<?php echo base_url('/mission') ?>">Mission </a></li>
                                            <li><a href="<?php echo base_url('/vision') ?>">Vision </a></li>
                                            <li><a href="<?php echo base_url('/company_documents') ?>">Company
                                            Documents </a></li>
                                            <li><a href="<?php echo base_url('/faq') ?>">FAQ </a></li>
                                        </ul>
                                    </li>
                                    <!-- li end-->
                                    <li
                                        class="nav-item dropdown <?= $this->uri->segment(1) == 'packages' ?  'active' : '' ?>">
                                        <a class="nav-link" href="<?php echo base_url('/packages') ?>">Packages</a>
                                    </li>
                                    <!-- li end-->
                                    <li
                                        class="nav-item dropdown <?= $this->uri->segment(1) == 'gallery' ?  'active' : '' ?>">
                                        <a class="nav-link" href="#" data-toggle="dropdown">Gallery<i
                                                class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php
                                            $gallery = $this->Crud->ciRead("galler_category", "`id` != '0'");
                                            foreach($gallery as $key){
                                            ?>
                                            <li><a href="<?php echo base_url('gallery?id='.$key->id) ?>"><?= $key->gallery_category ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <!-- li end-->
                                    <li
                                        class="nav-item dropdown <?= $this->uri->segment(1) == 'shop' ?  'active' : '' ?>">
                                        <a class="nav-link" href="<?php echo base_url('/shop') ?>">Shop</a>
                                    </li>
                                    <!-- li end-->
                                    <li class="nav-item dropdown <?= $this->uri->segment(1) == 'Service' ?  'active' : '' ?>">
                                        <a class="nav-link" href="<?php echo base_url('/service') ?>">Service</a>
                                    </li>
                                    <?php if(!$this->session->userdata('aiplUserId')){ ?>
                                    <li class="nav-item dropdown"><a class="nav-link"
                                            href="<?php echo base_url('/faq') ?>" data-toggle="dropdown">Login<i
                                                class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url('/authentication/login') ?>">User Login</a>
                                            </li>
                                            <li><a target="_blank" href="<?php echo base_url('/franchise') ?>">Franchise
                                                    Login</a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <!-- li end-->
                                    <li
                                        class="nav-item dropdown <?= $this->uri->segment(1) == 'downloads' ?  'active' : '' ?>">
                                        <a class="nav-link" href="#" data-toggle="dropdown">Downloads<i
                                                class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php
                                                $DOWNLOADS = $this->Crud->ciRead("download_master", "`download_type` = 'joining_form'");
                                                $DOWNLOADS2 = $this->Crud->ciRead("download_master", "`download_type` = 'price_list'");
                                                $DOWNLOADS3 = $this->Crud->ciRead("download_master", "`download_type` = 'training_list'");
                                            ?>
                                            <li><a target="_blank" href="<?= $DOWNLOADS[0]->download_file != '' ? base_url('uploads/tiesup/'.$DOWNLOADS[0]->download_file) : '#' ?>">Joining Form </a></li>
                                            <li><a target="_blank" href="<?= $DOWNLOADS[0]->download_file != '' ? base_url('uploads/tiesup/'.$DOWNLOADS2[0]->download_file) : '#' ?>">Product Price List </a></li>
                                            <li><a target="_blank" href="<?= $DOWNLOADS[0]->download_file != '' ? base_url('uploads/tiesup/'.$DOWNLOADS3[0]->download_file) : '#' ?>">Training List </a></li>
                                        </ul>
                                    </li>
                                    <li
                                        class="nav-item dropdown">
                                        <a class="nav-link" href="#" data-toggle="dropdown">More<i
                                                class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url('/franchises') ?>">Franchise </a></li>
                                            <li><a href="<?php echo base_url('/benefits') ?>">Benifits </a></li>
                                            <li><a href="<?php echo base_url('/contact') ?>">Contact Us</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item dropdown"><a class="nav-link"
                                            href="<?php echo base_url('/faq') ?>" data-toggle="dropdown">
                                            <img src="<?php echo base_url('assets/images/live.webp') ?>" alt="" style="height: 40px;"></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="https://youtube.com/@AIPLLive" target="_blank"><i class="fa fa-youtube text-danger"></i> Youtube</a>
                                            </li>
                                            <li><a href="https://facebook.com/aipllive24X7/" target="_blank" href="<?php echo base_url('/franchise') ?>"><i class="fa fa-facebook-official text-info"></i> Facebook</a></li>
                                        </ul>
                                    </li>

                                    <?php if($this->session->userdata('aiplUserId')){ ?>
                                    <li class="nav-item dropdown"><a class="nav-link"
                                            href="<?php echo base_url('/faq') ?>" data-toggle="dropdown">My Account<i
                                                class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo base_url('/dashboard/index') ?>">Dashboard</a>
                                            </li>
                                            <li><a href="<?php echo base_url('/') ?>">My Profile</a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <!--Nav ul end-->
                            </div>
                            <?php if(!$this->session->userdata('aiplUserId')){ ?>
                            <a href="<?php echo base_url('/registration') ?>"
                                class="top-right-btn btn btn-primary">Customer Registration</a>
                            <?php }else{ ?>
                                <a href="<?php echo base_url('/cart') ?>"
                                class="top-right-btn btn btn-success"><i class="icon icon-cart"></i> My Cart (<span id='cart' class="text-warning">
                                    <?php 
                                        $userid = $this->session->userdata('aiplUserId');
                                        $sql="SELECT sum(`qty`) as qt  FROM `cart_master` WHERE `user_id`='$userid' and `status`='0'";
                                        $query=$this->db->query($sql);

                                        echo $cart =$query->result_array()[0]['qt'] ?? 0;//$this->Crud->ciCount("cart_master", "`user_id` = '$userid' AND `status` = '0'");
                                    ?>
                                </span>)</a>
                            <?php } ?>
                            <!-- Top bar btn -->
                        </nav>
                        <!-- Collapse end-->
                    </div>
                </div>
                <!-- Site nav inner end-->
            </header>
            <!-- Header end-->
        </div>