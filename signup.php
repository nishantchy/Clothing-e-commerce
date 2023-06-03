<?php
include "dbconnect.php";
?>
<?php
$nameErr = $passError = $passError1 = $passError2 = $emailError = $emailError1 = $success =null;
if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if(empty($name)){
        $nameErr = "Please enter your Name";
    }
    else if(empty($email)){
        $emailError = "Please enter your email address";
    }
    else if(empty($pass) && empty($cpass)){
        $passError = "Passwords field cannot be empty";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailError1 =  "Invalid email address";
    }
    else if(strlen($pass)<8){
        $passError1 = "Atleast 8 characters required";
    }
    else if($pass !== $cpass){
        $passError2 = "Passwords do not match";
    }
    else{
        $sql = "INSERT INTO `register` (`name`, `email`, `password`) VALUES ('$name', '$email', '$pass')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $success = "Signed Up successfully";
        }
        else{
            echo "Error signing up";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <?php
    if($nameErr!= NULL){
        ?> <style>.nameError{display: block;color:red;}</style> <?php
    }
    if($emailError!= NULL){
        ?> <style>.emailError{display: block;color:red;}</style> <?php
    }
    if($emailError1!= NULL){
        ?> <style>.emailError1{display: block;color:red;}</style> <?php
    }
    if($passError!= NULL){
        ?> <style>.passError{display: block;color:red;}</style> <?php
    }
    if($passError1!= NULL){
        ?> <style>.passError1{display: block;color:red;}</style> <?php
    }
    if($passError2!= NULL){
        ?> <style>.passError2{display: block;color:red;}</style> <?php
    }
    if($success!=NULL){
        ?> <style>.success{display: block;color:white;background-color:green;width:15%;text-align:center;margin:auto;border-radius:0.2rem;padding:0.7rem}</style> <?php
    }
    ?>
</head>
<body>
    <div class="success">
        <?php echo $success ?>
    </div>
    <div class="container">
        <div class="logo-section">
            <img src="./svg/png/logo-black.png" alt="">
        </div>
    <div class="form-section">
        <form method="post">
            <div class="uname">
                <label for="">Username</label>
            <input type="text" name="username" id="">
            <p class="error nameError"><?php echo $nameErr?></p>
            </div>
            <div class="email">
            <label for="">Email</label>
            <input type="text" name="email" id="">
            <p class="error emailError"><?php echo $emailError?></p>
            <p class="error emailError1"><?php echo $emailError1?></p>
            </div>
            <div class="password">
                <label for="">Password</label>
            <input type="password" name="pass" id="">
            <p class="error passError"><?php echo $passError?></p>
            <p class="error passError1"><?php echo $passError1?></p>
            </div>
            <div class="confirm">
                <label for="">Confirm Password</label>
            <input type="password" name="cpass" id="">
            <p class="error passError2"><?php $passError2?></p>
            </div>
            <div class="submit">   
            <input type="submit" name="submit" value="Sign Up" id="">
            </div>
        </form>
        <div class="login">
            <p>Already Have an account? <a href="login.php">Login Here.</a></p>
        </div>
    </div>
    </div>
</body>
</html>

