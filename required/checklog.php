<?php
require_once('required/config.php');

if(isset($_SESSION['admin_email']) && isset($_SESSION['admin_password']))
{
    $email_chk_ses = $_SESSION['admin_email'];
    $password_chk_ses = $_SESSION['admin_password'];

    $sql = "SELECT * FROM admins WHERE email = '$email_chk_ses' AND password = '$password_chk_ses'";
        $result = $mysqli->query($sql);
        if (!$result->num_rows > 0) {
        header('location: login.php');
        exit();
        }
}
elseif(!isset($_COOKIE['remember_user']) && !isset($_COOKIE['remember_password'])){
    setcookie('admin_name', '', time() - (86400 * 30));
    header('location: login.php');
}
elseif(isset($_COOKIE['remember_user']) && isset($_COOKIE['remember_password'])){
    $email_chk_ck = $_COOKIE['remember_user'];
    $password_chk_ck = $_COOKIE['remember_password'];

    $sql = "SELECT fname, lname FROM admins WHERE email = '$email_chk_ck' AND password = '$password_chk_ck'";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $full_name = $row['fname'] . ' ' . $row['lname'];
        setcookie('admin_name', $full_name, time() + (86400 * 30));
    }
}


// if (!isset($_COOKIE['remember_user'])) {
//     header('location: login.php');
//     exit();
// }
?>
