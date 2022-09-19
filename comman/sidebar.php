<!-- -----------Navbar Content-------------- -->

<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="shadow">
        <div>
            <div class="logoarea pt-3 mb-5">
                <a href="#" class="d-flex justify-content-center">
                    <img src="../assets/images/sidebarlogo.png" style="width: 230px;">
                </a>
            </div>
            <ul class="list-unstyled components mt-4" id="sideul">
                <li class="" id="side_search">
                    <a class="InputSearch">
                        <img src="../assets/images/search.png" style="width: 23px; top: 12px; left: 14px; " alt="" class="position-absolute " align="center">
                        <input type="text" id="myinput" placeholder="Search here" style="width: 100%; border:none;"
                            class="px-5" onkeyup="searchside()" maxlength="15"></a>
                </li>
                <li class="" id="side_dashboard">
                    <a href="../loginsystem/dashboard.php" class="px-3"><img src="../assets/images/dashbaord-icon.png"
                            style="width: 20px; margin-right: 10px">Dashboard</a>
                </li>
                <li class="" id="side_user">
                    <a href="../usermaster/usermaster.php" class="px-3"><img src="../assets/images/user-icon.png"
                            style="width: 20px; margin-right: 10px">User Master</a>
                </li>
                <li class="" id="side_client">
                    <a href="../clientmaster/clientmaster.php" class="px-3"><img
                            src="../assets/images/user-group-icon.png" style="width: 20px; margin-right: 10px">Client
                        Master</a>
                </li>
                <li class="" id="side_item">
                    <a href="../itemmaster/itemmaster.php" class="px-3"><img src="../assets/images/company-icon.png"
                            style="width: 20px; margin-right: 10px">Item Master</a>
                </li>
                <li class="" id="side_invoice">
                    <a href="../invoicemaster/invoicemaster.php" class="px-3"><img
                            src="../assets/images/report-icon.png" style="width: 20px; margin-right: 10px">Invoice</a>
                </li>
                <li>
                    <a onclick="logout();" style="cursor: pointer;" class="px-3"> <span
                            class="fa-solid fa-right-from-bracket me-2"></span>
                        Logout</a>
                </li>

            </ul>

        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="">

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn" style="background-color: whitesmoke;">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light mt-1" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="font-size: 16px; font-weight:500px;"> <img src="../assets/images/user-image.png"
                                    style="width: 33px; margin-right:5px;">
                                <span> <?php echo ($_SESSION['name']) ?></span>
                                <span class="fa fa-angle-down ml-2" style="color: white;"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" onclick="logout();" href="#"><span
                                            class="fa-solid fa-right-from-bracket me-2"></span>Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>