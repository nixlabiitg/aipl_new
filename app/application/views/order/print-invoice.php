<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice</title>
    <style>
    * {
        /* font-size: 12px; */
    }

    table {
        border: 1px solid #000;
        width: 100%;
        border-collapse: collapse;
        margin-top: 2px;
        font-size: 8px;
    }

    table tr th,
    td {
        border: 1px solid #000;
    }
    </style>
</head>

<body>
    <div style="padding:10px; border: 1px solid #000; background-color : lightpink;">
        <div style="text-align:center;">
            <img src="<?php echo base_url('../portal_assets/images/logo.png') ?>" style="height:60px;" alt="">
            <h4><strong>ACEAWS INDIA PVT. LTD.</strong></h4>
            <h3>SALE INVOICE</h3>
        </div>
        <div style="border:1px solid #000; padding-left:5px;">
            <h5>SHIPPING DETAILS:</h5>
            <table style="border:none; margin-top:-35px;">
                <tr>
                    <td style="border:none;">
                        <p>
                            <b>Name : </b> <?= $MEMBER[0]->name ?><br />
                            <b>Phone No : </b> <?= $MEMBER[0]->mobile ?><br />
                            <b>Address : <?= $MEMBER[0]->address ?></b>
                        </p>
                    </td>
                    <td style="border:none; text-align:right; vertical-align:top;">
                        <h3>Invoice No : SALE-INV-<?= $ORDER[0]->order_id ?>&nbsp;<br/>
                        Invoice Date : <?= date('M d, Y h:i A', strtotime($ORDER[0]->order_date)) ?>&nbsp;</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <table>
                <colgroup>
                    <col style="width:5%;">
                    <col style="width:35%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Product Name</th>
                        <th>HSN Code</th>
                        <th>GST(%)</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>GST(&#8377;)</th>
                        <th>Net Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id = 0;
                        $orderid = $ORDER[0]->order_id;
                        $sql = $this->db->query("SELECT o.*, p.product_name, p.HSN_code FROM `order_details` o JOIN product_master p ON p.product_code = o.product_id WHERE o.order_id = '$orderid'");
                        $order_products = $sql->result();
                        foreach($order_products as $data){
                            $including_gst = $data->rate/(1+$data->gst/100);
                            $gst_in_rupee = $data->rate - $including_gst;
                            $total_gst += $gst_in_rupee;

                            // Total amount
                            $total_rate = $data->rate *  $data->qty;
                            $total_amount +=$data->rate;
                    ?>
                    <tr>
                        <td style="text-align:center;"><?= ++$id ?></td>
                        <td><?= $data->product_name ?></td>
                        <td style="text-align:center;"><?= $data->HSN_code ?></td>
                        <td style="text-align:center;"><?= $data->gst ?></td>
                        <td style="text-align:right;"><?= number_format($data->rate, 2) ?></td>
                        <td style="text-align:center;"><?= $data->qty ?></td>
                        <td style="text-align:center;"><?= number_format($gst_in_rupee,2) ?></td>
                        <td style="text-align:right;"><?= number_format($total_rate,2) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table>
                <colgroup>
                    <col style="width:50%;">
                    <col style="width:25%;">
                    <col style="width:25%;">
                </colgroup>
                <tbody>
                    <tr>
                        <th rowspan="7" style="text-align:left; vertical-align:top;">
                        <?php                            
                            $obj=new IndianCurrency($total_amount - $ORDER[0]->discount_price);
                        ?>
                            <b><u>Amount in words : </u></b><br />
                            <?=$obj->get_words()?>
                        </th>
                        <th style="text-align:right;">Total Amount : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($total_amount,2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Total CGST (incl.) : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($total_gst/2, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Total SGST (incl.) : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($total_gst/2, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Total IGST (incl.) : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($total_gst, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Discount : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($ORDER[0]->discount_price, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Net amount to Pay : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($total_amount - $ORDER[0]->discount_price,2) ?></th>
                    </tr>
                </tbody>
            </table>

            <table style="border:none;">
                <tr>
                    <td style="border:none;">
                        <p><strong>ACEAWS INDIA PVT. LTD.</strong><br />
                        House No: 144, Rajghar Road, Bhangaghar,<br />
                        Kamrup(M), Guwahati - 781005, Assam<br />
                        Tel No. : +91 86388 28553
                        </p>
                    </td>
                    <td style="border:none; text-align:center;">
                        <h3>Authorized Signature</h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>