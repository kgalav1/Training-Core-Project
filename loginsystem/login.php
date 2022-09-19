<?php 
session_start();  
include('../comman/header.php');
?>

<title>Login Your Account</title>
<style>
::placeholder {
    font-size: 18px;
}


#logineye {
    position: absolute;
    right: 10px;
    top: 52px;
}

.logineye {
    text-decoration: none;
    color: black;
}
</style>

</head>

<body>
    <?php 
    if((isset($_SESSION['passwordreset']))){
  echo '<div class="alert alert-info alert-dismissible fade show absolute" role="alert">
  <strong>Success !</strong> '.$_SESSION['accountactivation'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
}
  if(isset($_SESSION['msg'])){
   echo '<div class="alert alert-success alert-dismissible fade show absolute" role="alert">
    <strong>Success !</strong> Account Verified Successfully
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if((!isset($_SESSION['name'])) && (!isset($_SESSION['msg']))){
    echo '<div class="alert alert-danger alert-dismissible fade show absolute" role="alert">
    <strong>Alert !</strong> You\'re logged out.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  
  }
  
  ?>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../assets/images/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="login">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4" id="login_email">
                            <label class="form-label" for="form3Example3">Username or Email address</label>
                            <input type="text" id="nameemail" name="nameemail" class="form-control form-control-lg"
                                placeholder="Enter a valid Username or email address" maxlength="40" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3" style="position: relative;" id="login_pass">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" id="loginpassword" name="loginpassword"
                                class="form-control form-control-lg" placeholder="Enter password" maxlength="35"/> <a
                                href="javascript:void(0)" class="logineye" onclick="change()"> <i
                                    class="fa-solid fa-eye-slash" id="logineye"></i> </a>
                        </div>

                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4"><a href="forgotemail.php" class="text-primary">Forgot password?</a></div>

                        </div>

                        <div class="text-lg-start mt-2 pt-2" style="float: left;">
                        <input type="hidden" name="form_action" id="form_action" value="login" />
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" id="btn"
                                name="login">Login</button>

                            <p class="fw-bold mt-2 pt-1 mb-0">Don't have an account? <a
                                    href="signup.php"
                                    class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-2 px-4 px-xl-5 bg-dark">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2020. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <!-- Right -->
        </div>
    </section>

    <?php include('../comman/footer.php')?>

    <script>
    $('#login').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);
        data.append('type', "loginsubmit");
        var valueuser = validateLogin();
        if (valueuser == true) {

            $.ajax({
                url: "logininsert.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data == 89) {
                        $.notify("All Feilds Required", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 100) {
                        $.notify("Invalid Credentials", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 101) {
                        $.notify("User not present or account not verified", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 104) {
                        window.location.href='dashboard.php';
                    }
                }
            });
        } else {
            return false;
        }
    });
    </script>

</body>

</html>