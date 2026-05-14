<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
  $category_title=$_POST['cat_title'];

  // select data from database
$select_query="select * from `categories` where categories_title='$category_title'";
$result_select= mysqli_query($con,$select_query);
$number=mysqli_num_rows($result_select);
if($number>0){
  echo"<script>alert('this categories is present inside the database')</script>";
}else{
$insert_query="insert into `categories` (`categories_title`) values ('$category_title')";
$result = mysqli_query($con,$insert_query);
if($result){
  echo"<script>alert('category has been inserted successfully')</script>";
}
}
}
?>
<h2 class="text-center text-white">Insert categories</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2 ">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control " name="cat_title" placeholder="Insert Categories" aria-label="categories" aria-describedby="basic-addon1" autocomplete="off">
</div>
<div class="input-group w-10 mb-2 m-auto ">
  <input type="submit" class=" bg-black text-light broder-2 " name="insert_cat" value="Insert Categories">

</div>
</form>