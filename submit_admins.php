<?php

include('required/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = secure($_POST['fname']);
    $lname = secure($_POST['lname']);
    $email = secure($_POST['email']);
    $password = secure($_POST['password']);
    $id = secure($_POST['modifyID']);

    if(empty($id)){
        $sql = "INSERT INTO admins (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";
        echo "Hiinsert";
    }else{
        $sql = "UPDATE admins SET fname='$fname', lname='$lname', email='$email', password='$password' WHERE srno='$id'";
        $res = $mysqli->query($sql);
        echo "Hiupdate";
    }

    if ($mysqli->query($sql) == TRUE) {
        // header("Location: admins.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>