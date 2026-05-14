<?php
if(isset($_GET['delete_order'])){
    $delete_order=$_GET['delete_order'];

    //delete query
    $delete_order="delete from `user_orders` where order_id=$delete_order";
    $result_order=mysqli_query($con,$delete_order);
    if($result_order){
        echo "<script>alert('order deleted successfully')</script>";
        echo "<script>window.open('./indax.php?orders_list','_self')</script>";
    }
}
?>