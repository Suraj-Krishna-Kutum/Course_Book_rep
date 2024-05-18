<?php
session_start();
if(isset($_SESSION["username"])){
    header("Location: user.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Books</title>
</head>
<body>
<?php
?>
    <h1 align="center">Student/Admin Login</h1>
    <form action="login_register.php" method = "post" align="center">
        <label for="">Username:</label><br>
        <input type="text" name="username" required><br>
        <label for="">Password:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Log in" name="login">
        <input type="submit" value="Register" name="register">
    </form>          
</body>
</html>
<?php


?>