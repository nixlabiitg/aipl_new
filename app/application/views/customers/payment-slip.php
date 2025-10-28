<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Slip</title>
    <style>
    .payment-slip {
        display: border-box;
        margin: 10px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .payment-header {
        text-align: center;
    }

    .payment-header p {
        margin-top: -10px;
    }

    .payment-member-details table {
        width: 100%;
    }

    .payment-details{
        margin-top:20px;
    }

    .payment-details table{
        width : 100%;
        border : 1px solid #ccc;
        border-collapse : collapse;
    }

    .payment-details table tr td, th{
        border : 1px solid #ccc;
    }
    </style>
</head>

<body>
    <div class="payment-slip">
        <div class="payment-header">
            <h2><strong>ACEAWS INDIA PVT. LTD.</strong></h2>
            <p>House No: 144, Rajghar Road, Bhangaghar, <br /> Kamrup(M), Assam, Guwahati - 781005,<br /> Ph:
                8638828553</p>
        </div>

        <div class="payment-member-details">
            <h3 style="text-align:center; text-transform : uppercase;"><u>Payment Slip</u></h3>
            <table>
                <tbody>
                    <tr>
                        <td><b>Member Name :</b> <?= $PAYMENT[0]->name ?></td>
                        <td><b>Member ID :</b> <?= $PAYMENT[0]->customer_id ?></td>
                    </tr>
                    <tr>
                        <td><b>Contact No :</b> <?= $PAYMENT[0]->mobile ?></td>
                        <td><b>Email ID :</b> <?= $PAYMENT[0]->email ?></td>
                    </tr>
                    <tr>
                        <td><b>Payment Date :</b> <?= date('d F Y', strtotime($PAYMENT[0]->approve_date)) ?></td>
                        <td><b>Slip No : </b> PAY-SLIP-<?= $PAYMENT[0]->id ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="payment-details">
            <table>
                <colgroup>
                    <col style="width: 80%"/>
                    <col style="width: 20%"/>
                </colgroup>
                <tbody>
                    <tr>
                        <th style="text-align:left;"><u>Payments</u></th>
                        <th style="text-align: right;">Amount(&#8377;)</th>
                    </tr>
                    <tr>
                        <td>Payout Request (Income)</td>
                        <td style="text-align: right;"><?= number_format($PAYMENT[0]->request_amount, 2) ?></td>
                    </tr>

                    <tr>
                        <th style="text-align:left;" colspan="2"><u>Deduction</u></th>
                    </tr>
                    <tr>
                        <td>TDS(<?= $SETTINGS[0]->tds ?>%)</td>
                        <td style="text-align: right;"><?= number_format($PAYMENT[0]->tds, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Admin Charge (<?= $SETTINGS[0]->admIn_charge ?>%)</td>
                        <td style="text-align: right;"><?= number_format($PAYMENT[0]->admin_charge, 2) ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr style="text-align: right;">
                        <td><b>TOTAL PAYMENT : </b></td>
                        <td><b><?= number_format($PAYMENT[0]->request_amount, 2) ?></b></td>
                    </tr>

                    <tr style="text-align: right;">
                        <td><b>TOTAL DEDUCTION : </b></td>
                        <td><b>(-)<?= number_format($PAYMENT[0]->tds + $PAYMENT[0]->admin_charge, 2) ?></b></td>
                    </tr>

                    <tr style="text-align: right;">
                        <td><b>NET PAY : </b></td>
                        <td style="color : green;"><b><?= number_format($PAYMENT[0]->request_amount - ($PAYMENT[0]->tds + $PAYMENT[0]->admin_charge), 2) ?></b></td>
                    </tr>
                </tfoot>
            </table>

            <div style="text-align: right; margin-top : 50px;">
                <p>Authorized signature</p>
            </div>
        </div>
    </div>
</body>

</html>