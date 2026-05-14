<?php
if(isset($_GET['Edit_account'])){
    $user_session_name=$_SESSION['username'];
    $session_query="Select * from `user_table` where username='$user_session_name'";
    $result_query=mysqli_query($con,$session_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}
    if(isset($_POST['user_update'])){
        $update_id=$user_id;
        $user_username=$_POST['user_username'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        //accessing imgae
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        //update query
        $update_data="Update `user_table` set username='$user_username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' where user_id=$update_id";
        $result_query_update=mysqli_query($con,$update_data);
        if($result_query_update){
            echo "<script>alert('data updated successfully')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        .profile_image{
    width: 100px;
    height: 100px;
    object-fit:contain;
}
    </style>
</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" >
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_name ?>" name="user_username" >
        </div>
        <div class="form-outline mb-2">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email" >
        </div>
        <div class="form-outline mb-2 d-flex w-50 m-auto">
            <input type="file" class="form-control w-70 m-auto" name="user_image" >
            <img src="./user_images/<?php echo $user_image?>" alt="" class="profile_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address" >
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile" >
        </div>
        <input type="submit" class="btn btn-primary px-3 py-2 border-1" value="Update" name="user_update">
    </form>
</body>
</html>