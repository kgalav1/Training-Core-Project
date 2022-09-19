<?php
session_start();

include('../comman/config.php');
$item = new DbConnectivity1();

// ------------------------------Add Item--------------------------------------
$addupdate = function () use ($item) {
  if (isset($_POST["form_action"])) {

    $sno = $_POST["snoEdit"];
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $files = $_FILES["file"];
    $filename = $files['name'];
    $fileerror = $files['error'];
    $filetmp = $files['tmp_name'];
    $filext = explode('.', $filename);
    $filecheck = strtolower(end($filext));
    $fileextstored = array('png', 'jpg', 'jpeg', 'jfif');
    $path = $_POST["path"];

    $required = array('name', 'desc', 'price');

    foreach ($required as $field) {
      if (empty(trim($_POST[$field]))) {
        echo "89";
        exit;
      }
    }

    if ($_POST["form_action"] == "insert") {

      if ($_FILES['file']['size'] == 0) {
        echo "800";
      } else {

      if (in_array($filecheck, $fileextstored)) {

        $destinationfile = 'upload/' . $filename;
        move_uploaded_file($filetmp, $destinationfile);

        $sql = "INSERT INTO `itemmaster` (`name`, `desc`, `price`, `image`) VALUES ('$name', '$desc', '$price', '$destinationfile');";
        $result = $item->QueryExecute($sql);
        if ($result) {
          echo "2";
        }

      } else {
        echo "6";
      }
    }
  }

    // ------------------------------EDIT CODE--------------------------------------

    if ($_POST["form_action"] == "edit") {

      if ($_FILES['file']['size'] == 0 ){
    
        move_uploaded_file($filetmp,$path);
    
        $edit = "UPDATE `itemmaster` SET `name` = '$name', `desc` = '$desc', `price` = '$price', `image` = '$path' 
                WHERE `itemmaster`.`sno` = $sno";
          $result = $item->Update($edit);
        
         if($result){
          echo "3";
         }
         else{
           echo "Error in updation";
         }
        
    }
    else{
    
    if(in_array($filecheck, $fileextstored)){
    
        $destinationfile = 'upload/'.$filename;
        move_uploaded_file($filetmp,$destinationfile);
    
    
        $edit = "UPDATE `itemmaster` SET `name` = '$name', `desc` = '$desc', `price` = '$price', `image` = '$destinationfile' 
                WHERE `itemmaster`.`sno` = $sno";
         $result = $item->Update($edit);
        
         if($result){
          echo "3";
         }
         else{
           echo "Error in updation";
         }
        }
        else{
          echo "6";
        }
      }
    }
  }
};


$editdetailsfill = function () use ($item) {
  $sno = $_POST['edit_id'];
  $result_array = [];

  $itemeditsql = "SELECT `sno`, `name`, `desc`, `price`, `image` FROM itemmaster WHERE sno = $sno";
  $itemresult = $item->Execute($itemeditsql);

  foreach ($itemresult as $row) {
    array_push($result_array, $row);
  }
  header('content-type: application/json');
  echo json_encode($result_array);
};

// ------------------------------------Delete Code----------------------------------    

$deleteitem = function () use ($item) {
  $sno = $_POST['delete_id'];

  $check = "SELECT * FROM `invoice_item` where `item_id` = '$sno' ";
  $checkresult = $item->total_rows($check);
  if ($checkresult > 0) {
    echo "5";
  } else {
    $sql = "DELETE FROM `itemmaster` WHERE `itemmaster`.`sno` = $sno";
    $result = $item->delete($sql);
    if ($result) {
      echo "4";
    }
  }
};



if (isset($_POST['type']) && $_POST['type'] == "addupdate") {
  $addupdate();
}
if (isset($_POST['type']) && $_POST['type'] == "editdetailsfill") {
  $editdetailsfill();
}
if (isset($_POST['type']) && $_POST['type'] == "deleteitem") {
  $deleteitem();
}
