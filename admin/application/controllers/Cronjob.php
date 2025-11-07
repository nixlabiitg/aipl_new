<?php

class Cronjob extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		
	}

    public function clear_cache()
    {

        $folderPath =APPPATH."session/cache/";
        //   echo $folderPath;
        $webcache=str_replace("admin/","",$folderPath);
        //   echo "<br>".$webcache;
        $staffcache=str_replace("admin","staff",$folderPath);
        //   echo "<br>".$staffcache;
        $franchisecache=str_replace("admin","franchise",$folderPath);
        //   echo "<br>".$franchisecache;

        if (!is_dir($folderPath)) {
            echo "Folder does not exist.";
            // exit();
        }

        // Get all the files in the folder
        $files = glob($folderPath . '*');       
        foreach ($files as $file)
        {          
                unlink($file);              
        }

        $files = glob($webcache . '*');       
        foreach ($files as $file)
        {          
                unlink($file);              
        }
        $files = glob($staffcache . '*');       
        foreach ($files as $file)
        {          
                unlink($file);              
        }

        $files = glob($franchisecache . '*');       
        foreach ($files as $file)
        {          
                unlink($file);              
        }
    }

    public function cronjob()
    {
        $this->fastrackbenefitb();
        $this->fastrack_income();
        $cur_date = Date("Y-m-d");       
        $ldate= date("Y-m-t", strtotime($cur_date));            
        $day = date('l', strtotime($cur_date));
        $this->autopool2();
        $this->club_achieve();
        // $this->digital_wallet_interest(); did in login
        $this->pointincome();
        $this->autopool1_income();
        $this->autopool2_income();
        $this->club_autopool_income();
        $this->directpointbonus();
        $this->activation_wallet_benefits();
        $this->ipp_digital_wallet_benefit();

        // PP & SPP Income
        $this->remunaration_first_benifit();
        $this->remunaration_second_benifit();

        // MRL 
        $this->apply_mrl_if_eligible();
        //clear cache
        $this->clear_cache();
    }


 
public function pointincome()
{
    $sql="SELECT * FROM customer_master  where point_wallet >=500 and status=1";
    $query=$this->db->query($sql);
    $result=$query->result_array();
    foreach($result as $rs)
    {           
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','500','Point Income','23')";
            $this->db->query($sql);
        
            $sql="UPDATE `customer_master` SET `point_wallet`=point_wallet-500,`main_wallet`=main_wallet+500 WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);         
    }
}


