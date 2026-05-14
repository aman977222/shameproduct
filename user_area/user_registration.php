<?php
include('../includes/connect.php');
include('../function/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user registration</title>
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
            <h2 class="text-center text-light">New User registration</h2>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- username fild-->
                        <div class="form-outline mb-3">
                            <label for="user_username" class="form-label text-light">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                        </div>
                        <!-- email fild-->
                        <div class="form-outline mb-3">
                            <label for="user_email" class="form-label text-light">Email</label>
                            <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email">
                        </div>
                        <!-- image fild-->
                        <div class="form-outline mb-3">
                            <label for="user_image" class="form-label text-light">user image</label>
                            <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                        </div>
                        <!-- password fild-->
                        <div class="form-outline mb-3">
                            <label for="user_password" class="form-label text-light">password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                        </div>
                        <!-- confirm password fild-->
                        <div class="form-outline mb-3">
                            <label for="conf_user_password" class="form-label text-light">confirm password</label>
                            <input type="password" id="conf_user_password" class="form-control" placeholder="Enter your confirm password" autocomplete="off" required="required" name="conf_user_password">
                        </div>
                        <!-- Address fild-->
                        <div class="form-outline mb-3">
                            <label for="user_address" class="form-label text-light">Address</label>
                            <input type="text" id="user_address" class="form-control" placeholder="Enter your Address" autocomplete="off" required="required" name="user_address">
                        </div>
                        <!-- contact fild-->
                        <div class="form-outline mb-3">
                            <label for="user_mobile" class="form-label text-light">Contact</label>
                            <input type="text" id="user_mobile" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_mobile">
                        </div>
                        <!-- login from link-->
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Register" class="bg-black text-light py-2 px-3" name="user_register">
                            <p class="text-light fw-bold mt-2 pt-1">Already have an account ? <a href="user_login.php"> login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
</body>
</html>

<!-- php code-->
<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hashed_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_mobile=$_POST['user_mobile'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();
    //select query
    $select_query="select * from `user_table` where username='$user_username' or user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo"<script>alert('username or email already exist')</script>";
    }elseif($user_password!=$conf_user_password){
        echo"<script>alert('password do not match')</script>";
    }
    else{
    //insert query
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $inset_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hashed_password','$user_image','$user_ip','$user_address','$user_mobile')";
    $sql_execute=mysqli_query($con,$inset_query);
    echo"<script>window.open('user_login.php','_self')</script>";
    }

    //selecting cart items
    $select_cart_items="select * from `cart_details` where ip_address='$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_items);
    $rows_count_cart=mysqli_num_rows($result_cart);
    if($rows_count_cart>0){
        $_SESSION['username']=$user_username;
        echo"<script>alert('You have items in your cart')</script>";
        echo"<script>window.open('checkout.php','_self')</script>";
}
else{
    echo"<script>window.open('../index.php','_self')</script>";
}
}
?>