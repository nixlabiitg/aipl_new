<?php

class Cronjob extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		
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
         $bonus=0;
        $sql="SELECT * FROM `customer_master` WHERE `direct_bonus_point`>100";
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
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


    public function club_achieve()
    {
        $sql="SELECT * FROM `customer_master` WHERE `club_id`<3 and status=1";
     
        $query=$this->db->query($sql);
        $result=$query->result_array();
        foreach($result as $rs)
        {
            $sql="SELECT count(`id`) as cnt FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id where c.status='1' and p.club_achieve='1' and c.sponsor_id='".$rs['customer_id']."'";
          
        //   echo $sql;
            $query=$this->db->query($sql);
            $club=$query->result_array();
            if($club[0]['cnt']>=4 && $rs['club_id']==0)
            {
                // green club income
                $sql="UPDATE `customer_master` SET `club_id`='1',`main_wallet`=`main_wallet`+500 WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','500','Green Club Bonus','6')";
                $this->db->query($sql);
                //member development bonus
                $this->member_development_bonus($rs['sponsor_id'],250);
            }
            else if($club[0]['cnt']>=7 && $rs['club_id']==1)
            {
                // red club income
                $sql="UPDATE `customer_master` SET `club_id`='2',`main_wallet`=`main_wallet`+1000 WHERE `customer_id`='".$rs['customer_id']."'";
                $this->db->query($sql);
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','1000','Red Club Bonus','6')";
                $this->db->query($sql);
                 //member development bonus
                 $this->member_development_bonus($rs['sponsor_id'],500);
            }
            else if($club[0]['cnt']>=10 && $rs['club_id']==2)
            {
                // yellow club income
                $sql="UPDATE `customer_master` SET `club_id`='3',`main_wallet`=`main_wallet`+1500 WHERE `customer_id`='".$rs['customer_id']."'";
               
                $this->db->query($sql);
                $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','1500','Yellow Club Bonus','6')";
              
                $this->db->query($sql);
               
                //club autopool               
                $this->club_autopool($rs['customer_id']);                
                //direct club
                $this->direct_club($rs['sponsor_id']);
                //Reward & Recognition
                $this->associate_club($rs['sponsor_id']);
                //member development bonus
                 $this->member_development_bonus($rs['sponsor_id'],1000);
            }

        }

        // $sql="SELECT * FROM `customer_master` WHERE `club_id`=3 and status=1";
       
        // $query=$this->db->query($sql);
        // $result=$query->result_array();
        // foreach($result as $rs)
        // {
           
        //         $this->direct_club($rs['customer_id']);
             
        // }
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


     // autopool 2 end
     public function autopool2_income()
     {
         $cnt=0;
         $sql="SELECT * FROM autopool_master2 a1 INNER JOIN customer_master c on c.customer_id=a1.member_id WHERE `iscompleted`=0";
         $query=$this->db->query($sql);
         $result=$query->result_array();
         foreach($result as $rs)
         {
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
				$sql="UPDATE `customer_master` SET `director_club_id`=4 WHERE `customer_id`='".$sponsoId."'";
				$this->db->query($sql);     
			}
			
		}	


        // Director
		$sql="SELECT count(`id`) as cnt,director_club_id FROM `customer_master` WHERE `sponsor_id`='".$sponsoId."' and  status=1 and director_club_id>3 group by director_club_id";		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $rs)
		{
			if($rs['cnt']>=5 && $rs['director_club_id']==4)
			{
				$sql="UPDATE `customer_master` SET `director_club_id`=5 WHERE `customer_id`='".$sponsoId."'";
				$this->db->query($sql);     
			}
			else if($rs['cnt']>=4 && $rs['club_id']==5)
			{
				$sql="UPDATE `customer_master` SET `director_club_id`=6 WHERE `customer_id`='".$sponsoId."'";
				$this->db->query($sql);     
			}
			
		}

}
//Direct club bonus
public function direct_club_bonus()
{
    //Assistant Director
    $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.director_club_id=cl.club_id WHERE c.director_club_id='4'";		
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
    $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.director_club_id=cl.club_id WHERE c.director_club_id='5'";		
 
    $query = $this->db->query($sql);
    $result = $query->result_array();
    foreach($result as $rs)
    {
        $sql="SELECT sum(`credit`) as income FROM customer_transaction_master ct INNER JOIN customer_master c on c.customer_id=ct.customer_id where c.sponsor_id='".$rs['customer_id']."' and c.status='1' and c.director_club_id='4' and DATE_FORMAT(ct.vc_date,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')";		
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
    $sql="SELECT * FROM customer_master c INNER JOIN club_master cl on c.director_club_id=cl.club_id WHERE c.director_club_id='6'";		
    $query = $this->db->query($sql);
    $result = $query->result_array();
    foreach($result as $rs)
    {
        $sql="SELECT sum(`credit`) as income FROM customer_transaction_master ct INNER JOIN customer_master c on c.customer_id=ct.customer_id where c.sponsor_id='".$rs['customer_id']."' and c.status='1' and c.director_club_id='5' and DATE_FORMAT(ct.vc_date,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')";		
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
            $sql="SELECT * FROM `customer_master` WHERE `status`=1 and director_club_id>0";		
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
            $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$com.",fasttrack_duration=fasttrack_duration+1 WHERE `customer_id`='".$rs['customer_id']."'";
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

}

