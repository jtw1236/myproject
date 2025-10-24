<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}
    require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel</title>
    <link rel="stylesheet" href="style.css">
    <style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    text-align: center;
}

.title {
    margin-top: 30px;
    font-size: 36px;
    color: rgb(33, 33, 33);
}

.container {
    display: flex;
    justify-content: center;

    margin: 40px auto;
    gap: 20px;
    max-width: 1000px;
}

.card {
    width: 200px;
    height: 200px;
    border-radius: 10px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: transform 0.2s ease;
    margin-top:10%
}

.card:hover {
    transform: scale(1.03);
}

.card h2 {
    font-size: 20px;
    margin: 0;
}
a{
    text-decoration:none;
}
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: rgba(156, 31, 31, 1);
        color: white;
        padding: 10px 20px;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    input {
        background-color: rgba(86, 124, 71, 1);
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
        color: white;
        font-weight:bold;
    } 
    form {
    margin-right: 30px;
}
    input:hover  {
        background-color: rgba(109, 158, 89, 1);
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
        color: white;

    }

    </style>
</head>
<body>
   
    <div class="navbar">
    <h4>LIBRARY</h2>
    <form action="../logout.php" method="post">
        <input type="submit" value="Logout"  onclick="return confirm('Are You Sure?')">
    </form>
</div>
 <br><br><br><br>
    <h1 class="title">Control Panel</h1>
   <div class="container">
    <a href="books.php"> 
        <div class="card" style="background-color: rgba(0, 140, 255, 1);">
            <h2>Books</h2>
        </div>
    </a>
    <a href="add_book.php">
        <div class="card" style="background-color: rgba(0, 90, 126, 1);">
            <h2>Add Book</h2>
        </div>
    </a>
    <a href="author.php">
        <div class="card" style="background-color: rgba(175, 68, 86, 1);">
            <h2>Authors</h2>
        </div>
    </a>
    <a href="add_author.php">
        <div class="card" style="background-color: rgb(220, 20, 60);">
            <h2>Add Author</h2>
        </div>
    </a>
    </div>

    <script>
    //code java la 7ata m3ash yrja3 men login la hon (AI)<-
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        window.location.reload();
    }
});
</script>

</body>

</html>
