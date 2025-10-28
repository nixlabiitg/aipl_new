<?php

class Cronjobmt extends CI_Controller {

	public function __construct() {
        parent::__construct();
		error_reporting(0);
        $this->load->helper('calculation_helper');
	}

    public function cronjobmt()
    {        
       
        $cur_date = Date("Y-m-d");       
        $ldate= date("Y-m-t", strtotime($cur_date));      
        $day = date('l', strtotime($cur_date));        
        if($cur_date==$ldate)
        {
            $this->monthly_repurchase_income();
            $this->direct_club_bonus();
            $this->calculate_monthly_performance_income();
            $this->direct_team_shopping_income();
        } 
        if($day=="Thursday") $this->associate_club_bonus();  

    }



   
    //Direct club bonus
    public function direct_club_bonus()
    {
        //Assistant Director
        $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.club_id=cl.club_id WHERE c.club_id='4'";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $rs)
        {
            $sql="SELECT sum(`credit`) as income FROM customer_transaction_master ct INNER JOIN customer_master c on c.customer_id=ct.customer_id where c.sponsor_id='".$rs['customer_id']."' and c.status='1' and c.club_id='3' and DATE_FORMAT(ct.vc_date,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')";		
        
            $query = $this->db->query($sql);
            $inc = $query->result_array();
            $income=$inc[0]['income'];
            if($income>0)
            {
                $com=round($income*$rs['commission_from_club']/100,2)+$rs['remuneration'];
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Director Club Bonus','13')";
                $this->db->query($sql);        
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
            }
            
        }
        //Director
        $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.club_id=cl.club_id WHERE c.club_id='5'";		
    
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $rs)
        {
            $sql="SELECT sum(`credit`) as income FROM customer_transaction_master ct INNER JOIN customer_master c on c.customer_id=ct.customer_id where c.sponsor_id='".$rs['customer_id']."' and c.status='1' and c.club_id='4' and DATE_FORMAT(ct.vc_date,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')";		
            $query = $this->db->query($sql);
            $inc = $query->result_array();
            $income=$inc[0]['income'];
            if($income>0)
            {
                $com=round($income*$rs['commission_from_club']/100,2)+$rs['remuneration'];
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Director Club Bonus','13')";
                $this->db->query($sql);        
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
            }        
        }
        //Senior Director
        $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.club_id=cl.club_id WHERE c.club_id='6'";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $rs)
        {
            $sql="SELECT sum(`credit`) as income FROM customer_transaction_master ct INNER JOIN customer_master c on c.customer_id=ct.customer_id where c.sponsor_id='".$rs['customer_id']."' and c.status='1' and c.club_id='5' and DATE_FORMAT(ct.vc_date,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')";		
            $query = $this->db->query($sql);
            $inc = $query->result_array();
            $income=$inc[0]['income'];
            if($income>0)
            {
                $com=round($income*$rs['commission_from_club']/100,2)+$rs['remuneration'];
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Director Club Bonus','13')";
                $this->db->query($sql);        
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
            }
            
        }

    }



    //associate club bonus
    public function associate_club_bonus()
    {
        //Assistant Director
        $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.reward_club_id=cl.club_id WHERE c.reward_taken_week<24";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $rs)
         {            
                $com=$rs['remuneration'];
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Reward & Recognition','14')";
                $this->db->query($sql);        
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com.",reward_taken_week=reward_taken_week+1 WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
                   
        }
    }

    
    //Repurchase Income
    //call this at the time of re -purchase $this->repurchaseIncome($sponsorid,0,5,2,1,1,1,$invoiceamt);
    public function repurchaseIncome($sponsorid,$s,$l1,$l2,$l3,$l4,$l5,$invoiceamt)  //S=0 in call
    {
        $k=$s+1;
        $percentage=0;
        $eligible_amount=round($invoiceamt*20/100,2);
        if($k<=5)	
        {
            $sql="SELECT * FROM customer_master  WHERE `customer_id`='".$sponsorid."'";
            
            $query = $this->db->query($sql);
            $result = $query->result_array();
            if($this->db->affected_rows()>0)
            {
                    foreach ($result as $rs) {  
                    
                    if($k==1) $percentage=$l1;
                    else if($k==2) $percentage=$l2;
                    else if($k==3) $percentage=$l3;
                    else if($k==4) $percentage=$l4;
                    else  $percentage=$l5;
                    
                    $comm=round($eligible_amount*$percentage/100,2);
                    if($comm>0)
                    {
                        $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$comm." WHERE `customer_id`='".$sponsorid."'";
                        $this->db->query($sql);    
                        $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$comm."','Repurchase Income','15')";
                        $this->db->query($sql);
                    }				
                    $this->repurchaseIncome($rs['sponsor_id'],$k,$l1,$l2,$l3,$l4,$l5,$invoiceamt);  
                    
                
                }
            }	
        }	
        else
        {
            return;
        }

    }

    //Repurchase Income
    public function monthly_repurchase_income()
    {
        $sql="SELECT sum(`amount`)-sum(`discount_price`) as total from order_master  where DATE_FORMAT(`order_date`,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m') and (`status`> 0 AND `status`< 3)";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $rp=round($result[0]['total']*20/100,2);

        if($rp==0) return;
    
        //all AIPP user commission
        $sql="SELECT * FROM `customer_master` WHERE `status`=1 AND club_id = 0";	
        $query = $this->db->query($sql);	
        $result = $query->result_array();
        $totaluser=$this->db->affected_rows();
        if($totaluser == 0) return;
        $com=round($rp*25/($totaluser*100),2);
        
        foreach ($result as $rs) {
            $this->self_repurchase_income($rs['customer_id']);
            $order_amt = $this->user_monthly_repurchase($rs['customer_id']);
            if($com > 0 && $order_amt > 999)
            {
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
                
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Monthly Repurchase Income','22')";
                $this->db->query($sql);
            }
        }

        //Club user commission
        $sql="SELECT * FROM `customer_master` WHERE `status`=1 and (`club_id` = 1 OR `club_id` = 2 OR `club_id` = 3)";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $totaluser=$this->db->affected_rows();
        if($totaluser == 0) return;
        $com=round($rp*25/($totaluser*100),2);

        foreach ($result as $rs) {
            $order_amt = $this->user_monthly_repurchase($rs['customer_id']);
            if($com > 0 && $order_amt > 999)
            {
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);    
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Monthly Repurchase Income ( club )','22')";
                
                $this->db->query($sql);
            }
        }

        //Director user commission
        $sql="SELECT * FROM `customer_master` WHERE `status`=1 and club_id>3";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $totaluser=$this->db->affected_rows();
        if($totaluser == 0) return;
        $com=round($rp*50/($totaluser*100),2);

        foreach ($result as $rs) { 
            $order_amt = $this->user_monthly_repurchase($rs['customer_id']);

            if($com > 0 && $order_amt > 999)
            {
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);    
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Monthly Repurchase Income ( director )','22')";
                $this->db->query($sql);
            }
        }
    }

    public function user_monthly_repurchase($custid)
    {
        $invoicevalue=0;
        $sql="SELECT (sum(`amount`)-sum(`discount_price`)) as total from order_master  where DATE_FORMAT(`order_date`,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m') and (`status`>0 AND `status`< 3) and `user_id`='".$custid."'";
    
        $query = $this->db->query($sql);
    
        $result = $query->result_array();
        
        return $invoicevalue=$result[0]['total'];
    }

    public function self_repurchase_income($custid)
    {
        $invoicevalue=0;
        $sql="SELECT (sum(`amount`)-sum(`discount_price`)) as total from order_master  where DATE_FORMAT(`order_date`,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m') and `status`>0 and `user_id`='".$custid."'";
    
        $query = $this->db->query($sql);
    
        $result = $query->result_array();
        
        $invoicevalue=$result[0]['total'];
    

        if($invoicevalue<1000) return;

        $sql="SELECT sum(credit) as income FROM `customer_transaction_master` WHERE `customer_id`='".$custid."' and (`income_type_id`=15 or `income_type_id`=20 or `income_type_id`=21 or `income_type_id`=22) and DATE_FORMAT(`vc_date`,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $rincome=round($result[0]['income']*5/100,2);

        $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$rincome." WHERE `customer_id`='".$custid."'";
        $this->db->query($sql);    
        $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$custid."','".$rincome."','Monthly Repurchase Income ( self repurchase )','21')";
        $this->db->query($sql);
    }


    // Monthly performance income
    public function calculate_monthly_performance_income(){
        $sql = $this->db->query("SELECT * FROM `customer_master` WHERE `status` = '1' AND `club_id` BETWEEN 1 AND 3");
        $club_achievers = $sql->result();

        foreach($club_achievers as $data){
            $club_achiever_id = $data->customer_id;
            $clud_achieve = $data->club_id;
            $repurchase_amount = calculate_repuchase_amount($club_achiever_id);

            $double_repurchase_amount = $repurchase_amount * 2;
            $rp = $double_repurchase_amount * (20/100);

            $performance_bonus = 0;
            if($clud_achieve == 1){
                if($rp>=100001){
                    $performance_bonus = round($rp * 30/100,2);
                }else if($rp>=50001){
                    $performance_bonus = round($rp * 20/100,2);
                }else if($rp>=25001){
                    $performance_bonus = round($rp * 15/100,2);
                }else if($rp>=500){
                    $performance_bonus = round($rp * 10/100,2);
                }
            }else if($clud_achieve == 2){
                if($rp>=100001){
                    $performance_bonus = round($rp * 40/100,2);
                }else if($rp>=50001){
                    $performance_bonus = round($rp * 30/100,2);
                }else if($rp>=25001){
                    $performance_bonus = round($rp * 20/100,2);
                }else if($rp>=500){
                    $performance_bonus = round($rp * 15/100,2);
                }
            }else if($clud_achieve == 3){
                if($rp>=100001){
                    $performance_bonus = round($rp * 50/100,2);
                }else if($rp>=50001){
                    $performance_bonus = round($rp * 40/100,2);
                }else if($rp>=25001){
                    $performance_bonus = round($rp * 30/100,2);
                }else if($rp>=500){
                    $performance_bonus = round($rp * 20/100,2);
                }
            }

            if($performance_bonus > 0){
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$performance_bonus." WHERE `customer_id`='".$club_achiever_id."'";
                $this->db->query($sql);

                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$club_achiever_id."','".$performance_bonus."','Monthly Performance bonus (Team)','25')";
                $this->db->query($sql);
            }
        }
    }

    // Direct team shopping income
    public function direct_team_shopping_income(){
        $sql = $this->db->query("SELECT * FROM `customer_master` WHERE `status` = '1'");
        $members = $sql->result();

        foreach($members as $data){
            $member_id = $data->customer_id;
            $clud_achieve = $data->club_id;
            $repurchase_amount = calculate_direct_repuchase_amount($member_id);

            $team_shopping_income = 0;
            
            if($clud_achieve == 0 && $repurchase_amount >= 25000){
                $team_shopping_income = round($repurchase_amount * 5/100,2);
            }else if($clud_achieve == 1 && $repurchase_amount >= 50000){
                $team_shopping_income = round($repurchase_amount * 10/100,2);
            }else if($clud_achieve == 2 && $repurchase_amount >= 100000){
                $team_shopping_income = round($repurchase_amount * 12/100,2);
            }else if($clud_achieve == 3 && $repurchase_amount >= 200000){
                $team_shopping_income = round($repurchase_amount * 15/100,2);
            }
            
            if($team_shopping_income > 0){
                $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$team_shopping_income." WHERE `customer_id`='".$member_id."'";
                $this->db->query($sql);

                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$member_id."','".$team_shopping_income."','Monthly Direct Team Shopping Income','26')";
                $this->db->query($sql);
            }
        }
    }
}