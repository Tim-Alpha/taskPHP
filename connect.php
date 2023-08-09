<?php
    //creating connection from database
    $con=new mysqli('localhost','root','','task');
    if(!$con)
    {
        die(mysqli_error($con));
    }
    else{
        // echo ('connected successfully !');
    }
?>