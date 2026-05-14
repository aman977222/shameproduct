<!--connect file-->
<?php

include('includes/connect.php');
include('function/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact form</title>
<!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>

    <!--css file link-->
    <link rel="stylesheet" href="style.css">
    <style>
      body{
      overflow-x:hidden;
      }
    </style>
</head>
    <body>
      <section>
        <div class="container-fluid">
            <h2 class="text-center text-light">Contact Form</h2>
            <div class="row d-flex align-items-center justify-content-center mt-5">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- username fild-->
                        <div class="form-outline mb-3">
                            <label for="user_username" class="form-label text-light">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                        </div>
                        <div class="form-outline mb-3">
                            <label for="email" class="form-label text-light">Email</label>
                            <input type="text" id="email" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="email">
                        </div>
                        <div class="form-outline mb-3">
                            <label for="mobile_number" class="form-label text-light">Mobile_number</label>
                            <input type="text" id="mobile_number" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="mobile_number">
                        </div>
                        <div class="form-outline mb-3">
                        <label for="user_username" class="form-label text-light">Messages</label>
                        <textarea type="text" name="messages" id="" cols="100" rows="5" placeholder="Emter Your messages" autocomplete="off" required="required"></textarea>
                        </div>
                        <!-- registration from link-->
                        <div class="mt-4 pt-2">
                            <input type="submit" value="submit" class="bg-black text-light py-2 px-3" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

<!-- php code -->
 <?php
if(isset($_POST['submit'])){
    $user_username=$_POST['user_username'];
    $email=$_POST['email'];
    $mobile_number=$_POST['mobile_number'];
    $messages=$_POST['messages'];
    //insert query
        $inset_query="insert into `contact_from` (username,email,user_mobile,messages) values ('$user_username','$email','$mobile_number','$messages')";
    $sql_execute=mysqli_query($con,$inset_query);
    echo"<script>window.open('index.php','_self')</script>";
    }
?>