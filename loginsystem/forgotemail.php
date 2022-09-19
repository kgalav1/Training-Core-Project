<?php
 include('../comman/header.php');
 session_start();
 ?>

<title>Forgot Password</title>
<style>
::placeholder {
    font-size: 18px;
}
</style>

</head>

<body>
    <?php if((isset($_SESSION['passwordreset']))){
  echo '<div class="alert alert-success alert-dismissible fade show absolute" role="alert">
  <strong>Success!</strong> '.$_SESSION['passwordreset'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
}
 ?>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../assets/images/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="forgot">
                        <!-- Email input -->
                        <div class="form-outline mb-4" id="box">
                            <label class="form-label" for="form3Example3">Email address <span
                                    style="color: red;">*</span></label> <span class="formerror"></span>
                            <input type="text" id="forgot_email" name="email" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" maxlength="40" />
                        </div>

                        <div class="mt-4 pt-2">
                            <input type="hidden" name="form_action" id="form_action" value="sendemail" />
                            <button type="submit" class="btn btn-primary btn-lg" name="submit">Send Email</button>
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
    function validateForgot() {
        clearErrors();
        var returnval = true;
        var emaildat = document.getElementById('forgot_email').value;

        if (emaildat.length == 0) {
            seterror("box", " *Enter your valid email id");
            returnval = false;
        }
        return returnval;
    }

    $('#forgot').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);
        data.append('type', "forgotemailsubmit");
        var valueuser = validateForgot();
        if (valueuser == true) {
            Overlay.show('overlay', 'Sending you an email...');
            $.ajax({
                url: "logininsert.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    Overlay.hide('overlay');
                    if (data == "103") {
                    $.notify("Email Send successful", {
                        globalPosition: 'bottom right',
                        className: 'success',
                        autoHideDelay: 10000,
                    });
                }
                    // if (data.success == 103) {
                    //     window.location.href = 'forgotpassword.php?token=' + data.token + '';
                    // }
                    if (data == "1") {
                        $.notify("Please fill Email", {
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