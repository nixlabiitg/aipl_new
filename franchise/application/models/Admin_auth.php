<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth extends CI_Model {

    public function checkLogin($email, $password, $operatingSystem, $browser) {

        $this->db->where('user_email', $email)->or_where('user_phone', $email)->or_where('customer_id', $email);
        $this->db->where('user_type', '3');

        $query = $this->db->get('user_master');

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $key) {

                $decPassword = $this->encryption->decrypt($key->password);

                if ($decPassword == $password) {

                    if ($key->status == 1) {

                        $loginData = [

                            'user_id' => $key->user_id,

                            'user_role' => $key->user_type,

                            'os' => $operatingSystem,

                            'browser' => $browser,

                            'ip' => $_SERVER['REMOTE_ADDR'],

                            'login_date' => date('Y-m-d'),

                            'login_time' => date('H:i:s')


                        ];

                        $this->db->insert('login_history', $loginData);

                        $this->session->set_userdata('aiplFranchiseId', $key->customer_id);

                        $this->session->set_userdata('aiplFranchiseEmail', $key->user_email);

                        $this->session->set_userdata('role', $key->user_type);

                        $this->session->set_userdata('aiplFranchiseName', $key->user_name);
                        
                        $this->session->set_userdata('aiplFranchiseUserId', $key->user_id,);

                    } else {

                        return "Email not verified";

                    }

                } else {

                    return 'Incorrect password';

                }

            }

        } else {

            return "Invalid username";

        }

    }

}

?>