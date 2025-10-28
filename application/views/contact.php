<?php
    if ($_POST) {
        if ($_POST) {
          $visitor_name = "";
          $visitor_email = "";
          $visitor_subject = "";
          $visitor_message = "";
      
      
          if (isset($_POST['name'])) {
            $visitor_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
          }
      
          if (isset($_POST['email'])) {
            $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
            $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
          }

          if (isset($_POST['subject'])) {
            $visitor_subject = htmlspecialchars($_POST['subject']);
        }
      
          if (isset($_POST['message'])) {
            $visitor_message = htmlspecialchars($_POST['message']);
          }
      
      
          $recipient = "aceaaroindia@gmail.com";
      
          $headers  = 'MIME-Version: 1.0' . "\r\n"
            . 'Content-type: text/html; charset=utf-8' . "\r\n"
            . 'From: ' . $visitor_email . "\r\n";
      
          $email_content = "<html><body style='align-items:center; justify-content:center;'>";
          $email_content .= "<table style='font-family: Arial;'><thead><tr><td style='background: #eee; padding: 10px; font-weight:bold;' colspan='2'>Mail From Contact Form : WEBSITE</td><thead></tr>";
          $email_content .= "<tbody><tr><td style='background: #eee; padding: 10px;'>Visitor Name</td><td style='background: #fda; padding: 10px;'>$visitor_name</td></tr>";
          $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Visitor Email</td><td style='background: #fda; padding: 10px;'>$visitor_email</td></tr>";
          $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Visitor Subject</td><td style='background: #fda; padding: 10px;'>$visitor_subject</td></tr>";
          $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Visitor Message</td><td style='background: #fda; padding: 10px;'>$visitor_message</td></tr></tbody></table>";
          $email_content .= '</body></html>';
      
        //   echo $email_content;
      
          if (mail($recipient, "Mail From Website Contact Form", $email_content, $headers)) {
            echo '<script>alert("Message sent Successfully")</script>';
          } else {
            echo '<script>alert("We are sorry, contact email did not go through.")</script>';
          }
        }
      }
?>
<div class="banner-area" id="banner-area"
    style="background-image:url(<?php echo base_url('') ?>assets/images/banner/banner1.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="banner-heading">
                    <h1 class="banner-title">Contact</h1>
                    <ol class="breadcrumb">
                        <li>Home</li>
                        <li><a href="#">Contact</a></li>
                    </ol>
                </div>
            </div>
            <!-- Col end-->
        </div>
        <!-- Row end-->
    </div>
    <!-- Container end-->
</div>
<!-- Banner area end-->

<section class="main-container contact-area" id="main-container">
    <div class="contact-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d229225.54440678548!2d91.5627956900343!3d26.14298086204037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a5a287f9133ff%3A0x2bbd1332436bde32!2sGuwahati%2C%20Assam!5e0!3m2!1sen!2sin!4v1675235017238!5m2!1sen!2sin"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="gap-60"></div>
    <div class="ts-form form-boxed" id="ts-form">
        <div class="container">
            <div class="row">
                <div class="contact-wrapper full-contact">
                    <div class="col-lg-6">
                        <div
                            style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                            <h3 class="column-title">Contact Us</h3>
                            <p class="contact-content">We are here to help answer your questions about AIPL and the
                                products &amp; Services we run.</p>
                            <div class="contact-info-box contact-box info-box ">
                                <div class="contact-info">
                                    <?php
                                    $contact = $this->Crud->ciRead("contact_info", "`id` = '1'");
                                ?>
                                    <div class="ts-contact-info"><span class="ts-contact-icon float-left"><i
                                                class="icon icon-map-marker2"></i></span>
                                        <div class="ts-contact-content">
                                            <h3 class="ts-contact-title">Find Us</h3>
                                            <p><?= $contact[0]->address ?></p>
                                        </div>
                                        <!-- Contact content end-->
                                    </div>
                                    <div class="ts-contact-info"><span class="ts-contact-icon float-left"><i
                                                class="icon icon-phone3"></i></span>
                                        <div class="ts-contact-content">
                                            <h3 class="ts-contact-title">Call Us</h3>
                                            <p><?php echo '+91 '.substr($contact[0]->phone, 0, 3).'-'.substr($contact[0]->phone, 3, 3).'-'.substr($contact[0]->phone, 6, 4); ?>
                                            </p>
                                            <p><?php echo '+91 '.substr($contact[0]->phone2, 0, 3).'-'.substr($contact[0]->phone2, 3, 3).'-'.substr($contact[0]->phone2, 6, 4); ?>
                                            </p>
                                        </div>
                                        <!-- Contact content end-->
                                    </div>
                                    <div class="ts-contact-info last"><span class="ts-contact-icon float-left"><i
                                                class="icon icon-envelope"></i></span>
                                        <div class="ts-contact-content">
                                            <h3 class="ts-contact-title">Mail Us</h3>
                                            <p><?= $contact[0]->email ?></p>
                                            <p><?= $contact[0]->email2 ?></p>
                                        </div>
                                        <!-- Contact content end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact info end -->
                    <div class="col-lg-6">
                        <div
                            style="background: linear-gradient(to bottom, #FCEFD7, #F8D9B7); padding: 20px; border-radius: 10px;">
                            <h3 class="column-title">Contact Now</h3>
                            <div class="contact-submit-box contact-box form-box">
                                <form class="contact-form" action="#" method="POST">
                                    <div class="error-container"></div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control form-name border-dark" id="name" name="name"
                                                    placeholder="Full Name" type="text" required="">
                                            </div>
                                        </div>
                                        <!-- Col end-->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control form-email border-dark" id="email" name="email"
                                                    placeholder="Email" type="email" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control form-website border-dark" id="subject" name="subject"
                                                    placeholder="Subject" type="text" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea class="form-control form-message required-field border-dark" id="message"
                                                    name="message" placeholder="Message" rows="8"></textarea>
                                            </div>
                                        </div>
                                        <!-- Col 12 end-->
                                    </div>
                                    <!-- Form row end-->
                                    <button class="btn btn-primary tw-mt-30" type="submit"><i
                                            class="fa fa-paper-plane-o"></i> Send Massage</button>
                                </form>
                                <!-- Form end-->
                            </div>
                        </div>
                    </div>
                    <!-- Contact form end -->
                </div>
            </div>
        </div>
    </div>
</section>