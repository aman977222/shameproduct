<?php

include('../includes/connect.php');
include('../function/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment page</title>
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>

    <!--css file link-->
    <link rel="stylesheet" href="../style.css">
    <style>
      body{
      overflow-x:hidden;
      }
      img{
        width:50%;
        height:50%;
        margin: auto;
        object-fit:contain;
      }
    </style>
</head>
<body>
    <section>
        <!--php code to access user id-->
        <?php
        $user_ip=getIPAddress();
        $select_user="Select * from `user_table` where user_ip='$user_ip'";
        $result=mysqli_query($con,$select_user);
        $run_query=mysqli_fetch_array($result);
        $user_id= $run_query['user_id'];
        ?>
        <div class="container">
            <h2 class="text-center text-info">Payment options</h2>
            <div class="row mx-auto d-flex justify-content-center align-items-center my-5">
                <!--<div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><h2 class="text-center"><img src="../image/upi.png" alt=""><br>Pay with online</a>
            </div>-->
               <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center"><img src="../image/cod.png" alt=""><br>Cash on Delivery</a>
            </div>
        </div>
        </div>
    </section>
</body>
</html>