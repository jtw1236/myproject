<?php


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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>author</title>
</head>

    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: rgb(230, 245, 255); 
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid rgb(200, 220, 240); 
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: rgb(180, 220, 255);
            color: rgb(0, 70, 130); 
        }

        tr:hover {
            background-color: rgb(210, 235, 255);
        }
input[type="submit"] {
    background-color: rgba(0, 125, 197, 1);
    color: white;
    border: none;
    padding: 10px 20px;
    margin-right: 10px;
    cursor: pointer;
    border-radius:2px;
    display:inline;
}
input.delete {
    background-color: rgba(219, 0, 0, 1);;
}
form{
    display: inline-block;
}
h1{
    text-align:center;
    vertical-align:center;
    color:rgba(212, 1, 1, 1);
    margin-top:15%;
    text-align:center;
}
a{
    text-decoration:none;
    color:white;
    display: flex;
    justify-content: center;
    align-items: center; 


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
     .edit{
    background-color: rgba(0, 125, 197, 1);
    color: white;
    border: none;
    padding: 10px 20px;
    margin-right: 10px;
    cursor: pointer;
    border-radius:2px;
    width: 100px;
    display: inline;

        }
        img {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    </style>
<body>

<?php
//table exist or no
$check_table_books=("SHOW TABLES LIKE 'books'");
$result=$conn->query($check_table_books);
if($result->num_rows > 0){

$select_query=("SELECT b.id,b.title ,b.description,b.pages_count,b.book_type,b.in_stock,authors.name AS author_name  
                FROM books as b 
                JOIN authors ON b.author_id = authors.id");
    
$relsut1=$conn->query($select_query);
//eza ltable b2lbo recourd (mesh fade) 
if($relsut1->num_rows > 0 ){

//counter and table headers created  barra lwhile .
$counter=1;

$dir='../images';
$getImages = array_diff(scandir($dir), array('.', '..'));
$allowtypes=array('jpg','gif','jpeg','png');
$images_names = [];

//bn3abe asma2 limages kellon b2aleb array bas bdon ltype le elon
foreach ($getImages as $filename) {
    $images_names[]= $filename;

}

echo"<table>";
echo"<tr>   
        <th>Number</th>
        <th>Cover</th>
        <th>Author name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Pages Number</th>
        <th>Book Type</th>
        <th>In Stock</th>
        <th>Action</th>
    </tr>
        
";
//creation of td and fill it from the databas
while($row=$relsut1->fetch_assoc()){
//bne5od esem lkteb bn7ot m7al lspace - krmel nkaren ma3 lsora 
echo " <tr> 
        <td>" . $counter . "</td>";
        $found=false;
        //bnmshe 3a larray t3elet lsowar
        for ($i = 0; $i < count($images_names); $i++){
            //bne5od 2wal jeze2 men limage name (le abel lno2ta )
            $imagename=pathinfo($images_names[$i],PATHINFO_FILENAME);
            //bnkarenn 2wal jez2 men lsora ma3 esem lid 
            if($imagename===$row['id']){//eza mzbut
                //bnjahez lpath t3eel limage
                $src=$dir.'/'.$images_names[$i];
            echo'<td><img src="'.$src.'" alt="Book Cover"  id="imgid"></td>';
             $found=true;
            break;
        } 
        }
        //eza ma t8yar lboolean y3ne ma l2yna lsora 
        if(!$found){
            echo'<td>NO IMAGE</td>';
        }
 
       echo "
        <td>".$row['author_name'] ."</td>
        <td>".$row['title'] ."</td>
        <td>".$row['description'] ."</td>
        <td>".$row['pages_count'] ."</td>
        <td>".$row['book_type'] ."</td>
        <td>".$row['in_stock'] ."</td>

        <td>
            <a class='edit' href='edit_book.php?id=" . $row['id'] . "'>Edit</a>
            <form action='delete_book.php' method='post' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='submit' value='Delete' onclick=\"return confirm('Are You Sure?');\" class='delete'>
            </form>
        </td>
    </tr>
";

$counter++;
}

echo"</table>";
}else{
echo"<h1>Books Table Empty.<br> Add Some Books.</h1>";


}

}else//eza ltable mesh mawjoud 
{
    echo"<h1> TABLE NOT EXIST !</h1>";
}
?>
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





