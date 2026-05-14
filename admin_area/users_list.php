<h3 class="text-center text-success">All users</h3>
<table class="table table-bordered mt-3 border-dark">
<thead class="table-dark text-light text-center">
<!--php code-->
<?php
$get_users="select * from `user_table`";
$result=mysqli_query($con,$get_users);
$row_count=mysqli_num_rows($result);
echo "<tr>
        <th>Sl no.</th>
        <th>user name</th>
        <th>user email</th>
        <th>user image</th>
        <th>user ip</th>
        <th>user address</th>
        <th>user mobile no.</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class='text-center'>";
if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No users yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $user_password=$row_data['user_password'];
        $user_image=$row_data['user_image'];
        $user_ip=$row_data['user_ip'];
        $user_address=$row_data['user_address'];
        $user_mobile=$row_data['user_mobile'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$username</td>
        <td>$user_email</td>
        <td><img src='../user_area/user_images/$user_image' alt='$username' class='poduct_img profile_img'/></td>
        <td>$user_ip</td>
        <td>$user_address</td>
        <td>$user_mobile</td>
        <td><a href='indax.php?delete_users=$user_id' type='button' class='' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
        }
    }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./indax.php?users_list" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="indax.php?delete_users=<?php echo $user_id; ?>" class="text-light text-decoration-none">yes</a></button>
      </div>
    </div>
  </div>
</div>