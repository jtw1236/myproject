<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];

$massage="";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorname = trim($_POST['authorname']??'');
}


// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];
//call the id of the author for check if the authr exist or not
$existwriter = $conn->prepare("SELECT id from authors where name= ? ");
$existwriter->bind_param("s",$authorname);
$existwriter->execute();
$result= $existwriter->get_result();
//eza mwjoud abel bye5od lerror massage w bfel 
if($result->num_rows > 0){
    $massage="<span class='error'>Writer already exist !</span>";

}
else//eza msh mwjoud 
    {
$existwriter->close();
//eza lvalue mesh empty bn3mel add 
 if (!empty($authorname)) {
        $query = $conn->prepare("INSERT INTO authors (name) VALUES (?)");
        $query->bind_param("s", $authorname);
        //eza mesh emty bn3mello add (excute lal query) 
        if($query->execute()){
            $massage="<span class='done'>New Author Added !</span>";
        }
    }else//emoty value bye5od l error massage w bfel.
    {
        $massage="<span class='error'>empty value !</span>";
    }
}

    require_once'add_author.php';


?>