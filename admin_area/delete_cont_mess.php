<?php
if(isset($_GET['delete_cont_mess'])){
    $delete_cont_mess=$_GET['delete_cont_mess'];

    //delete query
    $delete_cont_mess="delete from `contact_from` where contact_id=$delete_cont_mess";
    $result_order=mysqli_query($con,$delete_cont_mess);
    if($result_order){
        echo "<script>alert('order deleted successfully')</script>";
        echo "<script>window.open('./indax.php?contact_list','_self')</script>";
    }
}
?>