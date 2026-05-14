<?php
if(isset($_GET['edit_product'])){
    $edit_id=$_GET['edit_product'];
    $get_data="select * from `products` where product_id=$edit_id";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_keywords=$row['product_keywords'];
    $category_id=$row['category_id'];
    $brand_id=$row['brand_id'];
    $product_Image1=$row['product_Image1'];
    $product_Image2=$row['product_Image2'];
    $product_Image3=$row['product_Image3'];
    $product_price=$row['product_price'];

    //fetchig category
    $select_category="select * from `categories` where categories_id=$category_id";
    $result_category=mysqli_query($con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $categories_title=$row_category['categories_title'];
    //echo $categories_title;

    //fetchig brands
    $select_brands="select * from `brands` where Brands_id=$brand_id";
    $result_brands=mysqli_query($con,$select_brands);
    $row_brands=mysqli_fetch_assoc($result_brands);
    $brands_title=$row_brands['Brands_title'];
    //echo $brands_title;
}
?>
<div class="container mt-5">
    <h1 class="text-center text-danger">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label text-light">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title; ?>" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label text-light">Product Description</label>
            <input type="text" id="product_desc" value="<?php echo $product_description; ?>" name="product_desc" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label text-light">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords ?>" name="product_keywords" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label text-light">Product category</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $categories_title; ?>"><?php echo $categories_title; ?></option>
                <?php
                $select_category_all="select * from `categories`";
                $result_category_all=mysqli_query($con,$select_category_all);
                while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                    $categories_title=$row_category_all['categories_title'];
                     $categories_id=$row_category_all['categories_id'];
                     echo "<option value='$categories_id'>$categories_title</option>";
                };
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brands" class="form-label text-light">Product brands</label>
            <select name="product_brands" class="form-select">
                <option value="<?php echo $brands_title; ?>"><?php echo $brands_title; ?></option>
                <?php
                $select_brands_all="select * from `brands`";
                $result_brands_all=mysqli_query($con,$select_brands_all);
                while($row_brands_all=mysqli_fetch_assoc($result_brands_all)){
                $brands_title=$row_brands_all['Brands_title'];
                $brands_id=$row_brands_all['Brands_id'];
                echo "<option value='$brands_id'>$brands_title</option>";
                };
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label text-light">Product Image1</label>
            <div class="d-flex">
                <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
                <img src="./product_images/<?php echo $product_Image1 ?>" alt="" class="poduct_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label text-light">Product Image2</label>
            <div class="d-flex">
                <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required="required">
                <img src="./product_images/<?php echo $product_Image2 ?>" alt="" class="poduct_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label text-light">Product Image3</label>
            <div class="d-flex">
                <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required="required">
                <img src="./product_images/<?php echo $product_Image3 ?>" alt="" class="poduct_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label text-light">Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price ?>" name="product_price" class="form-control" required="required">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>

<!-- editing product-->
 <?php
 if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];
    $product_desc=$_POST['product_desc'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];

    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    //cheching fo fields empty or not
    if($product_title=='' or $product_desc=='' or $product_keywords=='' or $product_category=='' or $product_brands=='' or $product_price=='' or $product_Image1=='' or $product_Image2=='' or $product_Image3==''){
        echo "<script>alert('please fill all the  fileds and continue the process')</script>";
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");

        //product update query
        $update_product="update `products` set date=NOW(),product_title='$product_title',product_description='$product_desc',product_keywords='$product_keywords',category_id='$product_category',brand_id='$product_brands',product_Image1='$product_image1',product_Image2='$product_image2',product_Image3='$product_image3',product_price='$product_price' where product_id=$edit_id";
        $result_update=mysqli_query($con,$update_product);
        if($result_update){
            echo "<script>alert('product update successfully')</script>";
            echo "<script>window.open('./indax.php?edit_products','_self')</script>";
        }
    }
 }
 ?>