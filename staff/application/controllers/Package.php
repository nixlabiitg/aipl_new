<?php
class Package extends CI_Controller
{    
      
    public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplStaffId')) {
			redirect('authentication/login');
		}
	}

    public function addPackage()
{
	$d=$this->input->post();
	$sql="INSERT INTO `package_master`( `package_name`,  `package_amount`,`digital_wallet_value`, `shopping_coupon_value`, `no_of_coupon`, `magic_shopping_points`, `gift_product_amount`, `direct_ipp_amount`, `registration_point`, `reffer_point`,`magic_ipp_for_level_1`,`magic_ipp_for_level_2`,`magic_ipp_for_level_3`,`magic_ipp_for_level_4`,`magic_ipp_for_level_5`,`magic_ipp_for_level_6`,`magic_ipp_for_level_7`,`magic_ipp_for_level_8`,`magic_ipp_for_level_9`,`magic_ipp_for_level_10`, `autopool_allow`,`club_achieve`, `level_upgrade_incentive_level_1`, `level_upgrade_incentive_level_2`, `level_upgrade_incentive_level_3`, `level_upgrade_incentive_level_4`, `level_upgrade_incentive_level_5`, `level_upgrade_incentive_level_6`, `level_upgrade_incentive_level_7`, `level_upgrade_incentive_level_8`, `level_upgrade_incentive_level_9`, `level_upgrade_incentive_level_10`,`booster_income`,`direct_point_bonus`,`fasttrack_income`,`fastrack_duration`,`benefit_b_first_year`,`benefit_b_second_year`,`benefit_b_third_year`,`benefit_b_fourth_year`,`benefit_b_fifth_year`) VALUES ('".$d['p_name']."','".$d['p_amount']."','".$d['d_wallet']."','".$d['quopon']."','".$d['noquopon']."','".$d['magicpoint']."','".$d['giftamt']."','".$d['sponsoramt']."','".$d['regpoint']."','".$d['refpoint']."','".$d['level1']."','".$d['level2']."','".$d['level3']."','".$d['level4']."','".$d['level5']."','".$d['level6']."','".$d['level7']."','".$d['level8']."','".$d['level9']."','".$d['level10']."','".$d['autopoolallow']."','".$d['clubachieve']."','".$d['inclevel1']."','".$d['inclevel2']."','".$d['inclevel3']."','".$d['inclevel4']."','".$d['inclevel5']."','".$d['inclevel6']."','".$d['inclevel7']."','".$d['inclevel8']."','".$d['inclevel9']."','".$d['inclevel10']."','".$d['boosterIncome']."','".$d['directpoint']."','".$d['fastrackIncome']."','".$d['fastrackDuration']."','".$d['f1y']."','".$d['f2y']."','".$d['f3y']."','".$d['f4y']."','".$d['f5y']."')";
	//  echo $sql;
	$this->db->query($sql);
	echo json_encode($this->db->affected_rows(),true);
}

public function package()
{
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('master/package');
		$this->load->view('layouts/footer');
}
public function active_package()
{
	$sql="SELECT * FROM `package_master` WHERE `status`=1";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$data['status']=1;

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('master/listpackage',$data);
		$this->load->view('layouts/footer');
}

public function block_package()
{
	$sql="SELECT * FROM `package_master` WHERE `status`=2";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$data['status']=2;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('master/listpackage',$data);
		$this->load->view('layouts/footer');
}
public function edit_package()
	{
		$d=$this->input->post();
		   
		$sql="UPDATE `package_master` SET `package_name`='".$d['packagename']."',`package_amount`='".$d['p_amount']."',`digital_wallet_value`='".$d['dwallet']."',`shopping_coupon_value`='".$d['quopon']."',`no_of_coupon`='".$d['noquopon']."',`magic_shopping_points`='".$d['magicpoint']."',`gift_product_amount`='".$d['giftamt']."',`direct_ipp_amount`='".$d['sponsoramt']."',`registration_point`='".$d['regpoint']."',`reffer_point`='".$d['refpoint']."',`magic_ipp_for_level_1`='".$d['level1']."',`magic_ipp_for_level_2`='".$d['level2']."',`magic_ipp_for_level_2`='".$d['level3']."',`magic_ipp_for_level_4`='".$d['level4']."',`magic_ipp_for_level_5`='".$d['level5']."',`magic_ipp_for_level_6`='".$d['level6']."',`magic_ipp_for_level_7`='".$d['level7']."',`magic_ipp_for_level_8`='".$d['level8']."',`magic_ipp_for_level_9`='".$d['level9']."',`magic_ipp_for_level_10`='".$d['level10']."',`autopool_allow`='".$d['autopool']."',`club_achieve`='".$d['clubachieve']."',`level_upgrade_incentive_level_1`='".$d['inclevel1']."',`level_upgrade_incentive_level_2`='".$d['inclevel2']."',`level_upgrade_incentive_level_3`='".$d['inclevel3']."',`level_upgrade_incentive_level_4`='".$d['inclevel4']."',`level_upgrade_incentive_level_5`='".$d['inclevel5']."',`level_upgrade_incentive_level_6`='".$d['inclevel6']."',`level_upgrade_incentive_level_7`='".$d['inclevel7']."',`level_upgrade_incentive_level_8`='".$d['inclevel8']."',`level_upgrade_incentive_level_9`='".$d['inclevel9']."',`level_upgrade_incentive_level_10`='".$d['inclevel10']."',`booster_income`='".$d['boosterIncome']."',`direct_point_bonus`='".$d['directpoint']."', `fasttrack_income`='".$d['fastrackIncome']."',`fastrack_duration`='".$d['fastrackDuration']."',`benefit_b_first_year`='".$d['f1y']."',`benefit_b_second_year`='".$d['f2y']."',`benefit_b_third_year`='".$d['f3y']."',`benefit_b_fourth_year`='".$d['f4y']."',`benefit_b_fifth_year`='".$d['f5y']."' WHERE `package_id`='".$d['packageId']."'";
		$query=$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}

	public function block_unblock()
	{
		$d=$this->input->post();
		$sql="UPDATE `package_master` SET `status`='".$d['status']."' WHERE `package_id`='".$d['packageId']."'";
		$query=$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}
}

?>