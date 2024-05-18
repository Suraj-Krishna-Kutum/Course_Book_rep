<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
echo "<h1 align='center'>Hello ".$_SESSION['username']."</h1>";
$servername = "localhost";
$username = "root";
$password = "";
$database = 'miniproject';
    
$conn = new mysqli($servername,$username,$password,$database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Book</title>
</head>
<body>
    <table align="center">
        <tr>
            <th colspan="3" >
                <form action="user.php" method = "post">
                    <label for="">Course Code:</label><br>
                    <input type="text" name="courseid" required><br>
                    <input type="submit" value="Search" name="search">
                </form> 
            </th>
        </tr>
    </table>

    <?php
    if($_SESSION['username'] == "admin"){
    ?>
    <?php
    if(isset($_POST['search'])){
        $search = $_POST['courseid'];
        $sql = "SELECT * FROM course_book
                WHERE courseid = '$search'
                ";
        if($search == "all_books"){
            $sql = "SELECT * FROM course_book";
        }
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){ 
            ?>
            <table align="center">
                <tr>
                <th>Course Code</th>
                <th>Book Title</th>
                <th>Description</th>
                <th>Download</th>
                </tr>
            <?php
            while( $row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                <td align="center"><?php
                echo $row["courseid"];
                ?>
                </td>
                <td align="center">
                <?php
                echo $row["bname"];
                ?>
                </td>
                <td>
                <?php
                echo $row["decription"];
                ?>
                <td align="center">
                <?php
                $ad = $row['address'];
                echo  "<a href='{$ad}' target='_blank'>download</a> ";
            }
                ?>
            </table>        
    <?php
        }
    ?>
    <h3 align="center">Update Course Books</h3>
    <?php
    }else{
        echo "<p align='center'>No Data!</p>";
    }
    ?>
    <table align="center">
        <tr>
            <th>
                <form action="perform.php" method = "post" enctype="multipart/form-data" >
                    <label for="">Course ID:</label><br>
                    <input type="text" name="courseid" ><br>
                    <label for="">Book Title:</label><br>
                    <input type="text" name="bname" ><br>
                    <label for="">Description:</label><br>
                    <input type="text" name="description" ><br>
                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                    <input type="submit" value="Add" name="add">
                </form>
            </th>
            <th>
                <form action="perform.php" method = "post" >
                    <label for="">Course ID:</label><br>
                    <input type="text" name="courseid" ><br>
                    <label for="">Book Title:</label><br>
                    <input type="text" name="bname" ><br>
                    <input type="submit" value="Delete" name="delete">
                </form>
            </th>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <form action="perform.php" method = "post" >
                    <input type="submit" value="Logout" name="logout">
                </form>
            </td>
        </tr>
</table>
<?php
}else{
    if(isset($_POST['search'])){
        $search = $_POST['courseid'];
        $sql = "SELECT * FROM course_book
                WHERE courseid = '$search'
                ";
        if($search == "all_books"){
            $sql = "SELECT * FROM course_book";
        }
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){ 
            ?>
            <table align="center">
                <tr>
                <th>Course Code</th>
                <th>Book Title</th>
                <th>Description</th>
                <th>Download</th>
                </tr>
            <?php
            while( $row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                <td><?php
                echo $row["courseid"];
                ?>
                </td>
                <td>
                <?php
                echo $row["bname"];
                ?>
                </td>
                <td>
                <?php
                echo $row["decription"];
                ?>
                <td>
                <?php
                $ad = $row['address'];
                echo  "<a href='{$ad}' target='_blank'>download</a> ";
            }
                ?>
            </table>        
    <?php
        }
    ?>
    <br>
    <br>
    <?php
    }else{
        echo "<p align='center'>No Data!</p>";
    }
?>
    <table align="center">
        <tr>
            <th>
                <form action="perform.php" method = "post" >
                    <input type="submit" value="Logout" name="logout">
                </form>
            </th>
        </tr>
    </table>
<?php
}
?>
</body>
</html>