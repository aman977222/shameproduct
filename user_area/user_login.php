<?php
include('../includes/connect.php');
include('../function/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!--css file link-->
    <link rel="stylesheet" href="../style.css">
     <style>
      body{
      overflow-x:hidden;
      }
    </style>
</head>
<body>
    <section>
        <div class="container-fluid">
            <h2 class="text-center text-light">User login</h2>
            <div class="row d-flex align-items-center justify-content-center mt-5">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- username fild-->
                        <div class="form-outline mb-3">
                            <label for="user_username" class="form-label text-light">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                        </div>
                        <!-- password fild-->
                        <div class="form-outline mb-3">
                            <label for="user_password" class="form-label text-light">password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                        </div>
                        <!-- registration from link-->
                        <div class="mt-4 pt-2">
                            <input type="submit" value="login" class="bg-black text-light py-2 px-3" name="user_login">
                            <p class="text-light fw-bold mt-2 pt-1">Don't have an account ? <a href="user_registration.php"> registration</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
     $select_query="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $ip=getIPAddress();

    //cart item
     $select_query_cart="Select * from `cart_detalis` where ip_address='$ip'";
     $select_cart=mysqli_query($con,$select_query_cart);
        $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            //echo "<script>alert('Login successful')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                //echo "<script>window.open('../index.php','_self')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
        }else{
            $_SESSION['username']=$user_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }
        }else{
            echo "<script>alert('Invalid password')</script>";
        }
    }else{
        echo "<script>alert('Invalid username')</script>";
    }
    }
?>