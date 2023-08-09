<?php
include "connect.php";

// getting data from registration form
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $age = mysqli_real_escape_string($con, $_POST['age']);
  $email = strtolower($email);
  $turn = 1;

  //--------------------------------------------
  // Query to check if data is available
  $sql1 = "SELECT * FROM  `admin`";
  $myResult = $con->query($sql1);

  if ($myResult->num_rows > 0) {
    $sql2 = "SELECT * FROM `admin` WHERE  turn=1";
    $resultData = mysqli_query($con, $sql2);
    $row = mysqli_fetch_assoc($resultData);
    $oldId = $row['id'];
    $oldName = $row['name'];
    $oldMobile = $row['mobile'];
    $oldEmail = $row['email'];
    $oldAge = $row['age'];
    $oldTurn = $row['turn'];

    $sql2 = "UPDATE `admin` SET `id`='$oldId',`name`='$oldName', `mobile`='$oldMobile', `email` ='$oldEmail', `age`='$oldAge', `turn`=0 WHERE `turn`=1";
    $resultUpdate = mysqli_query($con, $sql2);
    if($resultUpdate){
      echo ("updation Successfull!");
    }
    else{
        echo ("updation failed!");
    }
  }
  //-----------------------------------------------

  // sending data to the database
  $sql = "INSERT INTO `admin`(`name`, `mobile`, `email`, `age`, `turn`) VALUES ('$name',$mobile,'$email',$age,$turn)";

  // running query for removing repetation
  $emailquery = "SELECT * FROM `admin` where email='$email'";
  $mobilequery = "SELECT * FROM `admin` where mobile='$mobile'";

  $queryemail = mysqli_query($con, $emailquery);
  $emailcount = mysqli_num_rows($queryemail);

  $querymobile = mysqli_query($con, $mobilequery);
  $mobilecount = mysqli_num_rows($querymobile);

  // cheacking condition for sussessfull or unsuccessfull attempt
  if ($emailcount > 0) {
    echo '<script>alert("Email already exist !")</script>';
  } else if ($mobilecount > 0) {
    echo '<script>alert("Mobile number already exist !")</script>';
  } else {
    $result = mysqli_query($con, $sql);
    if ($result) {
      // echo '<script type="text/javascript">loginbtn()</script>';
      echo '<script>alert("Account Created Succesfully👍")</script>';
    } else {
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
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" value="" name="email" required>
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" value="" name="age" required>
        <!-- min="1" max="120" -->
      </div>
      <button type="submit" name="submit">SUBMIT</button>
    </form>
  </div>
</body>

</html>