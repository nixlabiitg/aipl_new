<div class="page-body" >

   
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Service Management
                            <small>Service panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Service</li>
                        <li class="breadcrumb-item active">Service Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <?php $this->load->view('messages') ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3><?=($status==0?"PENDING SERVICE":($status==1?"APPROVED SERVICE":($status==2 ?"CANCELED SERVICE BY SERVICE PROVIDER":($status==4 ?"CANCELED SERVICE BY CUSTOMER":"COMPLETED SERVICE"))))?></h3>
                    </div>
                 
                   <!-- <div class="card-body">-->
                        <!-- Add category -->
                        <div class="col-lg-12">
                            <div class="card-body order-datatable">
                                <!-- <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_12" > -->
                                <table class="table table-striped- table-bordered table-hover table-checkable" id="basic-1" style="width:100%;">
                              
                                <thead>
                                        <tr class="text-center">  
                                        <th>#</th>  
                                           <th>Image(s)</th>
                                           <th>Service Provider</th>    
                                            <th>Service Name</th>  
                                            <th>Customer Name</th>                                                 
                                            <th>Order Id</th>
                                            <th>Order Date</th>                                            
                                            <th>Amount</th>  
                                         
                                            <th>Note</th>  
                                            <?php if ($status==2 || $status==4) {?>
                                            <th>Cancel Date</th> 
                                            <th>Cancel Reason</th> <?php }?>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php                                                                           
                                        $id = "0";
                                        foreach ($PRODUCTS as $product) {
                                    
                                        ?>
                                        <input hidden id="delivery_address_id<?php echo $product['s_order_id']?>" value="<?= $product['delivery_address_id']  ?>">
                                        <span hidden id="add<?php echo $product['s_order_id']?>"><p class="mb-0">Address 1 : <?= $product['address1'] ?></p><p class="mb-0">House No : <?= $product['house_no']  ?></p><p class="mb-0">Road Name : <?= $product['road_name']  ?></p><p class="mb-0">PIN : <?= $product['pin'] ?><p class="mb-0"> Contact No : <?= $product['contact_no']  ?></span>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo ++$id ?>
                                            </td>
                                            <td class="text-center">
                                                <img src="<?php echo base_url('../service/uploads/products/'.$product['image_one']) ?>" alt="" class="rounded images" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                                                data-imageone = "<?php echo base_url('../service/uploads/products/'.$product['image_one']) ?>"
                                                data-imagetwo = "<?php echo base_url('../service/uploads/products/'.$product['image_two']) ?>"
                                                data-imagethree = "<?php echo base_url('../service/uploads/products/'.$product['image_three']) ?>"
                                                data-imagefour = "<?php echo base_url('../service/uploads/products/'.$product['image_four'] ) ?>"
                                                data-imagefive = "<?php echo base_url('../service/uploads/products/'.$product['image_five']) ?>"
                                                data-imagesix = "<?php echo base_url('../service/uploads/products/'.$product['image_six']) ?>"
                                                style="height:70px; width:70px; cursor:pointer;">
                                            </td>         
                                            <td id="sname<?php echo $product['s_order_id']?>"><?= $product['s_provider_name'] ?></td>                                                                      
                                            <td id="sname<?php echo $product['s_order_id']?>"><?= $product['service_name'] ?></td>
                                        
                                             <td id="cname<?php echo $product['s_order_id']?>"><?= $product['name']  ?></td> 
                                            <td id="refno<?php echo $product['s_order_id']?>"><?= $product['ref_no']  ?></td>
                                            <td id="odate<?php echo $product['s_order_id']?>"><?= $product['order_date']  ?></td>
                                             <td style="text-align:center;"><?= $product['net_amount']  ?></td> 
                                             <td style="text-align:center;"><?= $product['note']  ?></td> 
                                             <?php if ($status==2 || $status==4) {?>
                                                <td style="text-align:center;"><?= $product['cancel_date']  ?></td> 
                                                <td style="text-align:center;"><?= $product['cancel_reason']  ?></td> 
                                           
                                            <?php } ?>   

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                               </div>
                        </div>
                    </div>
                </div>
          <!--  </div>  -->
        </div>
    </div>
    <form id='pd'  action="<?php echo base_url('products/product_details'); ?>" method="post">
                                                   <input hidden id="pcode" name="pcode" type="text" >     
                                                   <input hidden id="pname" name="pname" type="text" >     
                                                   <input hidden id="catid" name="catid" type="text" >  
                                                </form>
    <form id='pedit'  action="<?php echo base_url('products/editProduct'); ?>" method="post">
        <input hidden id="pid" name="pid" type="text" >     
        <input hidden id="pcode" name="pcode" type="text" >     
        <input hidden id="pname" name="pname" type="text" >     
        <input hidden id="catid" name="catid" type="text" >  
    </form>                          
    
<style>
img {
  font-family: 'Helvetica';
  font-weight: 300;
  line-height: 2;  
  text-align: center;
  
  width: 100%;
  height: auto;
  display: block;
  position: relative;
  min-height: 50px;
}

img:before { 
  content: " ";
  display: block;

  position: absolute;
  top: -10px;
  left: 0;
  height: calc(100% + 10px);
  width: 100%;
  background-color: rgb(230, 230, 230);
  border: 2px dotted rgb(200, 200, 200);
  border-radius: 5px;
}

img:after { 
  content: "\f127" " Not Found ";
  display: block;
  font-size: 16px;
  font-style: normal;
  font-family: FontAwesome;
  color: rgb(100, 100, 100);
  
  position: absolute;
  top: 5px;
  left: 0;
  width: 100%;
  text-align: center;
}
</style>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Product Images</h5>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-4">
                        <img src="" alt="" id="imageOne" class="rounded mb-2" style="width:100%; height:100%;">
                    </div>
                    <div class="col-lg-4">
                        <img src="" alt="" id="imageTwo" class="rounded mb-2"  style="width:100%; height:100%;">
                    </div>
                    <div class="col-lg-4">
                        <img src="" alt="" id="imageThree" class="rounded mb-2"  style="width:100%; height:100%;">
                    </div>
                    <div class="col-lg-4">
                        <img src="" alt="" id="imageFour" class="rounded mb-2"  style="width:100%; height:100%;">
                    </div>
                    <div class="col-lg-4">
                        <img src="" alt="" id="imageFive" class="rounded mb-2"  style="width:100%; height:100%;">
                    </div>
                    <div class="col-lg-4">
                        <img src="" alt="" id="imageSix" class="rounded mb-2"  style="width:100%; height:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="productdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-s" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Service Order</h5>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="close_();">
          <span aria-hidden="true" onclick="close();">&times;</span>
        </button>
     
      </div>
      <div class="modal-body">
            <div class="container">
                <div class="row justify-content-center align-items-center mb-0">
                        <div class="col-lg-4 text-right">
                        <label for="despatch">Order No :</label>
                        </div>
                        <div class="col-lg-8">                
                            <label  id="orderno"></lable>
                        </div>                    
                    
                </div>
                <div class="row justify-content-center align-items-center mb-0">
                   <div class="col-lg-4  text-right">
                     <label for="despatch">Date :</label>
                    </div>
                    <div class="col-lg-8">                  
                        <label id="orderdate"  ></lable>
                    </div>
            </div>


                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-4  text-right">
                        <label for="despatch">Customer :</label>
                    </div>
                    <div class="col-lg-8">
                        <label id="custname" ></label>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-4  text-right">
                        <label for="despatch">Service Requested :</label>
                    </div>
                    <div class="col-lg-8">
                        <label id="service" ></label>
                    </div>
                </div>
                <div class="row justify-content-center align-center">
                    <div class="col-lg-4  text-right">
                        <label for="despatch">Service Location:</label>
                    </div>
                    <div class="col-lg-8">
                        <span  id="address" ></span>
                    </div>
                </div>
                <div class="row justify-content-center align-center">
                    <div class="col-lg-4  text-right">
                        <label for="despatch">Update Status</label>
                    </div>
                    <div class="col-lg-8">
                      <select name="status" id="status" class="form-control" required onchange="sub_category(this);">
                                                <option  selected value="1">Complete</option>
                                                <option  value="2">Cancel</option>                                          
                      </select>
                    </div>
                </div>

              
                <input  type="text" hidden id="delvid" class="form-control" >
                              
                   
                 
                  
                
                  </div>  
                  <input hidden type="text"  id="orederid" class="form-control" >
                       
                  <div class="row justify-content-right align-items-center mb-3">
                            <div class="col-lg-11  text-right">
                                <a  class="btn btn-primary btn-sm text-white" onclick=save_despatch(this);>Submit</a>
                            </div>
                </div>             
             </div>
         </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).on('click', '.images', function(e){
        $img1 = $(this).data('imageone');
        $img2 = $(this).data('imagetwo');
        $img3 = $(this).data('imagethree');
        $img4 = $(this).data('imagefour');
        $img5 = $(this).data('imagefive');
        $img6 = $(this).data('imagesix');

        $("#imageOne").attr('src', $img1);
        $("#imageTwo").attr('src', $img2);
        $("#imageThree").attr('src', $img3);
        $("#imageFour").attr('src', $img4);
        $("#imageFive").attr('src', $img5);
        $("#imageSix").attr('src', $img6);
    })

