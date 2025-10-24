<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'library';
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_report(MYSQLI_REPORT_OFF);   //ai la 7ata nw2ef 3ared lerror w totla3 lmassage  le elna
// Check if database exists and use it 
if (!$conn->select_db($database)) {
    echo "<h1 style='text-align:center;color:red; margin-top:15%;'  >CREATE THE DATABASE FIRST!!</h1>";
    exit();
}
// Check if users table exist exists
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ( $result->num_rows === 0) {
    echo "<h1 style='text-align:center;color:red; margin-top:15%;'>USER TABLE NOT FOUND</h1>";
    exit();
}



    ?>

