<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the 'socialmediamanager' database
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS socialmediamanager";
if ($conn->query($sqlCreateDatabase) === TRUE) {
    // echo "Database 'socialmediamanager' created successfully\n";
} else {
    // echo "Error creating database: " . $conn->error . "\n";
    $conn->close();
    exit;
}

// Connect to the 'socialmediamanager' database
$conn->select_db("socialmediamanager");

// SQL queries to create tables
$sqlAdminsTable = "
CREATE TABLE IF NOT EXISTS admins (
    srno INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255),
    lname VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
";
$sqlUsersTable = "
CREATE TABLE IF NOT EXISTS users (
    srno INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255),
    lname VARCHAR(255),
    email VARCHAR(255),
    contact BIGINT(10),
    password VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
";
$sqlTrendingTable = "
CREATE TABLE IF NOT EXISTS trending (
    srno INT AUTO_INCREMENT PRIMARY KEY,
    hashtags VARCHAR(255),
    used INT
);
";
$sqlSupportTable = "
CREATE TABLE IF NOT EXISTS support (
    srno INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    contact BIGINT(10),
    email VARCHAR(255),
    subject VARCHAR(255),
    message TEXT,
    posted_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";
$sqlDoodleTable = "
CREATE TABLE IF NOT EXISTS doodle (
    srno INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    image_path VARCHAR(255),
    added_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
";

// Execute the SQL queries
if (
    $conn->query($sqlAdminsTable) === TRUE &&
    $conn->query($sqlUsersTable) === TRUE &&
    $conn->query($sqlTrendingTable) === TRUE &&
    $conn->query($sqlSupportTable) === TRUE &&
    $conn->query($sqlDoodleTable) === TRUE
) {
    // echo "Tables created successfully\n";
} else {
    // echo "Error creating tables: " . $conn->error . "\n";
}

// Close the database connection
$conn->close();

?>
