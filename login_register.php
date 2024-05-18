<?php
session_start();
?>
<?php
require 'connect.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM admin_table
                where user = '$username'";
        
        try{
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){ 
                $row = mysqli_fetch_array($result);
            }else{
                echo 'User not found';
            }
            if($row['password']==$password){
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row['id'];
                header('Location: user.php');
            }else{
                echo "<script>alert('Wrong Password')</script>";
            }
            
        }catch(mysqli_sql_exception){
            echo"<script>alert('Could not register user')</script>";
            sleep(3);
            header('Location: index.php');
        }
        
    }elseif(isset($_POST['register'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "INSERT INTO admin_table(user,password)
                VALUES ('$username','$password')";

        try{
            mysqli_query($conn, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            header('Location: user.php');
            
        }catch(mysqli_sql_exception){
            echo'Could not register user';
            sleep(3);
            header('Location: index.php');
        }
        
    }
}
else{
    header('Location: index.php');
}
?>