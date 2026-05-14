<!--connect file-->
<?php

include('../includes/connect.php');
include('../function/common_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcome <?php echo $_SESSION['username']; ?></title>
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>

    <!--css file link-->
    <link rel="stylesheet" href="../style.css">
    <style>
      body{
      overflow-x:hidden;
      }
      .profile_img{
    width: 100px;
    height: 100px;
    border-radius: 50%;
}
    </style>
</head>
    <body>
      <section>
   <!--navber-->
   <div class="container-fluid p-0">
    <!---first child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="../image/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class='fa-solid fa-cart-shopping'></i><sup><?php cart_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
        </li>
      </ul>
      <form class="d-flex" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!--calling cart function-->
<?php
cart();
?>
<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-blue">
    <ul class="navbar-nav me-auto">
     <?php
      if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Wellcome Guest</a>
        </li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>wellcome ".$_SESSION['username']."</a>
        </li>";
        }
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='user_login.php'>Login</a>
        </li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='logout.php'>Logout</a>
        </li>";
        }
        ?>
    </ul>
</nav>


<!--third child-->
<div class="bg-blue text-light">
    <h3 class="text-center"> &/Home page\&</h3>
    <p class="text-center">Communication is at the heart of e-commerce and community</p>
</div>

<!--forth child-->
<div class="row">
    <div class="col-md-2 ">
        <ul class="navbar-nav bg-secondary text-center" style="height:51vh;">
            <li class="nav-item bg-secondary">
          <a class="nav-link text-black" href="#"><h4>your profile</h4></a>
        </li>
        <?php
        $username=$_SESSION['username'];
        $user_image="Select * from `user_table` where username='$username'";
        $result_image=mysqli_query($con,$user_image);
        $row_image=mysqli_fetch_array($result_image);
        $user_image=$row_image['user_image'];
        echo "<li class='nav-item bg-black'>
          <img src='./user_images/$user_image' class='profile_img' alt=''>
        </li>";
        ?>
        <li class="nav-item bg-black">
          <a class="nav-link text-light" href="profile.php">Pending order</a>
        </li>
        <li class="nav-item bg-black">
          <a class="nav-link text-light" href="profile.php?Edit_account">Edit Account</a>
        </li>
        <li class="nav-item bg-black">
          <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
        </li>
        <li class="nav-item bg-black">
          <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
        </li>
        <li class="nav-item bg-black">
          <a class="nav-link text-light" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
    <div class="col-md-10 text-center">
        <?php
        get_user_order_details();
        if(isset($_GET['Edit_account'])){
        include("Edit_account.php");
        }
        if(isset($_GET['my_orders'])){
        include("user_orders.php");
        }
        if(isset($_GET['delete_account'])){
        include("delete_account.php");
        }
        ?>
    </div>
</div>

<?php
include("../includes/footer.php");
?>
   </div>




</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>