<?php
include "connect.php";

// getting data from registration form
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

  // Query to admin data table
  $sql1 = "SELECT * FROM  `admin`";
  $myResult = $con->query($sql1);

  // Query to check if any admin available or not
  if ($myResult->num_rows > 0) {
    $sql2 = "SELECT * FROM `admin` WHERE  turn=1";
    $adminResult = mysqli_query($con, $sql2);
    $row = mysqli_fetch_assoc($adminResult);
    $myAdmin = $row['id'];

    // counting number of admin
    $sqlCount = "SELECT COUNT(*) AS row_count FROM `admin`";
    $resultCountAdmin = $con->query($sqlCount);
    $row = $resultCountAdmin->fetch_assoc();
    $rowCount = $row["row_count"];

    echo "Number of rows in the table: " . $rowCount;
    echo "Assign to admin : " . $myAdmin;

    // sending data to the database
    $sql = "INSERT INTO `user`(`name`, `mobile`, `myadmin`) VALUES ('$name',$mobile,'$myAdmin')";

    if ($myAdmin >= $rowCount) {


      $sql2 = "UPDATE `admin` SET `turn`=1 WHERE `id`=1";
      $resultUpdate = mysqli_query($con, $sql2);
      if ($resultUpdate) {
        echo ("updation Successfull!");
      } else {
        echo ("updation failed!");
      }
    } else {
      $sql2 = "UPDATE `admin` SET `turn`=0 WHERE turn=1";
      $resultLastUpdate = mysqli_query($con, $sql2);
      if ($resultLastUpdate) {
        echo ("Last updation Successfull!");
      } else {
        echo ("Last updation failed!");
      }

      $myAdmin = (int)$myAdmin;
      $myAdmin += 1;

      $sql2 = "UPDATE `admin` SET `turn`=1 WHERE `id`='$myAdmin'";
      $resultNewUpdate = mysqli_query($con, $sql2);
      if ($resultNewUpdate) {
        echo ("New updation Successfull!");
      } else {
        echo ("New updation failed!");
      }
      //--------------------------
    }

    // running query for removing repetation
    $mobilequery = "SELECT * FROM `user` where mobile='$mobile'";

    $querymobile = mysqli_query($con, $mobilequery);
    $mobilecount = mysqli_num_rows($querymobile);

    // cheacking condition for sussessfull or unsuccessfull attempt
    if ($mobilecount > 0) {
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
  } else {
    echo ("Sorry no admin avilable this time");
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