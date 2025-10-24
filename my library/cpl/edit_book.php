<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];
//a5dna lid men link 
$bookid = (int) $_GET['id'];
//jbna lname t3ool lid men ldatabase
$query = $conn->prepare("SELECT b.id,b.title,b.author_id ,b.description,b.pages_count,b.book_type,b.in_stock,authors.name AS author_name  
                FROM books as b  
                JOIN authors 
                ON b.author_id = authors.id 
                WHERE b.id = ?"
                 );
$query->bind_param("i", $bookid);
$query->execute();
$result = $query->get_result();
$book = $result->fetch_assoc();
//jbna lsora 
$dir='../images';
$getImages = array_diff(scandir($dir), array('.', '..'));
$allowtypes=array('jpg','gif','jpeg','png');
$images_names = [];
//bn3abe asma2 limages kellon b2aleb array bas bdon ltype le elon
foreach ($getImages as $filename) {
    $images_names[]= $filename;

}

//jebna lauthors
$select_authors=("SELECT * from authors");
$authorrecords=$conn->query($select_authors);
?><!--3dna code ladd aothur ma3 t8yeer laction w t3beyet ltext box bel name lbdna n3melo edit-->
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
<h1>Edit Book</h1>
      <form method="POST" enctype="multipart/form-data" action="edit_book_action.php">
  <label for="author_id">Author:</label>
  <select name="author_id" id="author_id" required>
    <option value="" >-- Select Author --</option>
  <?php while($row = $authorrecords->fetch_assoc()): ?>
<option value="<?= $row['id'] ?>" <?= ($row['id'] == $book['author_id']) ? 'selected' : '' ?>>
        <?= $row['name'] ?>
    </option>
<?php endwhile; ?>
  </select>
  

  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value=<?=$book['title'] ?> required>




  <label for="description">Description:</label>
  <textarea name="description" id="description" rows="5"  required><?=$book['description'] ?></textarea>


 

  <label for="pages">Page Count:</label>
  <input type="number" name="pages" id="pages" min="1" value=<?=$book['pages_count'] ?> required>


  <!--bne5od lid t3ee lkteb krmel n3del 3leh bel editbookaction-->
<input type="hidden" name="bookid" id="bookid" min="1" value=<?=$book['id'] ?> required>




  <label for="type">Type:</label>
 <select name="type" id="type" required>
  <option value="historical" <?= ($book['book_type'] == 'historical') ? 'selected' : '' ?>>Historical</option>
  <option value="short story" <?= ($book['book_type'] == 'short story') ? 'selected' : '' ?>>Short Story</option>
  <option value="children" <?= ($book['book_type'] == 'children') ? 'selected' : '' ?>>Children</option>
</select>




  <label>
    <input type="checkbox" name="in_stock" value="1" <?= ($book['in_stock'] == 1) ? 'checked' : '' ?>> In Stock
  </label>



  <label for="cover_image"></label>
  <?php
    $found=false;
        //bnmshe 3a larray t3elet lsowar
        for ($i = 0; $i < count($images_names); $i++){
            //bne5od 2wal jeze2 men limage name (le abel lno2ta )
            $imagename=pathinfo($images_names[$i],PATHINFO_FILENAME);
            //bnkaret 2wal jez2 men lsora ma3 esem lid 
            if($imagename==$book['id']){//eza mzbut 
                //bnjahez lpath t3eel limage
                $src=$dir.'/'.$images_names[$i];
                
            echo'<p> Carrent Picture Name :' .$images_names[$i].' <Br>Update Image:<input type="file" name="image" id="cover_image" accept="image/*"  ><Br> </p>';
             $found=true;
            break;
        } 
        }
        //eza ma t8yar lboolean y3ne ma l2yna lsora 
        if(!$found){
            echo' <p> Cover Image:<input type="file" name="image" id="cover_image" accept="image/*"  > </p>';
        }
        ?>
 

  <input type="submit" value="Submit">
</form>
    </div>
    <a href="books.php">
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

