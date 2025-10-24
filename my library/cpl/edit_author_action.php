<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];




$message="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //jebna lname w id men lform
    $name = $_POST['authorname']??'';
    $authorid = (int) ($_POST['authorid'] ?? 0);
$duplicatequery = $conn->prepare("SELECT name from authors where name = ? AND id != ?");
$duplicatequery->bind_param("si",$name,$authorid);
$duplicatequery->execute();
$result=$duplicatequery->get_result();
//eza lesem mesh mwjoud abel bn3mel update
if($result->num_rows === 0){


$query = $conn->prepare("UPDATE authors SET name = ? WHERE id = ?");
$query->bind_param("si",$name,$authorid);
 if ($query->execute()) {
     unset ($_SESSION['authorid']); 
    header("location:author.php");
    
 }else{
        die("connot update the name.");

 }
 }else//eza lesem mwjoud abel bn3mel lerror massage w bn3eed ktebet lcode t3eel ledit_author ma3 t3delet 3leh
 {
       $_SESSION['message']  = "<span class='error'>athour already exist</span>";
       header("location:edit_author.php");
   
   

 }

}



 ?>

