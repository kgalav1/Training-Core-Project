<?php

include('../comman/config.php');
$cs = new DbConnectivity1();

//------------------------------ USER MASTER SEARCHING PAGINATION---------------------------------------

if ($_POST["action"] == "user") {

    $sname = $_POST['name'];
    $semail = $_POST['email'];
    $sphone = $_POST['phone'];
    $limit = $_POST['limit'];
    $sort_field = $_POST['sort_field'];
    $sort_type = $_POST['sort_type'];
    $page = isset($_POST['page']) ? $_POST['page'] : '1';
    $offset = ($page - 1) * $limit;


    $search = "SELECT * FROM `signupdetails` WHERE 1=1 and `name` LIKE '%$sname%' and `email` LIKE '%$semail%'
    and `phone` LIKE '%$sphone%' ORDER BY `$sort_field` $sort_type LIMIT {$offset}, {$limit}";

    $searchresult = $cs->Execute($search);
    $count_row = $cs->total_rows($search);

    $total = "SELECT * FROM `signupdetails`";
    $output = "";
    $pagin = "";
    // $number = 1;
    // $numElementsPerPage = 5; // How many elements per page
    // $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // echo "<td>  ". $currentNumber++ ." </td>";
    // $number++;


    if ($cs->total_rows($total) > 0) {

        $total_records = $cs->total_rows($total);
        $total_page = ceil($total_records / $limit);
        // if($total_records <= $limit)


        if ($cs->total_rows($search) > 0) {
            $sno = 1;
            $currentNumber = ($page - 1) * $limit + $sno;
            while ($row = mysqli_fetch_assoc($searchresult)) {
                $sno = $sno + 1;
                $output .= "<tr>
                    <td>" . $currentNumber++ . "</td>
                    <td onclick = 'userEdit(" . $row['sno'] . ");' style='cursor:pointer;'>" . $row['name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td> <button type='button' class='edit bremove'><img onclick = 'userEdit(" . $row['sno'] . ");'style='width:22px' src='../assets/images/edit.png' alt='edit'></button>
                    <button type='button' value=" . $row['sno'] . " class='delete bremove'><img style='width:22px' src='../assets/images/delete.png' alt='delete'></button></td>
                    </tr>";
            }
        } else {
            $output .= "<tr><td colspan='5' style='text-align:center;'>NO DATA FOUND</td></tr>";
        }



        $pagin .= '<div id="pagi">
           <nav aria-label="Page navigation example">
           <ul class="pagination justify-content-end">
           <li class="me-3 mt-1 fw-500">Showing ' . ($offset + 1) . ' - ' . ($offset + $count_row) . ' records out of ' . $total_records . '</li>';

        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $pagin .= '<li class="page-item ' . $active . '"><a class="page-link" id="' . $i . '" href="">' . $i . '</a></li>';
        }
        $pagin .= '</ul>
                </nav>
            </div>';
    } else {
        $output .= "<tr><td colspan='5' style='text-align:center;'>NO DATA FOUND</td></tr>";
    }
    echo json_encode(array('table_data' => $output, 'pagination' => $pagin));
}

//------------------------------ CLIENT MASTER SEARCHING PAGINATION---------------------------------------

