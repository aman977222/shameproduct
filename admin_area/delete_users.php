<?php
if(isset($_GET['delete_users'])){
    $delete_users=$_GET['delete_users'];

    //delete query
    $delete_users="delete from `user_table` where user_id=$delete_users";
    $result_order=mysqli_query($con,$delete_users);
    if($result_order){
        echo "<script>alert('user deleted successfully')</script>";
        echo "<script>window.open('./indax.php?users_list','_self')</script>";
    }
}
?>