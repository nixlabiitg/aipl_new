<?php
class Franchise_model extends CI_Model{

    // Total Sponsor Commission
    public function total_sponsor_income($user){
        return $this->db->select_sum('credit')
            ->where('customer_id', $user)
            ->where('income_type_id', 33) // Franchise Refer Commission
            ->get('customer_transaction_master')
            ->row()->credit;
    }

    // Remuneration (Rs. 10,000 per direct)
    public function total_remuneration($user){
        return $this->db->select_sum('credit')
            ->where('customer_id', $user)
            ->where('income_type_id', 33)
            ->like('remarks', 'Remuneration')
            ->get('customer_transaction_master')
            ->row()->credit;
    }

    // Monthly Incentive
    public function total_incentive($user){
        return $this->db->select_sum('credit')
            ->where('customer_id', $user)
            ->where('income_type_id', 33)
            ->like('remarks', 'Incentive')
            ->get('customer_transaction_master')
            ->row()->credit;
    }

    // QR Benefit
    public function total_qr_benefit($user){
        return $this->db->select_sum('credit')
            ->where('customer_id', $user)
            ->where('income_type_id', 33)
            ->like('remarks', 'QR')
            ->get('customer_transaction_master')
            ->row()->credit;
    }

    // Sponsor Income (list)
    public function get_sponsor_income($user){
        return $this->db->query("
            SELECT credit, vc_date, remarks
            FROM customer_transaction_master
            WHERE customer_id = '$user'
            AND income_type_id = 33
            ORDER BY id DESC
        ")->result_array();
    }

    // Franchise Income Statement
    public function get_income_statement($user, $from, $to){
        return $this->db->query("
            SELECT 
                ct.credit,
                ct.vc_date,
                it.income_name,
                ct.remarks,
                u.name AS member_name,
                u.mobile AS member_mobile
            FROM customer_transaction_master ct
            JOIN income_type_master it ON it.income_type_id = ct.income_type_id
            LEFT JOIN customer_master u ON u.customer_id = SUBSTRING_INDEX(ct.remarks, ' ', -1)
            WHERE ct.income_type_id = 33
            AND ct.customer_id = '$user'
            AND ct.vc_date BETWEEN '$from 00:00:00' AND '$to 23:59:59'
            ORDER BY ct.id DESC
        ")->result_array();
    }
}
