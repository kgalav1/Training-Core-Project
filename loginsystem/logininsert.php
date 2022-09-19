<?php
session_start();
include('../invoicemaster/vendor/mailer.php');
include('../comman/config.php');
$login = new DbConnectivity1();

// ----------------------------- SIGNUP INSERT CODE -------------------------------------------------

$signupsubmit = function () use ($login) {

  $name = $login->test_input($_POST["name"]);
  $email =  $login->test_input($_POST["email"]);
  $phone =  $login->test_input($_POST["phone"]);
  $password =  $_POST["password"];
  $token = bin2hex(random_bytes(15));
  $str_result = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $otp = substr(str_shuffle($str_result), 0, 6);


  $erroremail = false;
  $errorphone = false;

  foreach ($_POST as $key => $field) {
    if (empty(trim($field))) {
      echo "89";
      exit;
    }
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erroremail = true;
    echo "600";
  }

  if (!empty($phone) && strlen($phone) < 10) {
    $errorphone = true;
    echo "700";
  }

  if ($erroremail == false && $errorphone == false) {

    $exist = "select `name`,`email` from `signupdetails` where name = '$name' or email = '$email'";
    $numrows = $login->CheckAlreadyExists($exist);

    if ($numrows > 0) {
      echo "102";
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `signupdetails` (`name`, `email`, `phone`, `password`, `token`, `otp`, `status`) VALUES ('$name', '$email', '$phone', '$hash', '$token', '$otp', 'inactive');";
      $result = $login->QueryExecute($sql);

      if ($result) {
        $subject = "Account Activation";
        $body = "Hi, $name Enter this OTP to activate your account $otp";
        $headers = "From: test@sansoftwares.com";
        $mail = new mailer();
        $mail->sendEmail($email, $subject, $body, $headers);
        $_SESSION['msg'] = "Account verified successfully";
        $data['token'] = $token;
        $data['success'] = "103";
        echo json_encode($data);
      } else {
        echo "Something not correct :(";
      }
    }
  }
};



// ----------------------------- LOGIN INSERT CODE -------------------------------------------------

$loginsubmit = function () use ($login) {

  $nameemail = $login->test_input($_POST["nameemail"]);
  $loginpassword = $_POST["loginpassword"];


  foreach ($_POST as $key => $field) {
    if (empty(trim($field))) {
      echo "89";
      exit;
    }
  }

  $sql = "select * from `signupdetails` where (name = '$nameemail' or email = '$nameemail') and status = 'active'";
  $num = $login->CheckAlreadyExists($sql);

  if ($num == 1) {

    $row = $login->RetrieveData($sql);
    if (password_verify($loginpassword, $row[0]["password"])) {
      $sqlname =  "select `name` from `signupdetails` where email = '$nameemail' or name = '$nameemail' ";
      $rowname = $login->RetrieveData($sqlname);
      $_SESSION['name'] = $rowname[0]["name"];

      // $otp = rand(100000,999999);
      // $session_sql = "UPDATE `signupdetails` SET `session_id` = $otp WHERE NAME = '".$resultdata["name"]."'";
      // $session_result = mysqli_query($con, $session_sql);

      // $findsql =  "select `session_id` from `signupdetails` WHERE NAME = '".$resultdata["name"]."'";
      // $findresult = mysqli_query($con, $findsql);
      // $findrow = mysqli_fetch_assoc($findresult);
      // $_SESSION['session_id'] = $findrow["session_id"];

      // header('location:dashboard.php');
      echo "104";
    } else {
      echo "100";
    }
  } else {
    echo "101";
  }
};


$otpsubmit = function () use ($login) {
  $token = $_POST["hidden"];
  $one = $_POST["first"];
  $two = $_POST["second"];
  $three = $_POST["third"];
  $four = $_POST["fourth"];
  $five = $_POST["fifth"];
  $six = $_POST["sixth"];

  $final = $one . $two . $three . $four . $five . $six;
  
  foreach ($_POST as $key => $field) {
    if (empty(trim($field))) {
      echo "89";
      exit;
    }
  }
  // echo "hii";

  $select = "select `otp` from `signupdetails` where `token` = '$token'";
  $selectresult = $login->Execute($select);

  while ($row = mysqli_fetch_assoc($selectresult)) {
    $rowotp = $row["otp"];
  }

  if ($rowotp == $final) {
    $sql = "UPDATE `signupdetails` SET `status` = 'active' WHERE `otp` = '$final'";
    $result = $login->Execute($sql);

    if ($result) {
      $_SESSION['msg'] = "Account Verified Successfully";
      // header('location:login.php');
      echo 3;
    }
  } else {
    echo "Invalid OTP";
  }
};


$forgotpasssubmit = function () use ($login) {
  $token = $_POST['token'];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];

  foreach ($_POST as $key => $field) {
    if (empty(trim($field))) {
      echo "89";
      exit;
    }
  }

  $hash = password_hash($password, PASSWORD_DEFAULT);

  if ($password == $cpassword) {

    $update = "UPDATE `signupdetails` SET `password` = '$hash' WHERE `token` = '$token'";
    $result = $login->Update($update);
    $_SESSION['passwordreset'] = "Password Reset Successfully";

    if ($result) {
      echo "1";
      // header('location:login.php');
    }
  } else {
    echo "420";
  }
};


$forgotemailsubmit = function () use ($login) {
  $email = $_POST["email"];

  if (empty(trim($email))) {
    echo "1";

  }else{

  $sql = "select * from `signupdetails` where email = '$email'";
  $result = $login->Execute($sql);
  $numrows = $login->CheckAlreadyExists($sql);

  if ($numrows) {

    $userdata = mysqli_fetch_array($result);
    $name = $userdata['name'];
    $token = $userdata['token'];

    $mail = new mailer();

    $subject = "Password Reset";
    $body = "Hi, $name Click here to Reset your Passowrd http://localhost/Project/loginsystem/forgotpassword.php?token=$token";
    $headers = "From: test@sansoftwares.com";


    $mail->sendEmail($email, $subject, $body, $headers);
    $_SESSION['passwordreset'] = "we have send a email to $email please check to Reset your Passowrd";
    // $data['success'] = "103";
    // $data['token'] = $token;
    // echo json_encode($data);
    echo "103";
  } else {
    echo "No Record Found";
  }
}
};


if (isset($_POST['type']) && $_POST['type'] == "otpsubmit") {
  $otpsubmit();
}
if (isset($_POST['type']) && $_POST['type'] == "loginsubmit") {
  $loginsubmit();
}
if (isset($_POST['type']) && $_POST['type'] == "signupsubmit") {
  $signupsubmit();
}
if (isset($_POST['type']) && $_POST['type'] == "forgotpasssubmit") {
  $forgotpasssubmit();
}
if (isset($_POST['type']) && $_POST['type'] == "forgotemailsubmit") {
  $forgotemailsubmit();
}
