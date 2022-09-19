<?php

include('../comman/config.php');
$client = new DbConnectivity1();

// ------------------------------Add Client--------------------------------------

$addupdate = function () use ($client) {
  if (isset($_POST["form_action"])) {

    $sno =  $client->test_input($_POST["sno"]);
    $name = $client->test_input($_POST["name"]);
    $email = $client->test_input($_POST["email"]);
    $phone = $client->test_input($_POST["phone"]);
    $password = $_POST["password"];
    $hiddenpassword = $_POST["hiddenpassword"];
    $address = $client->test_input($_POST["address"]);
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];

    if ($_POST["form_action"] == "insert") {

      $required = array('name', 'email', 'phone', 'password', 'address', 'country', 'state', 'city');

      $erroremail = false;
      $errorphone = false;

      foreach ($required as $field) {
        if (empty(trim($_POST[$field]))) {
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



        $exist = "select `client_name`,`email` from `clientmaster` where client_name = '$name' or email = '$email'";
        $numrows = $client->CheckAlreadyExists($exist);

        if ($numrows) {
          echo "1";
        } else {
          $hash = password_hash($password, PASSWORD_DEFAULT);

          $sql = "INSERT INTO `clientmaster` (`client_name`, `email`, `phone`, `password`, `address`, `country`, `state`, `city`) VALUES ('$name', '$email', '$phone', '$hash', '$address', '$country', '$state', '$city')";
          $result = $client->QueryExecute($sql);

          if ($result) {
            echo "2";
          } else {
            echo "Error in your code";
          }
        }
      }
    }


    // ------------------------------EDIT CODE--------------------------------------

    if ($_POST["form_action"] == "edit") {

      $required = array('name', 'email', 'phone', 'password', 'address');

      $erroremail = false;
      $errorphone = false;

      foreach ($required as $field) {
        if (empty(trim($_POST[$field]))) {
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

        $existname = "SELECT `client_name` FROM `clientmaster` WHERE client_name ='$name' AND sno <> $sno;";
        $namenumrows = $client->CheckAlreadyExists($existname);

        $existemail = "SELECT `email` FROM `clientmaster` WHERE email ='$email' AND sno <> $sno;";
        $emailnumrows = $client->CheckAlreadyExists($existemail);


        if ($namenumrows) {
          echo "1";
          exit();
        }

        if ($emailnumrows) {
          echo "1";
          exit();
        }

        if ($namenumrows == 0 && $emailnumrows == 0) {
          if ($hiddenpassword == $password) {
            $edit = "UPDATE `clientmaster` SET `client_name` = '$name', `email` = '$email', `phone` = '$phone', `address` = '$address', `password` = '$password' WHERE `clientmaster`.`sno` = $sno";
          } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $edit = "UPDATE `clientmaster` SET `client_name` = '$name', `email` = '$email', `phone` = '$phone', `address` = '$address', `password` = '$hash' WHERE `clientmaster`.`sno` = $sno";
          }
          $result = $client->Update($edit);

          if ($result) {
            echo "3";
          } else {
            echo "Error in updation";
          }
        }
      }
    }
  }
};

$editdetailsfill = function () use ($client) {
  $invoice_id = $_POST['invoice_id'];
  $result_array = [];

  $clientsql = "SELECT `sno`, `client_name`, `email`, `phone`, `address`, `password` FROM clientmaster WHERE sno = $invoice_id";
  $clientresult = $client->Execute($clientsql);

  foreach ($clientresult as $row) {
    array_push($result_array, $row);
  }
  header('content-type: application/json');
  echo json_encode($result_array);
};


// ------------------------------------Delete Code----------------------------------    


$deleteuser = function () use ($client) {
  $sno = $_POST['delete_id'];

  $check = "SELECT * FROM `main_invoice` where `client_id` = '$sno' ";
  // print_r($check);die;
  $checkresult = $client->total_rows($check);
  if ($checkresult > 0) {
    echo "5";
  } else {

    $sql = "DELETE FROM `clientmaster` WHERE `clientmaster`.`sno` = $sno";
    $result = $client->delete($sql);

    if ($result) {
      echo "4";
    }
  }
};

?>


<?php
$statechange = function () use ($client) {
  $category_id = $_POST["category_id"];
  $state_sql = "SELECT * FROM `states` where country_id = $category_id";
  $result = $client->Execute($state_sql);
?>
  <option selected disabled value="0">Choose a state</option>
  <?php
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
<?php
  }
};
?>

<?php
$citychange = function () use ($client) {
  $category_id = $_POST["category_id"];
  $city_sql = "SELECT * FROM `cities` where state_id = $category_id";
  $result = $client->Execute($city_sql);
?>
  <option selected disabled value="0">Choose a city</option>
  <?php
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
<?php
  }
};
?>

<?php
if (isset($_POST['type']) && $_POST['type'] == "addupdate") {
  $addupdate();
}
if (isset($_POST['type']) && $_POST['type'] == "editdetailsfill") {
  $editdetailsfill();
}
if (isset($_POST['type']) && $_POST['type'] == "deleteuser") {
  $deleteuser();
}
if (isset($_POST['type']) && $_POST['type'] == "statechange") {
  $statechange();
}
if (isset($_POST['type']) && $_POST['type'] == "citychange") {
  $citychange();
}
?>