<?php
include "../comman/config.php";
$invoice = new DbConnectivity1();

$addupdate = function () use ($invoice) {
  
if (isset($_POST["form_action"])) {
    
    $client_id = $_POST["asno"];
    $invoice_id = $_POST["number"];
    $invoice_date = $_POST["date"];
    $arr_item_id = $_POST["itemsno"];
    $arr_item_name = $_POST["itemname"];
    $arr_item_price = $_POST["itemprice"];
    $arr_item_quantity = $_POST["itemquantity"];
    $arr_item_total = $_POST["itemamount"];
    $total_Amount = $_POST["tamount"];

    if ($client_id == "") {
        echo "Client name is not set!";
    } else if (in_array('', $arr_item_id) == true) {
        echo "Item is not set!";
    } else if ($invoice_date == "") {
        echo "Invoice Date can't me blank!";
    } else if (in_array('', $arr_item_name) == true) {
        echo "Item name is not set!";
    } else if (in_array('', $arr_item_quantity) == true) {
        echo "Item Quantity is not set!";
    } else if (in_array('', $arr_item_price) == true) {
        echo "Item price is not set!";
    } else if (in_array('', $arr_item_total) == true) {
        echo "Item subTotal is not set!";
    } else if ($total_Amount == 0) {
        echo "Items total amount  is Zero!";
        //validations 
    } else {

        if ($_POST["form_action"] == "insert") {

            $addclient_sql = "INSERT INTO `main_invoice` (`client_id`, `grand_total`, `invoice_date`) 
    VALUES ('$client_id', '$total_Amount', '$invoice_date')";

            $addclient_result = $invoice->Execute($addclient_sql);

            for ($i = 0; $i < count($arr_item_name); $i++) {

                $additem_sql = "INSERT INTO `invoice_item` (`item_id`, `item_price`, `item_quantity`, `item_amount`, `invoice_id`) 
    VALUES ('$arr_item_id[$i]', '$arr_item_price[$i]', '$arr_item_quantity[$i]', '$arr_item_total[$i]', '$invoice_id')";

                $additem_result = $invoice->Execute($additem_sql);
            }
            echo "2";
        }

        if ($_POST["form_action"] == "edit") {

            $updateclient_sql = "UPDATE `main_invoice` SET `client_id` = '$client_id', `grand_total` = '$total_Amount', `invoice_date` = '$invoice_date' WHERE `invoice_id` = '$invoice_id'";

            $updateclient_result = $invoice->Execute($updateclient_sql);


            if ($updateclient_result) {
                $deleteitem_sql = "DELETE FROM `invoice_item` WHERE `invoice_id` = '$invoice_id'";
                $deleteitem_result = $invoice->Execute($deleteitem_sql);

                for ($i = 0; $i < count($arr_item_name); $i++) {
                    $additemedit_sql = "INSERT INTO `invoice_item` (`item_id`, `item_price`, `item_quantity`, `item_amount`, `invoice_id`) 
            VALUES ('$arr_item_id[$i]', '$arr_item_price[$i]', '$arr_item_quantity[$i]', '$arr_item_total[$i]', '$invoice_id')";

                    $additemedit_result = $invoice->Execute($additemedit_sql);
                }
            }
            if ($updateclient_result && $additemedit_result) {
                echo "3";
            }
        }
    }
}
};

$editdetailsfill = function () use ($invoice) {
    $invoice_id = $_POST['invoice_id'];
    $result_array = [];
    
    $invoicesql = "SELECT a.client_id,a.invoice_id,a.invoice_date,c.client_name,c.email,c.phone,CONCAT_WS(',', d.name,e.name,c.address) full_address,b.item_id,f.name,b.item_price,b.item_quantity,b.item_amount,a.grand_total
    from main_invoice a INNER JOIN invoice_item b ON a.invoice_id=b.invoice_id INNER JOIN 
    clientmaster c ON a.client_id=c.sno INNER JOIN states d ON c.state=d.id INNER JOIN cities e ON c.city=e.id 
    INNER JOIN itemmaster f ON b.item_id=f.sno
    WHERE a.invoice_id='$invoice_id'";
    
    $invoiceresult = $invoice->Execute($invoicesql);
    
    foreach($invoiceresult as $row){
        array_push($result_array, $row);
    }
    header('content-type: application/json');
    echo json_encode($result_array);

};

