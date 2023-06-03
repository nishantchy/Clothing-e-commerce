<?php
include "dbconnect.php";
?>
<?php
session_start();
if(isset($_GET['id'])){
  $p_id = $_GET['id'];
  $sql = "SELECT * FROM products WHERE p_id = $p_id";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    $product = $result-> fetch_assoc();
    if(!isset($_SESSION['cart'])){
      $_SESSION['cart']=[];
    }
    array_push($_SESSION['cart'], $product);
  }
  else{
    echo "Product not found";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow p-3 mb-5 bg-white rounded">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html"><img src="svg/png/logo-black.png" alt=""></a>
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
                <button><a class="nav-link" href="cart.php">My Cart</a></button>
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
      <div class="fa-container">
        <div class="img-section">
            <img src="uploads/<?php echo $product['p_image'];?>" alt="">
        </div>
        <div class="details">
            <div class="name">
                <p><?php echo $product['p_name'];?></p>
            </div>
            <div class="price">
                <p><?php echo $product['p_price'];?></p>
            </div>
            <div class="fa-details">
                <p><?php echo $product['p_details']?></p>
            </div>
            <div class="order-btns">
                <div class="btn1">
                    <button>Order Now</button>
                </div>
                <div class="btn2">
                    <button>Add to Cart</button>
                </div>
            </div>
        </div>
      </div>
</div>
 
      <!-- footer -->
      <footer class="bg-light text-center text-white">
        <!-- Grid container -->
        <div class="social-media">
          <div class="facebook">
            <img src="./svg/Facebook-f_Logo-Blue-Logo.wine.svg" alt="">
          </div>
          <div class="instagram">
            <img src="./svg/Instagram-Logo.wine.svg" alt="">
          </div>
        </div>
      
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2020 Copyright: Luga Nepal
        </div>
        <!-- Copyright -->
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>