<?php include('../comman/header.php'); ?>
</head>

<body>

    <section class="vh-100" style="background-color: #bfb7b7;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px; box-shadow: 1px 1px 10px 1px black;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1"
                                    style="background-color:whitesmoke">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <!-- -----------Signup Form-------------- -->

                                    <form class="mx-1 mx-md-4" id="signup">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 input-container" id="namediv">
                                                <input type="text" id="name" name="name" class="form-control text-input"
                                                    maxlength="20" autocomplete="off" />
                                                <label for="name" class="label">Enter Your Name</label>
                                                <span class="formerror"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 input-container" id="emaildiv">
                                                <input type="email" id="email" name="email"
                                                    class="form-control text-input" maxlength="30" />
                                                <label for="email" class="label">Enter Your Email</label>
                                                <span class="formerror"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-solid fa-mobile-button fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 input-container" id="phonediv">
                                                <input type="text" id="phone" name="phone"
                                                    class="form-control text-input"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="10" />
                                                <label for="phone" class="label">Enter Your Mobile No.</label>
                                                <span class="formerror"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 input-container" id="passworddiv">
                                                <input type="password" id="loginpassword" name="password"
                                                    class="form-control text-input" maxlength="25" />
                                                <label for="password" class="label">Enter Your Password</label>
                                                <a href="javascript:void(0)" class="eyepsignup" onclick="change()"> <i
                                                        class="fa-solid fa-eye-slash" id="eye"></i> </a>
                                                <span class="formerror"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="hidden" name="form_action" id="form_action" value="signup" />
                                            <button type="submit" name="submit" id="submit"
                                                class="btn btn-primary btn-lg">Register</button>
                                        </div>
                                        <p class="text-center text-muted mt-5 mb-0">Have already an account? <a
                                                href="login.php" class="fw-bold text-body"><u>Login
                                                    here</u></a></p>

                                    </form>
                                    <!-- ---------------------------------------------------- -->
                                </div>

                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="../assets/images/draw1.webp" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include '../comman/footer.php'; ?>

    <script>
    document.querySelectorAll(".text-input").forEach((element) => {
        element.addEventListener("blur", (event) => {
            if (event.target.value != "") {
                event.target.nextElementSibling.classList.add("filled");
            } else {
                event.target.nextElementSibling.classList.remove("filled");
            }
        });
    });


    $('#signup').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);
        data.append('type', "signupsubmit");
        var valueuser = validateSignup();
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
                    $.notify("Email Send successful", {
                        globalPosition: 'bottom right',
                        className: 'success'
                    });
                    if (data == "89") {
                        $.notify("All Feilds Required", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data.success == 103) {
                        window.location.href = 'otp.php?token=' + data.token + '';
                    }

                    if (data == 102) {
                        $.notify("User Already Exists", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 500) {
                        $.notify("All feilds required", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 600) {
                        $.notify("Invalid Email Format", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 700) {
                        $.notify("Incomplete mobile no.", {
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