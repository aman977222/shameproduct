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
    <title>Admin login</title>
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
        <h2 class="text-center mb-5 text-light">Admin login</h2>
        <div class="row d-flex justify-center ">
            <div class="col-lg-6 col-xl-5 m-auto">
                <img src="../image/admin.jpg" alt="Admin login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4 m-auto">
                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-outline mb-4 ">
                        <label for="admin_name" class="form-label text-light "><h4>Admin Name</h4></label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter your admin name" required="required" class="form-control m-auto">
                    </div>
                    <div class="form-outline mb-4 ">
                        <label for="admin_password" class="form-label text-light "><h4>Admin Password</h4></label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Enter your admin Password" required="required" class="form-control m-auto">
                    </div>
                    <div>
                        <p class="text-light fw-bold mt-2 pt-1">don't have an account ? <a href="#"> Registration </a></p>
                        <input type="submit" class="bg-dark py-2 px-3 broder-0" name="admin_login" value="login">
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

<?php
if(isset($_POST['admin_login'])){
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    if($row_count > 0){
        $row_data = mysqli_fetch_assoc($result);
        
        if(password_verify($admin_password, $row_data['admin_password'])){
            $_SESSION['admin_name'] = $admin_name;
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.open('indax.php','_self');</script>";
        } else {
            echo "<script>alert('Invalid credentials (password)');</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials (username)');</script>";
    }
}
?>