if ($_POST["action"] == "client") {

    $sname = $_POST['name'];
    $semail = $_POST['email'];
    $sphone = $_POST['phone'];
    $limit = $_POST['limit'];
    $sort_field = $_POST['sort_field'];
    $sort_type = $_POST['sort_type'];
    $page = isset($_POST['page']) ? $_POST['page'] : '1';
    $offset = ($page - 1) * $limit;

    $search = " SELECT clientmaster.sno, clientmaster.client_name, clientmaster.email, clientmaster.phone, clientmaster.address, states.name as state,cities.name as city FROM clientmaster inner JOIN states ON clientmaster.state=states.id 
    INNER JOIN cities ON clientmaster.city=cities.id where 1=1 and clientmaster.client_name like '%$sname%' and clientmaster.email like '%$semail%' and clientmaster.phone like '%$sphone%' ORDER BY `$sort_field` $sort_type LIMIT {$offset}, {$limit}";

    $searchresult = $cs->Execute($search);
    $count_row = $cs->total_rows($search);

    $total = "SELECT * FROM `clientmaster`";
    $output = "";
    $pagin = "";

    if ($cs->total_rows($total) > 0) { // To Check total record from database

        $total_records = $cs->total_rows($total);
        $total_page = ceil($total_records / $limit);


        if ($cs->total_rows($search) > 0) { // To Check custom record from database
            $sno = 1;
            $currentNumber = ($page - 1) * $limit + $sno;

            while ($row = mysqli_fetch_assoc($searchresult)) {
                $sno = $sno + 1;

                $output .= "<tr>
            <td>" . $currentNumber++ . "</td>
            <td onclick = 'clientEdit(" . $row['sno'] . ");' style='cursor:pointer;'>" . $row['client_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['city'] . "</td>
            <td>" . $row['state'] . "</td>
            <td> <button type='button' class='edit bremove'><img onclick = 'clientEdit(" . $row['sno'] . ");'style='width:22px' src='../assets/images/edit.png' alt='edit'></button>
            <button type='button' value=" . $row['sno'] . " class='delete bremove'><img style='width:22px' src='../assets/images/delete.png' alt='delete'></button></td>
            </tr>";
            }
        } else {
            $output .= "<tr><td colspan='8' style='text-align:center;'>NO DATA FOUND</td></tr>";
        }


        $pagin .=    '<div id="pagi">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                    <li class="me-3 mt-1 fw-500">Showing ' . ($offset + 1) . ' - ' . ($offset + $count_row) . ' records out of ' . $total_records . '</li>';

        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $pagin .= '<li class="page-item ' . $active . '"><a class="page-link" id="' . $i . '" href="">' . $i . '</a></li>';
        }
        $pagin .= '</ul>
                </nav>
            </div>';
    } else {
        $output .= "<tr><td colspan='8' style='text-align:center;'>NO DATA FOUND</td></tr>";
    }
    echo json_encode(array('table_data' => $output, 'pagination' => $pagin));
}

//------------------------------ ITEM MASTER SEARCHING PAGINATION---------------------------------------

if ($_POST["action"] == "item") {

    $sname = $_POST['name'];
    $limit = $_POST['limit'];
    $sort_field = $_POST['sort_field'];
    $sort_type = $_POST['sort_type'];
    $page = isset($_POST['page']) ? $_POST['page'] : '1';
    $offset = ($page - 1) * $limit;

    $search = "SELECT * FROM `itemmaster` where 1=1 and name like '%$sname%' ORDER BY `$sort_field` $sort_type LIMIT {$offset}, {$limit}";
    $searchresult = $cs->Execute($search);

    $total = "SELECT * FROM `itemmaster`";
    $output = "";
    $pagin = "";

    if ($cs->total_rows($total) > 0) {  // To Check all record from database

        $total_records = $cs->total_rows($total);
        $total_page = ceil($total_records / $limit);
        $count_row = $cs->total_rows($search);


        if ($cs->total_rows($search) > 0) { // To Check custom record from database
            $sno = 1;
            $currentNumber = ($page - 1) * $limit + $sno;

            while ($row = mysqli_fetch_assoc($searchresult)) {
                $sno = $sno + 1;

                $output .= "<tr>
        <td>" . $currentNumber++ . "</td>
        <td onclick = 'itemEdit(" . $row['sno'] . ");' style='cursor:pointer;'>" . $row['name'] . "</td>
        <td>" . $row['desc'] . "</td>
        <td>" . $row['price'] . "</td>
        <td> <img class='image' src=" . $row['image'] . "> </td>
        <td> <button type='button' class='edit bremove'><img onclick = 'itemEdit(" . $row['sno'] . ");'style='width:22px' src='../assets/images/edit.png' alt='edit'></button>
            <button type='button' value=" . $row['sno'] . " class='delete bremove'><img style='width:22px' src='../assets/images/delete.png' alt='delete'></button></td>
        </tr>";
            }
        } else {
            $output .= "<tr><td colspan='6' style='text-align:center;'>NO DATA FOUND</td></tr>";
        }

        $pagin .= '<div id="pagi">
                <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                <li class="me-3 mt-1 fw-500">Showing ' . ($offset + 1) . ' - ' . ($offset + $count_row) . ' records out of ' . $total_records . '</li>';

        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $pagin .= '<li class="page-item ' . $active . '"><a class="page-link" id="' . $i . '" href="">' . $i . '</a></li>';
        }
        $pagin .= '</ul>
            </nav>
        </div>';
    } else {
        $output .= "<tr><td colspan='6' style='text-align:center;'>NO DATA FOUND</td></tr>";
    }
    echo json_encode(array('table_data' => $output, 'pagination' => $pagin));
}

