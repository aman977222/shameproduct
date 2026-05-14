<?php
if(isset($_GET['delete_Brands'])){
    $delete_Brands=$_GET['delete_Brands'];

    //delete query
    $delete_Brands="delete from `brands` where Brands_id=$delete_Brands";
    $result_Brands=mysqli_query($con,$delete_Brands);
    if($result_Brands){
        echo "<script>alert('Brands deleted successfully')</script>";
        echo "<script>window.open('./indax.php?view_brands','_self')</script>";
    }
}
?>