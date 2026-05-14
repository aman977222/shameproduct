<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_categories=$_POST['product_categories'];
    $product_Brands=$_POST['product_Brands'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    //accessing images
    $product_Image1=$_FILES['product_Image1']['name'];
    $product_Image2=$_FILES['product_Image2']['name'];
    $product_Image3=$_FILES['product_Image3']['name'];
    
    //accessing image tmp name
    $temp_Image1=$_FILES['product_Image1']['tmp_name'];
    $temp_Image2=$_FILES['product_Image2']['tmp_name'];
    $temp_Image3=$_FILES['product_Image3']['tmp_name'];

    //checking empty condition
    if($product_title=='' or $description=='' or $product_keywords=='' or $product_categories=='' or $product_Brands=='' or $product_price=='' or $product_Image1=='' or $product_Image2=='' or $product_Image3==''){
        echo"<script>('please fill all the available fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_Image1,"./product_images/$product_Image1");
        move_uploaded_file($temp_Image2,"./product_images/$product_Image2");
        move_uploaded_file($temp_Image3,"./product_images/$product_Image3");

        //insert query
        $inset_products="insert into `products` (date,status,product_title,product_description,product_keywords,category_id,brand_id,product_Image1,product_Image2,product_Image3,product_price) values (NOW(),'$product_status','$product_title','$description','$product_keywords','$product_categories','$product_Brands','$product_Image1','$product_Image2','$product_Image3','$product_price')";
        $result_query=mysqli_query($con,$inset_products);
        if($result_query){
            echo "<script>alert('product insert successfully')</script>";
        echo "<script>window.open('./indax.php','_self')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserts product Admin Dashboard</title>
    <!--bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
          
         <!--font awesome link-->
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>

        <!--css file link-->
    <link rel="stylesheet" href="../style.css">
     <style>
      body{
      overflow-x:hidden;
      }
    </style>
</head>
<body>
     <section>
    <div class="container">
        <h1 class="text-center text-light"> Insert Products</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="product_title" class="form-label "><h5>product title</h5></label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
        <!--description-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="description" class="form-label"><h5>description</h5></label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter description" autocomplete="off" required="required">
            </div>
            <!--product_keywords-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="product_keywords" class="form-label"><h5>product keywords</h5></label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!--categories-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <h5>category</h5>
                <select name="product_categories" id="" class="form-select">
                    <option value="">select a category</option>
                    <?php
                    $select_query="select * from `categories`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['categories_title'];
                        $category_id=$row['categories_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
</div>
              <!--Brands-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <h5>Brands</h5>
                <select name="product_Brands" id="" class="form-select">
                    <option value="">select a Brands</option>
                     <?php
                    $select_query="select * from `brands`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $brand_title=$row['Brands_title'];
                        $brand_id=$row['Brands_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
              </div>
              <!--Image 1-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="product_Image1" class="form-label"><h5>product Image1</h5></label>
                <input type="file" name="product_Image1" id="product_Image1" class="form-control" required="required">
            </div>
             <!--Image 2-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="product_Image2" class="form-label"><h5>product Image2</h5></label>
                <input type="file" name="product_Image2" id="product_Image2" class="form-control" required="required">
            </div>
             <!--Image 3-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="product_Image3" class="form-label"><h5>product Image3</h5></label>
                <input type="file" name="product_Image3" id="product_Image3" class="form-control" required="required">
            </div>
            <!--product_price-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <label for="product_price" class="form-label"><h5>product price</h5></label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!--product_price-->
            <div class="form-outline text-light mb-2 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert products">
            </div>
        </form>
    </div>
</section>
</body>
</html>