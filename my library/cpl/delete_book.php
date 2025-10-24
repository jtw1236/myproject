<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}

require_once '../config/connection.php';
// use session then cookie if session mesh mwjoude 
$username = $_SESSION['username'] ?? $_COOKIE['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorname = trim($_POST['authorname']??'');
    //BNE5OD LID KA RA2EM SA7I7 EZA KAN MWJOUD AW 0 EZA MA KEN RA2EM
    $bookid = is_numeric($_POST['id']) ? (int)$_POST['id'] : 0;
}

// nshayek 3a lid eza mwjoud
$check = $conn->prepare("SELECT id FROM books WHERE id = ?");
$check->bind_param("i", $bookid);
$check->execute();
$check->store_result();
//eza l id mesh mwjoud
if ($check->num_rows === 0) {
    $check->close();
    $conn->close();
    header("Location: author.php");
    exit;
}
$sql = $conn->prepare("DELETE FROM books WHERE id = ?");
$sql->bind_param("i", $bookid);
//eza l execute 3tane false bnw2ef ma3 error massage  
if (!$sql->execute()) {
    $sql->close();
    $conn->close();
    die("Failed to delete author.");
}
//bnma7e lsora 
$dir='../images';
$getImages = array_diff(scandir($dir), array('.', '..'));
$allowtypes=array('jpg','gif','jpeg','png');
$images_names = [];
//bn3abe asma2 limages kellon b2aleb array bas bdon ltype le elon
foreach ($getImages as $filename) {
    $images_names[]= $filename;

}

//bnmshe 3a larray t3elet lsowar
        for ($i = 0; $i < count($images_names); $i++){
            //bne5od 2wal jeze2 men limage name (le abel lno2ta )
            $imagename=pathinfo($images_names[$i],PATHINFO_FILENAME);
            //bnkaret 2wal jez2 men lsora ma3 esem lid 
            if($imagename==$bookid){//eza mzbut 
                //bnm7e limg
                unlink("../images/".$images_names[$i]);
                header("Location: books.php");
            }
            
        }






//bas ma fe she y5elle y3tene false bel 7ale ltbe3eyye fa bkamel 
$sql->close();
$conn->close();
header("Location: books.php");
exit;



?>
