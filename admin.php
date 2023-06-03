<?php
include "dbconnect.php";
$success = $error = $uploadError = $fileError1 = $fileError = $error1 = $priceError = $priceError1= $titleError=null;
if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $price = $_POST['price'];
  $details = $_POST['details'];
  $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $img = basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if(empty($title)){
        $titleError = "Please fill title";
    }
    else if(empty($price)){
        $priceError = "Fill price section";
    }
    else if($price < 0){
        $priceError1 = "Price cannot be negative";
    }
    else if($_FILES["fileUpload"]["size"]>500000000){
        $fileError1 = "Sorry, your file is too large"; 
        $uploadOk =0;
    }
    else if($imageFileType != "jpg" && $imageFileType !="png" && $imageFileType!="jpeg"){
        $fileError = "Sorry, only jpg, jpeg and png files are allowed.";
        $uploadOk = 0;
    }
    else if($uploadOk==0){
        $uploadError = "Sorry, your file was not uploaded";
    }
    
    else{
        if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)){
           $sql = "INSERT INTO `products` (`p_name`, `p_price`, `p_details`, `p_image`) VALUES ('$title', '$price', '$details','$img')";
           $result = mysqli_query($conn, $sql);
            if($result){
            $success = "Product Added Successfully";
            }
            else{
            $error = "Error adding product";
            }
        }
        else{
            $error1 = "Sorry, there was an error uploading the file";
        }
    } 
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php
    if($success!=NULL){
        ?> <style>.success{display: block;color:white;background-color:green;width:15%;text-align:center;margin:auto;border-radius:0.2rem;padding:0.7rem}</style> <?php
    }
    if($titleError!= NULL){
        ?><style> .titleError{display:block;color:red;}</style><?php
    }
    if($priceError!= NULL){
        ?><style> .priceError{display:block;color:red;}</style><?php
    }
    if($priceError1!= NULL){
        ?><style> .priceError1{display:block;color:red;}</style><?php
    }
    if($fileError!= NULL){
        ?><style> .fileError{display:block;color:red;}</style><?php
    }
    if($fileError1!= NULL){
        ?><style> .fileError1{display:block;color:red;}</style><?php
    }
    if($uploadError!= NULL){
        ?><style> .uploadError{display:block;color:red;}</style><?php
    }
    if($error1!= NULL){
        ?><style> .error1{display:block;color:red;}</style><?php
    }
    ?>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow p-3 mb-5 bg-white rounded">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src="svg/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Our Products</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Settings
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                  <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
                  <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="admin.php">Dashboard</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <button><a class="nav-link" href="cart.html">My Cart</a></button>
              </li>
            </ul>
            
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <!-- End of Nav -->
      <div class="success">
        <?php echo $success?>
      </div>
      <div class="heading text-center">
        <p>Add Item</p>
      </div>
      <div class="add-items-form">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="title form">
                <label for="">Title</label>
                <input type="text" name="title" id="">
                    <p class="error titleError"><?php echo $titleError ?></p>
            </div>
            <div class="price form">
            <label for="">Price</label>
            <input type="text" name="price" id="">
                    <p class="error priceError"><?php echo $priceError ?></p>
                    <p class="error priceError1"><?php echo $priceError1 ?></p>
            </div>
    
            <div class="details form">
             <label for="">Details</label>
             <textarea name="details" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="file">
                <input type="file" name="fileUpload" id="">
                    <p class="error fileError"><?php echo $fileError ?></p>  
                    <p class="error fileError1"><?php echo $fileError1 ?></p>
                    <p class="error uploadError"><?php echo $uploadError ?></p>
                    <p class="error error1"><?php echo $error1 ?></p>
            </div>
            <div class="submit add d-flex justify-content-center">
                <input type="submit" name="submit" value="Add Item" id="">
            </div>
        </form>
      </div>



      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>