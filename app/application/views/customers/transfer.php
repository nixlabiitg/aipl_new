<div class="page-content bottom-content">
    <div class="container">
        <div class="text-center mb-3">
            <a class="btn btn-info position-relative shadow-info w-100 my-2 ms-2" style="font-size:20px;">
            Wallet : &#8377;<?=$wallet;?>
                            </a>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" placeholder="Customer Id" class="form-control" id="cust_id">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <a class="btn btn-primary text-white" onclick="find();"><i class="fa fa-search"></i>Find</a>

                </div>
            </div>
        </div>

        <div class="divider border-secondary inner-divider transparent mb-0"><span>Customer Details</span></div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input readonly type="text" class="form-control" id="name">
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Mobile</label>
                    <input readonly type="text" class="form-control" id="mobile">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Address</label>
                    <textarea readonly class="form-control" id="address"></textarea>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Sponsor Id</label>
                    <input readonly type="text" id="sponsorId" class="form-control" id="sponsor_id">
                </div>
            </div>

            <div hidden class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Sponsor Name</label>
                    <input readonly type="text" class="form-control" id="cid">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label>Amount (&#8377;)</label>
                    <input type="text" class="form-control" id="amount" placeholder="Enter amount">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <button type="submit" name="addstaff" class="btn btn-primary mt-3 w-100"
                        onclick="transfer()">Transfer</button>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function checkPass(x) {
    var repass = $("#password").val();
    if (x.value != repass) {
        $("#msg").html("Password didn't match. Try again.");
        $("#retypepass").val('');
    }
}


transfer = function() {

    if ($("#amount").val == "") {
        alert("Please enter valid amount.");
        return;
    }
    if (!confirm("Are you sure to transfer amount now?")) return;

    if ($("#cid").val() == "") {
        alert("Customer Not found.");
        return;
    }
    var d = {
        "cid": $("#cid").val(),
        "amount": $("#amount").val()
    }
    $.ajax({
        url: "<?=base_url("Customer/transferamount")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {

            if (data == 'd') alert("Don't have sufficient balance in activation wallet.");
            else alert("Amount Transfered Successfully")
            window.location.reload();
        },
        error: function(data) {
            alert(data);
        }

    })
}


find = function() {

    var d = {
        "cid": $("#cust_id").val()
    }

    $.ajax({
        url: "<?=base_url("Customer/findtotransfer")?>",
        type: "POST",
        dataType: "TEXT",
        data: d,
        success: function(data) {
            //   alert(data);
            var d1 = JSON.parse(data);

            for (i = 0; i < d1.length; i++) {
                $("#name").val(d1[i]['name']);
                $("#address").val(d1[i]['address']);
                $("#mobile").val(d1[i]['mobile']);
                $("#email").val(d1[i]['email']);
                $("#sponsorId").val(d1[i]['sponsor_id']);
                $("#cid").val(d1[i]['customer_id']);
            }


        },
        error: function(data) {
            alert(data);
        }

    })
}
</script>