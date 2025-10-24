<?php
session_start();
require_once 'config/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
}
//bnjeeb lpassword t3eel lusername .
    $query = $conn->prepare("SELECT password FROM users WHERE username=?");
    $query->bind_param("s", $username);
    $query->execute();
    $query->store_result();
//eza mwjoud lusername bfoot la yshuf lpassword .
        if($query->num_rows > 0){
        $query->bind_result($hashedPassword);
        $query->fetch();
//eza lpassword sa7 bym3el session w cookie , w bfwtna 3a cpl.
            if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            setcookie("username", $username,time()+(3 * 60 * 60),"/");
           header("Location:cpl/cpl.php");
         }
    
         else
         {
            $massage = "<span class='error'>wrong username or password..</span>";

    }
}
// eza ma fe password lal username m3neta lusername 8alat.
else{
            $massage = "<span class='error'>wrong username or password..</span>";
    }
require_once 'login.php';

?>