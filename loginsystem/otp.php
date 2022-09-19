<?php
// include('../comman/config.php');
include('../comman/header.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
}
?>

<title>OTP verification</title>

<style>
    .height-100 {
        height: 100vh
    }

    .card {
        width: 400px;
        border: none;
        height: 300px;
        box-shadow: 0px 5px 20px 0px #d2dae3;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .card h6 {
        color: red;
        font-size: 20px
    }

    .inputs input {
        width: 40px;
        height: 40px
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0
    }

    .card-2 {
        background-color: #fff;
        padding: 10px;
        width: 350px;
        height: 100px;
        bottom: -50px;
        left: 20px;
        position: absolute;
        border-radius: 5px
    }

    .card-2 .content {
        margin-top: 50px
    }

    .card-2 .content a {
        color: red
    }

    .form-control:focus {
        box-shadow: none;
        border: 2px solid red
    }

    .validate {
        border-radius: 20px;
        height: 40px;
        background-color: red;
        border: 1px solid red;
        width: 140px
    }
</style>

</head>

<body>

    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <h6>Please enter the one time password <br> to verify your account</h6>
                <!-- <div> <span>A code has been sent to</span> <small>*******9897</small> </div> -->
                <form id="otpsubmit">
                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                        <input type="hidden" name="hidden" value="<?php echo $token ?>">
                        <input class="m-2 text-center form-control rounded" type="text" id="first" name="first" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" id="second" name="second" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" id="third" name="third" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" id="fourth" name="fourth" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" id="fifth" name="fifth" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" id="sixth" name="sixth" maxlength="1" />
                    </div>
                    <div class="mt-4"> <button class="btn btn-danger px-4 validate" type="submit" name="validate">Validate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('../comman/footer.php'); ?>


    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {
                const inputs = document.querySelectorAll('#otp > *[id]');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                return true;
                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                inputs[i].value = String.fromCharCode(event.keyCode);
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            }
                        }
                    });
                }
            }
            OTPInput();
        });


        $('#otpsubmit').on('submit', function(event) {
            event.preventDefault();
            // debugger
            var data = new FormData(this);
            data.append('type', "otpsubmit");
            // var valueuser = validateotp();
            // if (valueuser == true) {

            $.ajax({
                url: "logininsert.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data == "89") {
                        $.notify("All Feilds Required", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == 3) {
                        $.notify("OTP Verified Succesfully", {
                            globalPosition: 'bottom right',
                            className: 'success'
                        });
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 2000);
                    }
                }
            })
        });
    </script>
</body>

</html>