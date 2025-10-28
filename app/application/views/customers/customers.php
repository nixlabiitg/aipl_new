<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="col-12">
                <?php
                    $id = 0;
                    function underCustomer($customerId)
                    {
                        $c = &get_instance();
                        $uc = "";
                        $sql = "SELECT * FROM `customer_master` WHERE `sponsor_id`='".$customerId."'";
                        $query = $c->db->query($sql);
                        $result = $query->result_array();
                        if($c->db->affected_rows()>0)
                        {
                            foreach ($result as $rs) {                                      
                                    $uc = $rs['customer_id']."/". underCustomer($rs['customer_id']) ;
                            
                            }
                        }
                        else
                        {
                            $uc = $rs['customer_id'];
                        }
                        
                        return $uc;
                    }

                    foreach ($cust as $c) {
                    $sl = ++$id;
                    $custid=underCustomer($c['customer_id'])   ;
                    // echo $custid;
                    $criteria="";
                    $cd=explode("/",$custid);
                    for($i=0;$i<count($cd)-1;$i++)
                    {
                        if($i<(count($cd)-2)) $criteria.="customer_id='".$cd[$i]."' or ";
                            else $criteria.="customer_id='".$cd[$i]."'" ;
                    }
                        // echo $criteria;
                        $criteria=($criteria!=""?"WHERE ".$criteria:" WHERE customer_id=''");   
                    
                    if($c['st']==$status)
                    {
                ?>
                    <div class="card payment-service">
						<div class="card-header border-0 pb-0">
							<h5 class="card-title sub-title">Customer ID : <?=$c['customer_id']?></h5>
							<div class="active-style"></div>
						</div>
						<div class="card-body">
							<ul class="card-list">
								<li>
									<div class="accordion style-2" id="accordionExample<?= $sl ?>">
										<div class="accordion-item">
											<h2 class="accordion-header" id="heading<?= $sl ?>">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $sl ?>" aria-expanded="false" aria-controls="collapse<?= $sl ?>">
													<i class="fa-solid fa-user icon-bx me-2"></i>
													<?= $c['name'] ?>
												</button>
											</h2>
											<div id="collapse<?= $sl ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $sl ?>" data-bs-parent="#accordionExample<?= $sl ?>" style="">
												<div class="accordion-body">
													<table class="table table-bordered table-striped">
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>: <?= $c['address']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact No</th>
                                                            <td>: <?= $c['mobile']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>: <?= $c['email']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sponsor Id</th>
                                                            <td>: <?=$c['sponsor_id']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Package</th>
                                                            <td>: <?= $c['package_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee/Relationship</th>
                                                            <td>: <?= $c['nominee']?>, <?= $c['relationship']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee Bank Account No</th>
                                                            <td>: <?= $c['nominee_bank_no']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee DOB</th>
                                                            <td>: <?= $c['nominee_dob']?></td>
                                                        </tr>
                                                        <?php if($status==1) { ?>
                                                        <tr>
                                                            <th>Approved Date</th>
                                                            <td>: <?= $c['rgdate']?></td>
                                                        </tr>
                                                        <?php } else {?>
                                                        <tr>
                                                            <th>Registration Date</th>
                                                            <td>: <?= date('d M Y, h:i A', strtotime($c['rgdate']))?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </table>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
                <?php } 
                    $sql="SELECT *,c.status as st,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id   ".$criteria;
                
                    $query=$this->db->query($sql);
                    $res=$query->result_array();
                    foreach($res as $c)
                    {
                    if($c['st']==$status)
                    {
                ?>
                    <div class="card payment-service">
						<div class="card-header border-0 pb-0">
							<h5 class="card-title sub-title">Customer ID : <?=$c['customer_id']?></h5>
							<div class="active-style"></div>
						</div>
						<div class="card-body">
							<ul class="card-list">
								<li>
									<div class="accordion style-2" id="accordionExample">
										<div class="accordion-item">
											<h2 class="accordion-header" id="heading1">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $sl ?>" aria-expanded="false" aria-controls="collapse<?= $sl ?>">
													<i class="fa-solid fa-user icon-bx me-2"></i>
													<?= $c['name'] ?>
												</button>
											</h2>
											<div id="collapse<?= $sl ?>" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionExample" style="">
												<div class="accordion-body">
													<table class="table table-bordered table-striped">
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>: <?= $c['address']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact No</th>
                                                            <td>: <?= $c['mobile']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>: <?= $c['email']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sponsor Id</th>
                                                            <td>: <?=$c['sponsor_id']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Package</th>
                                                            <td>: <?= $c['package_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee/Relationship</th>
                                                            <td>: <?= $c['nominee']?>, <?= $c['relationship']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee Bank Account No</th>
                                                            <td>: <?= $c['nominee_bank_no']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nominee DOB</th>
                                                            <td>: <?= $c['nominee_dob']?></td>
                                                        </tr>
                                                        <?php if($status==1) { ?>
                                                        <tr>
                                                            <th>Approved Date</th>
                                                            <td>: <?= $c['rgdate']?></td>
                                                        </tr>
                                                        <?php } else {?>
                                                        <tr>
                                                            <th>Registration Date</th>
                                                            <td>: <?= date('d M Y, h:i A', strtotime($c['rgdate']))?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </table>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
                <?php }} } ?>
                </div>
            </div>
        </div>
    </div>
</div>