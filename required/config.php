<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_error) {
    exit('Could not connect');
}

// isLoggedin
function isLoggedin()
{
    return isset($_SESSION['admin_id']);
}

function secure($value)
{
    global $mysqli;
    return mysqli_real_escape_string($mysqli, htmlspecialchars(trim($value)));
}

function Encrypt($value)
{
    return md5("Mehreen") . md5($value) . md5("Injeela");
}

function formatDate($date)
{
    return date('d M Y', strtotime($date));
}

function formatDateTime($date)
{
    return date('d M Y h:i A', strtotime($date));
}

function formatTime($date)
{
    return date('h:i A', strtotime($date));
}
