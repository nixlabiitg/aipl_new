



<div class="page-body" >
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Product Management
                            <small>Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Product Management</li>
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
                <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?=base_url('orders/pendingOrders') ?>">Pending Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('orders/despatchOrders') ?>">Despatched Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('orders/deliveredOrders') ?>">Delivered Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=base_url('orders/cancelOrders') ?>" >Cancelled Orders</a>
                        </li>
                        </ul>
                    <!-- <div class="card-header">
                        <h3>CANCELED ORDERS</h3>
                    </div> -->
                    <div class="row mt-4">
                          <div class="col-lg-2" style="text-align:right">
                                <label for="productName">Seller Name</label>                                   
                          </div>
                            <div class="col-lg-4 ">                                                        
                            <select class="form-control" id="seller">
                                <?php foreach($seller as $s) {?>
                                    <option value="<?=$s['user_id']?>"><?=$s['company_name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-4" style="text-align:left">                                                        
                            <span class="btn badge-info" onclick="cancelled_orders();">Display</button>
                            </div>
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
                                            
                                          <th>Product Image(s)</th>
                                            <th>Product Name</th>                                          
                                            <th>Customer Name</th>
                                            <th>Order Id</th>
                                            <th>Order Date</th>
                                            <th>Quantity</th>  
                                            <th>Amount</th>  
                                            <th>Status</th>                           
                                        </tr>
                                    </thead>
                                    <tbody id="bd1">
                                        <?php                                                                           
                                        $id = "0";
                                        foreach ($PRODUCTS as $product) {
                                    
                                        ?>
                                       
                                        <input hidden id="delid<?php echo $product['order_id']?>" value="<?= $product['delid']  ?>">
                                        <span hidden id="add<?php echo $product['order_id']?>"><p class="mb-0">Address 1 : <?= $product['address1'] ?></p><p class="mb-0">House No : <?= $product['house_no']  ?></p><p class="mb-0">Road Name : <?= $product['road_name']  ?></p><p class="mb-0">PIN : <?= $product['pin'] ?><p class="mb-0"> Contact No : <?= $product['contact_no']  ?></p></span>
                                      
                                       
                                        <tr>
                                            <td class="text-center">
                                                <?php echo ++$id ?>
                                            </td>
                                            <td class="text-center">
                                                <img src="<?php echo base_url('uploads/products/'.$product['product_image_one']) ?>" alt="" class="rounded images" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                                                data-imageone = "<?php echo base_url('uploads/products/'.$product['product_image_one']) ?>"
                                                data-imagetwo = "<?php echo base_url('uploads/products/'.$product['product_image_two']) ?>"
                                                data-imagethree = "<?php echo base_url('uploads/products/'.$product['product_image_three']) ?>"
                                                data-imagefour = "<?php echo base_url('uploads/products/'.$product['product_image_four'] ) ?>"
                                                data-imagefive = "<?php echo base_url('uploads/products/'.$product['product_image_five']) ?>"
                                                data-imagesix = "<?php echo base_url('uploads/products/'.$product['product_image_six']) ?>"
                                                style="height:70px; width:70px; cursor:pointer;">
                                            </td>                                           
                                            <td><?= $product['product_name'] ?></td>
                                        
                                            <td id="cname<?php echo $product['order_id']?>"><?= $product['name']  ?></td>
                                            <td id="refno<?php echo $product['order_id']?>"><?= $product['ref_no']  ?></td>
                                            <td id="odate<?php echo $product['order_id']?>"><?= $product['order_date']  ?></td>
                                            <td id="qty<?php echo $product['order_id']?>" style="text-align:center;"><?= $product['qty']  ?></td>
                                            <td style="text-align:center;"><?= $product['netamount']  ?></td>                                         
                                            <td style="text-align:center;"><?= ($product['delivery_date']?"Delivered On ".$product['delivery_date']." Cancelled On ".$product['cancel_date']:"Cancelled On ".$product['cancel_date'])  ?></td>
                                         
                                        </tr>
                                        <span hidden id="despatchdetails<?php echo $product['order_id']?>"><p class="mb-0">Despatch Date : <?= $product['despatch_date'] ?></p><p class="mb-0">Reference/Tracking Id: <?= $product['reference_track_id']  ?></p><p class="mb-0">Despatch Through : <?= $product['despatch_through']  ?></p><p class="mb-0">Contact No : <?= $product['cn'] ?><p class="mb-0"> Remarks : <?= $product['remarks']  ?></a><p class="mb-0"> Delivered On : <?= $product['delivery_date']  ?></p></span>
                                
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



<div class="modal fade" id="productdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Despatch </h5>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="close_();">
          <span aria-hidden="true" onclick="close();">&times;</span>
        </button>
     
      </div>
      <div class="modal-body">
            <div class="container">
            <div class="row justify-content-center align-items-center mb-3">
                    <div class="col-lg-3 text-right">
                       <label for="despatch">Order No :</label>
                    </div>
                    <div class="col-lg-3">                
                        <label  id="orderno"></lable>
                    </div>
                    <div class="col-lg-3  text-right">
                     <label for="despatch">Date :</label>
                    </div>
                    <div class="col-lg-3">                  
                        <label id="orderdate"  ></lable>
                    </div>
             </div>


                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-3  text-right">
                        <label for="despatch">Customer :</label>
                    </div>
                    <div class="col-lg-9">
                        <label id="custname" ></label>
                    </div>
                </div>
                <div class="row justify-content-center align-center">
                    <div class="col-lg-3  text-right">
                        <label for="despatch">Delivery Address :</label>
                    </div>
                    <div class="col-lg-9">
                        <span  id="address" ></span>
                    </div>
                </div>
                        <div class="row">
                                        <div class="col-lg-12">                           
                                                    <div class="table-wrap">                   
                                                        <table class="table display" id="basic-1" style="width:100%;font-size:12px;" >
                                                            <thead>
                                                                <tr class="text-center">   
                                                                <th>#</th>                                        
                                                                    <th>Product Name</th>
                                                                    <th>Carat</th>
                                                                    <th>Weight</th>
                                                                
                                                                    <th>Quantity</th>  
                                                                    <th>Amount</th>  
                                                                
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bd">
                                                            
                                                            </tbody>
                                                        </table>
                                                        <hr>

                                                        
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                    <input  type="text" hidden id="delvid" class="form-control" >
                  
                  </div>  
                  <div class="row justify-content-center align-center">
                    
                    <div class="col-lg-9">
                        <span  id="des" ></span>
                    </div>
                </div>
                  <input hidden type="text"  id="orederid" class="form-control" >
                       
                  <div class="row justify-content-center align-items-center mb-3">
                            <div class="col-lg-11  text-right">
                                <a  class="btn btn-primary btn-sm text-white" onclick=close_();>Close</a>
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
        url : "<?php echo base_url('products/ordered_product'); ?>",
        type : "POST",
        dataType : "text",
        data : d,
        success : function(data) {
         // do something
         //  alert(data);
         $("#custname").html($("#cname"+x.id).html());
         $("#orderno").html($("#refno"+x.id).html());
         $("#orderdate").html($("#odate"+x.id).html());
         $("#delvid").val($("#delid"+x.id).val());
         $("#address").html($("#add"+x.id).html());
         $("#des").html($("#despatchdetails"+x.id).html());
         $("#orederid").val(x.id);

           var d=JSON.parse(data);
           var tm="";
               for(i in d){
                         tm+="<tr><td class='text-center'>"+(Number(i)+1)+"</td>"  
                         +"<td>"+ d[i]['product_name']+"</td>"  
                         +"<td class='text-center'>"+ d[i]['carat']+"</td>"
                         +"<td class='text-center'>"+ d[i]['weight']+"</td>"
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
        url : "<?php echo base_url('products/despatch'); ?>",
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
    dom: 'Bfrtirp',
    //dom: 'lfrBrrtip',
  
   

});
};


cancelled_orders=function()
{
    var em="";
    var d={
            "sid":$("#seller").val()
        }
        $.ajax({
        url : "<?php echo base_url('orders/cancelOrders'); ?>",
        type : "POST",
        dataType : "text",
        data : d,
        success : function(data) {
         // do something
      //  alert(data);
         po=JSON.parse(data);
      //    alert(po.length);
        
         for(i=0;i<po.length;i++)
         {
            var path='<?php echo base_url() ;?>'+'uploads/products/'+po[i]['product_image_one'];   
            path=path.replace("admin","seller");
        
                em+="<input hidden id='delid"+po[i]['order_id']+"' value='"+po[i]['delid']+"' >"
                +'<span hidden id="add'+po[i]['order_id']+'"><p class="mb-0">Address 1 : '+ po[i]['address1'] +'</p><p class="mb-0">House No : '+po[i]['house_no']+'</p><p class="mb-0">Road Name : '+po[i]['road_name']+'</p><p class="mb-0">PIN : '+po[i]['pin']+'<p class="mb-0"> Contact No : '+po[i]['contact_no']+'</span>'
                                        +"<tr>"
                                            +'<td class="text-center">'
                                                +(i+1)+'</td>'
                                            +'<td class="text-center"><img src="'+path+'"  alt="" class="rounded images" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"' 
                                             
                                            +'style="height:70px; width:70px; cursor:pointer;" />'
                                            +'</td>'          
                                            +'<td>'+po[i]['product_name']+'</td>'                                        
                                            +'<td id="cname'+po[i]['order_id']+'">'+ po[i]['name']+'</td>'
                                            +'<td id="refno'+po[i]['order_id']+'">'+ po[i]['ref_no']+'</td>'
                                            +'<td id="odate'+po[i]['order_id']+'">'+po[i]['order_date'] +'</td>'
                                            +'<td id="qty'+po[i]['order_id']+'>" style="text-align:center;">'+po[i]['qty']+'</td>'
                                            +'<td style="text-align:center;">'+po[i]['netamount']+'</td>'                                         
                                         //   +'<td style="text-align:center;">Delivered On '+ po[i]['delivery_date'] +'</td>'
                                            +'<td style="text-align:center;">'+ (po[i]['delivery_date']?"Delivered On "+po[i]['delivery_date']+" Cancelled On "+po[i]['cancel_date']:"Cancelled On "+po[i]['cancel_date'])+'</td>'
                                                           
                                            // +'<td class="text-center">'
                                            //     +'<a id="'+po[i]['order_id']+'" class="btn btn-primary btn-sm text-white" onclick=despatch(this);>Details</a>'
                                       
                                            // +'</td> '   
                                        +'</tr>'
                                      //  +'<span  hidden id="despatchdetails'+$po[i]['order_id']+'"><p class="mb-0">Despatched On : '+ $po[i]['despatch_date'] +'</p><p class="mb-0">Reference/Tracking Id: '+ $po[i]['reference_track_id']+'</p><p class="mb-0">Despatch Through : '+ $po[i]['despatch_through']+'</p><p class="mb-0">Contact No : '+ $po[i]['cn']+'<p class="mb-0"> Remarks : '+ $product['remarks'] +'</span>'
                                
             }     
          
            $("#bd1").html(em);
            },
            error : function(data) {
                // do something
                alert(data);
            }
         });

   
}
</script>