//------------------------------ INVOICE MASTER SEARCHING PAGINATION---------------------------------------

if ($_POST["action"] == "invoice") {

    $sid = $_POST['invoice_id'];
    $sname = $_POST['name'];
    $semail = $_POST['email'];
    $sphone = $_POST['phone'];
    $limit = $_POST['limit'];
    $sort_field = $_POST['sort_field'];
    $sort_type = $_POST['sort_type'];
    $page = isset($_POST['page']) ? $_POST['page'] : '1';
    $offset = ($page - 1) * $limit;

    $search = "SELECT main_invoice.invoice_id, clientmaster.client_name, clientmaster.email, clientmaster.phone,
    CONCAT_WS(',', clientmaster.address, states.name,cities.name) AS address, main_invoice.grand_total 
    FROM clientmaster INNER JOIN states ON clientmaster.state=states.id INNER JOIN cities ON clientmaster.city=cities.id 
    INNER JOIN main_invoice ON main_invoice.client_id = clientmaster.sno where 1=1 and main_invoice.invoice_id LIKE '%$sid%'
    and clientmaster.client_name LIKE '%$sname%' and clientmaster.email LIKE '%$semail%' AND clientmaster.phone LIKE '%$sphone%' ORDER BY `$sort_field` $sort_type LIMIT {$offset}, {$limit}";

    $searchresult = $cs->Execute($search);
    $count_row = $cs->total_rows($search);

    $total = "SELECT * FROM `main_invoice`";
    $output = "";
    $pagin = "";

    if ($cs->total_rows($total) > 0) {  // To Check all record from database

        $total_records = $cs->total_rows($total);
        $total_page = ceil($total_records / $limit);


        if ($cs->total_rows($search) > 0) { // To Check custom record from database
            $sno = 1;
            $currentNumber = ($page - 1) * $limit + $sno;

            while ($row = mysqli_fetch_assoc($searchresult)) {
                $sno = $sno + 1;

                $output .= "<tr>
        <td>" . $row['invoice_id'] . "</td>
        <td onclick = 'invoiceEdit(" . $row['invoice_id'] . ");' style='cursor:pointer;'>" . $row['client_name'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['address'] . "</td> 
        <td>" . $row['grand_total'] . "</td> 
        <td> <button type='button' class='edit bremove'><img onclick = 'invoiceEdit(" . $row['invoice_id'] . ");'style='width:22px' src='../assets/images/edit.png' alt='edit'></button></td>
        <td><button type='button' class='bremove'><img style='width:24px' src='../assets/images/file.png' alt='pdf' onclick=Getpdf(" . $row['invoice_id'] . ",'invoiceAll.php')></button></td>
        <td><button type='button' class='bremove' data-bs-toggle='modal' id='mail' data-bs-target='#exampleModal'><img style='width:24px;' src='../assets/images/gmail.png' alt='send' ></button></td>
        </tr>";
            }
        } else {
            $output .= "<tr><td colspan='10' style='text-align:center;'>NO DATA FOUND</td></tr>";
        }
        $pagin .= '<div id="pagi">
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            <li class="me-3 mt-1 fw-500">Showing ' . ($offset + 1) . ' - ' . ($offset + $count_row) . ' records out of ' . $total_records . '</li>';

        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $pagin .= '<li class="page-item ' . $active . '"><a class="page-link" id="' . $i . '" href="">' . $i . '</a></li>';
        }
        $pagin .= '</ul>
        </nav>
    </div>';
    } else {
        $output .= "<tr><td colspan='10' style='text-align:center;'>NO DATA FOUND</td></tr>";
    }
    echo json_encode(array('table_data' => $output, 'pagination' => $pagin));
}
