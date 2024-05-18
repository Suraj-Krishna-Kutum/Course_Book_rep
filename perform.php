<?php
session_start();
require 'connect.php';
?>
<?php

if(isset($_POST['delete'])){
    $courseid = $_POST['courseid'];
    $bname = $_POST['bname'];

    $fetchloc = "SELECT address FROM course_book
                WHERE courseid = '$courseid' AND bname = '$bname'";
    
    $data = mysqli_query($conn, $fetchloc);
    if(mysqli_num_rows($data) > 0){
        $row = mysqli_fetch_array($data);
        $address = $row["address"];
        if(file_exists($address)){
            unlink($address);
        }
    }

    $sql = "DELETE FROM course_book
            WHERE courseid = '$courseid' AND bname = '$bname'";
        
    try{
        mysqli_query($conn, $sql);
        header("Location: user.php");
            
    }catch(mysqli_sql_exception){
        echo'Could not delete record;';
        sleep(3);
        header('Location: user.php');
    }
}elseif(isset($_POST['add'])){
    
    $target_dir = "books/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file);
    $courseid = $_POST['courseid'];
    $bname = $_POST['bname'];
    $description = $_POST['description'];
    $sql = "INSERT INTO course_book(courseid,bname,decription,address)
            VALUE('$courseid','$bname','$description','$target_file')";
            
    try{
        mysqli_query($conn, $sql);
        header("Location: user.php");
                
    }catch(mysqli_sql_exception){
        echo'Could not delete record;';
        sleep(3);
        header('Location: user.php');
    }
}
elseif(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('Location: index.php');
}
?>