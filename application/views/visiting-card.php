<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visiting Card</title>
    <style>
        .box{
            display : flex;
            gap : 10px;
        }

        .box-1{
            height : 55mm;
            width : 85mm;
            border : 1px solid #ccc;
            border-radius : 5px;
            display : flex;
            align-items : center;
            background-color: lightpink;
        }

        .box-2{
            height : 55mm;
            width : 85mm;
            border : 1px solid #ccc;
            border-radius : 5px;
            display: flex;
            flex-direction: column;
            align-items : center;
            justify-content : center;
            gap:0px;
            text-align : center;
            background-color: lightpink;
        }

        .b-1{
            height : 100%;
            width: 40%;
            display: flex;
            align-items : center;
            justify-content : center;
        }

        /* Print Button Styling */
        .print-btn {
            margin: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }

        /* Hide Print Button in Print Mode */
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="box-1">
            <div class="b-1">
                <img src="<?php echo base_url('uploads/profile/'.$profile[0]->customer_id.'.png') ?>" style="height: 130px; border-radius: 5px;" />
            </div>
            <div class="b-2">
                <b><?= $profile[0]->name ?></b><br>
                <small>(Business Representative)</small><br><br>
                <small><b>ID :</b>
                <?= $profile[0]->customer_id ?><br>
                <b>Phone :</b> 
                <?= $profile[0]->mobile ?><br>
                <b>Address :</b> 
                <?= $profile[0]->address ?></small>
            </div>
        </div>
        <div class="box-2">
            <img src="<?php echo base_url(''); ?>portal_assets/images/logo.png" style="height: 100px;">
            <p style="font-size: 10px;"><small>ACEAWS INDIA PVT. LTD., House No: 144, Rajghar Road, Bhangaghar, Kamrup(M), Assam, Guwahati - 781005, Ph: 8638828553</small></p>
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">Print</button>
</body>
</html>