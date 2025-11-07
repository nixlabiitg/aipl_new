<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestEmail extends CI_Controller {

    public function index() {
        $this->load->library('email');

        $config = array(
            'protocol'    => 'smtp',
            'smtp_host'   => 'ssl://smtp.gmail.com',
            'smtp_port'   => 465,
            'smtp_user'   => 'banajyotidas@gmail.com',
            'smtp_pass'   => 'sodrkqgkuudfojdz', // your Gmail App Password
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'wordwrap'    => TRUE,
            'newline'     => "\r\n",
            'crlf'        => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('banajyotidas@gmail.com', 'Aceaaro India Pvt. Ltd.');
        $this->email->to('nixlabiitg@gmail.com');
        $this->email->subject('Test Email from CodeIgniter');
        $this->email->message('<p>Hello,</p><p>Your registration is successful. Your User ID is TEST@123 and your password is 111111.</p>');

        if($this->email->send()) {
            echo "<h3>Email sent successfully to nixlabiitg@gmail.com!</h3>";
        } else {
            echo "<h3>Email failed to send!</h3>";
            echo "<pre>".$this->email->print_debugger(['headers'])."</pre>";
        }
    }
}
