<!--connect file-->
<?php

include('../includes/connect.php');
include('../function/common_function.php');
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashbard</title>
    <!--bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
          
         <!--font awesome link-->
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
.poduct_img{
    width: 100px;
    height: 100px;
    background: rgb(29, 29, 30);
   border: 2px solid rgba(4, 251, 33, 1);
}
.admin-image {
    width: 100%;
    height: 100%;
   text-align: center;
   background: rgb(29, 29, 30);
   border: 4px solid rgb(45, 4, 251);
}
    </style>
</head>
<body>
    <section>
    <!--navbar-->
     <div class="container-fluid p-0">
        <!---first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <image src="../image/logo.png" alt="" class="logo">
                    <nav class="navbar navbar-expand-lg">
                        <ul class="navbar-nav">
    <?php
    if (!isset($_SESSION['admin_name'])) {
        // User is a GUEST (Not logged in)
        echo "
        <li class='nav-item'>
            <a class='nav-link text-light' href='#'>Welcome Guest</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link text-light' href='admin_login.php'>Login</a>
        </li>";
    } else {
        // User is LOGGED IN
        echo "
        <li class='nav-item'>
            <a class='nav-link text-black' href='#'>Welcome " . $_SESSION['admin_name'] . "</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link text-black' href='admin_logout.php'>Logout</a>
        </li>";
    }
    ?>
</ul>

                    </nav>
            </div>
        </nav>
        <!--second child-->
        <div class="bg-blue text-light">
            <h3 class="text-center p-2 ">Manage Details</h3>
            </div>
            <!--third child-->
        <div class="row">
            <div class="col-md-12 p-1 d-flex align-items-center admin-image">
                <div class="p-3">
        <?php
        $admin_name=$_SESSION['admin_name'];
        $admin_image="Select * from `admin_table` where admin_name='$admin_name'";
        $result_image=mysqli_query($con,$admin_image);
        $row_image=mysqli_fetch_array($result_image);
        $admin_image=$row_image['admin_image'];
        echo "<li class='nav-item '>
          <img src='./admin_image/$admin_image' class='profile_img' alt=''>
        </li>";
        ?>
         <p class="text-light text-center">
            <?php 
            if(!isset($_SESSION['admin_name'])){
            echo "<li class='nav-item'>
            <a class='nav-link text-light' href='#'>Wellcome Guest</a>
            </li>";
            }else{
            echo "<li class='nav-item bg-'>
            <a class='nav-link text-light' href='#'>wellcome ".$_SESSION['admin_name']."</a>
            </li>";
            }?></p>
                </div>
                <div class="button text-center botton-design">
                    <button class="my-2"><a href="insert_product.php" class="nav-link text-light bg-black ">Insert Products</a></button>
                    <button class="my-2"><a href="indax.php?view_products" class="nav-link text-light bg-black ">View Products</a></button>
                    <button class="my-2"><a href="indax.php?insert_Categories" class="nav-link text-light bg-black ">Insert Categories</a></button>
                    <button class="my-2"><a href="indax.php?view_categories" class="nav-link text-light bg-black ">View Categories</a></button>
                    <button class="my-2"><a href="indax.php?insert_brand" class="nav-link text-light bg-black ">Insert Brands</a></button>
                    <button class="my-2"><a href="indax.php?view_brands" class="nav-link text-light bg-black ">View Brands</a></button>
                    <button class="my-2"><a href="indax.php?orders_list" class="nav-link text-light bg-black ">All orders</a></button>
                    <button class="my-2"><a href="indax.php?orders_payment" class="nav-link text-light bg-black ">All payments</a></button>
                    <button class="my-2"><a href="indax.php?users_list" class="nav-link text-light bg-black ">users list</a></button>
                    <button class="my-2"><a href="admin_registration.php" class="nav-link text-light bg-black ">admin registration</a></button>
                    <button class="my-2"><a href="indax.php?contact_list" class="nav-link text-light bg-black ">contact list</a></button>
                </div>
            </div>
        </div>

        <!--fourth child-->
        <div class="container m-3">
            <?php
            if(isset($_GET['insert_Categories'])){
                include('Insert_Categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_product'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['edit_categories'])){
                include('edit_categories.php');
            }
            if(isset($_GET['edit_Brands'])){
                include('edit_Brands.php');
            }
            if(isset($_GET['delete_categories'])){
                include('delete_categories.php');
            }
            if(isset($_GET['delete_Brands'])){
                include('delete_Brands.php');
            }
            if(isset($_GET['delete_payment'])){
                include('delete_payment.php');
            }
            if(isset($_GET['delete_users'])){
                include('delete_users.php');
            }
            if(isset($_GET['orders_list'])){
                include('orders_list.php');
            }
            if(isset($_GET['delete_order'])){
                include('delete_order.php');
            }
            if(isset($_GET['orders_payment'])){
                include('orders_payment.php');
            }
            if(isset($_GET['users_list'])){
                include('users_list.php');
            }
            if(isset($_GET['contact_list'])){
                include('contact_list.php');
            }
            if(isset($_GET['delete_cont_mess'])){
                include('delete_cont_mess.php');
            }
            ?>
        </div>
        <!--last child
      <div class="text-light p-0 text-center footer">
       <p>reserved Designd by aman(vgu24ons2bca****)</p>
      </div>-->
      <?php
include("../includes/footer.php");
?>
     </div>
    </section>

   <!--bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</body>
</html>