<?php 

include('../comman/config.php');
$user = new DbConnectivity1();

// ------------------------------Add Users--------------------------------------
$addupdate = function () use ($user) {

if(isset($_POST["form_action"])){

$sno = $user->test_input($_POST["snoEdit"]);
$name = $user->test_input($_POST["name"]);
$email =$user->test_input($_POST["email"]);
$phone = $user->test_input($_POST["phone"]);
$password = $_POST["password"];
$hiddenpassword = $_POST["hiddenpassword"];
$token = bin2hex(random_bytes(15));

$required = array('name', 'email', 'phone', 'password');

// Loop over field names, make sure each one exists and is not empty

$erroremail = false;
$errorphone = false;

foreach ($required as $field) {
  if (empty(trim($_POST[$field]))) {
    // echo ucfirst($field)." can not be blank";
    echo "89";
    exit;
  }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $erroremail = true;
  echo "600";
}

if(!empty($phone) && strlen($phone) < 10){
  $errorphone = true;
  echo "700";
}

if ($erroremail == false && $errorphone == false) {


if ($_POST["form_action"] == "insert") {

$exist = "select `name`,`email` from `signupdetails` where name = '$name' or email = '$email'";
$numrows = $user->CheckAlreadyExists($exist);

if ($numrows) {
    echo "1";
} else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `signupdetails` (`name`, `email`, `phone`, `password`, `token`, `status`) VALUES ('$name', '$email', '$phone', '$hash', '$token', 'active');";
    
    $result = $user->QueryExecute($sql);

if($result){
  echo "2";  
}
else{
echo "Error in your code";
}
}
}


// ------------------------------EDIT CODE--------------------------------------

if ($_POST["form_action"] == "edit") {

$existname = "SELECT `name` FROM `signupdetails` WHERE name ='$name' AND sno <> $sno;"; 
$namenumrows = $user->CheckAlreadyExists($existname);


$existemail = "SELECT `email` FROM `signupdetails` WHERE email ='$email' AND sno <> $sno;"; 
$emailnumrows = $user->CheckAlreadyExists($existemail);


if($namenumrows){
  echo "1";
}

if($emailnumrows){
  echo "1";
}

if($namenumrows == 0 && $emailnumrows == 0){

  if($hiddenpassword == $password){
$edit = "UPDATE `signupdetails` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `password` = '$password' WHERE `signupdetails`.`sno` = $sno";
  }
  else{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $edit = "UPDATE `signupdetails` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `password` = '$hash' WHERE `signupdetails`.`sno` = $sno";
  }
     $result = $user->Update($edit);
    
     if($result){
         echo "3";  
     }
     else{
       echo "Error in updation";
     }
}
}
}
}
};

$editdetailsfill = function () use ($user) {
    $sno = $_POST['edit_id'];
    $result_array = [];

    $usereditsql = "SELECT `sno`, `name`, `email`, `phone`, `password` FROM signupdetails WHERE sno = $sno";
    $userresult = $user->Execute($usereditsql);

    foreach($userresult as $row){
        array_push($result_array, $row);
    }
    header('content-type: application/json');
    echo json_encode($result_array);
  };

  // ------------------------------------Delete Code----------------------------------  

$deleteuser = function () use ($user) {
    $sno = $_POST['delete_id'];
    
    $sql = "DELETE FROM `signupdetails` WHERE `signupdetails`.`sno` = $sno";
    $result = $user->delete($sql);

      if($result){
        echo "4";
    }
    else{
      echo "Error in your code";
    }
     
};


if(isset($_POST['type']) && $_POST['type'] == "addupdate" ){
      $addupdate();
}
if(isset($_POST['type']) && $_POST['type'] == "editdetailsfill" ){
      $editdetailsfill();
}
if(isset($_POST['type']) && $_POST['type'] == "deleteuser" ){
  $deleteuser();
}


?>