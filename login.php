<?php
include "dbconnect.php";
$email_error = $password_error = $error =null;
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if(empty($email)){
        $email_error = "Email field cannot be empty";
      }
      else if(empty($pass)){
        $password_error =  "Password field cannot be empty";
      }
      else{
        $sql = "SELECT * FROM `register` WHERE email='$email' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        if($result){
            if(mysqli_num_rows($result)==1){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['email']=$email;
                header("Location: index.php");
            }
            else{
                $error = "Invalid details";
            }
          
        }
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <?php
    if($email_error!=NULL){
        ?> <style> .email-error{display:block;color:red;}</style> <?php
    }
    if($password_error!=NULL){
        ?> <style> .password-error{display:block;color:red;}</style> <?php
    }
    if($error!=NULL){
        ?> <style> .detail-error{display:block;color:red;}</style> <?php
    }

?>
</head>
<body>
    <!-- <div class="header">Login Page</div> -->
    <div class="container">
        <div class="logo-section">
            <img src="svg/logo.png" alt="">
        </div>
    <div class="form-section">
        <form method="post">
            <div class="email">
            <label for="">Email</label>
            <input type="text" name="email" id="">
            <p class="error email-error"><?php echo $email_error ?></p>
            </div>

            <div class="password">
                <label for="">Password</label>
            <input type="password" name="pass" id="">
            <p class="error password-error"><?php echo $password_error ?></p>
            </div>
            <div class="submit">   
            <input type="submit" name="submit" value="Login" id="">
            <p class="error detail-error"><?php echo $error ?></p>
            </div>
        </form>
        <div class="login">
            <p>Don't Have an account? <a href="signup.php">Sign Up Here.</a></p>
        </div>
    </div>
    </div>
</body>
</html>

