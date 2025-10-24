<?php


if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// Check if author table exist exists
$checkk = $conn->query("SHOW TABLES LIKE 'authors'");
if ( $checkk->num_rows === 0) {
    die( "<h1 style='text-align:center;color:red; margin-top:15%;'>Authors TABLE NOT FOUND , You have to create it.</h1>");

}


// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Author</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: white;
        }

        .form-box {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.81);
            background-color: #fff;
            text-align: center;
        }

        input[type="text"] {
            width: 250px;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid rgba(165, 151, 151, 1);
            border-radius: 6px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: rgb(60, 179, 113);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: rgb(50, 160, 100);
        }

        .error {
            color: rgba(255, 0, 0, 1);
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .done {
            color: rgba(23, 179, 9, 1);
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
        }

        .back {
            width: 200px;
            background-color: rgba(18, 99, 65, 1);
            text-align: center;
            border: 1px solid rgba(98, 180, 82, 1);
            padding: 10px;
            border-radius: 10px;
            margin-top: 20px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back:hover {
            background-color: rgba(14, 79, 52, 1);
        }
    </style>
</head>
<body>

    <div class="form-box">
        <h2>Add Author</h2>
        <form action="add_author_action.php" method="post">
            <input type="text" name="authorname" placeholder="Enter author name" required><br>
            <input type="submit" value="Add Author">
            <?php
                if (isset($massage)) {
                    echo $massage;
                }
            ?>
        </form>
    </div>
    <a href="cpl.php">
        <div class="back">Go Back</div>
    </a>
    
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