$clientautofill = function () use ($invoice) {
    $client_term = $_POST['search'];
    $cresult_array = [];

    $clientsql = "SELECT clientmaster.sno,clientmaster.client_name,clientmaster.email,clientmaster.phone,
    CONCAT_WS(', ', clientmaster.address, cities.name, states.name) AS address FROM clientmaster 
    INNER JOIN states  ON clientmaster.state=states.id
    INNER JOIN cities ON clientmaster.city=cities.id WHERE clientmaster.client_name LIKE '%$client_term%' ";
    $clientresult = $invoice->Execute($clientsql);

    foreach($clientresult as $row){
        array_push($cresult_array, $row);
    }
    header('content-type: application/json');
    echo json_encode($cresult_array);
};

$itemautofill = function () use ($invoice) {
    $item_term = $_POST['search'];
    $iresult_array = [];

    $itemsql = "select `sno`, `name`, `price` from `itemmaster` where name like '%$item_term%' ";
    $itemresult = $invoice->Execute($itemsql);

    foreach($itemresult as $row){
        array_push($iresult_array, $row);
    }
    header('content-type: application/json');
	echo json_encode($iresult_array);
};

$pdfshow = function () use ($invoice) {
    $invoice_id = $_POST['id'];
    $result_array = [];

    $pdfsql = "SELECT a.client_id,a.invoice_id,a.invoice_date,c.client_name,c.email,c.phone,CONCAT_WS(',', d.name,e.name,c.address) full_address,
    b.item_id,f.name,b.item_price,b.item_quantity,b.item_amount,a.grand_total
    from main_invoice a INNER JOIN invoice_item b ON a.invoice_id=b.invoice_id INNER JOIN 
    clientmaster c ON a.client_id=c.sno INNER JOIN states d ON c.state=d.id INNER JOIN cities e ON c.city=e.id 
    INNER JOIN itemmaster f ON b.item_id=f.sno
    WHERE a.invoice_id='$invoice_id'";

    $pdfresult = $invoice->Execute($pdfsql);

    while ($row = mysqli_fetch_assoc($pdfresult)) {
        array_push($result_array, $row);
    }
    $clientdetails = $result_array;

    include 'vendor/pdfCreate.php';

    $filename ="PDFs/invoice-SAN" . $clientdetails[0]['invoice_id'] . '.pdf';
    downloadPdf($filename, $html, 4, 'F');
    $result = "PDFs/invoice-SAN" . $clientdetails[0]['invoice_id'] . '.pdf';
    echo json_encode(array('result' => $result));
    
};

$sendmail = function () use ($invoice) {
    $invoice_id = $_POST['id'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['emailbody'];
    $result_array = [];

    $clientsql = "SELECT a.client_id,a.invoice_id,a.invoice_date,c.client_name,c.email,c.phone,CONCAT_WS(',', d.name,e.name,c.address) full_address,
    b.item_id,f.name,b.item_price,b.item_quantity,b.item_amount,a.grand_total
    from main_invoice a INNER JOIN invoice_item b ON a.invoice_id=b.invoice_id INNER JOIN 
    clientmaster c ON a.client_id=c.sno INNER JOIN states d ON c.state=d.id INNER JOIN cities e ON c.city=e.id 
    INNER JOIN itemmaster f ON b.item_id=f.sno
    WHERE a.invoice_id='$invoice_id'";

    $clientresult = $invoice->Execute($clientsql);

    while ($row = mysqli_fetch_assoc($clientresult)) {
        array_push($result_array, $row);
    }
    $clientdetails = $result_array;


    include '../invoicemaster/vendor/pdfCreate.php';
    $filename1 = __DIR__ . "\PDFs\invoice-SAN" . $clientdetails[0]['invoice_id'] . '.pdf';

    downloadPdf($filename1, $html, 4, 'F');

    include '../invoicemaster/vendor/mailer.php';
    $mail = new mailer();

    $attachArr['attachment'] = array(
        array('file' => $filename1, 'name' => "Invoice-SAN" . $clientdetails[0]['invoice_id'])
    );
    $mail->sendEmail($to, $subject, $body, $attachArr);
    echo "202";

};

if(isset($_POST['type']) && $_POST['type'] == "addupdate" ){
    $addupdate();
}
if(isset($_POST['type']) && $_POST['type'] == "editdetailsfill" ){
    $editdetailsfill();
}
if(isset($_POST['type']) && $_POST['type'] == "clientautofill" ){
    $clientautofill();
}
if(isset($_POST['type']) && $_POST['type'] == "itemautofill" ){
    $itemautofill();
}
if(isset($_POST['type']) && $_POST['type'] == "pdfshow" ){
    $pdfshow();
}
if(isset($_POST['type']) && $_POST['type'] == "sendmail" ){
    $sendmail();
}
?>