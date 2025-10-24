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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Author</title>
    <style>
      
        body {
            flex-direction: column;
            justify-content: center;
            background-color: white;

        }

 
        form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
    width: 400px;
    margin: auto;
}

form label {
    font-weight: bold;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="number"],
form select,
form textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid rgba(85, 90, 85, 1);
    border-radius: 5px;
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
              color: rgba(218, 22, 22, 1);
            font-weight: bold;
            display: block;
            margin-top: 10px auto;
              

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
            justify-content: center;
            margin: 20px auto;
            

        }
          .done {
            color: rgba(23, 179, 9, 1);
            font-weight: bold;
            display: block;
            margin-top: 10px auto;
        }

        .back:hover {
            background-color: rgba(14, 79, 52, 1);
        }
        h1{
            text-align:center;
            color:rgba(148, 19, 19, 1)

        }
    </style>
</head>
<body>




<?php
//table books exist or no
$check_table_books=("SHOW TABLES LIKE 'books'");
$books=$conn->query($check_table_books);

//eza books table mesh mwjoud
if($books->num_rows === 0){
     $message="<h1 class='error'>Books Table not exist , you cannot add book without it .</h1>";
}else{
//bnshuf eza b2lbon records
$select_authors=("SELECT * from authors");
$authorrecords=$conn->query($select_authors);

if($authorrecords->num_rows === 0){
    $message="<h1 class='error'>Authors table is clear , Add author first then add book .</h1>";
}else{




?>


        <h1>Add Book</h1>
      <form method="POST" enctype="multipart/form-data" action="add_book_action.php">
  <label for="author_id">Author:</label>
  <select name="author_id" id="author_id" required>
    <option value="">-- Select Author --</option>
  <?php while($row = $authorrecords->fetch_assoc()): ?>
    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
<?php endwhile; ?>
  </select>
  

  <label for="title">Title:</label>
  <input type="text" name="title" id="title" required>




  <label for="description">Description:</label>
  <textarea name="description" id="description" rows="5" required></textarea>


 

  <label for="pages">Page Count:</label>
  <input type="number" name="pages" id="pages" min="1" required>





  <label for="type">Type:</label>
  <select name="type" id="type" required>
            <option value="historical">Historical</option>
            <option value="short story">Short Story</option>
            <option value="children">Children</option>
  </select>




  <label>
    <input type="checkbox" name="in_stock"> In Stock
  </label>



  <label for="cover_image"></label>
 <p> Cover Image:<input type="file" name="image" id="cover_image" accept="image/*"></p>

  <input type="submit" value="Submit">
</form>


    <?php

  }

 }


     if (isset($message)) {
                    echo $message;
                }
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
                ?>
    <a href="cpl.php">
        <div class="back">Go Back</div>
    </a>
</body>

    <script>
    //code java la 7ata m3ash yrja3 men login la hon (AI)<-
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        window.location.reload();
    }
});
</script>
</html>