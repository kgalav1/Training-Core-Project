<?php
include('../comman/header.php');
$dash = new DbConnectivity1();

session_start();
if (!isset($_SESSION['name'])) {
    header('location:../loginsystem/login.php');
}
?>

<title>Project - Dashboard</title>
<style>
.a {
    text-decoration: none;
    color: black;
}

.a:hover {
    color: black;
}
</style>


</head>

<body>
    <?php include('../comman/sidebar.php'); ?>

    <div class="container mt-5">
        <section>
            <div class="row">
                <div class="col-xl-6 col-sm-12 col-12 mb-4">
                    <div class="card">
                        <a href="../usermaster/usermaster.php" class="a">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1 my-auto">
                                    <div class="align-self-center">
                                        <i> <img src="../assets/images/user-master-icon.png" style="width: 80px;"> </i>
                                    </div>
                                    <div class="text-end">
                                        <h2> <?php 
                                         $total = "select count(`sno`) as total from `signupdetails`";
                                         $totalresultdata = $dash->RetrieveData($total);
                                         $_SESSION['sno'] = $totalresultdata[0]["total"];
                                         echo $_SESSION['sno']; ?> </h2>
                                        <p class="mb-0 fs-5" style="font-weight: 400;">User Master</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12 col-12 mb-4">
                    <div class="card">
                        <a href="../clientmaster/clientmaster.php" class="a">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                    <i> <img src="../assets/images/user-group-icon.png" style="width: 80px;"> </i>
                                    </div>
                                    <div class="text-end">
                                        <h2> <?php 
                                         $total = "select count(`sno`) as total from `clientmaster`";
                                         $totalresultdata = $dash->RetrieveData($total);
                                         $_SESSION['sno'] = $totalresultdata[0]["total"];
                                         echo $_SESSION['sno']; ?> </h2>
                                        <p class="mb-0 fs-5" style="font-weight: 400;">Client Master</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-sm-12 col-12 mb-4">
                    <div class="card">
                        <a href="../itemmaster/itemmaster.php" class="a">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                    <i> <img src="../assets/images/company-icon.png" style="width: 80px;"> </i>
                                    </div>
                                    <div class="text-end">
                                        <h2><?php 
                                         $total = "select count(`sno`) as total from `itemmaster`";
                                         $totalresultdata = $dash->RetrieveData($total);
                                         $_SESSION['sno'] = $totalresultdata[0]["total"];
                                         echo $_SESSION['sno']; ?></h2>
                                        <p class="mb-0 fs-5" style="font-weight: 400;">Item Master</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12 col-12 mb-4">
                    <div class="card">
                        <a href="../invoicemaster/invoicemaster.php" class="a">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                    <i> <img src="../assets/images/report-icon.png" style="width: 80px;"> </i>
                                    </div>
                                    <div class="text-end">
                                        <h3><?php 
                                         $total = "select count(`invoice_id`) as total from `main_invoice`";
                                         $totalresultdata = $dash->RetrieveData($total);
                                         $_SESSION['sno'] = $totalresultdata[0]["total"];
                                         echo $_SESSION['sno']; ?></h3>
                                        <p class="mb-0 fs-5" style="font-weight: 400;">Invoice Master</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php include('../comman/footer.php'); ?>
<script>
    $(document).ready(function(){
        $("#side_dashboard").addClass("active");
    });
</script>
</body>

</html>

