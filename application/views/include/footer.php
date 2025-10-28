<?php
   $contact = $this->Crud->ciRead("contact_info", "`id` = '1'");
?>
<!-- Footer start-->
<section id="call-to-action" class="call-to-action-bg bg-warning border-0 rounded-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 align-self-center">
                <h3 class="call-to-action-title">Download our AIPL user app</h3>
                <p>
                We will deal with your failure that determines how you achieve success.
                </p>
            </div>
            <div class="col-lg-4 text-right">
                <!--<a class="btn border-0" target="_blank" href="https://play.google.com/store/apps/details?id=co.median.android.pdqydo">
                    <img src="<?php echo base_url('assets/images/app-download.png') ?>" style="width:100%;" alt="">
                </a>-->
                <a class="btn border-0" target="_blank" href="<?php echo base_url('assets/app/aipl.apk') ?>">
                    <img src="<?php echo base_url('assets/images/app-download.png') ?>" style="width:100%;" alt="">
                </a>
            </div>
        </div>
    </div>
</section>

<footer class="footer" id="footer">
    <div class="footer-main bg-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 footer-widget footer-about">
                    <div class="footer-logo">
                        <img src="<?php echo base_url('') ?>portal_assets/images/logo.png" alt="" style="height:120px;">
                    </div>
                    <p><?= substr(file_get_contents(FCPATH . "admin/content/about.txt"),0,400) ?>...</p>
                </div>
                <!-- About us end-->
                <div class="col-lg-4 col-md-6 footer-widget">
                    <h3 class="widget-title">Quick Links</h3>
                    <ul class="list-dash">
                        <li><a href="<?php echo base_url('/about') ?>">About Us</a></li>
                        <li><a href="<?php echo base_url('/mission') ?>">Mission</a></li>
                        <li><a href="<?php echo base_url('/vision') ?>">Vision</a></li>
                        <li><a href="<?php echo base_url('/contact') ?>">Contact</a></li>
                        <li><a href="<?php echo base_url('/franchises') ?>">Franchise</a></li>
                        <li><a href="<?php echo base_url('/company_plan') ?>">Company Plan</a></li>
                        <li><a href="<?php echo base_url('/packages') ?>">Packages</a></li>
                        <li><a href="<?php echo base_url('/shop') ?>">Shop</a></li>
                        <li><a href="<?php echo base_url('/faq') ?>">FAQs</a></li>
                        <li><a href="<?php echo base_url('/franchise_registration') ?>">Franchise Registration</a></li>
                        <li><a href="<?php echo base_url('/registration') ?>">Customer Registration</a></li>
                        <li><a href="<?php echo base_url('/privacy_policy') ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url('/return_policy') ?>">Return Policy</a></li>
                        <li><a href="<?php echo base_url('/terms_and_condition') ?>">Terms and Condition</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 footer-widget">
                    <h3 class="widget-title">Company Locations</h3>
                    <div class="ts-contact-info"><span class="ts-contact-icon float-left"><i
                                class="icon icon-map-marker2"></i></span>
                        <div class="ts-contact-content">
                            <h3 class="ts-contact-title">Address</h3>
                            <p><?= $contact[0]->address ?></p>
                        </div>
                        <!-- Contact content end-->
                    </div>

                    <div class="ts-contact-info last"><span class="ts-contact-icon float-left"><i
                                class="icon icon-envelope"></i></span>
                        <div class="ts-contact-content">
                            <h3 class="ts-contact-title">Email Address</h3>
                            <p><?= $contact[0]->email ?></p>
                            <p><?= $contact[0]->email2 ?></p>
                        </div>
                        <!-- Contact content end-->
                    </div>
                    <div class="ts-contact-info"><span class="ts-contact-icon float-left"><i
                                class="icon icon-phone3"></i></span>
                        <div class="ts-contact-content">
                            <h3 class="ts-contact-title">Phone Number</h3>
                            <p><?php echo '+91 '.substr($contact[0]->phone, 0, 3).'-'.substr($contact[0]->phone, 3, 3).'-'.substr($contact[0]->phone, 6, 4); ?>
                            </p>
                            <p><?php echo '+91 '.substr($contact[0]->phone2, 0, 3).'-'.substr($contact[0]->phone2, 3, 3).'-'.substr($contact[0]->phone2, 6, 4); ?>
                            </p>
                        </div>
                        <!-- Contact content end-->
                    </div>
                </div>
            </div>
            <!-- Content row end-->
        </div>
        <!-- Container end-->
    </div>
    <!-- Footer Main-->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="copyright-info"><span>Copyright © <?= date('Y') ?> <?= PROJECT_NAME ?></span></div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="footer-social text-right">
                        <ul>
                            <li><a target="_blank" href="<?= $contact[0]->facebook ?>"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="<?= $contact[0]->twitter ?>"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a target="_blank" href="https://wa.me/+91<?= $contact[0]->whatsapp ?>"><i
                                        class="fa fa-whatsapp"></i></a></li>
                            <li><a target="_blank" href="<?= $contact[0]->instagram ?>"><i
                                        class="fa fa-instagram"></i></a></li>
                            <li><a target="_blank" href="<?= $contact[0]->youtube_link ?>"><i
                                        class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Row end-->
        </div>
        <!-- Container end-->
    </div>
    <!-- Copyright end-->
</footer>
<!-- Footer end-->

<div class="back-to-top affix" id="back-to-top" data-spy="affix" data-offset-top="10">
    <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-double-up"></i>
        <!-- icon end-->
    </button>
    <!-- button end-->
</div>
<!-- End Back to Top-->

<!--
      Javascript Files
      ==================================================
      -->
<!-- initialize jQuery Library-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/jquery.js"></script>


<!-- Bootstrap jQuery-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/bootstrap.min.js"></script>
<!-- Owl Carousel-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/owl.carousel.min.js"></script>
<!-- Counter-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/jquery.counterup.min.js"></script>
<!-- Waypoints-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/waypoints.min.js"></script>
<!-- Color box-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/jquery.colorbox.js"></script>


<!-- Template custom-->
<script type="text/javascript" src="<?php echo base_url('') ?>assets/js/custom.js"></script>
</div>
<!--Body Inner end-->
</body>

</html>