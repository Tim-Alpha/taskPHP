<?php
include "connect.php";

// getting data from registration form
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);


    //-----------------------------------------------

    $sqlAdmin = "SELECT * FROM `admin` WHERE  turn=1";
    $resultMyAdmin = mysqli_query($con, $sqlAdmin);
    $row = mysqli_fetch_assoc($resultMyAdmin);
    $adminId = $row['id'];

    //-----------------------------------------------

    // sending data to the database
    $sql = "INSERT INTO `user`(`name`, `mobile`, `myadmin`) 
    VALUES ('$name','$mobile',$adminId";

    // running query for removing repetation
    $mobilequery = "SELECT * FROM `user` where mobile='$mobile'";  

    $querymobile = mysqli_query($con, $mobilequery);
    $mobilecount = mysqli_num_rows($querymobile);

    // cheacking condition for sussessfull or unsuccessfull attempt
    if($mobilecount>0){
        echo '<script>alert("Mobile number already exist !")</script>';
    } else {
        $result = mysqli_query($con, $sql);
        if($result){
            // echo '<script type="text/javascript">loginbtn()</script>';
            echo '<script>alert("Account Created Succesfully👍")</script>';
        } else{
            echo '<script>alert(" Sorry registration failed 🥺")</script>';
            // die(mysqli_error($con));
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Tablet Form</title>
</head>

<body>
  <div class="form-container">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" value="" name="name" required>
      </div>
      <div class="form-group">
        <label for="mobile">Mobile Number:</label>
        <input type="tel" id="mobile" value="" name="mobile" required>
        <!-- pattern="[0-9]{10}" -->
      </div>
      <button type="submit" name="submit">SUBMIT</button>
    </form>
  </div>
</body>

</html>