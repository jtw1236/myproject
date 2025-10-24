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
.edit{
    text-decoration:none;
    color:white;
    display: flex;
    justify-content: center;
    align-items: center; 


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

    </style>
<body>

<?php
//table exist or no
$check_table_existing=("SHOW TABLES LIKE 'authors'");
$result1=$conn->query($check_table_existing);
if($result1->num_rows > 0){

$select_query=("SELECT * from authors");
$relsut=$conn->query($select_query);
//eza ltable b2lbo recourd (mesh fade) 
if($relsut->num_rows > 0 ){

//counter and create of table barra lwhile .
$counter=1;
echo"<table>";
echo"<tr> 
        <th>Number</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
        
";


//creation of td and fill it from the databas
while($row=$relsut->fetch_assoc()){
echo "
    <tr> 
        <td>" . $counter . "</td>

        <td>" . $row['name'] . "</td>
        <td>
            <form action='edit_author.php' method='post' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='submit' value='edit' class='edit'>
            </form>
            <form action='delete_author.php' method='post' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='submit' value='Delete' onclick=\"return confirm('Are You Sure?');\" class='delete'>
            </form>
        </td>
    </tr>
";

$counter++;


}
echo"</table>";




}else//eza ltable ma fe records
{

echo"<h1>Author Table Empty.<br> Add an author.</h1>";


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


