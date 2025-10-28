<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Coupon Code Web Design</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="coupon-card">
                <!-- <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="logo"> -->
                <h3>20% flat off on all rides within the city<br>using HDFC Credit Card</h3>
                <di class="coupon-row">
                    <span id="cpnCode">STEALDEAL20</span>
                    <span id="cpnBtn">Copy Code</span>
                </di>
                <p>Valid Till: 20Dec, 2021</p>
                <div class="circle1"></div>
                <div class="circle2"></div>
            </div>
        </div>
    </body>
</html>
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
    height: 100vh;
    background: #f0fff3;
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
    border-right: 0;

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