<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorname = trim($_POST['authorname']??'');
    //BNE5OD LID KA RA2EM SA7I7 EZA KAN MWJOUD AW 0 EZA MA KEN RA2EM
    $authorid = is_numeric($_POST['id']) ? (int)$_POST['id'] : 0;
}

// nshayek 3a lid eza mwjoud
$check = $conn->prepare("SELECT id FROM authors WHERE id = ?");
$check->bind_param("i", $authorid);
$check->execute();
$check->store_result();
//eza l id mesh mwjoud
if ($check->num_rows === 0) {
    $check->close();
    $conn->close();
    header("Location: author.php");
    exit;
}
$sql = $conn->prepare("DELETE FROM authors WHERE id = ?");
$sql->bind_param("i", $authorid);
//eza l execute 3tane false bnw2ef ma3 error massage  
if (!$sql->execute()) {
    $sql->close();
    $conn->close();
    die("Failed to delete author.");
}
//bas ma fe she y5elle y3tene false bel 7ale ltbe3eyye fa bkamel 
$sql->close();
$conn->close();
header("Location: author.php");
exit;



?>