//Direct Point Bonus
public function directpointbonus()
{
        $sql="SELECT * FROM `customer_master` WHERE `direct_bonus_point`>=100";
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
            $bonus = 0;
            $poindeduct = 0;

            if($rs['direct_point_level']==1 && $rs['direct_bonus_point']>=100)
            {
                $bonus=500;
                $poindeduct=100;                
            }
            if($rs['direct_point_level']==2 && $rs['direct_bonus_point']>=250)
            {
                $bonus=1000;
                $poindeduct=250;          
            }
            if($rs['direct_point_level']==3 && $rs['direct_bonus_point']>=500)
            {
                $bonus=2000;
                $poindeduct=500;          
            }
            if($rs['direct_point_level']==4 && $rs['direct_bonus_point']>=1000)
            {
                $bonus=5000;
                $poindeduct=1000;          
            }
            if($rs['direct_point_level']==5 && $rs['direct_bonus_point']>=2000)
            {
                $bonus=15000;
                $poindeduct=2000;          
            }
            if($rs['direct_point_level']==6 && $rs['direct_bonus_point']>=2500)
            {
                $bonus=30000;
                $poindeduct=2500;          
            }
            if($rs['direct_point_level']==7 && $rs['direct_bonus_point']>=5000)
            {
                $bonus=50000;
                $poindeduct=5000;          
            }

           if($bonus>0)
           {
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$bonus."','Direct Point Bonus','12')";
            $this->db->query($sql);
          
            $sql="UPDATE `customer_master` SET `direct_bonus_point`=direct_bonus_point-".$poindeduct.",`main_wallet`=main_wallet+".$bonus.",`direct_point_level`=`direct_point_level`+1 WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);
           }

        }
}


    public function digital_wallet_interest()
    {
        $sql="SELECT * FROM `customer_master` WHERE `status`=1 and `digital_wallet`>0";
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
            $interest=round($rs['digital_wallet']*12/36500,2);
            $mainwallet=$rs['main_wallet']+$interest;
            $sql="UPDATE `customer_master` SET `main_wallet`='".$mainwallet."' WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','".$interest."','Digital Wallet Interest','1')";
            $this->db->query($sql);
        }
    }


    // public function club_achieve()
    // {
    //     $this->load->helper('debug');
    //     $sql="SELECT * FROM `customer_master` WHERE `club_id`<3 and status=1";
     
    //     $query=$this->db->query($sql);
    //     $result=$query->result_array();
    //     foreach($result as $rs)
    //     {
    //         $sql="SELECT count(`id`) as cnt FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id where c.status='1' and p.club_achieve='1' and c.sponsor_id='".$rs['customer_id']."'";
          
    //     //   echo $sql;
    //         $query=$this->db->query($sql);
    //         $club=$query->result_array();
    //         if($club[0]['cnt']>=4 && $rs['club_id']==0)
    //         {
    //             // green club income
    //             $sql="UPDATE `customer_master` SET `club_id`='1',`main_wallet`=`main_wallet`+500 WHERE `customer_id`='".$rs['customer_id']."'";
    //             $this->db->query($sql);
    //             $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','500','Green Club Bonus','6')";
    //             $this->db->query($sql);
    //             //member development bonus
    //             $this->member_development_bonus($rs['sponsor_id'],250);
    //         }
    //         else if($club[0]['cnt']>=7 && $rs['club_id']==1)
    //         {
    //             // red club income
    //             $sql="UPDATE `customer_master` SET `club_id`='2',`main_wallet`=`main_wallet`+1000 WHERE `customer_id`='".$rs['customer_id']."'";
    //             $this->db->query($sql);
    //             $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','1000','Red Club Bonus','6')";
    //             $this->db->query($sql);
    //              //member development bonus
    //              $this->member_development_bonus($rs['sponsor_id'],500);
    //         }
    //         else if($club[0]['cnt']>=10 && $rs['club_id']==2)
    //         {
    //             // yellow club income
    //             $sql="UPDATE `customer_master` SET `club_id`='3',`main_wallet`=`main_wallet`+1500 WHERE `customer_id`='".$rs['customer_id']."'";
               
    //             $this->db->query($sql);
    //             $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','1500','Yellow Club Bonus','6')";
              
    //             $this->db->query($sql);
               
    //             //club autopool               
    //             $this->club_autopool($rs['customer_id']);                
    //             //direct club
    //             $this->direct_club($rs['sponsor_id']);
    //             //Reward & Recognition
    //             $this->associate_club($rs['sponsor_id']);
    //             //member development bonus
    //              $this->member_development_bonus($rs['sponsor_id'],1000);
    //         }

    //     }

    //     // $sql="SELECT * FROM `customer_master` WHERE `club_id`=3 and status=1";
       
    //     // $query=$this->db->query($sql);
    //     // $result=$query->result_array();
    //     // foreach($result as $rs)
    //     // {
           
    //     //         $this->direct_club($rs['customer_id']);
             
    //     // }
    // }


    public function club_achieve()
    {
        $this->load->helper('debug');
        $sql = "SELECT c.*, p.package_id 
            FROM customer_master c 
            LEFT JOIN package_master p ON c.package_id = p.package_id
            WHERE c.club_id < 3 AND c.status = 1";
    
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
            $sql="SELECT count(`id`) as cnt FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id where c.status='1' and p.club_achieve='1' and c.sponsor_id='".$rs['customer_id']."'";
        
            $query=$this->db->query($sql);
            $club=$query->result_array();
    
            // --------- Green Club Income ----------
            if($club[0]['cnt']>=4 && $rs['c.club_id']==0)
            {
                $sql="UPDATE `customer_master` 
                    SET `club_id`='1',
                        `main_wallet`=`main_wallet`+500";

                // Add point_wallet bonus based on package_id
                $package_id = (int) trim($rs['package_id']);
                if ($package_id === 17 || $package_id === 25) {
                    $sql .= ", `point_wallet` = `point_wallet` + 5";
                } elseif ($package_id === 27) {
                    $sql .= ", `point_wallet` = `point_wallet` + 10";
                }

                $sql .= " WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);

                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) 
                    VALUES ('".$rs['customer_id']."','500','Green Club Bonus','6')";
                $this->db->query($sql);

                $this->member_development_bonus($rs['sponsor_id'],250);
            }
            // --------- Red Club Income ----------
            else if($club[0]['cnt']>=7 && $rs['club_id']==1)
            {
                $sql="UPDATE `customer_master` 
                    SET `club_id`='2',
                        `main_wallet`=`main_wallet`+1000,
                        `point_wallet` = `point_wallet` + 35
                    WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);

                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) 
                    VALUES ('".$rs['customer_id']."','1000','Red Club Bonus','6')";
                $this->db->query($sql);

                $this->member_development_bonus($rs['sponsor_id'],500);
            }
            // --------- Yellow Club Income ----------
            else if($club[0]['cnt']>=10 && $rs['club_id']==2)
            {
                $sql="UPDATE `customer_master` 
                    SET `club_id`='3',
                        `main_wallet`=`main_wallet`+1500,
                        `point_wallet` = `point_wallet` + 50
                    WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);

                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) 
                    VALUES ('".$rs['customer_id']."','1500','Yellow Club Bonus','6')";
                $this->db->query($sql);

                $this->club_autopool($rs['customer_id']);                
                $this->direct_club($rs['sponsor_id']);
                $this->associate_club($rs['sponsor_id']);
                $this->member_development_bonus($rs['sponsor_id'],1000);
            }
        }
    }


    // club autopool 
	public function club_autopool($custid)
    {                      
                    $sql="SELECT * FROM `club_autopool` WHERE `uid_5`='' ORDER BY `entry_date` ASC limit 1";
                    
                    $query=$this->db->query($sql);
                    $result=$query->result_array();
                    if($result[0]['uid_1']=="")
                    {
                        $sql="UPDATE `club_autopool` SET `uid_1`='".$custid."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    elseif($result[0]['uid_2']=="")
                    {
                        $sql="UPDATE `club_autopool` SET `uid_2`='".$custid."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    elseif($result[0]['uid_3']=="")
                    {
                        $sql="UPDATE `club_autopool` SET `uid_3`='".$custid."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    elseif($result[0]['uid_4']=="")
                    {
                        $sql="UPDATE `club_autopool` SET `uid_4`='".$custid."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    else 
                    {
                        $sql="UPDATE `club_autopool` SET `uid_5`='".$custid."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    $sql="UPDATE `autopool_master2` SET `iscompleted`='1' where `member_id`='".$custid."'";
                    $this->db->query($sql);
                    $sql="INSERT INTO `club_autopool`(`member_id`) VALUES ('".$custid."')";
                    $this->db->query($sql);
        
    }
    // club autopool

    // autopool 2
	public function autopool2()
    {
        $cnt=0;
        $sql="SELECT a1.* FROM (autopool_master1 a1 INNER JOIN customer_master c on a1.member_id=c.customer_id) LEFT JOIN autopool_master2 a2 on a1.member_id=a2.member_id where a2.member_id is null and c.status='1' and a1.iscompleted=0 order by a1.id";
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
            $cnt=$this->downline($rs['member_id']);
           if($cnt>=3905)
           {
               
                    $sql="SELECT * FROM `autopool_master2` WHERE `uid_5`='' ORDER BY `entry_date` ASC limit 1";
                    $query=$this->db->query($sql);
                    $result=$query->result_array();
                    if($result[0]['uid_1']=="")
                    {
                        $sql="UPDATE `autopool_master2` SET `uid_1`='".$rs['member_id']."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    elseif($result[0]['uid_2']=="")
                    {
                        $sql="UPDATE `autopool_master2` SET `uid_2`='".$rs['member_id']."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    elseif($result[0]['uid_3']=="")
                    {
                        $sql="UPDATE `autopool_master2` SET `uid_3`='".$rs['member_id']."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    elseif($result[0]['uid_4']=="")
                    {
                        $sql="UPDATE `autopool_master2` SET `uid_4`='".$rs['member_id']."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }
                    else 
                    {
                        $sql="UPDATE `autopool_master2` SET `uid_5`='".$rs['member_id']."' WHERE  `id`='".$result[0]['id']."'";
                        $this->db->query($sql);
                    }

                    $sql="UPDATE `autopool_master1` SET `iscompleted`='1' where `member_id`='".$rs['member_id']."'";
                    $this->db->query($sql);

                    $sql="INSERT INTO `autopool_master2`(`member_id`) VALUES ('".$rs['member_id']."')";
                    $this->db->query($sql);

                
           }
        }        
        
    }
	
    public function downline($customerid)
    {
        $uc=0;
        $sql="SELECT * FROM `autopool_master1` WHERE `member_id`='".$customerid."'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if($this->db->affected_rows()>0)
        {
            foreach ($result as $rs) {     
              // 1st 
              if($rs['uid_1'] != null)
              {                                                            
              $uc++;
              $uc+=$this->downline($rs['uid_1']);  }
              // 2nd
              if($rs['uid_2'] != null)
              {
                $uc++;
              $uc+= $this->downline($rs['uid_2']);  }
              // 3rd
                if($rs['uid_3'] != null)
                {     
                        $uc++;                                                 
                        $uc+= $this->downline($rs['uid_3']);
                }
                // 4th
                if($rs['uid_4'] != null)
                {                                
                    $uc++;                   
                    $uc+= $this->downline($rs['uid_4']);
                }
                // 5th
                if($rs['uid_5'] != null)
                {                          
                    $uc++;                 
                    $uc+= $this->downline($rs['uid_5']);  }
                    
                }

        }
        else
        {
          return 0 ;
        }
       
        return $uc;
    }
    // autopool 2 end
    public function autopool1_income()
    {
        $cnt=0;
        $sql="SELECT * FROM autopool_master1 a1 INNER JOIN customer_master c on c.customer_id=a1.member_id WHERE `iscompleted`=0";
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
            
            // Check user has 2 direct sponsor or not
            $sql = $this->db->query("SELECT * FROM `customer_master` WHERE `sponsor_id` = '".$rs['member_id']."'");
            $result = $sql->num_rows();

            if($result >= 2){
                $cnt=$this->downline($rs['member_id']);
                if($cnt>=3905 && $rs['a1_l5']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','312500','Autopool 1 Level 5 Income','4')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+312500,a1_l5='312500' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                    $sql="UPDATE `autopool_master1` SET `iscompleted`=1 WHERE `member_id`='".$rs['member_id']."'";
                    $this->db->query($sql);

                }
                else if($cnt>=780 && $rs['a1_l4']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','62500','Autopool 1 Level 4 Income','4')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+62500,a1_l4='62500' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                
                }
                else if($cnt>=155 && $rs['a1_l3']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','12500','Autopool 1 Level 3 Income','4')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+12500,a1_l3='12500' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                }
                else if($cnt>=30 && $rs['a1_l2']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','2500','Autopool 1 Level 2 Income','4')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+2500,a1_l2='2500' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                }
                else if($cnt>=5 && $rs['a1_l1']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','500','Autopool 1 Level 1 Income','4')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+500,a1_l1='500' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                }
            }
        }
    }


     // autopool 2 end
     public function autopool2_income()
     {
         $cnt=0;
         $sql="SELECT * FROM autopool_master2 a1 INNER JOIN customer_master c on c.customer_id=a1.member_id WHERE `iscompleted`=0";
         $query=$this->db->query($sql);
         $result=$query->result_array();
         foreach($result as $rs)
         {
            // Check user has 2 direct sponsor or not
            $sql = $this->db->query("SELECT * FROM `customer_master` WHERE `sponsor_id` = '".$rs['member_id']."'");
            $result = $sql->num_rows();

            if($result >= 2){
                $cnt=$this->autopool2downline($rs['member_id']);
                if($cnt>=3905 && $rs['a2_l5']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','3125000','Autopool 2 Level 5 Income','5')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+3125000,a2_l5='3125000' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                    $sql="UPDATE `autopool_master2` SET `iscompleted`=1 WHERE `member_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
    
                }
                else if($cnt>=780 && $rs['a2_l4']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','625000','Autopool 2 Level 4 Income','5')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+625000,a2_l4='625000' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                
                }
                else if($cnt>=155 && $rs['a2_l3']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','125000','Autopool 2 Level 3 Income','5')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+125000,a2_l3='125000' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                }
                else if($cnt>=30 && $rs['a2_l2']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','25000','Autopool 2 Level 2 Income','5')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+25000,a2_l2='25000' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                }
                else if($cnt>=5 && $rs['a2_l1']==0)
                {
                    $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','5000','Autopool 2 Level 1 Income','5')";
                    $this->db->query($sql);
                
                    $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+5000,a2_l1='5000' WHERE `customer_id`='".$rs['member_id']."'";
                    $this->db->query($sql);
                }
            }
         }
     }

     public function autopool2downline($customerid)
     {
         $uc=0;
         $sql="SELECT * FROM `autopool_master2` WHERE `member_id`='".$customerid."'";
         $query = $this->db->query($sql);
         $result = $query->result_array();
         if($this->db->affected_rows()>0)
         {
             foreach ($result as $rs) {     
               // 1st 
               if($rs['uid_1'] != null)
               {                                                            
               $uc++;
               $uc+=$this->autopool2downline($rs['uid_1']);  }
               // 2nd
               if($rs['uid_2'] != null)
               {
                 $uc++;
               $uc+= $this->autopool2downline($rs['uid_2']);  }
               // 3rd
                 if($rs['uid_3'] != null)
                 {     
                         $uc++;                                                 
                         $uc+= $this->autopool2downline($rs['uid_3']);
                 }
                 // 4th
                 if($rs['uid_4'] != null)
                 {                                
                     $uc++;                   
                     $uc+= $this->autopool2downline($rs['uid_4']);
                 }
                 // 5th
                 if($rs['uid_5'] != null)
                 {                          
                     $uc++;                 
                     $uc+= $this->autopool2downline($rs['uid_5']);  }
                     
                 }
 
         }
         else
         {
           return 0 ;
         }
        
         return $uc;
     }


       // autopool 2 end
       public function club_autopool_income()
       {
           $cnt=0;
           $sql="SELECT * FROM club_autopool a1 INNER JOIN customer_master c on c.customer_id=a1.member_id WHERE `iscompleted`=0";
           $query=$this->db->query($sql);
           $result=$query->result_array();
           foreach($result as $rs)
           {
               $cnt=$this->clubautopooldownline($rs['member_id']);
               if($cnt>=3905 && $rs['c_l5']==0)
               {
                   $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','3125000','Club Autopool Level 5 Income','9')";
                   $this->db->query($sql);
               
                   $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+3125000,c_l5='3125000' WHERE `customer_id`='".$rs['member_id']."'";
                   $this->db->query($sql);
                   $sql="UPDATE `club_autopool` SET `iscompleted`=1 WHERE `member_id`='".$rs['member_id']."'";
                   $this->db->query($sql);
   
               }
               else if($cnt>=780 && $rs['c_l4']==0)
               {
                   $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','625000','Club Autopool Level 4 Income','9')";
                   $this->db->query($sql);
               
                   $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+625000,c_l4='625000' WHERE `customer_id`='".$rs['member_id']."'";
                   $this->db->query($sql);
                 
               }
               else if($cnt>=155 && $rs['c_l3']==0)
               {
                   $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','125000','Club Autopool Level 3 Income','9')";
                   $this->db->query($sql);
               
                   $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+125000,c_l3='125000' WHERE `customer_id`='".$rs['member_id']."'";
                   $this->db->query($sql);
               }
               else if($cnt>=30 && $rs['c_l2']==0)
               {
                   $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','25000','Club Autopool Level 2 Income','9')";
                   $this->db->query($sql);
               
                   $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+25000,c_l2='25000' WHERE `customer_id`='".$rs['member_id']."'";
                   $this->db->query($sql);
               }
               else if($cnt>=5 && $rs['c_l1']==0)
               {
                   $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['member_id']."','5000','Club Autopool Level 1 Income','9')";
                   $this->db->query($sql);
               
                   $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+5000,c_l1='5000' WHERE `customer_id`='".$rs['member_id']."'";
                   $this->db->query($sql);
               }
           }
       }
  
       public function clubautopooldownline($customerid)
       {
           $uc=0;
           $sql="SELECT * FROM `club_autopool` WHERE `member_id`='".$customerid."'";
           $query = $this->db->query($sql);
           $result = $query->result_array();
           if($this->db->affected_rows()>0)
           {
               foreach ($result as $rs) {     
                 // 1st 
                 if($rs['uid_1'] != null)
                 {                                                            
                 $uc++;
                 $uc+=$this->clubautopooldownline($rs['uid_1']);  }
                 // 2nd
                 if($rs['uid_2'] != null)
                 {
                   $uc++;
                 $uc+= $this->clubautopooldownline($rs['uid_2']);  }
                 // 3rd
                   if($rs['uid_3'] != null)
                   {     
                           $uc++;                                                 
                           $uc+= $this->clubautopooldownline($rs['uid_3']);
                   }
                   // 4th
                   if($rs['uid_4'] != null)
                   {                                
                       $uc++;                   
                       $uc+= $this->clubautopooldownline($rs['uid_4']);
                   }
                   // 5th
                   if($rs['uid_5'] != null)
                   {                          
                       $uc++;                 
                       $uc+= $this->clubautopooldownline($rs['uid_5']);  }
                       
                   }
   
           }
           else
           {
             return 0 ;
           }
          
           return $uc;
       }
//Member development bonus

public function member_development_bonus($sponsorid,$clubamt)  //S=0 in call
{
   
        $sql="SELECT * FROM customer_master  WHERE `customer_id`='".$sponsorid."'";
        
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if($result[0]['club_id']==3)
        {
            $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$clubamt." WHERE `customer_id`='".$sponsorid."'";
            $this->db->query($sql);     
           
           if($clubamt>0)
           {               
               $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$clubamt."','Member Development Bonus','8')";
               $this->db->query($sql);
            }			
           
        }
        else
        {
            $this->member_development_bonus($result[0]['sponsor_id'],$clubamt);  
          
        }      

    }

 // Direct Club
public function direct_club($sponsoId)
{
		//Assistant Director
		$sql="SELECT count(`id`) as cnt FROM `customer_master` WHERE `sponsor_id`='".$sponsoId."' and  status=1 and club_id=3";		
	
  
        $query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $rs)
		{
			if($rs['cnt']>=10)
			{
				// $sql="UPDATE `customer_master` SET `director_club_id`=4 WHERE `customer_id`='".$sponsoId."'";
				$sql="UPDATE `customer_master` SET `club_id`=4 WHERE `customer_id`='".$sponsoId."'";
			
                $this->db->query($sql);     
			}
			
		}	


        // Director
		$sql="SELECT count(`id`) as cnt,club_id FROM `customer_master` WHERE `sponsor_id`='".$sponsoId."' and  status=1 and club_id>3 group by club_id";		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $rs)
		{
			if($rs['cnt']>=5 && $rs['club_id']==4)
			{
				$sql="UPDATE `customer_master` SET `club_id`=5 WHERE `customer_id`='".$sponsoId."'";
				$this->db->query($sql);     
			}
			else if($rs['cnt']>=4 && $rs['club_id']==5)
			{
				$sql="UPDATE `customer_master` SET `club_id`=6 WHERE `customer_id`='".$sponsoId."'";
				$this->db->query($sql);     
			}
			
		}

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

// Associate Club
public function associate_club($sponsoId)
{
		//Assistant Director
		$sql="SELECT count(`id`) as cnt FROM `customer_master` WHERE `sponsor_id`='".$sponsoId."' and  status=1 and club_id=3";		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $rs)
		{
			if($rs['cnt']>=5)
			{
				$sql="UPDATE `customer_master` SET `reward_club_id`=7 WHERE `customer_id`='".$sponsoId."'";
				$this->db->query($sql);     
			}
			
		}	


        // Rewqard Recognition
		$sql="SELECT count(`id`) as cnt,reward_club_id FROM `customer_master` WHERE `sponsor_id`='".$sponsoId."' and  status=1 and reward_club_id>0 and reward_club_id<14 group by reward_club_id";		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $rs)
		{
			if($rs['cnt']>=5)
			{
				$sql="UPDATE `customer_master` SET `reward_club_id`=reward_club_id+1 WHERE `customer_id`='".$sponsoId."'";
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

    //Activation Wallet Benefits
    public function activation_wallet_benefits()
    {
        //Assistant Director
        $sql="SELECT * FROM `customer_master` WHERE `activation_wallet_calculation_amount`>=5000 and  interest_calc_end_date<=CURDATE()";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $rs)
         {            
           
               if($this->iswalletused($rs['customer_id'],$rs['interest_cal_start_date'],$rs['interest_calc_end_date'])==0)
               {
                $com=round($rs['activation_wallet_calculation_amount']*10/100,2);                
                $sql="UPDATE `customer_master` SET `activation_wallet`=activation_wallet+".$com.",interest_cal_start_date=DATE_ADD(interest_calc_end_date, INTERVAL 1 DAY),interest_calc_end_date=DATE_ADD(interest_calc_end_date, INTERVAL 30 DAY) WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Activation Wallet Benefits','18')";
                $this->db->query($sql);
               }
               
                   
        }
    }
    public function iswalletused($custid,$from,$to)
    {
        $cnt=0;
        $sql="SELECT count(`id`) as cnt FROM `customer_transaction_master` WHERE `customer_id`='".$custid."' and DATE_FORMAT(`vc_date`,'%Y-%m-%d')>='".$from."' and DATE_FORMAT(`vc_date`,'%Y-%m-%d')<='".$to."' and activate_to<>''";		
        $query = $this->db->query($sql);
        $cnt = $query->result_array()[0]['cnt'];   
        return $cnt;     
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


public function monthly_repurchase_income()  //S=0 in call
{

    $sql="SELECT sum(`amount`)-sum(`discount_price`) as total from order_master  where DATE_FORMAT(`order_date`,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m') and `status`>0";
    $query = $this->db->query($sql);
	$result = $query->result_array();
    $rp=round($result[0]['total']*20/100,2);
   
    //all user commission
	$sql="SELECT * FROM `customer_master` WHERE `status`=1";		
    $query = $this->db->query($sql);
    $result = $query->result_array();
    $totaluser=$this->db->affected_rows();
    $com=round($rp*5/($totaluser*100),2);   
    foreach ($result as $rs) {  
    if($com>0)
    {
        $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
        $this->db->query($sql);    
        $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Monthly Repurchase Income','22')";
        $this->db->query($sql);
    }
     $this->self_repurchase_income($rs['customer_id'])."<br>";
    }
    
    if($rp==0) return;

        //Club user commission
        $sql="SELECT * FROM `customer_master` WHERE `status`=1 and club_id>0";		
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $totaluser=$this->db->affected_rows();
        $com=round($rp*5/($totaluser*100),2);
        foreach ($result as $rs) {  
            $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);    
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Monthly Repurchase Income ( club )','22')";
            
                $this->db->query($sql);
            }
            //Director user commission
            $sql="SELECT * FROM `customer_master` WHERE `status`=1 and club_id>3";		
            $query = $this->db->query($sql);
            $result = $query->result_array();
            $totaluser=$this->db->affected_rows();
            $com=round($rp*10/($totaluser*100),2);
            foreach ($result as $rs) {  
            $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com." WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);    
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','Monthly Repurchase Income ( director )','22')";
            $this->db->query($sql);
            }


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
public function fastrack_income()
{
    $sql="SELECT c.customer_id,c.fasttrack_amount FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id where c.fasttrack_duration<p.fastrack_duration and c.next_calculate_date=CURDATE()";		
    $query = $this->db->query($sql);
    $result = $query->result_array();
    foreach($result as $rs)
     {  
            $com=$rs['fasttrack_amount'];                
            $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com.",fasttrack_duration=fasttrack_duration+1,next_calculate_date=DATE_ADD(next_calculate_date,INTERVAL 1 MONTH) WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','First Track Repurchase Income','17')";
            $this->db->query($sql);
    }
}


public function fastrackbenefitb()  
{

    $sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id where c.benifit_b_amount>0 and `next_benefit_income_date`=CURDATE()";
	$query = $this->db->query($sql);
    $result = $query->result_array();
    foreach($result as $rs)
    {
        if($rs['benefited_year']==1)
        {
            $com=round($rs['benifit_b_amount']*$rs['benefit_b_first_year']/100,2);      
        }
        else if($rs['benefited_year']==2)
        {
            $com=round($rs['benifit_b_amount']*$rs['benefit_b_second_year']/100,2);      
        }
        else if($rs['benefited_year']==3)
        {
            $com=round($rs['benifit_b_amount']*$rs['benefit_b_third_year']/100,2);      
        }
        else if($rs['benefited_year']==4)
        {
            $com=round($rs['benifit_b_amount']*$rs['benefit_b_fourth_year']/100,2);      
        }
        else if($rs['benefited_year']==5)
        {
            $com=round($rs['benifit_b_amount']*$rs['benefit_b_fifth_year']/100,2);      
        }
                   
            $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com.",benefited_year=benefited_year+1,next_benefit_income_date=DATE_ADD(next_benefit_income_date, INTERVAL 365 DAY) WHERE `customer_id`='".$rs['customer_id']."'";
            $this->db->query($sql);
            $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs['customer_id']."','".$com."','First Track Benefited B Income','19')";
            $this->db->query($sql);
    }


}

public function ipp_digital_wallet_benefit() {
    $sql = $this->db->query("
        SELECT 
            cm.*, 
            DATEDIFF(CURDATE(), cm.activation_date) as diff_date, 
            pm.package_id, 
            pm.digital_wallet_value 
        FROM 
            `customer_master` cm 
        JOIN 
            `package_master` pm ON pm.package_id = cm.package_id 
        WHERE 
            cm.status IN (1, 4)
    ");
    $result = $sql->result();

    $income_percentages = [
        1 => 10,
        2 => 20,
        3 => 30,
        4 => 40,
        5 => 50,
        6 => 50
    ];

    foreach ($result as $data) {
        $ipp_digital_year = (int)$data->ipp_digital_wallet_benefit_year;
        $digital_wallet_value = (float)$data->digital_wallet_value;
        $customer_id = $data->customer_id;
        $diff_date = (int)str_replace('-', '', $data->diff_date);

        $next_year_threshold = ($ipp_digital_year + 1) * 365;
        if ($ipp_digital_year >= 6 || $diff_date <= $next_year_threshold) {
            continue;
        }

        $ipp_digital_year++;
        $income_percentage = $income_percentages[$ipp_digital_year];
        $benefit_amt = $digital_wallet_value * ($income_percentage / 100);

        if($benefit_amt > 0){
            $this->db->query("
                UPDATE `customer_master` 
                SET 
                    `ipp_digital_wallet_benefit_year` = ?, 
                    `ipp_digital_wallet_benefit_income` = `ipp_digital_wallet_benefit_income` + ?, 
                    `main_wallet` = `main_wallet` + ? 
                WHERE 
                    `customer_id` = ?
            ", [$ipp_digital_year, $benefit_amt, $benefit_amt, $customer_id]);

            // Insert transaction record
            $this->db->query("
                INSERT INTO `customer_transaction_master` (
                    `customer_id`, 
                    `income_type_id`, 
                    `credit`, 
                    `remarks`, 
                    `vc_date`
                ) VALUES (?, ?, ?, ?, NOW())
            ", [
                $customer_id, 
                '32', 
                $benefit_amt,
                "Digital wallet benefit for year $ipp_digital_year"
            ]);
        }
    }
}

private function get_downline_count_within_month($id){
    $sql = "SELECT COUNT(*) as count FROM `customer_master` WHERE `sponsor_id` = ? AND `status` = 1";
    $result = $this->db->query($sql, [$id])->result();
    if($result){
        return $result[0]->count;
    }

    return 0;
}

public function apply_mrl_if_eligible(){
    $date = date('Y-m-d');
    $one_month_before = date('Y-m-d', strtotime($date . ' -1 month'));
    $sql = $this->db->query("SELECT * FROM `customer_master` WHERE date_format(`activation_date`, '%Y-%m-%d') >= '$one_month_before' AND `is_mrl` = 0");
    $result = $sql->result();
    foreach ($result as $data) {
        $customer = $data->customer_id;
        $downline_count = $this->get_downline_count_within_month($customer);

        if ($downline_count >= 10) {
            $data = [
                'is_mrl' => 1,
                'mrl_achieve_on' => date('Y-m-d H:i:s')
            ];

            $this->Crud->ciUpdate("customer_master", $data, "`customer_id` = '$customer'");
        }
    }
}

// public function remunaration_first_benifit(){
//         $sql = $this->db->query("SELECT * FROM customer_master WHERE registration_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND (`promotion_id` = '0' OR `promotion_id` = '1') ORDER BY `customer_master`.`registration_date` ASC");
//         $members = $sql->result();

//         foreach($members as $data){
//             $sales_point = $data->sales_point;

//             if($sales_point >= 30){
//                 $member_id = $data->customer_id;
//                 $sql = $this->db->query("SELECT * FROM `customer_transaction_master` WHERE `customer_id` = '$member_id' AND `income_type_id` = '29'");
//                 $total_entry = $sql->num_rows();

//                 $data = [
//                     'customer_id' => $member_id,
//                     'credit' => 5000,
//                     'vc_date' => date('Y-m-d H:i:s'),
//                     'remarks' => 'PP Remuneration Benefit',
//                     'income_type_id' => 29
//                 ];

//                 if($total_entry < 2){
//                     if($this->Crud->ciCreate("customer_transaction_master", $data)){
//                         $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+5000 WHERE `customer_id`='".$member_id."'";
//                         $this->db->query($sql);

//                         if($total_entry == 0){
//                             $sql = "UPDATE `customer_master` SET `promotion_id` = '1' WHERE `customer_id`='".$member_id."'";
//                             $this->db->query($sql);
//                         }
//                     }
//                 }else if($total_entry == 2){
//                     if($this->Crud->ciCreate("customer_transaction_master", $data)){
//                         $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+5000, `promotion_id` = '2' WHERE `customer_id`='".$member_id."'";
//                         $this->db->query($sql);
//                     }
//                 }
//             }

//             $sql = "UPDATE `customer_master` SET `sales_point`=0 WHERE `customer_id` ='".$member_id."'";
//             $this->db->query($sql);
//         }
//     }

//     public function remunaration_second_benifit(){
//         // $sql = $this->db->query("SELECT * FROM customer_master WHERE (`promotion_id` = '2' OR `promotion_id` = '3')");
//         $sql = $this->db->query("SELECT * FROM customer_master WHERE (`promotion_id` = '2' OR `promotion_id` = '3') AND `registration_date` >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
//         $members = $sql->result();

//         foreach($members as $data){
//             $member_id = $data->customer_id;
//             $sales_point = $data->spp_sales_point;
//             $incentive_member_no = $data->incentive_member_no;

//             $sql = $this->db->query("SELECT * FROM `customer_transaction_master` WHERE `customer_id` = '$member_id' AND `income_type_id` = '30' AND `credit` = 5000");
//             $total_entry = $sql->num_rows();

//             $sql = $this->db->query("SELECT * FROM `customer_transaction_master` WHERE `customer_id` = '$member_id' AND `income_type_id` = '30' AND `credit` = 15000");
//             $total_entry_ = $sql->num_rows();

//             if($total_entry < 3 && $sales_point < 150){
//                 $data = [
//                     'customer_id' => $member_id,
//                     'credit' => 5000,
//                     'vc_date' => date('Y-m-d H:i:s'),
//                     'remarks' => 'SPP Remuneration Benefit',
//                     'income_type_id' => 30
//                 ];

//                 if($this->Crud->ciCreate("customer_transaction_master", $data)){
//                     $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+5000 WHERE `customer_id`='".$member_id."'";
//                     $this->db->query($sql);
//                 }
//             }else if($total_entry_ < 5 && $sales_point >= 150){
//                 $data = [
//                     'customer_id' => $member_id,
//                     'credit' => 15000,
//                     'vc_date' => date('Y-m-d H:i:s'),
//                     'remarks' => 'SPP Remuneration Benefit',
//                     'income_type_id' => 30
//                 ];

//                 if($this->Crud->ciCreate("customer_transaction_master", $data)){
//                     $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+15000, `spp_sales_point` = `spp_sales_point`-150 WHERE `customer_id`='".$member_id."'";
//                     $this->db->query($sql);
//                 }
//             }else if($total_entry_ == 5 && $sales_point >= 150){
//                 $data = [
//                     'customer_id' => $member_id,
//                     'credit' => 15000,
//                     'vc_date' => date('Y-m-d H:i:s'),
//                     'remarks' => 'SPP Remuneration Benefit',
//                     'income_type_id' => 30
//                 ];

//                 if($this->Crud->ciCreate("customer_transaction_master", $data)){
//                     $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+15000, `spp_sales_point` = `spp_sales_point`-150, `promotion_id` = '3' WHERE `customer_id`='".$member_id."'";
//                     $this->db->query($sql);
//                 }
//             }else if($total_entry_ >= 6 && $sales_point >= 150){
//                 $data = [
//                     'customer_id' => $member_id,
//                     'credit' => 15000,
//                     'vc_date' => date('Y-m-d H:i:s'),
//                     'remarks' => 'SPP Remuneration Benefit',
//                     'income_type_id' => 30
//                 ];

//                 if($this->Crud->ciCreate("customer_transaction_master", $data)){
//                     $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+15000, `spp_sales_point` = `spp_sales_point`-150 WHERE `customer_id`='".$member_id."'";
//                     $this->db->query($sql);
//                 }
//             }

//             $this->pay_incentive_to_sponsor($member_id, $incentive_member_no);
//         }
//     }

 public function remunaration_first_benifit()
    {
        // Fetch customers registered within last 1 year and promotion 0 or 1
        $sql = $this->db->query("
        SELECT customer_id, sales_point
        FROM customer_master 
        WHERE promotion_id IN ('0', '1')
        AND registration_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
        ORDER BY registration_date ASC
    ");
        $members = $sql->result();

        foreach ($members as $member) {
            $member_id = $member->customer_id;
            $sales_point = $member->sales_point;

            // Count total directs under this member
            $directs = $this->db->query("
            SELECT COUNT(*) AS total_users
            FROM customer_master
            WHERE sponsor_id = '$member_id'
        ")->row()->total_users;

            // Check already paid PP remunerations
            $paid_5000 = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM customer_transaction_master
            WHERE customer_id = '$member_id'
            AND income_type_id = 29
            AND credit = 5000
        ")->row()->total;

            $paid_10000 = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM customer_transaction_master
            WHERE customer_id = '$member_id'
            AND income_type_id = 29
            AND credit = 10000
        ")->row()->total;

            $paid_15000 = $this->db->query("
            SELECT COUNT(*) AS total 
            FROM customer_transaction_master
            WHERE customer_id = '$member_id'
            AND income_type_id = 29
            AND credit = 15000
        ")->row()->total;

            // --- Apply new daily reward logic ---
            if ($directs >= 6 && $paid_5000 == 0) {
                $this->givePpRemuneration($member_id, 5000);
            }
            if ($directs >= 12 && $paid_10000 == 0) {
                $this->givePpRemuneration($member_id, 10000);
            }
            if ($directs >= 18 && $paid_15000 == 0) {
                $this->givePpRemuneration($member_id, 15000);
            }

            // Reset sales_point if needed
            $this->db->query("UPDATE customer_master SET sales_point = 0 WHERE customer_id = '$member_id'");
        }
    }

    private function givePpRemuneration($member_id, $amount)
    {
        // Prevent duplicate payment for the same day
        $exists = $this->db->query("
        SELECT id FROM customer_transaction_master
        WHERE customer_id = '$member_id'
        AND credit = $amount
        AND income_type_id = 29
        AND DATE(vc_date) = CURDATE()
        LIMIT 1
    ")->num_rows();

        if ($exists > 0) {
            return;
        }

        // Insert transaction
        $data = [
            'customer_id' => $member_id,
            'credit' => $amount,
            'vc_date' => date('Y-m-d H:i:s'),
            'remarks' => 'PP Remuneration Benefit',
            'income_type_id' => 29
        ];

        if ($this->Crud->ciCreate("customer_transaction_master", $data)) {
            // Update main wallet
            $this->db->query("
            UPDATE customer_master
            SET main_wallet = main_wallet + $amount
            WHERE customer_id = '$member_id'
        ");
        }
    }



    public function remunaration_second_benifit()
    {
        // Fetch customers under promotion 2 or 3 registered in the last 1 year
        $sql = $this->db->query("
            SELECT customer_id, spp_sales_point, incentive_member_no
            FROM customer_master 
            WHERE promotion_id IN ('2', '3')
            AND registration_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
        ");
        $members = $sql->result();

        foreach ($members as $member) {
            $member_id = $member->customer_id;
            $sales_point = $member->spp_sales_point;
            $incentive_member_no = $member->incentive_member_no;

            // Count total direct users
            $directs = $this->db->query("
                SELECT COUNT(*) AS total_users
                FROM customer_master
                WHERE sponsor_id = '$member_id'
            ")->row()->total_users;

            // Check already paid remunerations
            $paid_5000 = $this->db->query("
                SELECT COUNT(*) AS total 
                FROM customer_transaction_master 
                WHERE customer_id = '$member_id' 
                AND income_type_id = 30 
                AND credit = 5000
            ")->row()->total;

            $paid_10000 = $this->db->query("
                SELECT COUNT(*) AS total 
                FROM customer_transaction_master 
                WHERE customer_id = '$member_id' 
                AND income_type_id = 30 
                AND credit = 10000
            ")->row()->total;

            $paid_15000 = $this->db->query("
                SELECT COUNT(*) AS total 
                FROM customer_transaction_master 
                WHERE customer_id = '$member_id' 
                AND income_type_id = 30 
                AND credit = 15000
            ")->row()->total;

            // --- Apply new daily reward logic ---
            if ($directs >= 6 && $paid_5000 == 0) {
                $this->giveRemuneration($member_id, 5000, $sales_point);
            }
            if ($directs >= 12 && $paid_10000 == 0) {
                $this->giveRemuneration($member_id, 10000, $sales_point);
            }
            if ($directs >= 18 && $paid_15000 == 0) {
                $this->giveRemuneration($member_id, 15000, $sales_point);
            }

            // Pay sponsor incentive
            $this->pay_incentive_to_sponsor($member_id, $incentive_member_no);
        }
    }

    private function giveRemuneration($member_id, $amount, $sales_point)
    {
        // Prevent duplicate payment for the same amount
        $exists = $this->db->query("
            SELECT id FROM customer_transaction_master
            WHERE customer_id = '$member_id'
            AND credit = $amount
            AND income_type_id = 30
            LIMIT 1
        ")->num_rows();

        if ($exists > 0) {
            return;
        } // Already paid

        // Insert transaction
        $data = [
            'customer_id' => $member_id,
            'credit' => $amount,
            'vc_date' => date('Y-m-d H:i:s'),
            'remarks' => 'SPP Remuneration Benefit',
            'income_type_id' => 30
        ];

        if ($this->Crud->ciCreate("customer_transaction_master", $data)) {
            // Update main wallet and deduct sales points if needed
            $this->db->query("
                UPDATE customer_master 
                SET main_wallet = main_wallet + $amount,
                    spp_sales_point = GREATEST(spp_sales_point - 150, 0)
                WHERE customer_id = '$member_id'
            ");
        }
    }

    public function pay_incentive_to_sponsor($member_id, $incentive_member_no){
        $amount = 0;
        if($incentive_member_no >= 7){
            $amount = 1000;
        }else if($incentive_member_no >= 4){
            $amount = 500;
        }else if($incentive_member_no > 0 && $incentive_member_no < 4){
            $amount = 250;
        }

        if($amount > 0){
            $data = [
                'customer_id' => $member_id,
                'credit' => $amount,
                'vc_date' => date('Y-m-d H:i:s'),
                'remarks' => 'Incentive income',
                'income_type_id' => 31
            ];

            if($this->Crud->ciCreate("customer_transaction_master", $data)){
                $sql = "UPDATE `customer_master` SET `main_wallet`=main_wallet+'".$amount."', `incentive_member_no` = 0 WHERE `customer_id`='".$member_id."'";
                $this->db->query($sql);
            }
        }else{
            return;
        }
    }

}


//cronjob setting
//*/10 * * * * /usr/bin/curl https://aceaaro.com/admin/cronjob/cronjob
//10 23 * * * /usr/bin/curl https://aceaaro.com/admin/cronjobmt/cronjobmt