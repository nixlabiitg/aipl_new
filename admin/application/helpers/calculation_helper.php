<?php
    // Performance income
    function calculate_repuchase_amount($member_id){
        $date = date('Y-m-d');
        $repurchase_amount = 0;

        $C = &get_instance();
        $sql = $C->db->query("SELECT * FROM `customer_master` WHERE `sponsor_id` = '".$member_id."'");
        $direct_downline_members = $sql->result();

        foreach($direct_downline_members as $data){
            $direct_member_id = $data->customer_id;
            $repurchase_amount += total_repurchase($direct_member_id, $date);
            $repurchase_amount += calculate_repuchase_amount($direct_member_id);
        }

        return $repurchase_amount;
    }

    function total_repurchase($direct_member, $date){
        $month = date('Y-m', strtotime($date));
        $C = &get_instance();
        $product_price = 0;
        $sql = $C->db->query("SELECT * FROM `order_master` WHERE date_format(`order_date`, '%Y-%m') = '".$month."' AND `status` = '1' AND `user_id` = '".$direct_member."'");
        $orders = $sql->result();

        foreach($orders as $data){
            $order_id = $data->order_id;
            $product_price += find_product_wise_price($order_id);
        }

        return $product_price;
    }

    function find_product_wise_price($order_id){
        $C = &get_instance();
        $price = 0;
        $sql = $C->db->query("SELECT * FROM `order_details` WHERE `order_id` = '$order_id' AND `performance_bonus_status` = '1'");
        $products = $sql->result();
        foreach($products as $data){
            $price += $data->rate * $data->qty;
        }

        return $price;
    }

    // Direct team shopping income
    function calculate_direct_repuchase_amount($memberid){
        $date = date('Y-m-d');
        $repurchase_amount = 0;

        $C = &get_instance();
        $sql = $C->db->query("SELECT * FROM `customer_master` WHERE `sponsor_id` = '".$memberid."'");
        $direct_downline_members = $sql->result();

        foreach($direct_downline_members as $data){
            $direct_member_id = $data->customer_id;
           $repurchase_amount += total_direct_repurchase($direct_member_id, $date);
        }

        return $repurchase_amount;
    }

    function total_direct_repurchase($direct_member, $date){
        $month = date('Y-m', strtotime($date));
        $C = &get_instance();
        $product_price = 0;
        $sql = $C->db->query("SELECT * FROM `order_master` WHERE date_format(`order_date`, '%Y-%m') = '".$month."' AND `status` = '1' AND `user_id` = '".$direct_member."'");
        $orders = $sql->result();

        foreach($orders as $data){
            $order_id = $data->order_id;
            $product_price += find__product_wise_price($order_id);
        }

        return $product_price;
    }

    function find__product_wise_price($order_id){
        $C = &get_instance();
        $price = 0;
        $sql = $C->db->query("SELECT * FROM `order_details` WHERE `order_id` = '$order_id' AND `team_shopping_status` = '1'");
        $products = $sql->result();
        foreach($products as $data){
            $price += $data->rate * $data->qty; 
        }

        return $price;
    }