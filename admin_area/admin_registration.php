<?php
include('../includes/connect.php');
include('../function/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registration</title>
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
    </style>
</head>
<body>
    <section>
    <div class="container-fulid">
        <h2 class="text-center mb-5 text-light">Admin Registration</h2>
        <div class="row d-flex justify-center ">
            <div class="col-lg-6 col-xl-5 m-auto">
                <img src="../image/admin_reg.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4 m-auto">
                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-outline mb-4 ">
                        <label for="admin_name" class="form-label text-light "><h4>Admin Name</h4></label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter your admin name" required="required" class="form-control m-auto">
                    </div>
                    <div class="form-outline mb-4 ">
                        <label for="admin_email" class="form-label text-light "><h4>Admin Email</h4></label>
                        <input type="text" id="admin_email" name="admin_email" placeholder="Enter your admin email" required="required" class="form-control m-auto">
                    </div>
                    <div class="form-outline mb-3">
                            <label for="admin_image" class="form-label text-light"><h4>admin image</h4></label>
                            <input type="file" id="admin_image" class="form-control" required="required" name="admin_image">
                        </div>
                    <div class="form-outline mb-4 ">
                        <label for="admin_password" class="form-label text-light "><h4>Admin Password</h4></label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Enter your admin Password" required="required" class="form-control m-auto">
                    </div>
                    <div class="form-outline mb-4 ">
                        <label for="confirm_password" class="form-label text-light "><h4>Confirm Password</h4></label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your Confirm Password" required="required" class="form-control m-auto">
                    </div>
                    <div>
                        <p class="text-light fw-bold mt-2 pt-1">Already have an account ? <a href="admin_login.php"> login</a></p>
                        <input type="submit" class="bg-dark py-2 px-3 broder-0 text-light" name="admin_reg" value="Registration">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</section>
</body>
</html>

<!-- php code-->
<?php
if(isset($_POST['admin_reg'])){
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hashed_password=password_hash($admin_password,PASSWORD_DEFAULT);
    $confirm_password=$_POST['confirm_password'];
    $admin_image=$_FILES['admin_image']['name'];
    $admin_image_tmp=$_FILES['admin_image']['tmp_name'];
    //select query
    $select_query="select * from `admin_table` where admin_name='$admin_name' or admin_email='$admin_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo"<script>alert('username or email already exist')</script>";
    }elseif($admin_password!=$confirm_password){
        echo"<script>alert('password do not match')</script>";
    }
    else{
    //insert query
    move_uploaded_file($admin_image_tmp,"./admin_image/$admin_image");
        $inset_query="insert into `admin_table` (admin_name,admin_email,admin_image,admin_password) values ('$admin_name','$admin_email','$admin_image','$hashed_password')";
    $sql_execute=mysqli_query($con,$inset_query);
    echo"<script>window.open('admin_registration.php','_self')</script>";
    }
}
?>