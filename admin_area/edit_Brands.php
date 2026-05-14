<?php
if(isset($_GET['edit_Brands'])){
    $edit_Brands=$_GET['edit_Brands'];
    $get_Brands="select * from `brands` where Brands_id=$edit_Brands";
    $result=mysqli_query($con,$get_Brands);
    $row=mysqli_fetch_assoc($result);
    $Brands_title=$row['Brands_title'];
    //echo $Brands_title;
}
if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['Brands_title'];
    $update_query="update `Brands` set Brands_title='$brand_title' where Brands_id=$edit_Brands";
    $result_brand=mysqli_query($con,$update_query);
    if($result_brand){
        echo "<script>alert('brands update successfully')</script>";
        echo "<script>window.open('./indax.php?view_brands','_self')</script>";
    }
}
?>
<div class="container mt-2">
    <h1 class="text-center text-primary">Edit brands</h1>
    <form action="" method="post" class="text-center">
        <div class="from-outline mb-4 ">
            <label for="Brands_title" class="form-label text-light">brand title</label>
            <input type="text" name="Brands_title" id="Brands_title" class="form-control w-50 m-auto" required="required" value="<?php echo $Brands_title; ?>">
        </div>
        <input type="submit" value="update brand" class="btn btn-dark text-light px-3 mb-3" name="edit_brand">
    </form>
</div>