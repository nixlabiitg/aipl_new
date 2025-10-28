<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="container">
                    <div class="coupon-card">
                        <!-- <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="logo"> -->
                        <h3>&#8377; <?=$coupon[0]['shopping_coupon_amt']?> /- shopping
                            coupon <?=$coupon[0]['no_of_coupon']?> times usable</h3>
                        <di class="coupon-row">
                            <span id="cpnCode">AIPLDEAL100</span>
                            <!-- <span id="cpnBtn">Copy Code</span> -->
                        </di>
                        <!-- <p>Valid Till: 20 Dec, 2023</p> -->
                        <div class="row">
                            <div class="col-lg-6 text-left text-warning">
                                Used : <?=$coupon[0]['coupon_used']?> times
                            </div>
                            <div class="col-lg-6 text-right text-success">
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
.coupon-card {
    background: linear-gradient(135deg, #7158fe, #9d4de6);
    color: #fff;
    text-align: center;
    padding: 40px 80px;
    border-radius: 15px;
    box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.15);
    position: relative;

}

.coupon-card h3 {
    font-size: 15px;
    font-weight: 600;
    color : #fff;
    line-height: 20px;

}

.coupon-card p {
    font-size: 15px;

}

.coupon-row {
    display: flex;
    align-items: center;
    margin: 25px auto;
    width: fit-content;

}

#cpnCode {
    border: 1px dashed #fff;
    padding: 10px 20px;
    /* border-right: 0; */

}

#cpnBtn {
    border: 1px solid #fff;
    background: #fff;
    padding: 10px 20px;
    color: #7158fe;
    cursor: pointer;
}

.circle1,
.circle2 {
    background: #f0fff3;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);

}

.circle1 {
    left: -25px;
}

.circle2 {
    right: -25px;
}
</style>

<script>
var cpnBtn=document.getElementById("cpnBtn");
var cpnCode=document.getElementById("cpnCode");

cpnBtn.onclick=function() {
    navigator.clipboard.writeText(cpnCode.innerHTML);
    cpnBtn.innerHTML="COPIED";

    setTimeout(function() {
            cpnBtn.innerHTML="COPY CODE";
        }

        , 3000);
}
</script>