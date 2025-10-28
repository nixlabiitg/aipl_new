

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Coupon</h3>
          
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-daterange" id="" data-toggle="kt-tooltip" title=""
                    data-placement="left">
                    <span class="kt-subheader__btn-daterange-title"
                        id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date"
                        id="kt_dashboard_daterangepicker_date"><?php echo date('d M Y') ?></span>
                    <i class="flaticon2-calendar-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
            <div class="container">
                    <div class="coupon-card">
                        <!-- <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="logo"> -->
                        <h3>&#8377; <?=$coupon[0]['shopping_coupon_amt']?> /- shopping coupon<br><?=$coupon[0]['no_of_coupon']?>  times usable</h3>
                        <di class="coupon-row">
                            <span id="cpnCode">AIPLDEAL100</span>
                            <!-- <span id="cpnBtn">Copy Code</span> -->
                        </di>
                        <!-- <p>Valid Till: 20 Dec, 2023</p> -->
                        <div class="row">
                                <div class="col-lg-6 text-left">
                                    Used : <?=$coupon[0]['coupon_used']?> times
                                </div>
                                <div class="col-lg-6 text-right">
                                    Available : <?=$coupon[0]['no_of_coupon']-$coupon[0]['coupon_used']?> times
                                </div>

                        </div>

                        <div class="circle1"></div>
                        <div class="circle2"></div>
                    </div>
        </div>
            </div>
        </div>
    </div>
</div>






       
   
<style>
    /*the complete project is in the following link:
https://github.com/vkive/coupon-code.git
Follow me on Codepen
*/
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins', sans-serif;
    
}
.container{
    width: 100%;
    height: 50vh;
    /* background: #f0fff3; */
    display: flex;
    align-items: center;
    justify-content: center;

}
.coupon-card{
    background: linear-gradient(135deg, #7158fe, #9d4de6);
    color: #fff;
    text-align: center;
    padding: 40px 80px;
    border-radius: 15px;
    box-shadow: 0 10px 10px 0 rgba(0,0,0,0.15);
    position: relative;

}
.logo{
    width: 80px;
    border-radius: 8px;
    margin-bottom: 20px;

}
.coupon-card h3{
    font-size: 28px;
    font-weight: 400;
    line-height: 40px;

}
.coupon-card p{
    font-size: 15px;

}
.coupon-row{
    display: flex;
    align-items: center;
    margin: 25px auto;
    width: fit-content;

}
#cpnCode{
    border: 1px dashed #fff;
    padding: 10px 20px;
    /* border-right: 0; */

}
#cpnBtn{
    border: 1px solid #fff;
    background: #fff;
    padding: 10px 20px;
    color: #7158fe;
    cursor: pointer;
}
.circle1, .circle2{
    background: #f0fff3;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);

}
.circle1{
    left: -25px;
}
.circle2{
    right: -25px;
}

</style>

<style>
     var cpnBtn = document.getElementById("cpnBtn");
            var cpnCode = document.getElementById("cpnCode");

            cpnBtn.onclick = function(){
                navigator.clipboard.writeText(cpnCode.innerHTML);
                cpnBtn.innerHTML ="COPIED";
                setTimeout(function(){
                    cpnBtn.innerHTML="COPY CODE";
                }, 3000);
            }
</style>