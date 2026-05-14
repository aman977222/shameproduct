<?php
if(isset($_GET['delete_payment'])){
    $delete_payment=$_GET['delete_payment'];

    //delete query
    $delete_payment="delete from `user_payments` where payment_id=$delete_payment";
    $result_payment=mysqli_query($con,$delete_payment);
    if($result_payment){
        echo "<script>alert('payment deleted successfully')</script>";
        echo "<script>window.open('./indax.php?orders_payment','_self')</script>";
    }
}
?>