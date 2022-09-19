<?php 
session_start();
include('../comman/header.php');
?>

<title>Forgot Password</title>
<style>
#eyep {
    position: absolute;
    right: 37px;
    top: 52px;
}

.eye {
    text-decoration: none;
    color: black;
}


#eyecp {
    position: absolute;
    right: 37px;
    top: 157px;
}
</style>

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../assets/images/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="confirm_pass">

                        <div class="form-outline mb-4" id="box">
                            <label class="form-label" for="form3Example3">Enter Password <span
                                    style="color: red;">*</span></label> <span class="formerror"></span>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                            <a href="javascript:void(0)" class="eye" onclick="change()"> <i
                                    class="fa-solid fa-eye-slash" id="eyep"></i> </a>
                        </div>

                        <div class="form-outline mb-3" id="box1">
                            <label class="form-label" for="form3Example4">Enter Confirm Password <span
                                    style="color: red;">*</span></label> <span class="formerror"></span>
                            <input type="password" id="cpassword" name="cpassword"
                                class="form-control form-control-lg" />
                            <a href="javascript:void(0)" class="eye" onclick="cchange()"> <i
                                    class="fa-solid fa-eye-slash" id="eyecp"></i> </a>
                            <input type="hidden" name="token" class="get" value="<?php echo $_GET['token']?>">
                        </div>



                        <div class="mt-4 pt-2">
                            <input type="hidden" name="form_action" id="form_action" value="confirm" />
                            <button type="submit" class="btn btn-primary btn-lg" name="done">Reset Password</button>
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
    <?php include '../comman/footer.php'; ?>

    <script>
    function cchange() {
        if (document.getElementById("cpassword").type == 'password') {
            $("#eyecp").removeClass("fa-solid fa-eye-slash");
            $("#eyecp").addClass("fa-solid fa-eye");
            document.getElementById("cpassword").type = "text";
        } else {
            $("#eyecp").removeClass("fa-solid fa-eye");
            $("#eyecp").addClass("fa-solid fa-eye-slash");
            document.getElementById("cpassword").type = "password";
        }
    }

    function change() {
        if (document.getElementById("password").type == 'password') {
            $("#eyep").removeClass("fa-solid fa-eye-slash");
            $("#eyep").addClass("fa-solid fa-eye");
            document.getElementById("password").type = "text";
        } else {
            $("#eyep").removeClass("fa-solid fa-eye");
            $("#eyep").addClass("fa-solid fa-eye-slash");
            document.getElementById("password").type = "password";
        }
    }

    $('#confirm_pass').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);
        data.append('type', "forgotpasssubmit");
        var valueuser = validateConfirm();
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
                    if (data == "1") {
                        window.location.href = 'login.php';
                    }
                    if (data == "89") {
                        $.notify("All Feilds Required", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == "420") {
                        $.notify("Password Not Match", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
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