<?php
if(isset($_GET['delete_categories'])){
    $delete_categories=$_GET['delete_categories'];

    //delete query
    $delete_categories="delete from `categories` where categories_id=$delete_categories";
    $result_categories=mysqli_query($con,$delete_categories);
    if($result_categories){
        echo "<script>alert('categories deleted successfully')</script>";
        echo "<script>window.open('./indax.php?view_categories','_self')</script>";
    }
}
?>