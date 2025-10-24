<?php
require_once 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


//select from the table id where username= lda5alo luser .
    $check = $conn->prepare("SELECT id FROM users WHERE username=?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();
    $massage="";
//check result > 0 , y3ne mwjoud hayda l username abel .
if ($check->num_rows > 0) {
    $massage = "<span class='error'>username already exist try another.. </span>";
}else {
        $query = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $query->bind_param("ss", $username, $password);
        if( 
        $query->execute()){
        header("location:login.php");
    }
    else{
        $massage = "<span class='error'>ERROR IN REDIRECT..</span>";
        header("location:login.php");

    
}

}
require_once 'register.php';
}

?>