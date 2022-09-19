<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <div class="container" style="width: 100%;  text-align: center;">
        <div style=" width: 90%;">
            <div>
                <img src="../assets/images/logo.png" width="250" alt="logo" />
                <address>
                    <strong>SAN Softwares Pvt Ltd</strong><br>

                    419, 4th Floor, M3M Urbana, Sector 67,<br> Gurugram, Haryana 122018
                </address>
            </div>
            <hr>
            <div style="width: 100%; margin-top:50px;">
                <table style=" width: 90%;">
                    <tbody>
                        <tr>
                            <th style="  text-align: right;" colspan="2"><strong>Invoice No.: SAN -
                                    <?php echo $clientdetails[0]['invoice_id'] ?></strong></th>

                        </tr>

                        <tr>
                            <th style="text-align: left;" colspan="2"><strong>Invoice Date - </strong> <?php $date = $clientdetails[0]['invoice_date'];
                                echo  date("d/m/Y", strtotime($date)); ?></th>

                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Customer Details:</strong></td>
                        </tr>
                        <tr>
                            <td><?php echo "Name: ".$clientdetails[0]['client_name'];
                                echo '<br>';
                                echo "Email: ".$clientdetails[0]["email"];
                                echo "<br>";
                                echo 'Mobile no: ' . $clientdetails[0]['phone'];
                                echo "<br>";
                                echo 'Address: ' . $clientdetails[0]['full_address']
                                ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div>
            <div style="height: 50px; ">
                <span
                    style="font-size: 35px; color: #0EADF0; letter-spacing: -1px; line-height: 1; vertical-align: top; text-align: right; ">
                    Invoice
                </span>
            </div>
            <br>
        </div>
        <div style="width: 100%; ">
            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                    <tr style="margin-bottom:10px;">
                        <th style="font-size: 20px; font-family: 'Open Sans', sans-serif; color: black; font-weight: normal; line-height: 1; vertical-align: top;" width="52%" align="left">
                            Item
                        </th>
                        <th style="font-size: 20px; font-family: 'Open Sans', sans-serif; color: black; font-weight: normal; line-height: 1; vertical-align: top;" align="left">
                            Price
                        </th>
                        <th style="font-size: 20px; font-family: 'Open Sans', sans-serif; color: black; font-weight: normal; line-height: 1; vertical-align: top;" align="center">
                            Quantity
                        </th>
                        <th style="font-size: 20px; font-family: 'Open Sans', sans-serif; color: black; font-weight: normal; line-height: 1; vertical-align: top;" align="right">
                            Subtotal
                        </th>
                    </tr>
                    <tr>
                        <td height="10" colspan="4"></td>
                    </tr>
                    <tr>
                        <td style="background: #bebebe; height:3px; margin-top:10px;" colspan="4"></td>
                    </tr>
                    <tr>
                        <td height="10" colspan="4"></td>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($clientdetails); $i++) {

                    ?>
                    <tr>
                        <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: black;  line-height: 30px;  vertical-align: top; "
                            class="article">
                            <?php echo $clientdetails[$i]['name'] ?>
                        </td>
                        <td
                            style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: black;  line-height: 30px;  vertical-align: top; ">
                            <small> <?php echo $clientdetails[$i]['item_price'] ?></small>
                        </td>
                        <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: black;  line-height: 30px;  vertical-align: top; "
                            align="center"><small><?php echo $clientdetails[$i]['item_quantity'] ?></small></td>
                        <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: black;  line-height: 30px;  vertical-align: top; "
                            align="right">
                            <small><?php echo number_format($clientdetails[$i]['item_amount'], 2) ?></small></td>
                    </tr>
                    <tr>
                        <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                    </tr>
                    <?php

                    } ?>
                </tbody>
            </table>
        </div>
        <div style="width: 100%; height:100vh; margin-top:10px;">
            <table width="90%" border="" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                    <tr>
                        <td
                            style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                            Total:
                        </td>
                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;"
                            width="80">
                            <?php $total = $clientdetails[0]['grand_total'];
                            echo "$total"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                            Tax &amp; Fees (8%):
                        </td>
                        <td
                            style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                            <?php
                            $tax = $clientdetails[0]['grand_total'] / 100 * 8;
                            echo $tax;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>Grand Total (Incl.Tax):</strong>
                        </td>
                        <td
                            style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong> <?php
                                        echo $tax + $total;
                                        ?></strong>
                        </td>
                    </tr>
                    <tr>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="span8 well invoice-thank">
                <h5 style="text-align:center;">Thank You!</h5>
            </div>
        </div>
    </div>

    <div class="container" style="width: 100%;  text-align: center;">


        <div class="row">
            <div class="span3">
                <strong>Phone:</strong> 0124-4310736
                <strong>support:</strong> 0124-4310735
            </div>
            <div class="span3">
                <strong>Website:</strong> <a href="https://sansoftwares.com/">sansoftwares.com/</a>
            </div>
            <div class="span3">
                <strong>Email:</strong> <a href="support@sansoftwares.com">support@sansoftwares.com</a>
            </div>
        </div>
    </div>
</body>

</html>