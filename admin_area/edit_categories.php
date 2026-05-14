<?php
if(isset($_GET['edit_categories'])){
    $edit_categories=$_GET['edit_categories'];
    $get_categories="select * from `categories` where categories_id=$edit_categories";
    $result=mysqli_query($con,$get_categories);
    $row=mysqli_fetch_assoc($result);
    $categories_title=$row['categories_title'];
    //echo $categories_title;
}
if(isset($_POST['edit_cat'])){
    $cat_title=$_POST['categories_title'];
    $update_query="update `categories` set categories_title='$cat_title' where categories_id=$edit_categories";
    $result_cat=mysqli_query($con,$update_query);
    if($result_cat){
        echo "<script>alert('categorie update successfully')</script>";
        echo "<script>window.open('./indax.php?view_categories','_self')</script>";
    }
}
?>
<div class="container mt-2">
    <h1 class="text-center text-primary">Edit categorie</h1>
    <form action="" method="post" class="text-center">
        <div class="from-outline mb-4 ">
            <label for="categories_title" class="form-label text-light">Category title</label>
            <input type="text" name="categories_title" id="categories_title" class="form-control w-50 m-auto" required="required" value="<?php echo $categories_title; ?>">
        </div>
        <input type="submit" value="update category" class="btn btn-dark text-light px-3 mb-3" name="edit_cat">
    </form>
</div>