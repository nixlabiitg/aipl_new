<?php
class Cronjobfranchise extends CI_Controller {

	public function __construct() {
        parent::__construct();
		error_reporting(0);
	}

    public function pay_franchise_income()
    { 
        $this->pay_franchise_interest_income();
        $this->pay_maintenance_cost();
    }

    public function pay_franchise_interest_income(){
        $sql = $this->db->query("SELECT f.*, fpm.digital_wallet FROM `franchise_master` f JOIN franchise_package_master fpm ON fpm.id = f.package_id WHERE f.status = 1");
        $franchise = $sql->result();

        foreach($franchise as $data){
            $approve_date = date('Y-m-d', strtotime($data->app_reject_date));
            $today = date('Y-m-d');

            $date1 = new DateTime($approve_date);
            $date2 = new DateTime($today);

            // Calculate the difference
            $interval = $date1->diff($date2);

            // Get the difference in days
            $days_difference = $interval->days;
            if($days_difference >= 30){
                $franchiseid = $data->franchise_id;
                $digital_wallet_amount = floatval($data->digital_wallet);
                $wallet_amount = floatval($data->wallet);
                $interest_payment_amount = floatval($data->interest_payment);
                $payment_month = intval($data->payment_month);
        
                if($payment_month < 144){
                    $compound_amount = $interest_payment_amount + $digital_wallet_amount;
                    $calculate_interest_amount = floatval($compound_amount) * 2.26 / 100;
        
                    $update_wallet_amount = $wallet_amount + $calculate_interest_amount;
                    $update_interest_payment_amount = $interest_payment_amount + $calculate_interest_amount;
                    $update_payment_month = $payment_month + 1;
        
                    $transaction_data = [
                        'customer_id' => $franchiseid,
                        'credit' => $calculate_interest_amount,
                        'income_type_id' => 27,
                    ];
                    if($this->Crud->ciCreate("customer_transaction_master", $transaction_data)){
                        $this->Crud->ciUpdate("franchise_master", [
                            'wallet' => $update_wallet_amount,
                            'interest_payment' => $update_interest_payment_amount,
                            'payment_month' => $update_payment_month,
                        ], "`franchise_id` = '$franchiseid'");
                    }
                }
            }
        }
    }

    public function pay_maintenance_cost(){
        $franchise = $this->Crud->ciRead("franchise_master", "`status` = 1 AND `maintenance_cost_month` < 25 AND `app_reject_date` <= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");

        foreach($franchise as $data){
            $franchise_id = $data->franchise_id;
            $package_id = $data->package_id;
            $total_maintenance_cost = $data->total_maintenance_cost;
            $maintenance_cost_month = $data->maintenance_cost_month;
            $main_wallet = $data->wallet;


            $package = $this->Crud->ciRead("franchise_package_master", "`id` = '$package_id'");
            $maintenance_cost = $package[0]->maintain_cost;

            $updated_total_maintenance_cost = floatval($total_maintenance_cost) + floatval($maintenance_cost);
            $updated_maintenance_cost_month = intval($maintenance_cost_month) + 1;
            $updated_main_wallet = floatval($main_wallet) + floatval($maintenance_cost);

            $data = [
                'customer_id' => $franchise_id,
                'credit' => $maintenance_cost,
                'vc_date' => date('Y-m-d H:i:s'),
                'remarks' => 'Maintenance Cost',
                'income_type_id' => 28
            ];

            if($this->Crud->ciCreate("customer_transaction_master", $data)){
                $this->Crud->ciUpdate("franchise_master", [
                    'wallet' => $updated_main_wallet,
                    'total_maintenance_cost' => $updated_total_maintenance_cost,
                    'maintenance_cost_month' => $updated_maintenance_cost_month,
                ], "`franchise_id` = '$franchise_id'");
            }
        }
    }
}