despatch=function(x)
{
    var d={
            "orderid":x.id
                 }
        $.ajax({
        url : "<?php echo base_url('orders/ordered_product'); ?>",
        type : "POST",
        dataType : "text",
        data : d,
        success : function(data) {
         // do something
         //  alert(data);
         $("#custname").html($("#cname"+x.id).html());
         $("#service").html($("#sname"+x.id).html());
         $("#orderno").html($("#refno"+x.id).html());
         $("#orderdate").html($("#odate"+x.id).html());
         $("#delvid").val($("#delivery_address_id"+x.id).val());
         $("#address").html($("#add"+x.id).html());
         $("#orederid").val(x.id);

           var d=JSON.parse(data);
           var tm="";
               for(i in d){
                         tm+="<tr><td class='text-center'>"+(Number(i)+1)+"</td>"  
                         +"<td>"+ d[i]['product_name']+"</td>"  
                         +"<td class='text-center'>"+ d[i]['batch_no']+"</td>"
                         +"<td class='text-center'>"+ d[i]['price']+"</td>"
                         +"<td class='text-center'>"+ d[i]['qty_out']+"</td>"    
                         +"<td class='text-center'>"+ d[i]['netamount']+"</td></tr>"   ;                     
              
             }
             $("#bd").html(tm);
            },
            error : function(data) {
                // do something
                alert(data);
            }
         });

        $("#productdetails").modal("show");
}
close_=function()
{
   $("#productdetails").modal("toggle");
}

save_despatch=function(x)
{
    
        var d={
                "orderid":$("#orederid").val(),
                "despatch_through":$("#despatch").val(),
                "contact_no":$("#contactno").val(),
                "remarks":$("#remarks").val(),
                "deladdid":$("#delvid").val(),
                "trackid":$("#tracking").val()
                }
        $.ajax({
        url : "<?php echo base_url('orders/despatch'); ?>",
        type : "POST",
        dataType : "text",
        data : d,
        success : function(data) {
              // do something
              // alert(data);
                if(data==1)
                {
                   alert("Order Despatched Successfully.");                   
                    window.location.reload();                
                }
                else
                { 
                    alert("Failed To Despatch.");                    
                }
            },
            error : function(data) {
                // do something
                alert(data);
            }
         });
}

</script>

<script>
  
$( document ).ready(function() {
initTable1();
});
    var initTable1 = function() {
    var table = $('#kt_table_12');
// begin first table
table.DataTable({
    responsive: true,
    paging: true,
    dom: 'Bfrtirp'
   
});
};
</script>