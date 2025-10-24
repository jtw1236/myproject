<?php

session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];
//jbna lid,  hon saret mshklet lid NOT DEFINED bas yrja3 lal saf7a men laction b7al kan nfs lesem 
if (isset($_POST['id'])) {
    $_SESSION['authorid'] = (int) $_POST['id'];
} 

//jbna lname t3ool lid men ldatabase
$query = $conn->prepare("SELECT name FROM authors WHERE id = ?");
$query->bind_param("i", $_SESSION['authorid']);
$query->execute();
$result = $query->get_result();
$name = $result->fetch_assoc();
$namevalue = isset($name['name']) ? $name['name'] : '';
?><!--3dna code ladd aothur ma3 t8yeer laction w t3beyet ltext box bel name lbdna n3melo edit-->
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
        <h2>Edit Author</h2>
       <!--8yrna laction men add lal edit -->
        <form action="edit_author_action.php" method="post">
        <input type="text" name="authorname" value="<?php echo $namevalue; ?>" placeholder="Enter author name" required><br>
        <!--zedna input tenye la n7affez feha lid -->
        <input type="hidden" name="authorid" value="<?php echo $_SESSION['authorid']; ?>">

            <input type="submit" value="Update Author">
            <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>
        </form>
    </div>
    <a href="author.php">
        <div class="back">Go Back</div>
    </a>

</body>
</html>

