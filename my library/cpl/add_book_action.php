<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location:../login.php");
    exit;
}
$username = $_SESSION['username'] ?? $_COOKIE['username'];

require_once '../config/connection.php';
$message="";    


// git info
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorid  = $_POST['author_id'];
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $pagesnb      = (int)$_POST['pages'];
    $type   = $_POST['type'];
    $instock   = isset($_POST['in_stock']) ? 1 : 0;
    $img   = $_FILES['image'];
    

//tjheez lquery 
$query = $conn->prepare("INSERT INTO books (author_id, title, description, pages_count, book_type, in_stock) VALUES (?,?,?,?,?,?)");

$query->bind_param("issisi", $authorid, $title, $description, $pagesnb, $type, $instock);




//bne5od 3naser lsora lnshayyek 3lyhon ka no3 men lsecurity
$imgname= $_FILES['image']['name'];
$imgsize= $_FILES['image']['size'];
$imgtype= $_FILES['image']['type'];
$imgstmpn= $_FILES['image']['tmp_name'];
$imgerror=$_FILES['image']['error'];

 //7adana no3 lmalafet lmsmou7 tnda5ela (extension)
$allowtypes=array('jpg','gif','jpeg','png');
//a5dna e5er extension ba3ed lno2ta 
$img_parts = explode('.', $imgname);
$img_extension = strtolower(end($img_parts));

//shayyek 3a leshya le mohem tkon mwjoude l ne3ref lkteb 
            if(empty($authorid) || empty($title) ){//mt
               $_SESSION['message']="<h1 class='error'>Warning!! : title and author name are required </h1>";
                header("Location: add_book.php");
                exit;
            }
            //eza lsora mesh mwjoude bn3mel add 3ade l2nu lsora mesh requried metel ma mtlob
            if ($imgerror === 4) {
                    if($query->execute()){
                        $_SESSION['message']="<h1 class='done'> New book added succ.</h1>";
                         header("Location: add_book.php");
                          exit;
                    }else{
                        $_SESSION['message']="<h1 class='error'>Warning!! :Faleid to add book.</h1>";
                 header("Location: add_book.php");
                exit;              
                         }
                }
            else{//eza lsora mwjoude 


            if($imgsize >  8000000){//check 3a lsize 
                $_SESSION['message']="<h1 class='error'>Warning!! : Image size too big.</h1>";
                header("Location: add_book.php");
                exit;
            }

            elseif(!in_array($img_extension,$allowtypes)){//check 3a type t3eel lsora eza mwjoud bel allow types

                $_SESSION['message']="<h1 class='error'>Warning!! : Image type not allowed.</h1>";
                header("Location: add_book.php");
                exit;
            }
            else{
      
                    if($query->execute()){
                        $_SESSION['message']="<h1 class='done'> New book added succ.</h1>";
                          //eza kel she tamem b7awel lsora 3a lfolder w bn3mel execute
                            $upload_dir = "C:\\xampp\\htdocs\\my library\\images\\";
                            //bn8yer esem lsora lal id t3eel lkteb
                            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                            $book_title =  $conn->insert_id;
                            //prepare
                            $imgname = $book_title . '.' . $ext;
                            $target_file = $upload_dir . $imgname;
                            //add
                            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                            header("Location: add_book.php");
                                        exit;
                    }else{
                        $_SESSION['message']="<h1 class='error'>Warning!! :Faleid to add book.</h1>";
                        header("Location: add_book.php");
                        exit;
                
               }
            }

         }
    
}