<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = 'miniproject';

$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$query = "CREATE TABLE IF NOT EXISTS admin_table (
            id int auto_increment primary key,
            user varchar(255),
            password varchar(255)
        ); 
        ";

mysqli_query($conn, $query);

$query = "CREATE TABLE IF NOT EXISTS course_book (
    id int auto_increment ,
    courseid varchar(255) ,
    bname varchar(255),
    decription text,
    address text,
    primary key (id,courseid)
);
";

mysqli_query($conn, $query);

header("Location: index.php");

?>